<?php
require_once('init.php');

$connection = new Database;
if (isset($_POST['submit'])) {

    $prenume = strtolower($_POST['prenume']);
    $parola = $_POST['parola'];

    if (empty($prenume) || empty($parola)) {
        header('Location: login.php?error=empty');
        exit();
    }


    $sql = 'SELECT * FROM weather WHERE prenume = ?';
    $stmt = $connection->pdo->prepare($sql);
    $stmt->execute([$prenume]);
    $userFound = $stmt->fetch(PDO::FETCH_OBJ);
    $hashedPassword = password_verify($parola, $userFound->parola);


    if ($stmt->rowCount() == 0) {
        header('Location: login.php?error=usernotfound');
        exit();
    } else if ($hashedPassword == false) {
        header('Location: login.php?error=usernotfound');
    } else {
        session_start();
        $_SESSION['id'] = $userFound->id;
        $_SESSION['name'] = $userFound->prenume;
        header('Location: ../index.php');
    }
}
