window.onload = getCountries;
function getCountries(){
    let button1 = document.getElementById('lookup');
    let res = document.getElementById('result');
    button1.addEventListener('click',function(e){
        e.preventDefault();
        var countries = document.getElementById('country').value;
        fetch('world.php' + '?country=' + countries)
        .then (response=> {
            if (response.ok){
                return response.text()
            } else{
                return Promise.reject("Something is wrong")
            }
        })
        .then(data=>{
            res.innerHTML= data;
        })
        .catch(error=> console.log('An error has occured: ' + error));
    });

}





