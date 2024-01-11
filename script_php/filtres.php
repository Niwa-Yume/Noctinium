<?php
    $today = date('Y-m-d H:i:s');

    $link = "../eventlist?filtre=1&";

    if(isset($_POST['musique'])){
        if(1 <= $_POST['musique'] and $_POST['musique'] <= 14){
            $link .= "music=".$_POST['musique'];
            $link .= "&";
        }
    }
    if(isset($_POST['type'])){
        if(1 <= $_POST['type'] and $_POST['type'] <= 6){
            $link .= "type=".$_POST['type'];
            $link .= "&";
        }
    }
    if(isset($_POST['orga'])){
        if(1 <= $_POST['orga'] and $_POST['orga'] <= 3){
            $link .= "orga=".$_POST['orga'];
            $link .= "&";
        }
    }
    if(isset($_POST['date'])){
        $dateeventint = explode(" / ", $_POST['date']);
        $dateevent = $dateeventint[2]."-".$dateeventint[1]."-".$dateeventint[0];
        if($dateevent >= $today){
            $date = urlencode($dateevent);
            $link .= "date=".$date;
            $link .= "&";
        }
    }
    if(isset($_POST['ordre'])){
        if(1 <= $_POST['ordre'] and $_POST['ordre'] <= 2){
            $link .= "ordre=".$_POST['ordre'];
        }
    }

    header('Location: '.$link);
?> 