<?php
    require 'database-connection.php';
    require 'sessions.php';

    if(isset($_GET['organisateur']) and isset($_POST['comment'])){
        if($_GET['organisateur'] != ""){
            if($_POST['comment'] != ""){
                $today = date('Y-m-d H:i:s');
                $sql = "INSERT INTO commentorganiser (commentorganiser_content, commentorganiser_date, commentorganiser_user_id, commentorganiser_organiser_id)
                        VALUES (:commentorganiser_content, :commentorganiser_date, :commentorganiser_user_id, :commentorganiser_organiser_id)";
                $comment['commentorganiser_content'] = $_POST['comment'];
                $comment['commentorganiser_date'] = $today;
                $comment['commentorganiser_user_id'] = $_SESSION['user_id'];
                $comment['commentorganiser_organiser_id'] = $_GET['organisateur'];
                
                $statement = $pdo->prepare($sql);
                $statement->execute($comment);
                header('Location: ../organisateur?organisateur='. $_GET['organisateur'] .'');
                exit;
            }else{
                header('Location: ../error');
                exit;
            }
        }else{
            header('Location: ../error');
            exit;
        }
    }else{
        header('Location: ../error');
        exit;
    }
?>