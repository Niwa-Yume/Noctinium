<?php
    require 'database-connection.php';
    require 'sessions.php';

    if (isset($_POST['email'])){
        $email = $_POST['email'];
        $test = "SELECT user_email FROM user WHERE user_email = '". $email ."';";
        $check = $pdo->query($test);
        if($check->rowCount() == 0){
            $sql = "UPDATE user SET user_email = '". $email ."' WHERE user_id = ". $_SESSION['user_id'] .";";

            $statement = $pdo->prepare($sql);
            $statement->execute();

            $_SESSION['user_email'] = $email;

            header ('Location: ../compteConfiguration');
        }else{
            header('Location: ../compteConfiguration?error=1&email=1');
        }
    }
?>