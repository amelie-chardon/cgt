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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php require 'include/header.php'?>

    <main>
    <h1 class="display-4">Inscription</h1>

    <section class="panneau-col">
            <section class="bloc">
                <form class="formulaire" action="" method="post">
                    <label>Login</label>
                    <input type="text" name="login" class="form-control" required/><br/>
                    <label>E-mail :</label>
                    <input type="mail" name="mail" class="form-control" required/><br/>
                    <label>Mot de passe :</label>
                    <input type="password" name="password" class="form-control" required/><br/>
                    <label>Confirmation du mot de passe :</label>
                    <input type="password" name="password_conf" class="form-control" required/><br/>
                    <input class="submit btn btn-danger" type="submit" name="send">
                </form>
            </section>

            <p>Déjà inscrit ?</p>
            <a href="connexion.php"><button class="btn btn-danger submit" type="submit">Connexion</button></a>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>