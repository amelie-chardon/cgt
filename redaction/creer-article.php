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
  $countfiles = count ($_FILES['files']['name']);

  $file = $_FILES['files'];

  // Boucle tous les fichiers
  for($i = 0; $i <$countfiles; $i++) {

        $fileName = $_FILES['files']['name'][$i];
        $fileTmpName = $_FILES['files']['tmp_name'][$i];
        $fileSize = $_FILES['files']['size'][$i];
        $fileError = $_FILES['files']['error'][$i];
        $fileType = $_FILES['files']['type'][$i];
    
        $fileExt = explode('.',$fileName);
        
        $fileActualExt = strtolower(end($fileExt));
    
        $allowed = array('jpg','jpeg','png','pdf');
    
        if(in_array($fileActualExt,$allowed)){
            if($fileError == 0){
                if($fileSize < 1000000){
    
              //fileNameNew = uniqid('',true).".".$fileActualExt;
    
              $fileDestination = '../img/'.$fileName;
              move_uploaded_file($fileTmpName,$fileDestination);
              //header("Location:creer-article.php?uploadsuccess");
    
    
    
            }else{
              echo "votre fichier est trop gros";
            }
    
          }else{
            echo "votre fichier n'est pas au bon format";
    
          }
    
        }
        else{
          echo "votre fichier n'est ";
        }
      }

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
       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        


    


    </head>

<body>

    <main>
    <h1>Creer un article</h1>

    

    <section class="container-fluid">
<form method="POST" action="" enctype="multipart/form-data">

  <div class="form-group">
    <label for="Titre de l'article">Titre de l'article</label>
    <input type="text" class="form-control" name="titre" placeholder="Titre de l'article" required>
  </div>
  <div class="form-group">
    <label for="Sous titre de l'article">Sous Titre de l'article</label>
    <input type="text" class="form-control" name="stitre" placeholder="Sous titre de l'article" required>
  </div>


<input id="browse" type="file" name="files[]" onchange="previewFiles()" multiple="multiple">
<div id="preview"></div>



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
    <select class="form-control" name="section">
    <?php
    
   
    
    foreach ($_SESSION['bdd']->getSection() as $r)
    {
        echo "<option value=".$r[0].">".$r[1]."</option>";
    }
    ?>

    <div class="form-group">
    <label for="Redigez votre article">Redigez votre article</label>
    <textarea class="form-control" name="article" rows="10" cols="160" required></textarea>
  </div>
    </select>
  </div>
  
  
  <button type="submit" class="btn btn-danger" name="submit">Valider l'article</button>
</form>
    </section>
    


    </main>



    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="scripts.js"></script>
</body>
</html>
