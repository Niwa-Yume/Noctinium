<?php
require 'database-connection.php';

session_start();                                         // Start/renew session
$logged_in = $_SESSION['logged_in'] ?? false;            // Is user logged in?


function login($user_id, $user_surname, $user_name, $user_username, $user_telephone, $user_email, $user_img)                                         // Remember user passed login
{
    session_regenerate_id(true);                         // Update session id
    $_SESSION['logged_in'] = true;                       // Set logged_in key to true
	$_SESSION['user_id'] = $user_id;
	$_SESSION['user_nom'] = $user_surname;
	$_SESSION['user_prenom'] = $user_name;
	$_SESSION['user_pseudo'] = $user_username;
	$_SESSION['user_numtel'] = $user_telephone;
	$_SESSION['user_email'] = $user_email;
	$_SESSION['user_img'] = $user_img;
}

function logout()                                        // Terminate the session
{
    $_SESSION = [];                                      // Clear contents of array

    $params = session_get_cookie_params();               // Get session cookie parameters
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'],
        $params['secure'], $params['httponly']);         // Delete session cookie

    session_destroy();                                   // Delete session file
	header('../pages/index.php');
}
?>