<?php
session_start();
if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "register":
            if ($_POST ["submit"]) {
                $pdo = new PDO("mysql:host=localhost;dbname=hash", "root", "");
            $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
            $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if ($pseudo && $email && $pass1 && $pass2) {
                //var_dump("ok");
                $requete = $pdo -> prepare("
                SELECT *FROM membre WHERE email=:email");
                $requete ->execute(["email"=>$email]);
                $user = $requete->fetch();
                if($user){
                    header("location: register.php");exit;
                }else{
                    if($pass1==$pass2 && strlen($pass1)>=6){
                        $requeteuser = $pdo->prepare("
                        INSERT INTO user (pseudo, email, password) 
                        VALUES (:pseudo, :email, :password)");
                        $requeteuser->execute(["pseudo"=>$pseudo, 
                        "email"=>$email, 
                        "password"=>password_hash($pass1, PASSWORD_DEFAULT)
                    ]);
                    
                    }
                    }
                }
 
                
            }
            header("location: login.php");exit;
            
            break;
            case "login":
                if ($_POST["submit"])   {
                    $pdo = new PDO("mysql:host=localhost;dbname=hash", "root", "");
                    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
                    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    if ($email && $password) {
                        $requete = $pdo -> prepare("
                        SELECT * FFROM membre WHERE email = :email");
                        $requete ->execute(["email"=>$email]);
                        $user = $requete->fetch();
                    }
                 
                }
                break;
            case "logout":
                break;
            

    }
     
    }

