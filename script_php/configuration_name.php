<?php
    require 'database-connection.php';
    require 'sessions.php';

    if (isset($_POST['name'])){
        $name = $_POST['name'];
        $sql = "UPDATE user SET user_name = '". $surname ."' WHERE user_id = ". $_SESSION['user_id'] .";";

        $statement = $pdo->prepare($sql);
        $statement->execute();

        $_SESSION['user_name'] = $name;

        header ('Location: ../compteConfiguration');
    }
?>