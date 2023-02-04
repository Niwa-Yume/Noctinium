<?php
    require 'database-connection.php';
    include 'sessions.php';

    if (isset($_POST['site'])){
        $site = $_POST['site'];
        $sql = "UPDATE user SET user_site = '". $site ."' WHERE user_id = ". $_SESSION['user_id'] .";";

        $statement = $mysqli->prepare($sql);
        $statement->execute();

        $_SESSION['user_site'] = $site;

        header ('Location: ../compteConfiguration.php');
    }
?>