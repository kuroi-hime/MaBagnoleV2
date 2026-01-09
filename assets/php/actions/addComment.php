<?php
    require_once '../classes/DataBase.php';
    require_once '../classes/Commentaire.php';

    session_start();
    $pdo = DataBase::getPDO();

    $commentaire = new Commentaire();
    $commentaire->note = $_POST['note'];
    $commentaire->contenu = $_POST['contenu'];
    $commentaire->article_id = $_POST['id_article'];
    $commentaire->client_id = $_SESSION['id'];

    $commentaire->ajouter($pdo);

    header('location:../pages/accueil.php?'.$_POST['view'].'='.$_POST['id_article']);
?>