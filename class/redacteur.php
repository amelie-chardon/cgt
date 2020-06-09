<?php


//Rédacteur : personne qui est autorisée à rédiger des articles uniquement
//Droits : "Rédacteur"

class redacteur extends user
{

    //Fonction permettant d'écrire un article et l'insérer en base de données avant validation
    public function writeArticles(){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("INSERT INTO `articles` (`id`, `id_utilisateurs`, `id_sections`, `titre`, `sous_titre`, `date`, `contenu`, `statut`,`img`) VALUES (NULL, '".$_SESSION['user']->getid()."','1', '".$_POST['titre']."', '".$_POST['stitre']."',NOW(),'".$_POST['article']."', '0','".$_POST['img']."');");
        
        
        
        echo "Votre article a bien été enregistrer (en attente de publication)!!";

        header("Refresh:2; url=creer-article.php");

        

        return $result;
    }

    

    //Fonction pour récupérer tous les articles du rédacteur
    public function getArticlesRedac(){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $id=$this->id;
        $result=$this->execute("SELECT articles.id, articles.titre,articles.contenu,utilisateurs.login FROM articles INNER JOIN utilisateurs on utilisateurs.id=articles.id_utilisateurs WHERE utilisateurs.id=$id");
        return $result;
    }

    //
   
}

?>
