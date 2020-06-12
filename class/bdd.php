<?php

class bdd{

    protected $connexion = "";
    private $query="";
    private $result=[];

public function connect()
    {
        $connect = mysqli_connect('localhost', 'root', '','cgt');
        if($connect == false)
        {
            return false;
        }
        $this->connexion = $connect;
    }


    public function close(){
        mysqli_close($this->connexion);
    }


    public function execute($query)
    { 
        {
            $this->query=$query;
            $execute=mysqli_query($this->connexion, $query);

            // Si le résultat est un booléen 
            if(is_bool($execute))
            {
                $this->result=$execute;
            }
            // Si le résultat est un tableau
            else
            {
                $this->result=mysqli_fetch_all($execute);
            }

            return $this->result;
        }
    }

//Fonctions sur la BDD

    //Fonction recherche sur les articles (titre et contenu)
    public function search($str){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $str=addslashes($str);
        $result=$this->execute("SELECT id,titre from articles WHERE titre,contenu LIKE '%$str%' GROUP BY id ORDER BY id DESC");
        $this->search=$str;
        var_dump($str);
        return $result;
    }

    //Fonction pour récupérer un article
    public function getArticle($id){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("SELECT * from articles WHERE id=$id");
        return $result;
    }

    //Fonction pour récupérer tous les articles
    public function getArticles($id){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("SELECT articles.id, articles.titre,articles.contenu,articles.statut,utilisateurs.login FROM articles INNER JOIN utilisateurs on utilisateurs.id=articles.id_utilisateurs");
        return $result;
    }

    //Fonction pour récupérer les derniers articles
    public function lastArticle($i){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("SELECT id,titre,sous_titre,img FROM articles  ORDER BY `articles`.`date` DESC LIMIT 3 OFFSET 0");
        return $result[$i];
              
    }

    //Fonction de récupération des sections 
    public function getSection()
    {
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("SELECT * FROM sections");

        return $result;

    }
    

    //Fonction pour supprimer les accents d'une chaîne de caractères et mettre en minuscules
    public function str2url($str)
    {
        $url = $str;
        $url = preg_replace('#Ç#', 'c', $url);
        $url = preg_replace('#ç#', 'c', $url);
        $url = preg_replace('#è|é|ê|ë#', 'e', $url);
        $url = preg_replace('#È|É|Ê|Ë#', 'e', $url);
        $url = preg_replace('#à|á|â|ã|ä|å#', 'a', $url);
        $url = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'a', $url);
        $url = preg_replace('#ì|í|î|ï#', 'i', $url);
        $url = preg_replace('#Ì|Í|Î|Ï#', 'i', $url);
        $url = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $url);
        $url = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'o', $url);
        $url = preg_replace('#ù|ú|û|ü#', 'u', $url);
        $url = preg_replace('#Ù|Ú|Û|Ü#', 'u', $url);
        $url = preg_replace('#ý|ÿ#', 'y', $url);
        $url = preg_replace('#Ý#', 'y', $url);
        $url = preg_replace('#([^.a-z0-9]+)#i', '-', $url); 
        $url = preg_replace('#-{2,}#','-',$url); 
        $url = preg_replace('#-$#','',$url); 
        $url = preg_replace('#^-#','',$url); 
        $url = strtolower($url);

        return ($url);
    }

}


