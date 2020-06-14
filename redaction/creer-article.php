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

if($_SESSION['user']->isRedacteur()!=true and $_SESSION['user']->isRelecteur()!=true){
    header('Location:../index.php');
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


if(isset($_POST["submit"]))
{
    if(isset($_SESSION['relecteur']))
    {
        $_SESSION['relecteur']->writeArticles();

    }

    if(isset($_SESSION['redacteur']))
    {
        $_SESSION['redacteur']->writeArticles();

    }
    
}


?>
<!doctype html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="../style.css">
        <title>Accueil - Syndicats CGT Territoriaux & ICT - Ville de Marseille & CCAS</title>
        <script async src="preview.js"></script>
        <script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
    </head>

<body>

    <main>
    <h1>Creer un article</h1>

    

    <section class="container-fluid">
<form method="POST" action="">

  <div class="form-group">
    <label for="Titre de l'article">Titre de l'article</label>
    <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre de l'article" required>
  </div>
  <div class="form-group">
    <label for="Sous titre de l'article">Sous Titre de l'article</label>
    <input type="text" class="form-control" name="stitre" id="stitre" placeholder="Sous titre de l'article" required>
  </div>
  <div class="form-group">
    <label for="Insérer une image">Insérer une image</label>
    <input type="text" class="form-control" name="img" id="img" placeholder="Insérer une image" required>
  </div>
  <div class="form-group">
    <label for="Preview">Preview</label>
    <button type="button" class="form-control" name="prv" id="prv" required>Prévisualiser</button>
  </div>
  <div class="form-group">
    <label for="Choix du thème">Choix du thème</label>
    <select class="form-control" name="theme">
      <option value="">1</option>
      <option value="">2</option>
      <option value="">3</option>
    </select>
  </div>
  
  <div class="form-group">
    <label for="Choix du thème">Choix de la section</label>
    <select class="form-control" name="section" id="section">
    <?php
    
    foreach ($_SESSION['bdd']->getSection() as $r)
    {
        echo "<option value=".$r[0].">".$r[1]."</option>";
    }
    ?>

    <div class="form-group">
    <label for="Redigez votre article">Redigez votre article</label>
    <textarea class="form-control" name="article" id="article" rows="10" cols="160" required></textarea>
  </div>
    </select>
  </div>
  
  
  <button type="submit" class="btn btn-danger" name="submit">Valider l'article</button>
</form>
    </section>
    

    <div id="previ"></div>
    </main>
    



   
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
