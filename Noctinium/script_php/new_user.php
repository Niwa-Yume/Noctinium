<?php
	require 'database-connection.php';
	
	date_default_timezone_set('Europe/Zurich');

	$sql = "INSERT INTO user (user_surname, user_name, user_username, user_email, user_telephone, user_birthdate, user_password, user_timecreation, user_imageuser_id)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
	
	if (isset($_POST['surname']) and isset($_POST['name']) and isset($_POST['username']) and isset($_POST['telephone']) and isset($_POST['birthdate']) and isset($_POST['email']) and isset($_POST['mdp']) and isset($_POST['mdp2']) and isset($_POST['conditions']) and $_POST['mdp'] == $_POST['mdp2']){
		$password_to_hash = $_POST['mdp'];
		$password_hashed = password_hash($password_to_hash, PASSWORD_BCRYPT, ['cost' => 10]);
		$user['user_surname'] = $_POST['surname'];
		$user['user_name'] = $_POST['name'];
		$user['user_username'] = $_POST['username'];
		$user['user_telephone'] = $_POST['telephone'];
		$user['user_birthdate'] = $_POST['birthdate'];
		$user['user_email'] = $_POST['email'];
		$user['user_password'] = $password_hashed;
		$user['user_timecreation'] = date('d-m-y h:i:s');
		$user['user_userimage'] = 1;
	}else{
		header('Location: ../error.php');
		exit;
	}
	
	$statement = $mysqli->prepare($sql);
	$statement->bind_param("ssssssssi", $user['user_surname'], $user['user_name'], $user['user_username'], $user['user_email'], $user['user_telephone'], $user['user_birthdate'], $user['user_password'], $user['user_timecreation'], $user['user_userimage']);
	$statement->execute();
	
	header('Location: ../connexion.php');
	exit;
?>