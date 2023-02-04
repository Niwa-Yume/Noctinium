<?php
	require 'database-connection.php';
	include 'sessions.php';

	if ($logged_in) {                              // If already logged in
		header('Location: ../compte.php');           // Redirect to account page
		exit;                                      // Stop further code running
	}    

	if($_SERVER['REQUEST_METHOD'] == 'POST') {     // If form submitted
		$user_email =  $_POST['email'];           // Email user sent
		$user_password_unmasked =  $_POST['mdp'];      // Password user sent

		$conn = "SELECT user_password
			FROM user 
            WHERE user_email = '". $user_email . "';";

		$statement = mysqli_query($mysqli, $conn);
		$password_hashed = mysqli_fetch_array($statement);
		$user_password = $password_hashed['user_password'];

		if(!password_verify($user_password_unmasked, $user_password)){
		header('Location: ../error.php');
		} else {    //if details correct
		$sql = "SELECT user_id, user_surname, user_name, user_username, user_telephone, user_birthdate, user_timecreation, 
		user_imageuser_id, user_type, user_typesubcription, user_description, user_instagram, user_twitter, user_site 
		FROM user WHERE user_email = '". $user_email ."' AND user_password = '". $user_password ."';";
	
		$statement2 = mysqli_query($mysqli, $sql);
		$infoUser = mysqli_fetch_array($statement2);
		$user_id = $infoUser['user_id'];
		$user_surname = $infoUser['user_surname'];
		$user_name = $infoUser['user_name'];
		$user_username = $infoUser['user_username'];
		$user_telephone = $infoUser['user_telephone'];
		$user_birthdate = $infoUser['user_birthdate'];
		$user_timecreation = $infoUser['user_timecreation'];
		$user_imageuser_id = $infoUser['user_imageuser_id'];
		$user_type = $infoUser['user_type'];
		$user_typesubcription = $infoUser['user_typesubcription'];
		$user_decription = $infoUser['user_description'];
		$user_instagram = $infoUser['user_instagram'];
		$user_twitter = $infoUser['user_twitter'];
		$user_site = $infoUser['user_site'];
		
		$imgProfil = "SELECT imageuser_url FROM imageuser WHERE imageuser_id = '". $user_imageuser_id ."';";
		
		$statement3 = mysqli_query($mysqli, $imgProfil);
		$img_user = mysqli_fetch_array($statement3);
		$user_img = $img_user['imageuser_url'];
		
		$messageErreur = "";
		login($user_id, $user_surname, $user_name, $user_username, $user_telephone, $user_birthdate, $user_email, 
		$user_password, $user_timecreation, $user_img, $user_type, $user_typesubcription, $user_decription, $user_instagram, $user_twitter, $user_site);                               // Call login function
		header('Location: ../compte.php');       // Redirect to account page
		exit;                                  // Stop further code running
		}
	}
?>