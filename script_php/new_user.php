<?php
	require 'database-connection.php';
	require 'sessions.php';
	
	date_default_timezone_set('Europe/Zurich');

	$sql = "INSERT INTO user (user_surname, user_name, user_username, user_email, user_telephone, user_birthdate, user_password, user_timecreation, user_imageuser_id)
				VALUES (:user_surname, :user_name, :user_username, :user_email, :user_telephone, :user_birthdate, :user_password, :user_timecreation, :user_imageuser_id)";
	
	if($logged_in){
		header('Location: ../compte');
		exit;
	}

	if (isset($_POST['surname']) and isset($_POST['name']) and isset($_POST['username']) and isset($_POST['telephone']) and isset($_POST['birthdate']) and isset($_POST['email']) and isset($_POST['mdp']) and isset($_POST['mdp2']) and isset($_POST['conditions']) and $_POST['mdp'] == $_POST['mdp2']){
		$sql2 = "SELECT user_email FROM user WHERE user_email = '". $_POST['email'] ."';";
		$test = $pdo->query($sql2);
		if($test->rowCount() == 0){
			$sql3 = "SELECT user_telephone FROM user WHERE user_telephone = '". $_POST['telephone'] ."';";
			$test2 = $pdo->query($sql3);
			if($test2->rowCount() == 0){
				$sql4 = "SELECT user_username FROM user WHERE user_username = '". $_POST['username'] ."';";
				$test3 = $pdo->query($sql4);
				if($test3->rowCount() == 0){
					$today = date('Y-m-d', strtotime(' -16 years'));
					$datenaisint = explode(" / ", $_POST['birthdate']);
					$datenaissance = $datenaisint[2]."-".$datenaisint[1]."-".$datenaisint[0];
					if($datenaissance < $today){
						$password_to_hash = $_POST['mdp'];
						$password_hashed = password_hash($password_to_hash, PASSWORD_BCRYPT, ['cost' => 10]);
						$user['user_surname'] = $_POST['surname'];
						$user['user_name'] = $_POST['name'];
						$user['user_username'] = $_POST['username'];
						$user['user_telephone'] = $_POST['telephone'];
						$user['user_birthdate'] = $datenaissance;
						$user['user_email'] = $_POST['email'];
						$user['user_password'] = $password_hashed;
						$user['user_timecreation'] = date('Y-m-d H:i:s');
						$user['user_imageuser_id'] = 1;
					}else{
						header('Location: ../inscription?error=1&birth=1&surname='. $_POST['surname'] .'&name='. $_POST['name'] .'&username='. $_POST['username'] .'&tel='. $_POST['telephone'] .'&birthdate='. $_POST['birthdate'] .'&mail='. $_POST['email'] .'');
						exit;
					}
				}else{
					header('Location: ../inscription?error=1&uname=1&surname='. $_POST['surname'] .'&name='. $_POST['name'] .'&username='. $_POST['username'] .'&tel='. $_POST['telephone'] .'&birthdate='. $_POST['birthdate'] .'&mail='. $_POST['email'] .'');
				exit;
				}
			}else{
				header('Location: ../inscription?error=1&telephone=1&surname='. $_POST['surname'] .'&name='. $_POST['name'] .'&username='. $_POST['username'] .'&tel='. $_POST['telephone'] .'&birthdate='. $_POST['birthdate'] .'&mail='. $_POST['email'] .'');
				exit;
			}
		}else{
			header('Location: ../inscription?error=1&email=1&surname='. $_POST['surname'] .'&name='. $_POST['name'] .'&username='. $_POST['username'] .'&tel='. $_POST['telephone'] .'&birthdate='. $_POST['birthdate'] .'&mail='. $_POST['email'] .'');
			exit;
		}
	}else{
		header('Location: ../error');
		exit;
	}
	
	$statement = $pdo->prepare($sql);
	$statement->execute($user);
	
	header('Location: ../connexion');
	exit;
?>