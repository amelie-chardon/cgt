<?php

//Admin : qui a le droit de gérer les articles, les sections, les infos du site (pas de rédaction)
//Droits : "Administrateur"

class admin extends user
{
    //UTILISATEURS//

    //Fonction pour récupérer tous les utilisateurs
    public function getUtilisateurs(){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("SELECT id,login,mail,droits FROM utilisateurs");
        return $result;
    }

    //Fonction pour supprimer un utilisateur
    public function supprUtilisateur($id){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("DELETE FROM utilisateurs WHERE id=$id");
        return $result;
    }

    //Fonction pour modifier les droits d'un utilisateur
    public function modifDroits($id,$droits){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("UPDATE utilisateurs SET droits = \"$droits\" WHERE utilisateurs.id = $id");
        return $result;
    }

    //SECTIONS//

    //Fonction pour récupérer toutes les sections
    public function getSections(){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("SELECT id,nom FROM sections");
        return $result;
    }

    //Fonction pour supprimer une section
    public function supprSection($id){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("DELETE FROM sections WHERE id=$id");
        return $result;
    }
}


?>
