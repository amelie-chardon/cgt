<!doctype html>
<?php

require 'class/bdd.php';
require 'class/user.php';

session_start();

if(!isset($_SESSION['bdd']))
{
    $_SESSION['bdd'] = new bdd();
}
if(!isset($_SESSION['user'])){
    $_SESSION['user'] = new user();
}
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Adhésion - Syndicats CGT Territoriaux & ICT - Ville de Marseille & CCAS</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php require 'include/header.php'?>

    <main>




    </main>

<?php require 'include/footer.php'?>


</body>
</html>