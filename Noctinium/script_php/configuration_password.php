<?php
    require 'database-connection.php';
    require 'sessions.php';

    if (isset($_POST['mdp']) and isset($_POST['mdp2']) and isset($_POST['mdp3']) and $_POST['mdp'] == $_POST['mdp2']){
        $passowrd = $_POST['mdp3'];
        $new_password = $_POST['mdp'];
        if(password_verify($passowrd, $_SESSION['user_password'])){
            $new_password_hashed = password_hash($new_password, PASSWORD_BCRYPT, ['cost' => 10]);

            $sql = "UPDATE user SET user_password = '". $new_password_hashed ."' WHERE user_id = ". $_SESSION['user_id'] .";";
            
            $statement = $pdo->prepare($sql);
            $statement->execute();

            $_SESSION['user_password'] = $new_password_hashed;

            header ('Location: ../compteConfiguration.php');
            exit;
        }else{
            header ('Location: ../error.php');
            exit;
        }
    }else{
        header ('Location: ../error.php');
        exit;
    }
?>