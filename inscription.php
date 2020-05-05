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

if($_SESSION['user']->isConnected() != false){
    header('Location:index.php');
}

?>

<html>
<head>
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
                <form class="formulaire" action="" method="post">
                    <label>Login</label>
                    <input type="text" name="login" required><br>
                    <label>E-mail :</label>
                    <input type="mail" name="mail" required><br>
                    <label>Mot de passe :</label>
                    <input type="password" name="password" required><br>
                    <label>Confirmation du mot de passe :</label>
                    <input type="password" name="password_conf" required><br>
                    <input class="submit" type="submit" name="send">
                </form>
            </section>

            <p>Déjà inscrit ?</p>
            <a href="connexion.php"><button class="submit" type="submit">Connexion</button></a>
        <?php
        if(isset($_POST["send"])){
            if($_SESSION["user"]->inscription($_POST["login"],$_POST["password"],$_POST["password_conf"],$_POST["mail"]) == false){
                ?>
                    <p>Un problème est survenue lors de l'inscription. Veuillez réessayer.</p>
                <?php
            }
            else{
                $_SESSION["user"]->inscription($_POST["login"],$_POST["password"],$_POST["password_conf"],$_POST["mail"]);
                //header('location:index.php');
            }
        }
        ?>
    </section>
    </main>

<?php require 'include/footer.php'?>


</body>
</html>