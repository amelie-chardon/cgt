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




$bdd = $_SESSION['bdd'];

$article1=$bdd->lastArticle(0);
$article2=$bdd->lastArticle(1);
$article3=$bdd->lastArticle(2);


?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Actualités - Syndicats CGT Territoriaux & ICT - Ville de Marseille & CCAS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css"> 
</head>

<body>
<?php require 'include/header.php'?>

    <main>
    <h1 class="display-4">Accueil</h1>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="<?php echo $article1[3];?>" width="100%" height="600px" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
      <h5><?php echo $article1[1]; ?></h5>
    <p><?php echo $article1[2]; ?></p>
    </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?php echo $article2[3]; ?>" width="500px" height="600px"  alt="Second slide">
      <div class="carousel-caption d-none d-md-block">
      <h5><?php echo $article2[1];?></h5>
    <p><?php echo $article2[2]; ?></p>
    </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?php echo $article3[3]; ?>" width="500px" height="600px"  alt="Third slide">
      <div class="carousel-caption d-none d-md-block">
      <h5><?php echo $article3[1];?></h5>
    <p><?php echo $article3[2]; ?></p>
    </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


    </main>

<?php require 'include/footer.php'?>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>