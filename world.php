<?php
$host = 'localhost:8111';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';
$country = filter_input(INPUT_GET, "country", FILTER_SANITIZE_STRING);
$context = filter_input(INPUT_GET, "context", FILTER_SANITIZE_STRING);
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$allCities= $conn->query("SELECT cities.name, cities.district, cities.population 
          FROM cities JOIN countries ON cities.country_code = countries.code
          WHERE countries.name = '$country'");
          
$city = $allCities->fetchAll(PDO::FETCH_ASSOC);
?>


<?php if(!isset($context)):?>
  <link href="world.css" type="text/css" rel="stylesheet" />
  <table class = "table1">
    <caption><h2>COUNTRIES</h2></caption>
    <thead>
      <tr>
        <th class = "t1">Name</th>
        <th class = "t2">Continent</th>
        <th class = "t3">Independence</th>
        <th class = "t4">Name of State</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($results as $country): ?>
        <tr>
          <td><?php echo $country['name']; ?></td>
          <td><?php echo $country['continent']; ?></td>
          <td><?php echo $country['independence_year']; ?></td>
          <td><?php echo $country['head_of_state']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
<?php if(isset($context)):?>
  <link href="world.css" type="text/css" rel="stylesheet" />
  <table class = "table2">
    <caption><h2>CITIES</h2></caption>
    <thead>
      <tr>
        <th class = "t5">Name</th>
        <th class = "t6">District</th>
        <th class = "t7">Population</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($city as $city): ?>
        <tr>
          <td><?php echo $city['name']; ?></td>
          <td><?php echo $city['district']; ?></td>
          <td><?php echo $city['population']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>