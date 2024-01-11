<?php
	require 'database-connection.php';
	include 'sessions.php';
	
	$imgUtinew = "UPDATE user SET user_imageuser_id = 1 WHERE user_id = ". $_SESSION['user_id'] .";";
		
	$statement2 = $pdo->prepare($imgUtinew);
	$statement2->execute();
	
	$imgProfil = "SELECT imageuser_url FROM imageuser WHERE imageuser_id = 1;";
		
	$statement3 = $pdo->query($imgProfil);
	$img_user = $statement3->fetch();
	
	$_SESSION['user_img'] = $img_user['imageuser_url'];
	
	header ('Location: ../compteConfiguration');
?>