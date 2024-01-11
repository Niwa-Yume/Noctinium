<?php
	require 'database-connection.php';
	require 'sessions.php';

	if ($logged_in) {                              // If already logged in
		header('Location: ../compte');           // Redirect to account page
		exit;                                      // Stop further code running
	}    

	if($_SERVER['REQUEST_METHOD'] == 'POST') {     // If form submitted
		if(isset($_POST['email'])){
			$user_email =  $_POST['email']; 		         // Email user sent
		}else{
			header('Location: ../connexion?error=1&email=1');
			exit;
		}
		if(isset($_POST['mdp'])){
			$user_password_unmasked =  $_POST['mdp'];        // Password user sent
		}else{
			header('Location: ../connexion?error=1&password=1');
			exit;
		}

		$conn = "SELECT user_password FROM user WHERE user_email = '". $user_email . "';";

		$statement = $pdo->query($conn);
		if($statement->rowCount() > 0){
			$password_hashed = $statement->fetch();
			$user_password = $password_hashed['user_password'];
		}else{
			header('Location: ../connexion?error=1&account=1');
			exit;
		}
		$verify = password_verify($user_password_unmasked, $user_password);
		if(!$verify){
			header('Location: ../connexion?error=1&password=2');
			exit;
		} else {    //if details correct
			$sql = "SELECT user_id, user_surname, user_name, user_username, user_telephone, user_birthdate, user_timecreation, 
			user_imageuser_id, user_type, user_typesubscription, user_description, user_instagram, user_twitter, user_site 
			FROM user WHERE user_email = '". $user_email ."';";
			$statement2 = $pdo->query($sql);
			$infoUser = $statement2->fetch();
			$user_id = $infoUser['user_id'];
			$user_surname = $infoUser['user_surname'];
			$user_name = $infoUser['user_name'];
			$user_username = $infoUser['user_username'];
			$user_telephone = $infoUser['user_telephone'];
			$user_birthdate = $infoUser['user_birthdate'];
			$user_timecreation = $infoUser['user_timecreation'];
			$user_imageuser_id = $infoUser['user_imageuser_id'];
			$user_type = $infoUser['user_type'];
			$user_typesubscription = $infoUser['user_typesubscription'];
			$user_decription = $infoUser['user_description'];
			$user_instagram = $infoUser['user_instagram'];
			$user_twitter = $infoUser['user_twitter'];
			$user_site = $infoUser['user_site'];
			$imgProfil = "SELECT imageuser_url FROM imageuser WHERE imageuser_id = '". $user_imageuser_id ."';";
			
			$statement3 = $pdo->query($imgProfil);
			$img_user = $statement3->fetch();
			$user_img = $img_user['imageuser_url'];
			$messageErreur = "";
			login($user_id, $user_surname, $user_name, $user_username, $user_telephone, $user_birthdate, $user_email, 
			$user_password, $user_timecreation, $user_img, $user_type, $user_typesubscription, $user_decription, $user_instagram, $user_twitter, $user_site);                               // Call login function
			header('Location: ../compte');       // Redirect to account page
			exit;                                  // Stop further code running
		}
	}
?>