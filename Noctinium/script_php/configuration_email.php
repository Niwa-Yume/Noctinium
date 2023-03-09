<?php
    require 'database-connection.php';
    require 'sessions.php';

    if (isset($_POST['email'])){
        $email = $_POST['email'];
        $sql = "UPDATE user SET user_email = '". $email ."' WHERE user_id = ". $_SESSION['user_id'] .";";

        $statement = $pdo->prepare($sql);
        $statement->execute();

        $_SESSION['user_email'] = $email;

        header ('Location: ../compteConfiguration');
    }
?>