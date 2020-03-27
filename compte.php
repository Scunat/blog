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

$query= 'SELECT title, content
         FROM posts';
$sth = $dbh -> prepare($query);
//$sth->execute([$_GET['id']]);
$posts = $sth->fetchAll();
var_dump($posts);

include 'compte.phtml';