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
    
<?php
    //Modification/suppression des sections
    //TODO : ajout de section + création auto de la page associée
    $_SESSION["bdd"]->connect();
    $sections=$_SESSION["admin"]->getSections();

    ?>
    <h2 class="m-3">Liste des sections</h2>

    <div class="row justify-content-center m-2 p-3">

        <table class='tableau_admin table table-striped col-12 col-sm-10 col-md-8 col-lg-6'>
        <thead>
            <th scope="col">Id</th>
            <th scope="col">Sections</th>
            <th scope="col">Actions</th>
        </thead>
        <tbody>
        <?php foreach($sections as list($id,$nom)) { ?>
            <tr>
                <td class="align-middle"><?php echo $id ; ?> </td>
                <td class="align-middle"><?php echo $nom ; ?> </td>
                <td class="align-middle"><form method="post" action="sections.php"><button class="submit btn btn-danger" type="submit" id="suppr_section_<?php echo $id; ?>" name="suppr_section_<?php echo $id; ?>">Supprimer la section</button></form></td>
            </tr>
            <?php 
                if (isset($_POST["suppr_section_"."$id"]))
                {
                    $_SESSION["admin"]->supprSection($id);
                    unset($_POST);
                }
            } ?>
        </tbody>
        </table>
    </div>
    <h2 class="m-3">Créer une section</h2>

    <div class="row justify-content-center m-2 p-3">
        <form class="form bg-light p-3" method="post" action="sections.php">
            <label for="nom">Nom de la section</label>
            <input type="text" id="nom_section" name="nom_section" class="form-control" aria-describedby="nom_help">
            <small id="nom_help" class="form-text text-muted">
            Le nom doit être compris entre 5 et 20 caractères.
            </small>
            <button class="submit btn btn-danger m-3" type="submit" id="add_section" name="add_section">Valider</button>
        </form>
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

<?php 
    if (isset($_POST["add_section"]))
        {
            $nom_section=$_POST["nom_section"];
            $_SESSION["admin"]->addSection($nom_section);
            unset($_POST);
        }
?>