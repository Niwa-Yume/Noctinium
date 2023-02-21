<?php
    $link = "../eventlist.php?search=";

    if(isset($_POST['search'])){
        $link .= urlencode($_POST['search']);
    }
    header('Location: '.$link);
?>