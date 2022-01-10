<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Weather</title>
</head>

<body class="fundal w-full h-full bg-no-repeat bg-cover bg-scroll sm:h-screen" style="background-image: url(https://cdn.pixabay.com/photo/2012/04/14/16/37/sky-34536_960_720.png);">
    <div class=" py-5 px-8 flex flex-wrap border-b-1 space-y-2">
        <img src="https://cdn0.iconfinder.com/data/icons/ballicons/128/cloud-512.png" alt="" class="w-9 h-9">
        <a href="index.php" class="text-white font-semibold flex-auto text-xl sm:ml-2 text-center md:text-left">Weather App</a>
        <nav class="text-white sm:text-lg font-semibold space-x-6 text-sm md:items-center text-right">
            <?php
            if (isset($_SESSION['name'])) {
            ?>
                <div class="inline space-x-8">
                    <a href=""><?php echo ucfirst($_SESSION['name']); ?></a>
                    <a href="php/logout.php">Logout</a>
                </div>
            <?php
            }
            ?>
            <a class="hover:text-blue-300 transition duration-200" href="index.php">Acasa</a>
            <a class="hover:text-blue-300 transition duration-200" href="php/signIn.php">Sign in</a>
            <a class="hover:text-blue-300 transition duration-200" href="php/login.php">Login</a>
        </nav>
    </div>
    <div>
        <div class="info invisible text-lg text-black w-2/6 m-auto p-1 bg-red-400 text-center font-semibold rounded-lg">Numele orasului a fost introdus gresit</div>
        <div class="card">
            <div class="search w-3/6 m-auto flex flex-wrap justify-center space-x-4 mt-4">
                <input type="text" class="search-bar bg-gray-100 text-black font-semibold mt-3 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-700 focus:ring-opacity-50 border border-gray-700">
                <button class="bg-red-700 mt-3 w-20 rounded-xl hover:bg-red-400 hover:-translate-y-1 transform transition">&rarr;</button>
            </div>
        </div>

        <div class="weather mt-32 flex justify-center items-center">
            <div class="test invisible bg-gray-900 bg-opacity-80 flex flex-col px-5 py-4 text-white rounded-lg">
                <h2 class="city text-xl font-semibold text-center">Vremea in ...</h2>
                <h2 class="dayz text-xl font-semibold text-center mb-10">Ziua actuala</h2>
                <div class="temp">5℃</div>
                <div class="min-max">Temperatura maxima/minima</div>
                <div class="flex flex-wrap items-center space-x-10">
                    <img src="" alt="" class="icon w-24 h-24">
                    <div class="description text-lg font-semibold">Senin</div>
                </div>
                <div class="humidity">Umiditate in parametri normali</div>
                <div class="wind">Viteza vantului: 25km/h</div>
                <div class="pressure">Presiune: 2040 milibari</div>
            </div>
        </div>

        <?php
        if (isset($_SESSION['name'])) {
        ?>
            <div id="weatherContainer" class="invisible">
                <div id="iconsContainer" class="flex flex-wrap mt-24 px-24 lg:space-x-60 xl:space-x-60">
                    <div class="icons bg-black bg-opacity-40 text-white rounded-md py-2 px-4">
                        <h1 id="currentDay1" class="text-center">Day</h1>
                        <div class="image"><img src="photo.png" class="imgClass" id="img1"></div>
                        <p class="descriere1 text-center">Insorit</p>
                        <p class="text-center mt-5" id="day1">10</p>

                    </div>
                    <div class="icons bg-black bg-opacity-40 text-white rounded-md py-2 px-4">
                        <h1 id="currentDay2" class="text-center">Day</h1>
                        <div class="image"><img src="photo.png" class="imgClass" id="img2"></div>
                        <p class="descriere2 text-center">Insorit</p>
                        <p class="text-center mt-5" id="day2">10</p>

                    </div>
                    <div class="icons bg-black bg-opacity-40 text-white rounded-md py-2 px-4">
                        <h1 id="currentDay3" class="text-center">Day</h1>
                        <div class="image"><img src="photo.png" class="imgClass" id="img3"></div>
                        <p class="descriere3 text-center">Insorit</p>
                        <p class="text-center mt-5" id="day3">10</p>

                    </div>
                    <div class="icons bg-black bg-opacity-40 text-white rounded-md py-2 px-4">
                        <h1 id="currentDay4" class="text-center">Day</h1>
                        <div class="image"><img src="photo.png" class="imgClass" id="img4"></div>
                        <p class="descriere4 text-center">Insorit</p>
                        <p class="text-center mt-5" id="day4">10</p>

                    </div>
                    <div class="icons bg-black bg-opacity-40 text-white rounded-md py-2 px-4">
                        <h1 id="currentDay5" class="text-center">Day</h1>
                        <div class="image"><img src="photo.png" class="imgClass" id="img5"></div>
                        <p class="descriere5 text-center">Insorit</p>
                        <p class="text-center mt-5" id="day5">10</p>

                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <script>
        let weather = {
            "apiKey": "8f3ed20e764f68f036c1791590c0cc19",
            fetchWeather: function(city) {

                fetch("https://api.openweathermap.org/data/2.5/forecast?q=" + city + "&units=metric&appid=" + this.apiKey)
                    .then((responose) => responose.json())
                    .then((data) => this.displayWeather(data)).catch(error => document.querySelector('.info').classList.remove('invisible'));

            },
            displayWeather: function(data) {
                const {
                    temp,
                    feels_like,
                    temp_min,
                    temp_max,
                    pressure,
                    humidity
                } = data.list[0].main;
                const {
                    description,
                    icon
                } = data.list[0].weather[0];
                const {
                    speed
                } = data.list[0].wind;
                const {
                    name
                } = data.city;


                const roDescriptions = ['Cer senin', 'Partial noros', 'Nori rasfirati', 'Nori imprastiati', 'Innorat', 'Ploaie usoara', 'Ploaie usoara', 'Ploaie moderata', 'Ploaie', 'Furtuna', 'Ninsoare usoara', 'Ninsoare', 'Cetos'];

                const enDescriptions = ['clear sky', 'few clouds', 'scattered clouds', 'broken clouds', 'overcast clouds', 'shower rain', 'light rain', 'moderate rain', 'rain', 'thunderstorm', 'light snow', 'snow', 'mist'];

                const weekdays = ['Duminica', 'Luni', 'Marti', 'Miercuri', 'Joi', 'Vineri', 'Sambata', 'Duminica', 'Luni', 'Marti', 'Miercuri', 'Joi', 'Vineri', 'Sambata', 'Duminica'];

                <?php if (isset($_SESSION['name'])) {
                ?>
                    for (let i = 0; i < 5; i++) {
                        document.querySelector('#day' + (i + 1)).innerHTML = '🌡 ' + Math.trunc(data.list[i].main.temp) + '℃';
                    };
                    for (let i = 0; i < 5; i++) {
                        document.querySelector('#img' + (i + 1)).src = "http://openweathermap.org/img/wn/" + data.list[i].weather[0].icon + "@2x.png";
                    };
                    for (let i = 0; i < 5; i++) {
                        document.querySelector('.descriere' + (i + 1)).innerHTML = roDescriptions[enDescriptions.indexOf(data.list[i].weather[0].description)];
                    };
                    for (let i = 0; i < 5; i++) {
                        document.querySelector('#currentDay' + (i + 1)).innerHTML = weekdays[new Date().getDay() + (i + 1)];
                    };
                <?php
                }
                ?>

                let vremea = enDescriptions.indexOf(description);
                let vremeaRo = roDescriptions[vremea];

                document.querySelector('.city').innerText = 'Vremea in ' + name;
                document.querySelector('.dayz').innerText = weekdays[new Date().getDay()];
                document.querySelector('.icon').src = "http://openweathermap.org/img/wn/" + icon + "@2x.png";
                if (icon == '02d' || icon == '03d' || icon == '04d' || icon == '02n' || icon == '03n' || icon == '04n') {
                    document.body.style.backgroundImage = "url('https://cdn.pixabay.com/photo/2020/10/27/09/32/clouds-5690135_960_720.jpg')";
                } else if (icon == '09d' || icon == '09n' || icon == '10d' || icon == '10n') {
                    document.body.style.backgroundImage = "url('https://cdn.pixabay.com/photo/2018/03/11/12/15/raindrops-3216609_960_720.jpg')";
                } else if (icon == '01d' || icon == '01n') {
                    document.body.style.backgroundImage = "url('https://cdn.pixabay.com/photo/2016/01/02/01/51/clouds-1117584_960_720.jpg')";
                } else if (icon == '11d' || icon == '11n') {
                    document.body.style.backgroundImage = "url('https://cdn.pixabay.com/photo/2019/05/26/10/25/lightning-4229954_960_720.jpg')";
                } else if (icon == '13d' || icon == '13n') {
                    document.body.style.backgroundImage = "url('https://cdn.pixabay.com/photo/2013/10/27/17/14/snowfall-201496_960_720.jpg')";
                } else if (icon == '50d' || icon == '50n') {
                    document.body.style.backgroundImage = "url('https://pixabay.com/ro/photos/p%c4%83dure-cea%c5%a3%c4%83-aburi-diminea%c5%a3%c4%83-438388/')";
                }
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
            search: function() {
                this.fetchWeather(document.querySelector('.search-bar').value);
            }
        };

        document.querySelector('.search button').addEventListener('click', function() {
            weather.search();
            <?php
            if (isset($_SESSION['name'])) {
            ?>
                document.querySelector('#weatherContainer').classList.remove('invisible');
            <?php
            }
            ?>
        });

        document.querySelector('.search-bar').addEventListener('keyup', function(event) {
            if (event.key == 'Enter') weather.search();

        });
    </script>
</body>

</html>