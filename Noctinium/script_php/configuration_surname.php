<?php
    require 'database-connection.php';
    include 'sessions.php';

    if (isset($_POST['surname'])){
        $surname = $_POST['surname'];
        $sql = "UPDATE user SET user_surname = '". $surname ."' WHERE user_id = ". $_SESSION['user_id'] .";";

        $statement = $mysqli->prepare($sql);
        $statement->execute();

        $_SESSION['user_surname'] = $surname;

        header ('Location: ../compteConfiguration.php');
    }
?>