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
<title>Inscription - Syndicats CGT Territoriaux & ICT - Ville de Marseille & CCAS</title>
 <link rel="stylesheet" href="style.css">
</head>

<body>
<?php require 'include/header.php'?>

    <main>
    <h1>Inscription</h1>

    <section class="panneau-col">
            <section class="bloc">
                <form class="formulaire" action="connexion.php" method="post">
                    <label>Login</label>
                    <input type="text" name="login" required><br>
                    <label>E-mail :</label>
                    <input type="mail" name="mail" required><br>
                    <label>Mot de passe :</label>
                    <input type="password" name="password" required><br>
                    <label>Confirmation du mot de passe :</label>
                    <input type="password" name="password_conf" required><br>
                    <input type="submit" name="send">
                </form>
            </section>
        <?php
        if(isset($_POST["send"])){
            if($_SESSION["user"]->inscription($_POST["login"],$_POST["password"],$_POST["password_conf"],$_POST["mail"]) == false){
                ?>
                    <p>Un problème est survenue lors de l'inscription. Veuillez réessayer.</p>
                <?php
            }
            else{
                $_SESSION["user"]->inscription($_POST["login"],$_POST["password"],$_POST["password_conf"],$_POST["mail"]);
                header('location:index.php');
            }
        }
        ?>
    </section>
    </main>

<?php require 'include/footer.php'?>


</body>
</html>