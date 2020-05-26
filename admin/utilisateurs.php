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

?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="../style.css">
        <title>Admin - Syndicats CGT Territoriaux & ICT - Ville de Marseille & CCAS</title>
    </head>

<body>

    <main>
    
    <h1 class="display-4">Administration du site</h1>

    <h2 class="m-3">Liste des utilisateurs</h2>

<?php
    //Modification/suppression des utilisateurs
    $_SESSION["bdd"]->connect();
    $utilisateurs=$_SESSION["admin"]->getUtilisateurs();
    $i=0;
    ?>
    <div class="row justify-content-center m-2">
        <table class='tableau_admin table table-striped col-12 col-sm-10 col-md-10 col-lg-10'>
            <thead>
                <th scope="col">N°</th>
                <th scope="col">Login</th>
                <th scope="col">Mail</th>
                <th scope="col">Droits</th>
                <th scope="col" class="actions" colspan=2>Actions</th>
            </thead>
            <tbody>
            <?php foreach($utilisateurs as list($id,$login,$mail,$droits)) { 
                $i++;
                ?>
                <tr>
                    <td class="align-middle"><?php echo $i ; ?> </td>
                    <td class="align-middle"><?php echo $login ; ?> </td>
                    <td class="align-middle"><?php echo $mail ; ?> </td>
                    <td class="align-middle"><?php echo $droits ; ?> </td>
                    <td class="align-middle"><form method="post" action="utilisateurs.php"><button class="submit btn btn-danger" type="submit" id="suppr_utilisateur" name="utilisateur_<?php echo $id; ?>">Supprimer l'utilisateur</button></form></td>
                    <td class="align-middle"><form method="post" action="utilisateurs.php"><select class="custom-select p-2" name="droits" id="droits"><option value="">Modifier droits</option><option value="Utilisateur">Utilisateur</option><option value="Rédacteur">Rédacteur</option><option value="Relecteur">Relecteur</option><option value="Administrateur">Administrateur</option></select><input class="submit btn btn-danger" type="submit" id="submit" name="droit_utilisateur_<?php echo $id; ?>"></form></td>
                </tr>
                <?php 
                    if (isset($_POST["suppr_utilisateur_"."$id"]))
                    {
                        $_SESSION["admin"]->supprUtilisateur($id);
                        unset($_POST);
                    }
                    
                    if (isset($_POST["droit_utilisateur_"."$id"]))
                    {
                        $droits=$_POST['droits'];
                        $_SESSION["admin"]->modifDroits($id,$droits);
                        unset($_POST);
                    }
                } ?>
            </tbody>
        </table>
    </div>
    <section class="section_wrap">
        <a href="index.php"><button class="submit btn btn-danger" type="submit">Retour</button></a>
    </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>