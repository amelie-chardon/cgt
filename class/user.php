<?php

class user extends bdd{
    private $id = NULL;
    private $login = NULL;
    private $mail = NULL;
    private $droits = NULL;


    public function inscription($login,$mdp,$confmdp,$mail){
        if($login != NULL && $mdp != NULL && $confmdp != NULL && $mail != NULL){
            if($mdp == $confmdp){
                $this->connect();
                
                //On vérifie si le mail est déjà pris
                $requete = "SELECT mail FROM utilisateurs WHERE mail = '$mail'";
                $query = mysqli_query($this->connexion,$requete);
                $result = mysqli_fetch_all($query);

                //On vérifie si le login est déjà pris
                $requete2 = "SELECT login FROM utilisateurs WHERE login = '$login'";
                $query2 = mysqli_query($this->connexion,$requete);
                $result2 = mysqli_fetch_all($query);
                
                if(empty($result) && empty($result2)){
                    $mdp = password_hash($mdp, PASSWORD_BCRYPT, array('cost' => 12));
                    $requete = "INSERT INTO utilisateurs(login,mail,password,droits) VALUES ('$login','$mail','$mdp','user')";
                    $query = mysqli_query($this->connexion,$requete);
                    return "ok";
                    }
                else{
                    return "log";
                }
            }
            else{
                return "mdp";
            }
        }
        else{
            return "empty";
        };

    }
    public function connexion($mail,$mdp){
        $this->connect();
        $requete = "SELECT * FROM utilisateurs WHERE mail = '$mail'";
        $query = mysqli_query($this->connexion,$requete);
        $result = mysqli_fetch_assoc($query);

        if(!empty($result)){
            if($mail == $result["mail"]){
                if(password_verify($mdp,$result["password"])){
                    $this->id = $result["id"];
                    $this->login = $result["login"];
                    $this->mail = $result["mail"];
                    $this->droits = $result["droits"];
                    echo "Succes";
                }
                else{
                    echo "Echec";
                }
            }
            else{
                echo "Echec";
            }
        }
        else{
            echo "Echec";
        }
    }
    
    public function disconnect(){
        $this->id = NULL;
        $this->mail = NULL;
        $this->droits = NULL;
    }

    //FONCTIONS GET//

    public function getid(){
        return $this->id;
    }

    public function getmail(){
        return $this->mail;
    }
    
    public function getDroits(){
        return $this->droits;
    }


    //FONCTIONS IS TEST//
    
    public function isConnected(){
        if ($this->id != null) {
            return true;
        } else {
            return false;
        }
    }

    public function isAdmin(){
        if ($this->droits == 'admin') {
            return true;
        } else {
            return false;
        }
    }
}
?>