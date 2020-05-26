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
        $nom=$this->execute("SELECT nom FROM sections WHERE id=$id");
        $result=$this->execute("DELETE FROM sections WHERE id=$id");
        $nom=$nom[0][0];
        $nom_fichier=$this->str2url($nom);
        unlink("../section-$nom_fichier.php");
        return $result;
    }

    //Fonction pour créer une section dans la bdd et un fichier php en local
    public function addSection($nom){
        $this->connect();
        $this->execute("SET NAMES UTF8");
        $result=$this->execute("INSERT INTO sections (id,nom) VALUES (NULL,\"$nom\")");
        $nom_fichier=$this->str2url($nom);
        $myfile = fopen("../section-$nom_fichier.php", "w");
        return $result;
    }

}


?>
