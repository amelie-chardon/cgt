<?php

$_SESSION["bdd"]->connect();
$_SESSION["bdd"]->execute("SET NAMES UTF8");

$sections=$_SESSION["bdd"]->execute("SELECT nom FROM sections");

?>

<nav>
    <ul class="menu">
        <li><a href="index.php">Accueil</a></li>
        <li><a href="actualites.php">Actualités</a></li>
        <li class="deroulant"><a href="#">Sections</a>
            <ul class="sous-menu">
            <?php foreach ($sections as list($section))
        {
            ?><li><a href="section-<?php echo $_SESSION["bdd"]->supprAccents($section); ?>"><?php echo $section; ?></a></li>
        <?php
        }
        ?>
            </ul>
        </li>
        <li><a href="qui-sommes-nous.php">Qui-sommes-nous ?</a></li>
        <li><a href="adherer.php">Adhérer</a></li>
        <li><a href="liens-utiles.php">Liens utiles</a></li>
    </ul>
</nav>
