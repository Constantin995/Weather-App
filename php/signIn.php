<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="js/app.js" defer></script>
    <title>Sign In</title>
</head>

<body class="w-full h-screen bg-no-repeat bg-cover" style="background-image: url(https://cdn.pixabay.com/photo/2012/04/14/16/37/sky-34536_960_720.png);">
    <div class=" py-5 px-8 flex flex-wrap">
        <img src="https://cdn0.iconfinder.com/data/icons/ballicons/128/cloud-512.png" alt="" class="w-9 h-9">
        <a href="../index.php" class="text-white font-semibold flex-auto text-xl ml-2">Weather App</a>
        <nav class="text-white text-lg font-semibold space-x-6">
            <a class="hover:text-blue-300 transition duration-200" href="../index.php">Acasa</a>
            <a class="hover:text-blue-300 transition duration-200" href="signIn.php">Sign in</a>
            <a class="hover:text-blue-300 transition duration-200" href="login.php">Login</a>
            <a class="hover:text-blue-300 transition duration-200" href="../info.html">Info</a>
        </nav>
    </div>

    <?php

    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'empty') {
            echo "<div class='text-lg text-black w-2/6 m-auto p-1 bg-red-400 text-center font-semibold rounded-lg'>Toate campurile sunt obligatorii</div>";
        } else if ($_GET['error'] == 'short') {
            echo "<div class='text-lg text-black w-2/6 m-auto p-1 bg-red-400 text-center font-semibold rounded-lg'>Parola trebuie sa fie mai mare de 4 caractere</div>";
        } else if ($_GET['error'] == 'chars') {
            echo "<div class='text-lg text-black w-2/6 m-auto p-1 bg-red-400 text-center font-semibold rounded-lg'>Nume invalid (trebuie sa contina doar litere)</div>";
        }
    }
    ?>


    <div class=" w-3/4 h-auto m-auto mt-10 py-5 px-4 bg-black bg-opacity-30 rounded-md sm:w-4/12 min-w-max">
        <form action="checkSign.php" method="POST" class="flex flex-col space-y-5">
            <div class="text-white font-semibold space-y-2 text-md">
                <label for="">Nume</label>
                <input class="w-full py-2 px-2 rounded-md text-black" type="text" name="nume">
            </div>
            <div class="text-white font-semibold space-y-2 text-md">
                <label for="">Prenume</label>
                <input class="w-full py-2 px-2 rounded-md text-black" type="text" name="prenume">
            </div>
            <div class="text-white font-semibold space-y-2 text-md">
                <label for="">Parola</label>
                <input class="w-full py-2 px-2 rounded-md text-black" type="password" name="parola">
            </div>
            <input type="submit" name="submit" value="Trimite" class="buton p-2 text-black rounded-lg bg-green-600 font-semibold text-lg hover:bg-green-800 hover:text-white transition duration-200">
        </form>
        <div class=" text-lg font-semibold mt-10 px-2">
            <p>Apasa <a href="./login.php" class="text-white">aici</a> daca ai deja un cont !</p>
        </div>
    </div>
</body>

</html>