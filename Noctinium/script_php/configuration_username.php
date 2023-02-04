<?php
    require 'database-connection.php';
    include 'sessions.php';

    if (isset($_POST['username'])){
        $username = $_POST['username'];
        $sql = "UPDATE user SET user_username = '". $username ."' WHERE user_id = ". $_SESSION['user_id'] .";";

        $statement = $mysqli->prepare($sql);
        $statement->execute();

        $_SESSION['user_username'] = $username;

        header ('Location: ../compteConfiguration.php');
    }
?>