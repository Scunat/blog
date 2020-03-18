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

if (!empty($_POST)) {
    $article[$_POST['id']] =
        [
            'titre' => $_POST['title'],
            'contenu' => $_POST['content'],
            'date de publication' => $_POST['publication_date'],
            'fichier' => $_POST['image'],
            'redacteur' => $_POST['idWriter'],
        ];
    $query = 'INSERT INTO posts(title, contenu, publication_date, idWriter) VALUE(?,?,?,?)';
    $sth = $dbh->prepare($query);
    $sth->execute($_POST['title'], $_POST['content'], $_POST['publication_date'], $_POST['image'],$_POST['idWriter'] );
    header('Location:./');
    exit;
};


if (array_key_exists('fichier', $_FILES)) {
    if ($_FILES['fichier']['error'] === 0) {
        if (in_array(mime_content_type($_FILES['fichier']['tmp_name']), ['image/png', 'image/jpeg'])) {
            if ($_FILES['fichier']['size'] < 3000000) {
                move_uploaded_file($_FILES['fichier']['tmp_name'], 'uploads/' . uniqid() . '.' . pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION));
                header('Location:./');
                exit;
            }
        }
    }
}

include 'redactionArticle.phtml';
