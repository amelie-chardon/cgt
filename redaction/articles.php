<?php

require '../class/bdd.php';
require '../class/user.php';
require '../class/redacteur.php';
require '../class/relecteur.php';

session_start();




if(!isset($_SESSION['bdd']))
{
    $_SESSION['bdd'] = new bdd();
}

$bdd = $_SESSION['bdd'];

if(!isset($_SESSION['user']))
{
    $_SESSION['user'] = new user();
}

if($_SESSION['user']->isRedacteur()==true)
{
    if(!isset($_SESSION['redacteur']))
    {
        $_SESSION['redacteur'] = new redacteur();
    }
}

if($_SESSION['user']->isRelecteur()==true)
{
    if(!isset($_SESSION['redacteur']))
    {
        $_SESSION['redacteur'] = new redacteur();
    }

    if(!isset($_SESSION['relecteur']))
    {
        $_SESSION['relecteur'] = new relecteur();
    }
}



$article1=$bdd->getArticles(0);

$articles=$_SESSION['redacteur']->getArticlesRedac(); 








?>
<!doctype html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="../style.css">
        <title>Accueil - Syndicats CGT Territoriaux & ICT - Ville de Marseille & CCAS</title>
       
    </head>

<body>
<main>

<?php


if($_SESSION['user']->isRelecteur()==true)
{ 
    ?>
    <h1>Tous les articles </h1>
    <h2>Bienvenue <?php echo $article1[4][4];?></h2>
    <div class="row justify-content-center m-2">
        <table class='tableau_admin table table-striped col-12 col-sm-10 col-md-10 col-lg-10'>
            <thead>
                <th scope="col">id_articles</th>
                <th scope="col">Titre</th>
                <th scope="col">Nom</th>
                <th scope="col">statut</th>
                <th scope="col"></th>
                <th scope="col" class="actions" colspan=2>Actions</th>
            </thead>
            <tbody>
    <?php
    foreach( $article1 as list($id,$titre,$sous_titre,$stat,$nom))
    {
    ?>
        <tr>
                    <td class="align-middle"><?php echo $id;?> </td>
                    <td class="align-middle"><?php echo $titre;?></td>
                    <td class="align-middle"><?php echo $nom;?></td>
                    <td class="align-middle">
                    <?php 
                    if($stat == "1")
                    {echo "valider";}
                    else 
                    {echo "en relecture";}?></td>
                    <td class="align-middle"><?php echo ""?></td>
                    <td class="align-middle">
                        <form method="post" action="">
                            <select class="custom-select p-2" name="statut" id="statut"><option value="">Modifier statut</option><option value="0">En relecture</option><option value="1">valider</option></select>
                            <input class="submit btn btn-danger" type="submit" id="submit" name="statut_art<?php echo $id; ?>">
                        </form>
                    </td>
                    
        </tr>
        <?php
                     if (isset($_POST["statut_art"."$id"]))
                     {
                         $statut=$_POST['statut'];
                         
 
                         $_SESSION['relecteur']->validate($id,$statut);
                         header("refresh:0");

                     }
    }
 
    ?>
   
        </tbody>
        </table>
        <?php
    
   
}

if($_SESSION['user']->isRedacteur()==true)
{
?>
<h2>Bienvenue<?php echo $article1[4][4];?></h2>
<h1>Tous vos articles</h1>
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
    <?php

    foreach( $articles as list($id,$titre,$sous_titre,$contenu))
    {
    ?>
        <tr>
                    <td class="align-middle"><?php echo $id;?> </td>
                    <td class="align-middle"><?php echo $titre;?></td>
                    <td class="align-middle"><?php echo $sous_titre;?></td>
                    <td class="align-middle"><?php echo $contenu;?></td>
                    <td></td>
                    
        </tr>
    <?php
    }
    ?>
   
        </tbody>
        </table>
<?php 
          
       
    
}

?>

</main>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>