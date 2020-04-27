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

}


