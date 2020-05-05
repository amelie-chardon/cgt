<?php

//Rédacteur : personne qui a les droits "rédacteur" + qui a le droit de valider/publier des articles
//Droits : "Rédacteur"

class relecteur extends redacteur
{
    //Fonction pour récupérer tous les articles
    public function getArticles(){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("SELECT articles.id, articles.titre,utilisateurs.login, FROM articles INNER JOIN utilisateurs on utilisateurs.id=articles.id_utilisateurs");
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
