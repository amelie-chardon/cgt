<?php


//Rédacteur : personne qui est autorisée à rédiger des articles uniquement
//Droits : "Rédacteur"

class redacteur extends user
{
    public function writeArticles(){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        //$result=$this->execute("SELECT articles.id, articles.titre,utilisateurs.login FROM articles INNER JOIN utilisateurs on utilisateurs.id=articles.id_utilisateurs");
        $result=$this->execute("INSERT INTO `articles` (`id`, `id_utilisateurs`, `id_sections`, `titre`, `sous_titre`, `date`, `contenu`, `statut`)
        VALUES (NULL, '".$_SESSION['user']->getid()."', '1', '".$_POST['titre']."', '".$_POST['stitre']."',NOW(),'".$_POST['article']."', '0')");

        return $result;
    }
    public function getSection()
    {
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("SELECT * FROM sections");
        

        return $result;

    }
   
}

?>
