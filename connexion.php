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
    <title>Connexion - Syndicats CGT Territoriaux & ICT - Ville de Marseille & CCAS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php require 'include/header.php'?>

    <main>
    <h1 class="display-4">Connexion</h1>

    <section class="panneau-col">
            <section class="bloc">
                <form class="formulaire" action="" method="post">
                    <label>E-mail :</label>
                    <input type="mail" name="mail" class="form-control" required/><br/>
                    <label>Mot de passe :</label>
                    <input type="password" name="password" class="form-control" required/><br/>
                <input class="submit btn btn-danger" type="submit" name="send">
                </form>
            </section>
        <p>Pas encore inscrit ?</p>
        <a href="inscription.php"><button class="submit btn btn-danger" type="submit">Inscription</button></a>


        <?php
        if(isset($_POST["send"])){
            if($_SESSION["user"]->connexion($_POST["mail"],$_POST["password"]) == false){
                ?>
                    <p>Un problème est survenu lors de la connexion. Veuillez vérifer vos informations de connexion</p>
                <?php
            }
            else{
                $_SESSION["user"]->connexion($_POST["mail"],$_POST["password"]);
                //TODO : ajouter condition pour admin ou vérif
                if($_SESSION['user']->isAdmin()==true)
                {
                    header('location:admin/index.php');
                }
                if(($_SESSION['user']->isRelecteur()==true) OR ($_SESSION['user']->isRedacteur()==true))
                {
                    header('location:redaction/index.php');
                }
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