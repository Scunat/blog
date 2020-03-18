<?php
$dbh = new PDO(
    'mysql:host=localhost;dbname=blog;charset=utf8',
    'root',
    '',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);
//var_dump($dbh);

if (!empty($_POST)) {
    $pseudo = trim($_POST['pseudo']);
    $password = trim($_POST['password']);
    $query = 'INSERT INTO writers(user_name, hashed_password) VALUE(?,?)';
    $sth = $dbh->prepare($query);
    $sth->execute([$pseudo, password_hash($password, PASSWORD_BCRYPT)]);
    header('Location:authentification.php');
    exit;
}
include "inscription.phtml";
