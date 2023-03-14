<?php
    require 'database-connection.php';
    require 'sessions.php';

    if (isset($_POST['telephone'])){
        $telephone = $_POST['telephone'];
        $sql = "UPDATE user SET user_telephone = '". $telephone ."' WHERE user_id = ". $_SESSION['user_id'] .";";

        $statement = $pdo->prepare($sql);
        $statement->execute();

        $_SESSION['user_telephone'] = $telephone;

        header ('Location: ../compteConfiguration');
    }
?>