<?php
	require 'database-connection.php';
    require 'sessions.php';


    if($_SESSION['logged_in'] != true){
		header('Location: ../connexion.php');
		exit;
	}
    if(isset($_GET['event'])){
        $test = "SELECT event_user_id FROM events WHERE event_id = ". $_GET['event'] .";";
        $statement_test = $pdo->query($test);
        $id_test = $statement_test->fetch();
        if($id_test['event_user_id'] == $_SESSION['user_id']){
            $sql = "SELECT * FROM events WHERE event_id = ". $_GET['event'] .";";
            $statement = $pdo->query($sql);
            $event_base = $statement->fetch();
            $sql2 = "SELECT imageevent_url FROM imageevent WHERE imageevent_id = ". $event_base['event_imageevent_id'] .";";
            $statement2 = $pdo->query($sql2);
            $image = $statement2->fetch();
            if (isset($_POST['nom_event']) and isset($_POST['date_event']) and isset($_POST['time_event']) and isset($_POST['description_event']) 
            and isset($_POST['adresse_event']) and isset($_POST['musique']) and isset($_POST['type']) and isset($_POST['conditions'])){
                if($_POST['musique'] == ""){
                    header("Location: ../eventModify.php?eventerror=1&music=1");
                    exit;
                }
                if($_POST['type'] == ""){
                    header("Location: ../eventModify.php?error=1&type=1");
                    exit;
                }
                if(strncmp($_POST['adresse_event'], $event_base['event_location'], 50) != 0){
                    function geocode($address){
                        $addresse = urlencode($address);
                    
                        $url = "https://nominatim.openstreetmap.org/?addressdetails=1&q=$addresse&format=json&limit=1";
                    
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_URL,$url);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_HEADER, false);
                        curl_setopt($ch, CURLOPT_REFERER, $url);
                        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36");
                    
                        $result = curl_exec($ch);
                    
                        curl_close($ch);
                    
                        return json_decode($result, true);
                    }
                    $response = geocode($_POST['adresse_event']);
            
                    //Récupération des coordonnées GPS
                    $lat = $response[0]['lat'];
                    $lon = $response[0]['lon'];
                    if($lat and $lon){
                        $change_address = "UPDATE events SET event_location = :addresse, event_lat = :lat, event_lon = :lon WHERE event_id = ". $event_base['event_id'] .";";
                        $add['addresse'] = $_POST['adresse_event'];
                        $add['lat'] = $lat;
                        $add['lon'] = $lon;
                        $change_address_statement = $pdo->prepare($change_address);
                        $change_address_statement->execute($add);
                    }else{
                        header('Location: ../eventAdd.php?error=1&address=1');
                        exit;
                    }
                }
                if(strncmp($_POST['nom_event'], $event_base['event_title'], 30) != 0){
                    $change_title = "UPDATE events SET event_title = :title WHERE event_id = ". $event_base['event_id'] .";";
                    $title['title'] = $_POST['nom_event'];
                    $change_title_statement = $pdo->prepare($change_title);
                    $change_title_statement->execute($title);
                    echo $_POST['nom_event'];
                    exit;
                }
                if($_POST['date_event'] != "" && $_POST['time_event'] != ""){
                    $dateeventint = explode(" / ", $_POST['date_event']);
                    $timeevent = str_replace(" ","",$_POST['time_event']);
                    $dateevent = $dateeventint[2]."-".$dateeventint[1]."-".$dateeventint[0]." ".$timeevent.":00";
                    if(strncmp($dateevent, $event_base['event_datetime'], 20) != 0){
                        $change_date = "UPDATE events SET event_datetime = :date_event WHERE event_id = ". $event_base['event_id'] .";";
                        $date['date_event'] = $dateevent;
                        $change_date_statement = $pdo->prepare($change_date);
                        $change_date_statement->execute($date);
                    }
                }else{
                    header('Location: ../eventAdd.php?error=1&date=1');
                    exit;
                }
                if(strncmp($_POST['description_event'], $event_base['event_description'], 1000) != 0){
                    $change_description = "UPDATE events SET event_description = :descr WHERE event_id = ". $event_base['event_id'] .";";
                    $desc['descr'] = $_POST['description_event'];
                    $change_description_statement = $pdo->prepare($change_description);
                    $change_description_statement->execute($desc);
                }
                if(strncmp($_POST['musique'], $event_base['event_music'], 20)){
                    if($_POST['musique'] == "" or $_POST['musique'] < 1 or $_POST['musique'] > 14){
                        $_POST['musique'] = 14;
                    }
                    $change_music = "UPDATE events SET event_music = :music WHERE event_id = ". $event_base['event_id'] .";";
                        $music['music'] = $_POST['musique'];
                        $change_music_statement = $pdo->prepare($change_music);
                        $change_music_statement->execute($music);
                }
                if(strncmp($_POST['type'], $event_base['event_type'], 20)){
                    if($_POST['type'] == "" or $_POST['type'] < 1 or $_POST['type'] > 6){
                        $_POST['type'] = 6;
                    }
                    $change_type = "UPDATE events SET event_type = :types WHERE event_id = ". $event_base['event_id'] .";";
                        $type_event['types'] = $_POST['type'];
                        $change_type_statement = $pdo->prepare($change_type);
                        $change_type_statement->execute($type_event);
                }
                if($_POST['date_event_mask'] != "" && $_POST['time_mask'] != ""){
                    $dateeventmaskint = explode(" / ", $_POST['date_event_mask']);
                    $timeeventmask = str_replace(" ","",$_POST['time_mask']);
                    $dateeventmask = $dateeventmaskint[2]."-".$dateeventmaskint[1]."-".$dateeventmaskint[0]." ".$timeeventmask.":00";
                    if(strncmp($dateeventmask, $event_base['event_maskedlocation'], 20) != 0 and $dateeventmask != ""){
                        if($_POST['date_event'] == $event_base['event_datetime']){
                            if($_POST['date_event'] >= $_POST['date_event_mask']){
                                $change_masked = "UPDATE events SET event_maskedlocation = :mask WHERE event_id = ". $event_base['event_id'] .";";
                                $masked['mask'] = $_POST['date_event_mask'];
                                $change_masked_statement = $pdo->prepare($change_masked);
                                $change_masked_statement->execute($masked);
                            }else{
                                header('Location: ../eventModify.php?error=1&masked=1');
                                exit;
                            }
                        }else{
                            if($event_base['event_datetime'] >= $_POST['date_event_mask']){
                                $change_masked = "UPDATE events SET event_maskedlocation = :mask WHERE event_id = ". $event_base['event_id'] .";";
                                $masked['mask'] = $_POST['date_event_mask'];
                                $change_masked_statement = $pdo->prepare($change_masked);
                                $change_masked_statement->execute($masked);
                            }else{
                                header('Location: ../eventModify.php?error=1&masked=1');
                                exit;
                            }
                        }
                    }
                }else{
                    if($event_base['event_maskedlocation'] > $event_base['event_creation']){
                        $change_masked = "UPDATE events SET event_maskedlocation = :mask WHERE event_id = ". $event_base['event_id'] .";";
                        $masked['mask'] = $event_base['event_creation'];
                        $change_masked_statement = $pdo->prepare($change_masked);
                        $change_masked_statement->execute($masked);
                    }
                }
                if($_POST['prix_event'] != $event_base['event_price'] and $_POST['prix_event'] != ""){
                    $change_price = "UPDATE events SET event_price = :price WHERE event_id = ". $event_base['event_id'] .";";
                    $price['price'] = $_POST['prix_event'];
                    $change_price_statement = $pdo->prepare($change_price);
                    $change_price_statement->execute();
                }
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
                        $imgAdded = "INSERT INTO imageevent (imageevent_url)
                                    VALUES (:imageevent_url);";
                        
                        $img_add['imageevent_url'] = "imageevent/". $filename;
                        
                        $statement_img = $pdo->prepare($imgAdded);
                        $statement_img->execute($img_add);

                        $event_img_id = $pdo->lastInsertId();

                        $new_img = "UPDATE events SET event_imageevent_id = ". $event_img_id ." WHERE event_id = ". $event_base['event_id'] .";";
                        $new_img_statement = $pdo->prepare($new_img);
                        $new_img_statement->execute();
                    }
                }
                header('Location: ../event.php?event='.$event_base['event_id']);
                exit;
            }
        }else{
            header('Location: ../compte.php');
            exit;
          }
    }else{
        header('Location: ../compte.php');
        exit;
      }
?>