<?php

//Admin : qui a le droit de gérer les articles, les sections, les infos du site (pas de rédaction)

class admin extends user
{
    //Fonction pour récupérer tous les articles
    public function getArticles(){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("SELECT articles.id, articles.titre,utilisateurs.login, FROM articles INNER JOIN utilisateurs on utilisateurs.id=articles.id_utilisateurs");
        return $result;
    }

    //Fonction pour récupérer tous les articles
    public function supprArticle($id){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("DELETE FROM articles WHERE id=$id");
        return $result;
    }

    //Fonction pour récupérer tous les utilisateurs
    public function getUtilisateurs(){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("SELECT id,login,mail,rank FROM utilisateurs");
        return $result;
    }

    //Fonction pour récupérer toutes les catégories
    public function getCategories(){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("SELECT id,nom FROM categories");
        return $result;
    }
}


?>
