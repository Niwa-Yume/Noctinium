<?php
    require 'database-connection.php';
    require 'sessions.php';

    if (isset($_POST['username'])){
        $username = $_POST['username'];
        $test = "SELECT user_username FROM user WHERE user_username = '". $username ."';";
        $check = $pdo->query($test);
        if($check->rowCount() == 0){
            $sql = "UPDATE user SET user_username = '". $username ."' WHERE user_id = ". $_SESSION['user_id'] .";";

            $statement = $pdo->prepare($sql);
            $statement->execute();

            $_SESSION['user_username'] = $username;

            header ('Location: ../compteConfiguration');
        }else{
            header('Location: ../compteConfiguration?error=1&username=1');
        }
    }
?>