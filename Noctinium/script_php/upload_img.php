<?php
require 'database-connection.php';
include 'sessions.php';

$moved         = false;                                        // Initialize
$message       = '';                                           // Initialize
$error         = '';                                           // Initialize
$upload_path   = '../imageuser/';                                   // Upload path
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {                    // If form submitted
    $error = ($_FILES['newImg']['error'] === 1) ? 'too big ' : '';  // Check size error

    if ($_FILES['newImg']['error'] == 0) {                          // If no upload errors
        $error  .= ($_FILES['newImg']['size'] <= $max_size) ? '' : 'too big '; // Check size
        // Check the media type is in the $allowed_types array
        $type   = mime_content_type($_FILES['newImg']['tmp_name']);        
        $error .= in_array($type, $allowed_types) ? '' : 'wrong type ';
        // Check the file extension is in the $allowed_exts array
        $ext    = strtolower(pathinfo($_FILES['newImg']['name'], PATHINFO_EXTENSION));
        $error .= in_array($ext, $allowed_exts) ? '' : 'wrong file extension ';

        // If there are no errors create the new filepath and try to move the file
        if (!$error) {
          $filename    = create_filename($_FILES['newImg']['name'], $upload_path);
          $destination = $upload_path . $filename;
          $moved       = move_uploaded_file($_FILES['newImg']['tmp_name'], $destination);
        }
    }
    if ($moved === true) {                                            // If it moved
        $imgAdded = "INSERT INTO imageuser (imageuser_url)
					VALUES (?);";
		
		$imgurl['url'] = "imageuser/".$filename;
		
		$statement = $mysqli->prepare($imgAdded);
        $statement->bind_param("s", $imgurl['url']);
		$statement->execute();
		
		$imgid = $mysqli->insert_id;
		
		$imgUserNew = "UPDATE user SET user_imageuser_id = '". $imgid ."' WHERE user_id = ". $_SESSION['user_id'] .";";
		
		$statement2 = $mysqli->prepare($imgUserNew);
		$statement2->execute();
		
		$_SESSION['user_img'] = $imgurl['url'];
		
		header ('Location: ../compteConfiguration.php');
    } else {                                                          // Otherwise
        header ('Location: ../error.php');         // Error page
    }
}
?>
