<?php
	require 'database-connection.php';
    include 'sessions.php';

    date_default_timezone_set('Europe/Zurich');

	$sql = "INSERT INTO events (event_title, event_datetime, event_location, event_description, event_music,
     event_type, event_private, event_maskedlocation, event_price, event_user_id)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	
	if (isset($_POST['nom_event']) and isset($_POST['date_event']) and isset($_POST['description_event']) 
    and isset($_POST['adresse_event']) and isset($_POST['musique']) and isset($_POST['type']) and isset($_POST['conditions'])){
		$event['event_title'] = $_POST['nom_event'];
		$event['event_datetime'] = $_POST['date_event'];
		$event['event_location'] = $_POST['adresse_event'];
		$event['event_description'] = $_POST['description_event'];
		$event['event_music'] = $_POST['musique'];
		$event['event_type'] = $_POST['type'];
        $event['event_user_id'] = $_SESSION['user_id'];
        if ($_POST['date_event_mask'] == "") {
            $event['event_maskedlocation'] = date('d-m-y h:i:s');
        }else{
            $event['event_maskedlocation'] = $_POST['date_event_mask'];
        }
        if (isset($_POST['private'])) {
            $event['event_private'] = 1;
        }else{
            $event['event_private'] = 0;
        }
		if ($_POST['prix_event'] == "") {
            $event['event_price'] = 0;
        }else{
            $event['event_price'] = $_POST['prix_event'];
        }

        $event_add = $mysqli->prepare($sql);
	    $event_add->bind_param("ssssiissii", $event['event_title'], $event['event_datetime'], $event['event_location'],
        $event['event_description'], $event['event_music'], $event['event_type'], $event['event_private'],
        $event['event_maskedlocation'], $event['event_price'], $event['event_user_id']);
	    $event_add->execute();

        $event_id = $mysqli->insert_id;

        if ($_FILES['img_event']['name'] != "") {
            $moved         = false;                                        // Initialize
            $message       = '';                                           // Initialize
            $error         = '';                                           // Initialize
            $upload_path   = '../imageevent/';                                   // Upload path
            $max_size      = 5242880;                                      // Max file size
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif',];    // Allowed file types
            $allowed_exts  = ['jpeg', 'jpg', 'png', 'gif',];               // Allowed file extensions
    
            function create_filename($filename, $upload_path)              // Function to make filename
            {
                $basename   = pathinfo($filename, PATHINFO_FILENAME);      // Get basename
                $extension  = pathinfo($filename, PATHINFO_EXTENSION);     // Get extension
                $basename   = preg_replace('/[^A-z0-9]/', '-', $basename); // Clean basename
                $i          = 0;                                           // Counter
                while (file_exists($upload_path . $filename)) {            // If file exists
                    $i        = $i + 1;                                    // Update counter 
                    $filename = $basename . '-' . $i . '.' . $extension;         // New filepath
                }
                return $filename;                                          // Return filename
            }
            $error = ($_FILES['img_event']['error'] === 1) ? 'too big ' : '';  // Check size error
    
        if ($_FILES['img_event']['error'] == 0) {                          // If no upload errors
            $error  .= ($_FILES['img_event']['size'] <= $max_size) ? '' : 'too big '; // Check size
            // Check the media type is in the $allowed_types array
            $type   = mime_content_type($_FILES['img_event']['tmp_name']);        
            $error .= in_array($type, $allowed_types) ? '' : 'wrong type ';
            // Check the file extension is in the $allowed_exts array
            $ext    = strtolower(pathinfo($_FILES['img_event']['name'], PATHINFO_EXTENSION));
            $error .= in_array($ext, $allowed_exts) ? '' : 'wrong file extension ';
    
            // If there are no errors create the new filepath and try to move the file
            if (!$error) {
              $filename    = create_filename($_FILES['img_event']['name'], $upload_path);
              $destination = $upload_path . $filename;
              $moved       = move_uploaded_file($_FILES['img_event']['tmp_name'], $destination);
            }
        }
        if ($moved === true) {                                            // If it moved
            $imgAdded = "INSERT INTO imageevent (imageevent_url, imageevent_event_id)
                        VALUES (?, ?);";
            
            $img_add['url'] = $destination;
            
            $statement = $mysqli->prepare($imgAdded);
            $statement->bind_param("si", $img_add['url'], $event_id);
            $statement->execute();
            
            header('Location: ../event.php?event='. $event_id .'');;
        } else {           
            echo ("L'image na pas pu être ajoutée mais l'évènement est disponible.\nVous allez être redirigé vers la page de l'évènement");                                               // Otherwise
            sleep(8);
            header('Location: ../event.php?event='. $event_id .'');         // Error page
            exit;
        }
        }else{
            header('Location: ../event.php?event='. $event_id .'');
            exit;
        }
		
	}else{
		header('Location: ../error.php');
		exit;
	}
	
?>