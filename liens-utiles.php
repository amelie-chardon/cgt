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
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Contact - Syndicats CGT Territoriaux & ICT - Ville de Marseille & CCAS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php require 'include/header.php'?>

<main>

<h1 class="display-4">Liens utiles</h1>

<section class="section_wrap">
    <section class="bloc">
    <h3>L'UGICT-CGT</h3>
    <p>Case 408 - 263 rue de Paris</br>
    93516 Montreuil cedex</br>
    01 48 18 81 25</br>
    <a href="mailto:ugict@cgt.fr">ugict@cgt.fr</a></p>
    </section>
    
    <section class="bloc">
    <h3>Fédération CGT des services publiques</h3>
    <p>263 rue de Paris</br>
    Case 547 - 93515 Montreuil cedex</br>
    01 55 82 88 20</br>
    <a href="mailto:fdsp@cgt.fr">fdsp@cgt.fr</a></br>
    <a href="https://www.cgtservicespublics.fr" target="_blank">https://www.cgtservicespublics.fr</a></p>
    </section>

    <section class="bloc">
    <h3>Union départementale CGT13</h3>
    <p>23 boulevard charles Nedelec</br>
    13003 Marseille</br>
    04 91 64 70 88</br>
    <a href="mailto:ud-cgt-13@wanadoo.fr">ud-cgt-13@wanadoo.fr</a></br>
    </section>

    <section class="bloc">
    <h3>Union locale CGT Saint Lazare</h3>
    <p>2 rue d'Amiens</br>
    13003 Marseille</br>
    04 91 50 47 72</br>
    04 91 62 01 63</br>
    <a href="mailto:ulcgtstlazare@wanadoo.fr">ulcgtstlazare@wanadoo.fr</a></p>
    </section>
</section>
</main>

<?php require 'include/footer.php'?>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>