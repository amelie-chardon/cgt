<?php

class user extends bdd{
    private $id = NULL;
    private $mail = NULL;
    private $droits = NULL;


    public function inscription($prenom,$nom,$mdp,$confmdp,$mail){
        if($prenom != NULL && $nom != NULL&& $mdp != NULL && $confmdp != NULL && $mail != NULL){
            if($mdp == $confmdp){
                $this->connect();
                $requete = "SELECT email FROM utilisateurs WHERE email = '$mail'";
                $query = mysqli_query($this->connexion,$requete);
                $result = mysqli_fetch_all($query);
                
                if(empty($result)){
                    $mdp = password_hash($mdp, PASSWORD_BCRYPT, array('cost' => 12));
                    $requete = "INSERT INTO utilisateurs(nom,prenom,email,password) VALUES ('$nom','$prenom','$mail','$mdp')";
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

    public function creation_tache($titre,$description){
        //TODO : gérer l'enregistrement des tâches pour que l'utilisateur connecté puisse retrouver son tableau lors de la prochaine connexion (charger les taches selon la colonne dans todolist.php)
        if($titre!= NULL && $description!= NULL){
            $this->connect();
            $this->execute("INSERT INTO taches (id_utilisateurs,titre,date_creation,description) VALUES('$this->id','$titre',NOW(),'$description')");
            return "ok";
        }
        else
        {
            return "empty";
        };
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