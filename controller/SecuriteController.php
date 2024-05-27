<?php
namespace Controller;
session_start();
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
                //$role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if ($pseudo && $email && $pass1 && $pass2 ) {           //si les filtres sont ok
                    //var_dump("ok");die;
                    $requete = $pdo -> prepare("
                    SELECT * 
                    FROM membre 
                    WHERE email=:email");
                    $requete ->execute(["email"=>$email]);
                    $membre = $requete->fetch();
                    if($membre){     // si le membre existe
                        //var_dump("existe");die;
                        header("Location: index.php?action=register");exit;
                    }else{
                        //var_dump("n'existe pas");die; 
                        //si le membre n'existe pas
                        if($pass1==$pass2 && strlen($pass1)>=8){
                            $insertmembre = $pdo->prepare("
                            INSERT INTO membre (pseudo, email, password) 
                            VALUES (:pseudo, :email, :password)");
                            $insertmembre->execute([
                                "pseudo"=>$pseudo, 
                                "email"=>$email, 
                                "password"=>password_hash($pass1, PASSWORD_DEFAULT)  //hasher le mot de passe
                        ]);
                        header("Location: index.php?action=login");exit;
                        
                        } else {
                            header("Location: index.php?action=register");exit;
                            echo "les mots de passe ne sont pas identiques ou le mot de passe est trop court";
                        }
                    }
                } else {
                    header("Location: index.php?action=register");exit;
                    echo "veuillez remplir tous les champs";
                }

            } // fin submit
            
            require("hash/register.php");
    }

    public function login() {
        if (isset($_POST ["submit"])) {
            $pdo = Connect::seConnecter();
            //filtrer les données 
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if ($email && $password) { 
                //var_dump("ok");
                $requete = $pdo -> prepare("
                    SELECT * 
                    FROM membre 
                    WHERE email=:email");  //recuperer l'email
                    $requete ->execute(["email"=>$email]);
                    $membre = $requete->fetch();
                    //var_dump($membre);die;
                    if($membre){  
                        //var_dump("existe");die;                          // si l'email existe
                        $hash = $membre["password"];  
                        // var_dump($hash);die;    //acceder au mot de passe 
                        if(password_verify($password, $hash)){
                            //var_dump("ok");die;
                            $_SESSION["membre"] = $membre;
                            header("Location: index.php?action=accueil");exit;
                        } 
                    }else{
                        header("Location: index.php?action=login");exit;
                        echo "email ou mot de passe incorrect";
                    }  
                    }   
                }  //fin submit
                require ("hash/login.php");  
            } 

            
    //  public function logout(){
        // session_destroy();
        // header("location: index.php?action=login");exit;
        
        //}  
        public function accueil(){
            require ("view/acceuil.php");
        }     
    }


                
        
        
