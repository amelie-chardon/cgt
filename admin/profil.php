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

if($_SESSION['user']->isAdmin()!=true){
    header('Location:../index.php');
}

//Récupération des infos de profil
$infos=$_SESSION["user"]->mes_info();



?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="../style.css">
        <title>Admin - Syndicats CGT Territoriaux & ICT - Ville de Marseille & CCAS</title>
    </head>

<body>
<?php require("include/header.php"); ?>

    <main>
    
    <h1 class="display-4">Mon profil</h1>

        <h2 class="m-3 mt-4">Mes informations</h2>
            <div class="row justify-content-center m-2">
            <table class='tableau_admin table table-striped col-12 col-sm-10 col-md-10 col-lg-10'>
                <thead>
                    <th scope="col">Login</th>
                    <th scope="col">Mail</th>
                    <th scope="col">Droits</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="align-middle"><?php echo $infos[0][0] ; ?> </td>
                        <td class="align-middle"><?php echo $infos[0][1] ; ?> </td>
                        <td class="align-middle"><?php echo $infos[0][2]; ?> </td>
                    </tr>
                </tbody>
            </table>
            </div>

            <div class="row justify-content-center m-2">
        <div class="col-lg-6 col-md-10 col-sm-10 col-10 justify-content-center justify-items-center">
        <h2 class="m-3 mt-4">Modifier mes informations</h2>

                <form action="profil.php" method="POST" class="form bg-light p-3">
                    <label>Identifiant : </label>
                    <input class="form-control" type="text" name="login" value="<?php echo $_SESSION['user']->getlogin(); ?>"><br>
                    <label>Mail :</label>
                    <input class="form-control" type="mail" name="mail" value="<?php echo $_SESSION['user']->getmail() ?>"><br>
                    <label>Mot de passe :</label>
                    <input class="form-control" type="password" name="password_confirm" required><br>
                    <input type="submit" name="send_infos" class="submit btn btn-danger">
                </form>
        </div>


        <div class="col-lg-6 col-md-10 col-sm-10 col-10 justify-content-center justify-items-center">
        <h2 class="m-3 mt-4">Modifier mon mot de passe</h2>
                <form method="POST" class="form bg-light p-3">
                    <label>Votre ancien mot de passe : </label>
                    <input class="form-control" type="password" name="password_old" minlength="5" /><br>
                    <label>Votre nouveau mot de passe : </label>
                    <input class="form-control" type="password" name="password_new" minlength="5" /><br>
                    <label>Confirmation du mot de passe :</label>
                    <input class="form-control" type="password" name="password_new_confirm" required><br>
                    <input class="submit btn btn-danger" type="submit" name="send_password">
                </form>
        </div>
        </div>


    <h2 class="m-3">Me désinscrire</h2> 

    <div class="row justify-content-center m-2">
        <form class="formulaire" method="post">
            <button type="submit" name="desinscription" class="submit btn btn-danger">Se désinscrire</button>
        </form>
    </div>

    <section class="section_wrap m-4">
        <a href="index.php"><button class="submit btn btn-danger" type="submit">Retour</button></a>
    </section>

    </main>

</body>

</html>

<?php

    //Modification du login et/ou mail
    if(isset($_POST["send_infos"])){
        if(!empty($_POST["password_confirm"])){
            if(!empty($_POST["login"])){
                $_SESSION['user']->modify_info($_POST["password_confirm"],$_POST["login"],NULL);
            }
            if(!empty($_POST["mail"])){
                $_SESSION['user']->modify_info($_POST["password_confirm"],NULL,$_POST["mail"]);
            }
            ?>
            <p>Vos informations ont été mises à jour.</p>
            <?php
        }
        else{
            ?>
            <p>Veuillez rentrer votre ancien mot de passe pour valider vos changements.</p>
        <?php
        }
    }

    //Modification du mot de passe
    if(isset($_POST["send_password"])){
        if(!empty($_POST["password_new_confirm"]) && !empty($_POST["password_old"]) && !empty($_POST["password_new"])){
            {
                $_SESSION['user']->modify_password($_POST["password_old"],$_POST["password_new"],$_POST["password_new_confirm"]);
            }
            ?>
            <p>Votre mot de passe a bien été mis à jour.</p>
            <?php
        }
        else{
            ?>
            <p>Veuillez rentrer votre ancien mot de passe pour valider vos changements.</p>
        <?php
        }
    }


    //Désinscription
    if(isset($_POST["desinscription"]))
        {
            $_SESSION["user"]->desinscription();
        }

?>
