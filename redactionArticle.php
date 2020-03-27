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

//var_dump($_FILES);

//Inserer un fichier
if (array_key_exists('fichier', $_FILES)) {
    if ($_FILES['fichier']['error'] === 0) {
        if (in_array(mime_content_type($_FILES['fichier']['tmp_name']), ['image/png', 'image/jpeg'])) {
            if ($_FILES['fichier']['size'] < 3000000) {
                move_uploaded_file($_FILES['fichier']['tmp_name'], 'uploads/' . uniqid() . '.' . pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION));
            }
        }
    }
}

//Entrer informations dans BDD
if (!empty($_POST)) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $image= trim($_POST['MAX_FILE_SIZE']);
    $query = 'INSERT INTO posts(title, content, image) VALUE(?,?,?)';
    $sth = $dbh->prepare($query);
    $sth->execute([$title, $content, $image]);
    header('Location:compte.php');
    exit;
};

if (!empty($_POST)) {
$query= 'SELECT writers.id
         FROM writers
         INNER JOIN id ON posts.idWriter = writers.id';
$sth = $dbh -> prepare($query);
//$sth->bindValue($_GET['id'], PDO::PARAM_INT);
$sth->execute([$posts]);
$posts= $sth->fetch();
var_dump($posts);
};

include 'redactionArticle.phtml';