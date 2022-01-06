let weather = {
    "apiKey": "8f3ed20e764f68f036c1791590c0cc19",
    fetchWeather: function (city) {
    
    fetch("https://api.openweathermap.org/data/2.5/forecast?q=" + city + "&units=metric&appid=" + this.apiKey)
    .then((responose) => responose.json())
    .then((data) => this.displayWeather(data)).catch(error => document.querySelector('.info').classList.remove('invisible'));
        
    },
    displayWeather: function (data) {
        const {temp, feels_like, temp_min, temp_max, pressure,  humidity} = data.list[0].main;
        const {description, icon} = data.list[0].weather[0];
        const {speed} = data.list[0].wind;
        const {name} = data.city;

        // console.log(description,icon, name, speed);
        
        for(let i = 0; i < 5; i++){
            document.querySelector('#day' + (i+1)).innerHTML = Math.trunc(data.list[i].main.temp) + '℃';
        };
        for(let i = 0; i < 5; i++){
            document.querySelector('#img' + (i+1)).src = "http://openweathermap.org/img/wn/" + data.list[i].weather[0].icon + "@2x.png";
        };
        
        
        

        const roDescriptions = ['Cer senin','Partial noros','Nori rasfirati', 'Nori imprastiati', 'Innorat', 'Ploaie usoara', 'Ploaie usoara', 'Ploaie','Furtuna', 'Ninsoare', 'Cetos'];

        const enDescriptions = ['clear sky', 'few clouds', 'scattered clouds', 'broken clouds', 'overcast clouds', 'shower rain', 'light rain', 'rain', 'thunderstorm', 'snow', 'mist'];

        let vremea = enDescriptions.indexOf(description);
        let vremeaRo = roDescriptions[vremea];

        document.querySelector('.city').innerText = 'Vremea in ' + name;
        document.querySelector('.icon').src = "http://openweathermap.org/img/wn/" + icon + "@2x.png";
        document.querySelector('.description').innerText = vremeaRo;
        document.querySelector('.temp').innerText = `🌡 Temperatura este de ${Math.trunc(temp)}℃, se simte ca ${Math.trunc(feels_like)}℃`;
        document.querySelector('.min-max').innerText = `Temperatura minima este de ${temp_min}℃ iar temperatura maxima este de ${temp_max}℃`
        document.querySelector('.humidity').innerText = `💧 Umiditate: ${humidity}%`;
        document.querySelector('.wind').innerText = `💨 Viteza vantului ${speed} km/h`;
        document.querySelector('.pressure').innerText = `Presiunea atmosferica este de ${pressure} milibari`;
        document.querySelector('.test').classList.remove('invisible');
        document.querySelector('.info').classList.add('invisible');
        document.querySelector('.search-bar').value = '';
    },
    search: function () { 
        this.fetchWeather(document.querySelector('.search-bar').value);
    }
};

document.querySelector('.search button').addEventListener('click', function(){
    weather.search();
});

document.querySelector('.search-bar').addEventListener('keyup', function(event){
    if(event.key == 'Enter') weather.search();
});
