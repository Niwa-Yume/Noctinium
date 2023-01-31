<?php
require 'database-connection.php';

session_start();                                         // Start/renew session
$logged_in = $_SESSION['logged_in'] ?? false;            // Is user logged in?


function login($user_id, $user_surname, $user_name, $user_username, $user_telephone, $user_birthdate, $user_email, 
$user_password, $user_timecreation, $user_img, $user_type, $user_typesubcription, $user_decription, $user_instagram, $user_twitter, $user_site)                                         // Remember user passed login
{
    session_regenerate_id(true);                         // Update session id
    $_SESSION['logged_in'] = true;                       // Set logged_in key to true
	$_SESSION['user_id'] = $user_id;
	$_SESSION['user_surname'] = $user_surname;
	$_SESSION['user_name'] = $user_name;
	$_SESSION['user_username'] = $user_username;
	$_SESSION['user_telephone'] = $user_telephone;
	$_SESSION['user_birthdate'] = $user_birthdate;
	$_SESSION['user_email'] = $user_email;
	$_SESSION['user_password'] = $user_password;
	$_SESSION['user_timecreation'] = $user_timecreation;
	$_SESSION['user_img'] = $user_img;
	$_SESSION['user_type'] = $user_type;
	$_SESSION['user_typesubcription'] = $user_typesubcription;
	$_SESSION['user_description'] = $user_decription;
	$_SESSION['user_instagram'] = $user_instagram;
	$_SESSION['user_twitter'] = $user_twitter;
	$_SESSION['user_site'] = $user_site;
}

function logout()                                        // Terminate the session
{
    $_SESSION = [];                                      // Clear contents of array

    $params = session_get_cookie_params();               // Get session cookie parameters
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'],
        $params['secure'], $params['httponly']);         // Delete session cookie

    session_destroy();                                   // Delete session file
}
?>