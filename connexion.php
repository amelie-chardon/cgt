<!doctype html>
<?php 
session_start(); 

require 'class/bdd.php';
require 'class/user.php';
?>

<html>
<head>
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Connexion - Syndicats CGT Territoriaux & ICT - Ville de Marseille & CCAS</title>
 <link rel="stylesheet" href="style.css">
</head>

<body>
<?php require 'include/header.php'?>

    <main>
    <h1>Connexion</h1>

    <section class="panneau-col">
            <section class="bloc">
                <form class="formulaire" action="admin.php" method="post">
                    <label>E-mail :</label>
                    <input type="mail" name="mail" required><br>
                    <label>Mot de passe :</label>
                    <input type="password" name="password" required><br>
                <input type="submit" name="send">
                </form>
            </section>

        <?php
        if(isset($_POST["send"])){
            if($_SESSION["user"]->connexion($_POST["mail"],$_POST["password"]) == false){
                ?>
                    <p>Un problème est survenue lors de la connexion veuillez vérifer vos informations de connexion</p>
                <?php
            }
            else{
                $_SESSION["user"]->connexion($_POST["mail"],$_POST["password"]);
                header('location:index.php');
            }
        }
        ?>
    </section>
    </main>

<?php require 'include/footer.php'?>


</body>
</html>