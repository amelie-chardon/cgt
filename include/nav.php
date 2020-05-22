<?php

$_SESSION["bdd"]->connect();
$_SESSION["bdd"]->execute("SET NAMES UTF8");

$sections=$_SESSION["bdd"]->execute("SELECT nom FROM sections");

?>

<nav class="navbar navbar-expand-lg collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="menu navbar-nav" id="menu">
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
        <li class="nav-item"><a href="qui-sommes-nous.php">Qui-sommes-nous ?</a></li>
        <li class="nav-item"><a href="adherer.php">Adhérer</a></li>
        <li class="nav-item"><a href="liens-utiles.php">Liens utiles</a></li>
    </ul>
</nav>
