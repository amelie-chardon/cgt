<?php 
session_start();
require 'class/bdd.php';
require 'class/user.php';
require 'class/admin.php';


if(!isset($_SESSION['bdd']))
{
    $_SESSION['bdd'] = new bdd();
}

if(!isset($_SESSION['user'])){
    $_SESSION['user'] = new user();
}
/*
if($_SESSION['user']->isAdmin()!=true){
    header('Location:index.php');
}
*/
?>

<html>
    <head>
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="style.css">
        <title>Admin - Syndicats CGT Territoriaux & ICT - Ville de Marseille & CCAS</title>
    </head>

<body>
<?php require 'include/header.php'?>

    <main>
    
    <h1>Administration du site</h1>

<h2>Liste des articles</h2>

    <?php 
    //Récupération de tous les articles
    $_SESSION["bdd"]->connect();
    $articles=$_SESSION["admin"]->getArticles();
    ?>

    <table class='tableau_admin'>
        <thead>
            <th>Id</th>
            <th>Article</th>
            <th>Utilisateur</th>
            <th>Action</th>
        </thead>
        <tbody>
        <?php foreach($articles as list($id,$login,$titre) { ?>
            <tr>
                <td><?php echo $id ; ?> </td>
                <td><?php echo $login ; ?> </td>
                <td><?php echo $titre ; ?> </td>
                <td><form method="post" action="admin.php" id="suppression"><button type="submit" id="submit" name="article_<?php echo $id; ?>">Supprimer l'article</button></form></td=>
            </tr>
            <?php 
                if (isset($_POST["article_"."$id"]))
                {
                    $_SESSION["bdd"]->connect();
                    $_SESSION["admin"]->supprArticle($id)
                    unset($_POST);
                }
            } ?>
    </tbody>
</table>

<h2>Liste des utilisateurs</h2>

<?php
    //Modification/suppression des utilisateurs
    $_SESSION["bdd"]->connect();
    $utilisateurs=$_SESSION["admin"]->getUtilisateurs();

    ?>

    <table class='tableau_admin'>
    <thead>
        <th>Login</th>
        <th>Mail</th>
        <th>Droits</th>
        <th colspan=2>Actions</th>
    </thead>
    <tbody>
    <?php foreach($utilisateurs as list($id,$login,$mail,$droits)) { ?>
        <tr>
        <td><?php echo $login ; ?> </td>
        <td><?php echo $mail ; ?> </td>
        <td><?php echo $droits ; ?> </td>
        <td><form method="post" action="admin.php" id="articles"><button type="submit" id="suppr_utilisateur" name="utilisateur_<?php echo $id; ?>">Supprimer l'utilisateur</button></form></td>
        <td><form method="post" action="admin.php"><select name="droit" id="droit"><option value="">Modifier droits</option><option value="user">Utilisateur</option><option value="modo">Modérateur</option><option value="admin">Administrateur</option></select><input type="submit" id="submit" name="droit_utilisateur_<?php echo $id; ?>"></form></td>
        </tr>
        <?php 
            if (isset($_POST["suppr_utilisateur_"."$id"]))
            {
                $connect=mysqli_connect("localhost","root","","blog");
                $suppr="DELETE articles,commentaires,utilisateurs FROM utilisateurs LEFT JOIN articles ON (utilisateurs.id=articles.id_utilisateur) LEFT JOIN commentaires ON (utilisateurs.id=commentaires.id_utilisateur) WHERE utilisateurs.id=$utilisateur[0]";
                $result=mysqli_query($connect,$suppr);
                unset($_POST);
                mysqli_close($connect);
            }
            
            if (isset($_POST["droit_utilisateur_"."$id"]))
            {
                $id_droits=$_POST['droit'];
                $connect=mysqli_connect("localhost","root","","blog");
                $update="UPDATE utilisateurs SET id_droits = \"$id_droits\" WHERE utilisateurs.id = $utilisateur[0] ";
                $result=mysqli_query($connect,$update);
                unset($_POST);
                mysqli_close($connect);
            }
        } ?>
    </tbody>
</table>

<h2>Liste des catégories</h2>

<?php
    //Modification des catégories
    $_SESSION["bdd"]->connect();
    $categories=$_SESSION["admin"]->getCategories();

    ?>

    <table class='tableau_admin'>
    <thead>
        <th">Id</th>
        <th>Nom</th>
        <th colspan=2>Actions</th>
    </thead>
    <tbody>
    <?php foreach($categories as list($id,$nom)) { ?>
        <tr>
            <td><?php echo $id ; ?> </td>
            <td></td><?php echo $nom ; ?> </td>
            <td><form method="post" action="admin.php"><input name="modif_categorie" id="modif_categorie" type="text" placeholder="Modification nom catégorie" required ><input type="submit" id="submit" name="modif_categorie_<?php echo $id; ?>"></form></td>
        </tr>
        <?php 

            
            if (isset($_POST["modif_categorie_"."$categorie[0]"]))
            {
                $modif_categorie=$_POST["modif_categorie"];
                $connect=mysqli_connect("localhost","root","","blog");
                $update="UPDATE categories SET nom = \"$modif_categorie\" WHERE categories.id = $categorie[0] ";
                $result=mysqli_query($connect,$update);
                unset($_POST);
                mysqli_close($connect);
            }
        } ?>
    </tbody>
</table>
<?php

    //Ajout d'une catégorie
?>


        <form method="post" action="admin.php"><label for="ajout_categorie"><h2 class="voir-articles7">Ajouter une catégorie</h2></label><input name="nvelle_categorie" id="modif_categorie" type="text" placeholder="Nouvelle catégorie" required><input type="submit" id="submit2" name="ajout_categorie"></form>

        <?php
            if (isset($_POST["nvelle_categorie"]))
            {
                $ajout_categorie=$_POST["nvelle_categorie"];
                $connect=mysqli_connect("localhost","root","","blog");
                $ajout="INSERT INTO categories (id,nom) VALUES (NULL, \"$ajout_categorie\")";
                $result=mysqli_query($connect,$ajout);
                mysqli_close($connect);
            }
        unset($_POST);
        ?>


        </section>
        </section>
    </main>
<?php include("footer.php"); ?>
</body>
</html>