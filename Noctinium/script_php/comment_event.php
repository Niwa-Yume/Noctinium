<?php
    require 'database-connection.php';
    require 'sessions.php';

    if(isset($_GET['event']) and isset($_POST['comment'])){
        if($_GET['event'] != ""){
            if($_POST['comment'] != ""){
                $today = date('Y-m-d H:i:s');
                $sql = "INSERT INTO commentevent (commentevent_content, commentevent_date, commentevent_user_id, commentevent_events_id)
                        VALUES (:commentevent_content, :commentevent_date, :commentevent_user_id, :commentevent_events_id)";
                $comment['commentevent_content'] = $_POST['comment'];
                $comment['commentevent_date'] = $today;
                $comment['commentevent_user_id'] = $_SESSION['user_id'];
                $comment['commentevent_events_id'] = $_GET['event'];
                
                $statement = $pdo->prepare($sql);
                $statement->execute($comment);
                header('Location: ../event.php?event='. $_GET['event'] .'');
                exit;
            }else{
                header('Location: ../error.php');
                exit;
            }
        }else{
            header('Location: ../error.php');
            exit;
        }
    }else{
        header('Location: ../error.php');
        exit;
    }
?>