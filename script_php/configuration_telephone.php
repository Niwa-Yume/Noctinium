<?php
    require 'database-connection.php';
    require 'sessions.php';

    if (isset($_POST['telephone'])){
        $telephone = $_POST['telephone'];
        $test = "SELECT user_telephone FROM user WHERE user_telephone = '". $telephone ."';";
        $check = $pdo->query($test);
        if($check->rowCount() == 0){
            $sql = "UPDATE user SET user_telephone = '". $telephone ."' WHERE user_id = ". $_SESSION['user_id'] .";";

            $statement = $pdo->prepare($sql);
            $statement->execute();

            $_SESSION['user_telephone'] = $telephone;

            header ('Location: ../compteConfiguration');
        }else{
            header('Location: ../compteConfiguration?error=1&telephone=1');
        }
    }
?>