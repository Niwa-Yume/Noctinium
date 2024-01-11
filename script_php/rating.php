<?php
    require 'database-connection.php';
    require 'sessions.php';

    if(isset($_GET['organisateur']) and isset($_POST['rating'])){
        if($_GET['organisateur'] != ""){
            if($_POST['rating'] != ""){;
                if($_GET['organisateur'] == $_SESSION['user_id']){
                    header('Location: ../organisateur?organisateur='. $_GET['organisateur'] .'');
                    exit;
                }else{
                    $test = "SELECT rating_value FROM rating WHERE rating_user_id = ". $_SESSION['user_id'] ." AND rating_organiser_id = ". $_GET['organisateur'] .";";
                    $statement_test = $pdo->query($test);
                    if($statement_test->rowCount() > 0){
                        $sql2 = "UPDATE rating SET rating_value = ". $_POST['rating'] ." WHERE rating_user_id = ". $_SESSION['user_id'] ." AND rating_organiser_id = ". $_GET['organisateur'] ." ;";
                        $statement2 = $pdo->prepare($sql2);
                        $statement2->execute();
                        header('Location: ../organisateur?organisateur='. $_GET['organisateur'] .'');
                        exit;
                    }else{
                        $sql = "INSERT INTO rating (rating_value, rating_user_id, rating_organiser_id)
                                VALUES (:rating_value, :rating_user_id, :rating_organiser_id)";
                        $rating['rating_value'] = $_POST['rating'];
                        $rating['rating_user_id'] = $_SESSION['user_id'];
                        $rating['rating_organiser_id'] = $_GET['organisateur'];
                        
                        $statement = $pdo->prepare($sql);
                        $statement->execute($rating);
                        header('Location: ../organisateur?organisateur='. $_GET['organisateur'] .'');
                        exit;
                    }
                }
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