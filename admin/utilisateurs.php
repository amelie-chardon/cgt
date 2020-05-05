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
        <th class="actions" colspan=2>Actions</th>
    </thead>
    <tbody>
    <?php foreach($utilisateurs as list($id,$login,$mail,$droits)) { ?>
        <tr>
        <td><?php echo $login ; ?> </td>
        <td><?php echo $mail ; ?> </td>
        <td><?php echo $droits ; ?> </td>
        <td><form method="post" action="utilisateurs.php"><button class="submit" type="submit" id="suppr_utilisateur" name="utilisateur_<?php echo $id; ?>">Supprimer l'utilisateur</button></form></td>
        <td><form method="post" action="utilisateurs.php"><select name="droits" id="droits"><option value="">Modifier droits</option><option value="Utilisateur">Utilisateur</option><option value="Rédacteur">Rédacteur</option><option value="Relecteur">Relecteur</option><option value="Administrateur">Administrateur</option></select><input class="submit" type="submit" id="submit" name="droit_utilisateur_<?php echo $id; ?>"></form></td>
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
    <section class="section_wrap">
        <a href="index.php"><button class="submit" type="submit">Retour</button></a>
    </section>
    </main>
</body>
</html>