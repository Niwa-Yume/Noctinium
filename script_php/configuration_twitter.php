<?php
    require 'database-connection.php';
    require 'sessions.php';

    if (isset($_POST['twitter'])){
        $twitter = $_POST['twitter'];
        $sql = "UPDATE user SET user_twitter = '". $twitter ."' WHERE user_id = ". $_SESSION['user_id'] .";";

        $statement = $pdo->prepare($sql);
        $statement->execute();

        $_SESSION['user_twitter'] = $twitter;

        header ('Location: ../compteConfiguration');
    }
?>