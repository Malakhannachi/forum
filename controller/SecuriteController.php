<?php
namespace Controller;
use Model\Connect;

class SecuriteController{
    //session_start();
    public function register(){
       
        if (isset($_POST["submit"])) {
            $pdo = Connect::seConnecter();
                //filtrer les données 
                $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
                $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if ($pseudo && $email && $pass1 && $pass2 && $role) {
                    //var_dump("ok");
                    $requete = $pdo -> prepare("
                    SELECT * FROM membre WHERE email=:email");
                    $requete ->execute(["email"=>$email]);
                    $membre = $requete->fetch();
                    if($membre){
                        header("location: index.php?action=register");exit;
                    }else{
                        if($pass1==$pass2 && strlen($pass1)>=8){
                            $requete = $pdo->prepare("
                            INSERT INTO membre (pseudo, email, password, role) 
                            VALUES (:pseudo, :email, :password, :role)");
                            $requete->execute(["pseudo"=>$pseudo, 
                            "email"=>$email, 
                            "password"=>password_hash($pass1, PASSWORD_DEFAULT)
                            ,"role"=>$role
                        ]);
                        
                        }
                        }
                    }
                }

                require("hash/register.php");
        }
    public function login(){
        if (isset($_POST ["submit"])) {
            $pdo = Connect:: seConnecter();
            //filtrer les données 
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
            $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if ($email && $pass1 && $role) {
                //var_dump("ok");
                $requete = $pdo -> prepare("
                SELECT * FROM membre WHERE email=:email");
                $requete ->execute(["email"=>$email]);
                $membre = $requete->fetch();
                if($membre){
                    if(password_verify($pass1, $membre["password"])){
                        $_SESSION["membre"] = $membre;
                        header("location: index.php?action=login");exit;
                    }   
                }   
            }   
        }   
        require("hash/login.php");
    }       
}

               
     
    
