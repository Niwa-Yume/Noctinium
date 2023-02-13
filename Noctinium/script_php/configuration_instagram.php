<?php
    require 'database-connection.php';
    require 'sessions.php';

    if (isset($_POST['instagram'])){
        $instagram = $_POST['instagram'];
        $sql = "UPDATE user SET user_instagram = '". $instagram ."' WHERE user_id = ". $_SESSION['user_id'] .";";

        $statement = $pdo->prepare($sql);
        $statement->execute();

        $_SESSION['user_instagram'] = $instagram;

        header ('Location: ../compteConfiguration.php');
    }
?>