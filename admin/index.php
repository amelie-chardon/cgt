<!doctype html>
<?php 
require '../class/bdd.php';
require '../class/user.php';
require '../class/admin.php';

session_start();

if(!isset($_SESSION['bdd']))
{
    $_SESSION['bdd'] = new bdd();
}

if(!isset($_SESSION['user'])){
    $_SESSION['user'] = new user();
}

if(!isset($_SESSION['admin'])){
    $_SESSION['admin'] = new admin();
}

if($_SESSION['user']->isAdmin()!=true){
    header('Location:../index.php');
}

?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="../style.css">
        <title>Admin - Syndicats CGT Territoriaux & ICT - Ville de Marseille & CCAS</title>
    </head>

<body>

    <main>
    
    <h1>Administration du site</h1>
        <section class="section_wrap">
            <a href="utilisateurs.php"><button class="submit" type="submit">Utilisateurs</button></a>
            <a href="sections.php"><button class="submit" type="submit">Sections</button></a>
            <a href="../deconnexion.php"><button class="submit" type="submit">Déconnexion</button></a>
        </section>
    </main>
</body>
</html>