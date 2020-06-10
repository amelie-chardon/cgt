<?php

//Rédacteur : personne qui a les droits "rédacteur" + qui a le droit de valider/publier des articles
//Droits : "Rédacteur"

class relecteur extends redacteur
{   
    //Fonction permettant d'écrire un article et l'insérer en base de données avant validation
    public function writeArticles(){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("INSERT INTO `articles`(`id`, `id_utilisateurs`, `id_sections`, `titre`, `sous_titre`, `date`, `contenu`, `statut`,`img`) VALUES (NULL, '".$_SESSION['user']->getid()."','1', '".$_POST['titre']."', '".$_POST['stitre']."',NOW(),'".$_POST['article']."', '0','".$_POST['img']."')");
        
        echo "Votre article a bien été enregistrer il est désormais en attente de publication !!";

        header("Refresh:2; url=creer-article.php");
        

        return $result;
    }
    
    //Fonction pour récupérer tous les articles
    public function getArticles($id){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("SELECT articles.id, articles.titre,articles.contenu,articles.statut,utilisateurs.login, FROM articles INNER JOIN utilisateurs on utilisateurs.id=articles.id_utilisateurs");
        return $result;
    }

    ////Fonction Valider un article
    public function validate($id,$statut){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("UPDATE articles SET statut = \"$statut\" WHERE articles.id = $id");
        return $result;
    }

    
   

    //Fonction pour supprimer un article
    public function supprArticle($id){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("DELETE FROM articles WHERE id=$id");
        return $result;
    }

}
?>
