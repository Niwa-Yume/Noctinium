<?php
    require 'database-connection.php';
    require 'sessions.php';

    if (isset($_POST['description'])){
        $description = $_POST['description'];
        $sql = "UPDATE user SET user_description = '". $description ."' WHERE user_id = ". $_SESSION['user_id'] .";";

        $statement = $pdo->prepare($sql);
        $statement->execute();

        $_SESSION['user_description'] = $description;

        header ('Location: ../compteConfiguration.php');
    }
?>