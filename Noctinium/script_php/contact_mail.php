<?php
if(isset($_POST['name']) and isset($_POST['email']) and isset($_POST['message']))
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = "Contact via formulaire";
	$message = $_POST['message'];

	$email_body = "Demande de contact via le formulaire de la part de:\n\n$name.\n\nVoici le contenu:\n\n$message";
    
	$to = "noctinium@protonmail.com";//<== update the email address
	$headers = "From: <$email>\r\nReply-To: $email";
	//Send the email!
	mail($to,$subject,$email_body,$headers);
	//done. redirect to thank-you page.
	header('Location: ../contact.php?sent=1');

	
}else{
	header('Location: ../contact.php?sent=2');
}
?> 