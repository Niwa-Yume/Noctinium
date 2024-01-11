<?php
    require 'database-connection.php';
    require 'sessions.php';

    if(isset($_GET['event'])){
        $sql = "SELECT event_user_id FROM events WHERE event_id = ". $_GET['event'] .";";
        $statement = $pdo->query($sql);
        $event = $statement->fetch();
        if($event['event_user_id'] == $_SESSION['user_id']){
            header('Location: ../eventModify?event='.$_GET['event']);
            exit;
        }else{
            header('Location: ../compte');
            exit;
        }
    }else{
        header('Location: ../compte');
        exit;
    }
?> 