<?php

require_once('init.php');

$connection = new Database;

if (isset($_POST['submit'])) {
    $nume = strtolower($_POST['nume']);
    $prenume = strtolower($_POST['prenume']);
    $parola = $_POST['parola'];

    // echo $parola;


    if (empty($nume) || empty($prenume) || empty($parola)) {
        header('Location: signIn.php?error=empty');
        exit();
    } else if (strlen($parola) < 4) {
        header('Location: signIn.php?error=short');
        exit();
    } else if (!preg_match("/^[a-zA-z]*$/", $nume) || !preg_match("/^[a-zA-z]*$/", $prenume)) {
        header('Location: signIn.php?error=chars');
        exit();
    } else {
        $parola = password_hash($parola, PASSWORD_DEFAULT);
        $connection->insertData($nume, $prenume, $parola);
        header('Location: login.php?sign=succes');
    }
}
