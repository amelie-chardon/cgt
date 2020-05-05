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
        <link rel="stylesheet" href="../style.css">
        <title>Admin - Syndicats CGT Territoriaux & ICT - Ville de Marseille & CCAS</title>
    </head>

<body>

    <main>
    
    <h1>Administration du site</h1>
    <h2>Liste des sections</h2>

    
<?php
    //Modification/suppression des sections
    //TODO : ajout de section + création auto de la page associée
    $_SESSION["bdd"]->connect();
    $sections=$_SESSION["admin"]->getSections();

    ?>

    <table class='tableau_admin'>
    <thead>
        <th>Id</th>
        <th>Sections</th>
        <th class="actions">Actions</th>
    </thead>
    <tbody>
    <?php foreach($sections as list($id,$nom)) { ?>
        <tr>
        <td><?php echo $id ; ?> </td>
        <td><?php echo $nom ; ?> </td>
        <td><form method="post" action="sections.php"><button class="submit" type="submit" id="suppr_section" name="section_<?php echo $id; ?>">Supprimer la section</button></form></td>
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
    <section class="section_wrap">
        <a href="index.php"><button class="submit" type="submit">Retour</button></a>
    </section>
    
    </main>
</body>
</html>