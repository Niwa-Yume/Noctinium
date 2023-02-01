<?php
require '../include/database-connection.php';
include '../include/sessions.php';

$moved         = false;                                        // Initialize
$message       = '';                                           // Initialize
$error         = '';                                           // Initialize
$upload_path   = '../images/';                                   // Upload path
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
    $error = ($_FILES['image']['error'] === 1) ? 'too big ' : '';  // Check size error

    if ($_FILES['image']['error'] == 0) {                          // If no upload errors
        $error  .= ($_FILES['image']['size'] <= $max_size) ? '' : 'too big '; // Check size
        // Check the media type is in the $allowed_types array
        $type   = mime_content_type($_FILES['image']['tmp_name']);        
        $error .= in_array($type, $allowed_types) ? '' : 'wrong type ';
        // Check the file extension is in the $allowed_exts array
        $ext    = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $error .= in_array($ext, $allowed_exts) ? '' : 'wrong file extension ';

        // If there are no errors create the new filepath and try to move the file
        if (!$error) {
          $filename    = create_filename($_FILES['image']['name'], $upload_path);
          $destination = $upload_path . $filename;
          $moved       = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
        }
    }
    if ($moved === true) {                                            // If it moved
        $imgAdded = "INSERT INTO img (img_url)
					VALUES (:url);";
		
		$imgurl['url'] = $destination;
		
		$statement = $pdo->prepare($imgAdded);
		$statement->execute($imgurl);
		
		$imgid = $pdo->lastInsertId();
		
		$imgUtinew = "UPDATE utilisateur SET img_img_id = '". $imgid ."' WHERE uti_id = ". $_SESSION['id'] .";";
		
		$statement2 = $pdo->prepare($imgUtinew);
		$statement2->execute();
		
		$imgProfil = "SELECT img_url FROM img WHERE img_id = '". $imgid ."';";
		
		$statement3 = $pdo->query($imgProfil);
		$img_user = $statement3->fetch();
		
		$_SESSION['img_user'] = $img_user['img_url'];
		
		header ('Location: ../pages/account.php');
    } else {                                                          // Otherwise
        header ('Location: ../pages/erreur.php');         // Error page
    }
}
?>
