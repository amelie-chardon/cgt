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
        return $result;
    }

    //Fonction pour récupérer un article
    public function getArticle($id){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("SELECT * from articles WHERE id=$id");
        return $result;
    }

    //Fonction pour supprimer les accents d'une chaîne de caractères
    public function supprAccents($str)
    {
        $url = $str;
        $url = preg_replace('#Ç#', 'C', $url);
        $url = preg_replace('#ç#', 'c', $url);
        $url = preg_replace('#è|é|ê|ë#', 'e', $url);
        $url = preg_replace('#È|É|Ê|Ë#', 'E', $url);
        $url = preg_replace('#à|á|â|ã|ä|å#', 'a', $url);
        $url = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $url);
        $url = preg_replace('#ì|í|î|ï#', 'i', $url);
        $url = preg_replace('#Ì|Í|Î|Ï#', 'I', $url);
        $url = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $url);
        $url = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $url);
        $url = preg_replace('#ù|ú|û|ü#', 'u', $url);
        $url = preg_replace('#Ù|Ú|Û|Ü#', 'U', $url);
        $url = preg_replace('#ý|ÿ#', 'y', $url);
        $url = preg_replace('#Ý#', 'Y', $url);
         
        return ($url);
    }

}


