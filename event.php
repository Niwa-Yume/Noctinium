<?php
    require './script_php/database-connection.php';
    require './script_php/sessions.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="asset/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="asset/fontawesome/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
      <meta charset="utf-8" />
      <link rel="stylesheet" href="asset/event.css">

      <meta name="title" content="Page Événement avec les informations essentitels comme infos pratiques, adresse, Type d'événement, Type de musique, Prix et heure.">
      <meta name="viewport" content="width=100vw, initial-scale=0.5">
      <meta name="description" content="Découvrez les soirées, festivals, boite de nuits et autre événements de la ville de Genève. Trouvez toutes les informations pratiques sur les horaires, les prix et le trajet pour vous y rendre. Créer et Rejoignez dès maintenant sur noctinium.com !">
      <meta name="keywords" content="soirée proche, faire la fête genève, voir soirée genève, soirée près de chez moi, soirée thèmes genève, genève, club libertin genève, programme soirée genève, bon plan genève, libertin club genève, décadense, boite de nuit, boite de nuit proche, quoi faire à genève, soirée genève, boite de nuit près de moi, concert genève, motel campo, la décadense, fête de la musique genève, village du soir, événements genève, club genève, évènements genève, boite de nuit genève">

      <title>Évènement</title>
      <link rel="icon" href="image/logo_noctinium.ico">
      <meta name="viewport" content="width=100vw, initial-scale=0.5">
    </head>
    <body>
        <header>
            <a href="index"><img class="logo" id="logo" src="image/logo_noctinium.webp" alt="Logo"></a>
            <nav id="computer">
              <li><a href="index">Accueil</a></li>
              <li class="active"><a href="eventlist">Évènements</a></li>
              <li><a href="contact">Contact</a></li>
              <li><a href="propos">À propos</a></li>
              <li><a href="faq">FAQ</a></li>
              <li><a href="<?php 
				if($logged_in == true){
					echo("compte");
				}else{
					echo("connexion");
				};?>"><?php 
				if($logged_in == true){
					echo("Compte");
				}else{
					echo("Connexion");
				};?></a></li>
          </nav>
          <nav id="mobile" class="hidden">
                <ul>
                    <li class="bread"><a class="burger" onclick="openNav()">Menu &#9776;</a></li>
                </ul>
            </nav>
        </header>
        <div id="menuBack" class="menuBack" onclick="closeNav()">
            <div id="sidemenu" class="menu">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="index">Accueil</a>
                <a href="eventlist">Évènements</a>
                <a href="contact">Contact</a>
                <a href="propos">À propos</a>
                <a href="faq">FAQ</a>
                <a href="<?php 
                if($logged_in == true){
                    echo("compte");
                }else{
                    echo("connexion");
                };?>"><?php 
                if($logged_in == true){
                    echo("Compte");
                }else{
                    echo("Connexion");
                };?></a>
            </div>
        </div>
        <section class="subscribe">
            <?php
              if (isset($_GET['event'])){
                $event_id = $_GET['event'];

                $sql = "SELECT * FROM events WHERE event_id = '". $event_id ."';";
        
                $statement = $pdo->query($sql);
                if ($statement->rowCount() == 0){
                  echo ("<div style=\"height: 80%;margin-top: 100px;\" class=\"adresseEvent\"><h1>L'évènement sélectionné n'existe pas.<br><br>Veuillez réessayer.</h1></div></section>");
                }else{
                  $event = $statement->fetch();
                  $event_desc = htmlspecialchars($event['event_description'], ENT_QUOTES, 'utf-8');
                  $desc_test2 = str_replace("\r\n", "<br>", $event_desc);
                  $desc_test3 = str_replace("\r", "<br>", $desc_test2);
                  $desc_test4 = str_replace("\n", "<br>", $desc_test2);
                  $event_description = str_replace("\t", " ", $desc_test4);


                  $image = "SELECT imageevent_url FROM imageevent WHERE imageevent_id = '". $event['event_imageevent_id'] ."';";
                  $statement2 = $pdo->query($image);
                  $image_event = $statement2->fetch();

                  $orga = "SELECT user_username FROM user WHERE user_id = '". $event['event_user_id'] ."';";
                  $statement3 = $pdo->query($orga);
                  
                  if($statement3->rowCount() > 0){
                    $organisateur = $statement3->fetch();
                  }else{
                    $organisateur['user_username'] = "Utilisateur supprimé";
                  }

                  $today = date('Y-m-d H:i:s');
                  if($event['event_maskedlocation'] > $today ){
                    $adresse = "Adresse masquée jusqu'au ".$event['event_maskedlocation'];
                  }else{
                    $adresse = $event['event_location'];
                  }

                  $datetimeint = explode(" ",$event['event_datetime']);
                  $date = explode("-",$datetimeint[0]);
                  $timeevent = explode(":",$datetimeint[1]);
                  $dateevent = $date[2]."/".$date[1]."/".$date[0]." | ".$timeevent[0]." : ".$timeevent[1];

                  if($event['event_type'] == 1){
                    $event_type = "Before";
                    if($event['event_music'] == 1){
                      $event_music = "Afrobeat";
                    }elseif($event['event_music'] == 2){
                      $event_music = "All style";
                    }elseif($event['event_music'] == 3){
                      $event_music = "Années '70";
                    }elseif($event['event_music'] == 4){
                      $event_music = "Années '80";
                    }elseif($event['event_music'] == 5){
                      $event_music = "Années '90";
                    }elseif($event['event_music'] == 6){
                      $event_music = "Années '00";
                    }elseif($event['event_music'] == 7){
                      $event_music = "Bachata";
                    }elseif($event['event_music'] == 8){
                      $event_music = "Blues";
                    }elseif($event['event_music'] == 9){
                      $event_music = "Country";
                    }elseif($event['event_music'] == 10){
                      $event_music = "Dancehall";
                    }elseif($event['event_music'] == 11){
                      $event_music = "Dubstep";
                    }elseif($event['event_music'] == 12){
                      $event_music = "Électro";
                    }elseif($event['event_music'] == 13){
                      $event_music = "Funk";
                    }elseif($event['event_music'] == 14){
                      $event_music = "Hip Hop";
                    }elseif($event['event_music'] == 15){
                      $event_music = "House";
                    }elseif($event['event_music'] == 16){
                      $event_music = "Jazz";
                    }elseif($event['event_music'] == 17){
                      $event_music = "Latino";
                    }elseif($event['event_music'] == 18){
                      $event_music = "Métal";
                    }elseif($event['event_music'] == 19){
                      $event_music = "Punk";
                    }elseif($event['event_music'] == 20){
                      $event_music = "R'N'B";
                    }elseif($event['event_music'] == 21){
                      $event_music = "Rap";
                    }elseif($event['event_music'] == 22){
                      $event_music = "Reggae";
                    }elseif($event['event_music'] == 23){
                      $event_music = "Reggaeton";
                    }elseif($event['event_music'] == 24){
                      $event_music = "Rock";
                    }elseif($event['event_music'] == 25){
                      $event_music = "Techno";
                    }elseif($event['event_music'] == 26){
                      $event_music = "Autres";
                    }else{
                      $event_music = "Autres";
                    }
                  }elseif($event['event_type'] == 2){
                    $event_type = "After";
                    if($event['event_music'] == 1){
                      $event_music = "Afrobeat";
                    }elseif($event['event_music'] == 2){
                      $event_music = "All style";
                    }elseif($event['event_music'] == 3){
                      $event_music = "Années '70";
                    }elseif($event['event_music'] == 4){
                      $event_music = "Années '80";
                    }elseif($event['event_music'] == 5){
                      $event_music = "Années '90";
                    }elseif($event['event_music'] == 6){
                      $event_music = "Années '00";
                    }elseif($event['event_music'] == 7){
                      $event_music = "Bachata";
                    }elseif($event['event_music'] == 8){
                      $event_music = "Blues";
                    }elseif($event['event_music'] == 9){
                      $event_music = "Country";
                    }elseif($event['event_music'] == 10){
                      $event_music = "Dancehall";
                    }elseif($event['event_music'] == 11){
                      $event_music = "Dubstep";
                    }elseif($event['event_music'] == 12){
                      $event_music = "Électro";
                    }elseif($event['event_music'] == 13){
                      $event_music = "Funk";
                    }elseif($event['event_music'] == 14){
                      $event_music = "Hip Hop";
                    }elseif($event['event_music'] == 15){
                      $event_music = "House";
                    }elseif($event['event_music'] == 16){
                      $event_music = "Jazz";
                    }elseif($event['event_music'] == 17){
                      $event_music = "Latino";
                    }elseif($event['event_music'] == 18){
                      $event_music = "Métal";
                    }elseif($event['event_music'] == 19){
                      $event_music = "Punk";
                    }elseif($event['event_music'] == 20){
                      $event_music = "R'N'B";
                    }elseif($event['event_music'] == 21){
                      $event_music = "Rap";
                    }elseif($event['event_music'] == 22){
                      $event_music = "Reggae";
                    }elseif($event['event_music'] == 23){
                      $event_music = "Reggaeton";
                    }elseif($event['event_music'] == 24){
                      $event_music = "Rock";
                    }elseif($event['event_music'] == 25){
                      $event_music = "Techno";
                    }elseif($event['event_music'] == 26){
                      $event_music = "Autres";
                    }else{
                      $event_music = "Autres";
                    }
                  }elseif($event['event_type'] == 3){
                    $event_type = "Soirée";
                    if($event['event_music'] == 1){
                      $event_music = "Afrobeat";
                    }elseif($event['event_music'] == 2){
                      $event_music = "All style";
                    }elseif($event['event_music'] == 3){
                      $event_music = "Années '70";
                    }elseif($event['event_music'] == 4){
                      $event_music = "Années '80";
                    }elseif($event['event_music'] == 5){
                      $event_music = "Années '90";
                    }elseif($event['event_music'] == 6){
                      $event_music = "Années '00";
                    }elseif($event['event_music'] == 7){
                      $event_music = "Bachata";
                    }elseif($event['event_music'] == 8){
                      $event_music = "Blues";
                    }elseif($event['event_music'] == 9){
                      $event_music = "Country";
                    }elseif($event['event_music'] == 10){
                      $event_music = "Dancehall";
                    }elseif($event['event_music'] == 11){
                      $event_music = "Dubstep";
                    }elseif($event['event_music'] == 12){
                      $event_music = "Électro";
                    }elseif($event['event_music'] == 13){
                      $event_music = "Funk";
                    }elseif($event['event_music'] == 14){
                      $event_music = "Hip Hop";
                    }elseif($event['event_music'] == 15){
                      $event_music = "House";
                    }elseif($event['event_music'] == 16){
                      $event_music = "Jazz";
                    }elseif($event['event_music'] == 17){
                      $event_music = "Latino";
                    }elseif($event['event_music'] == 18){
                      $event_music = "Métal";
                    }elseif($event['event_music'] == 19){
                      $event_music = "Punk";
                    }elseif($event['event_music'] == 20){
                      $event_music = "R'N'B";
                    }elseif($event['event_music'] == 21){
                      $event_music = "Rap";
                    }elseif($event['event_music'] == 22){
                      $event_music = "Reggae";
                    }elseif($event['event_music'] == 23){
                      $event_music = "Reggaeton";
                    }elseif($event['event_music'] == 24){
                      $event_music = "Rock";
                    }elseif($event['event_music'] == 25){
                      $event_music = "Techno";
                    }elseif($event['event_music'] == 26){
                      $event_music = "Autres";
                    }else{
                      $event_music = "Autres";
                    }
                  }elseif($event['event_type'] == 4){
                    $event_type = "Concert/Showcase";
                    if($event['event_music'] == 1){
                      $event_music = "Afrobeat";
                    }elseif($event['event_music'] == 2){
                      $event_music = "All style";
                    }elseif($event['event_music'] == 3){
                      $event_music = "Années '70";
                    }elseif($event['event_music'] == 4){
                      $event_music = "Années '80";
                    }elseif($event['event_music'] == 5){
                      $event_music = "Années '90";
                    }elseif($event['event_music'] == 6){
                      $event_music = "Années '00";
                    }elseif($event['event_music'] == 7){
                      $event_music = "Bachata";
                    }elseif($event['event_music'] == 8){
                      $event_music = "Blues";
                    }elseif($event['event_music'] == 9){
                      $event_music = "Country";
                    }elseif($event['event_music'] == 10){
                      $event_music = "Dancehall";
                    }elseif($event['event_music'] == 11){
                      $event_music = "Dubstep";
                    }elseif($event['event_music'] == 12){
                      $event_music = "Électro";
                    }elseif($event['event_music'] == 13){
                      $event_music = "Funk";
                    }elseif($event['event_music'] == 14){
                      $event_music = "Hip Hop";
                    }elseif($event['event_music'] == 15){
                      $event_music = "House";
                    }elseif($event['event_music'] == 16){
                      $event_music = "Jazz";
                    }elseif($event['event_music'] == 17){
                      $event_music = "Latino";
                    }elseif($event['event_music'] == 18){
                      $event_music = "Métal";
                    }elseif($event['event_music'] == 19){
                      $event_music = "Punk";
                    }elseif($event['event_music'] == 20){
                      $event_music = "R'N'B";
                    }elseif($event['event_music'] == 21){
                      $event_music = "Rap";
                    }elseif($event['event_music'] == 22){
                      $event_music = "Reggae";
                    }elseif($event['event_music'] == 23){
                      $event_music = "Reggaeton";
                    }elseif($event['event_music'] == 24){
                      $event_music = "Rock";
                    }elseif($event['event_music'] == 25){
                      $event_music = "Techno";
                    }elseif($event['event_music'] == 26){
                      $event_music = "Autres";
                    }else{
                      $event_music = "Autres";
                    }
                  }elseif($event['event_type'] == 5){
                    $event_type = "Open Mic/Karaoké";
                    if($event['event_music'] == 1){
                      $event_music = "Afrobeat";
                    }elseif($event['event_music'] == 2){
                      $event_music = "All style";
                    }elseif($event['event_music'] == 3){
                      $event_music = "Années '70";
                    }elseif($event['event_music'] == 4){
                      $event_music = "Années '80";
                    }elseif($event['event_music'] == 5){
                      $event_music = "Années '90";
                    }elseif($event['event_music'] == 6){
                      $event_music = "Années '00";
                    }elseif($event['event_music'] == 7){
                      $event_music = "Bachata";
                    }elseif($event['event_music'] == 8){
                      $event_music = "Blues";
                    }elseif($event['event_music'] == 9){
                      $event_music = "Country";
                    }elseif($event['event_music'] == 10){
                      $event_music = "Dancehall";
                    }elseif($event['event_music'] == 11){
                      $event_music = "Dubstep";
                    }elseif($event['event_music'] == 12){
                      $event_music = "Électro";
                    }elseif($event['event_music'] == 13){
                      $event_music = "Funk";
                    }elseif($event['event_music'] == 14){
                      $event_music = "Hip Hop";
                    }elseif($event['event_music'] == 15){
                      $event_music = "House";
                    }elseif($event['event_music'] == 16){
                      $event_music = "Jazz";
                    }elseif($event['event_music'] == 17){
                      $event_music = "Latino";
                    }elseif($event['event_music'] == 18){
                      $event_music = "Métal";
                    }elseif($event['event_music'] == 19){
                      $event_music = "Punk";
                    }elseif($event['event_music'] == 20){
                      $event_music = "R'N'B";
                    }elseif($event['event_music'] == 21){
                      $event_music = "Rap";
                    }elseif($event['event_music'] == 22){
                      $event_music = "Reggae";
                    }elseif($event['event_music'] == 23){
                      $event_music = "Reggaeton";
                    }elseif($event['event_music'] == 24){
                      $event_music = "Rock";
                    }elseif($event['event_music'] == 25){
                      $event_music = "Techno";
                    }elseif($event['event_music'] == 26){
                      $event_music = "Autres";
                    }else{
                      $event_music = "Autres";
                    }
                  }elseif($event['event_type'] == 6){
                    $event_type = "Gaming";
                    if($event['event_music'] == 1){
                      $event_music = "Call of Duty";
                    }elseif($event['event_music'] == 2){
                      $event_music = "Counter-Strike";
                    }elseif($event['event_music'] == 3){
                      $event_music = "Dota 2";
                    }elseif($event['event_music'] == 4){
                      $event_music = "FIFA";
                    }elseif($event['event_music'] == 5){
                      $event_music = "Fortnite";
                    }elseif($event['event_music'] == 6){
                      $event_music = "Jeux WII";
                    }elseif($event['event_music'] == 7){
                      $event_music = "League of Legend";
                    }elseif($event['event_music'] == 8){
                      $event_music = "Minecraft";
                    }elseif($event['event_music'] == 9){
                      $event_music = "Mortal Kombat";
                    }elseif($event['event_music'] == 10){
                      $event_music = "Overwatch";
                    }elseif($event['event_music'] == 11){
                      $event_music = "PUBG";
                    }elseif($event['event_music'] == 12){
                      $event_music = "Rainbow 6";
                    }elseif($event['event_music'] == 13){
                      $event_music = "Rocket League";
                    }elseif($event['event_music'] == 14){
                      $event_music = "Street Fighter";
                    }elseif($event['event_music'] == 15){
                      $event_music = "Super Smash Bros.";
                    }elseif($event['event_music'] == 16){
                      $event_music = "Valorant";
                    }elseif($event['event_music'] == 17){
                      $event_music = "Yuh Gi Oh";
                    }elseif($event['event_music'] == 18){
                      $event_music = "Autres";
                    }else{
                      $event_music = "Autres";
                    }
               /* }elseif($event['event_type'] == 7){
                    $event_type = "Art";
                    if($event['event_music'] == 1){
                      $event_music = "Architecture";
                    }elseif($event['event_music'] == 2){
                      $event_music = "Cinéma";
                    }elseif($event['event_music'] == 3){
                      $event_music = "Cirque";
                    }elseif($event['event_music'] == 4){
                      $event_music = "Comédie";
                    }elseif($event['event_music'] == 5){
                      $event_music = "Danse";
                    }elseif($event['event_music'] == 6){
                      $event_music = "Dessin";
                    }elseif($event['event_music'] == 7){
                      $event_music = "Graffiti";
                    }elseif($event['event_music'] == 8){
                      $event_music = "Littérature";
                    }elseif($event['event_music'] == 9){
                      $event_music = "Peinture";
                    }elseif($event['event_music'] == 10){
                      $event_music = "Sculpture";
                    }elseif($event['event_music'] == 11){
                      $event_music = "Tatoo";
                    }elseif($event['event_music'] == 12){
                      $event_music = "Théâtre";
                    }elseif($event['event_music'] == 13){
                      $event_music = "Autres";
                    }else{
                      $event_music = "Autres";
                  } */
                  }elseif($event['event_type'] == 7){
                    $event_type = "Autres";
                    if($event['event_music'] == 1){
                      $event_music = "Conférence";
                    }elseif($event['event_music'] == 2){
                      $event_music = "Mode";
                    }elseif($event['event_music'] == 3){
                      $event_music = "Urbain";
                    }elseif($event['event_music'] == 4){
                      $event_music = "Autres";
                    }else{
                      $event_music = "Autres";
                    }
                  }else{
                    $event_type = "Autres";
                    $event_music = "Autres";
                  }

                  if($event['event_price'] <= 0){
                    $event_price = "Gratuit";
                  }else{
                    $event_price = $event['event_price']." CHF";
                  }

                  echo ("
                  <div class=\"eventCont\">
                    <div class=\"returnBtnCont\">
                      <button title=\"Retour\" class=\"returnBtn\" onclick=\"history.back()\"><i class=\"fa-solid fa-arrow-left\"></i></button>
                    </div>
                    <div class=\"copyBtnCont\">
                      <div class=\"tooltip\">
                        <span class=\"tooltiptext\" id=\"myTooltip\">Copier le lien</span>
                      </div>
                      <button id=\"copy-button\" class=\"copyBtn\" onmouseout=\"outFunc()\"><i class=\"fa-regular fa-clone\"></i></button>
                    </div>
                    <div class=\"titreEvent\">". $event['event_title'] ."</div>
                  <div class=\"eventGrid\">
                    <img class=\"imgEvent\" src=\"". $image_event['imageevent_url'] ."\" alt=\"Image de l'évènement\">
                    <div class=\"infoSup\">
                      <span class=\"dateEvent\">". $dateevent."</span>
                      <div class=\"adresseEvent\">". $event_music ." | ". $event_type ." | ". $event_price ."</div>
                      <div class=\"adresseEvent\">". $adresse ."</div>
                      <div class=\"userEvent\">Organisateur :<a class=\"orgaEvent\" href=\"organisateur?organisateur=". $event['event_user_id'] ."\">". $organisateur['user_username'] ."</a></div>
                    </div>
                  </div>
                  <div class=\"blog-slider__content infoCont\">
                    <div class=\"txtEvent\">". $event_description ."</div>");
                  if($event['event_maskedlocation'] <= $today ){
                    echo("
                      <a href=\"map?event=". $event_id ."\" class=\"btnEvent\">TROUVER L'ÉVENEMENT</a>
                      <a href=\"https://www.google.com/maps/search/?api=1&query=". urlencode($event['event_location']) ."\" class=\"btnMaps\" target=\"_blank\"><i class=\"fa-brands fa-google\"></i>\tMaps</a>
                      </div>
                      </div>
                      </section>");
                  }else{
                    echo("
                      <div><h1>Vous pourrez trouver l'évènement lorsque l'adresse sera révélée.</h1></div>
                      </div>
                      </div>
                      </section>");
                  }
                  
                    echo ("<hr class=\"gradient\">
                      <section class=\"attends\">
                        <div class=\"interaction\">
                        <div class=\"comment-form\">
                          ");
                  if($logged_in){
                    echo("<!-- Comment Avatar -->
                            <div >
                              <img class=\"comment-pp\" src=\"". $_SESSION['user_img'] ."\" alt=\"Image de profil\">
                            </div>
                            <form class=\"form\" name=\"form\" method=\"POST\" action=\"script_php/comment_event.php?event=". $event_id ."\">
                              <div class=\"form-row\">
                                <textarea
                                          class=\"input\"
                                          ng-model=\"cmntCtrl.comment.text\"
                                          placeholder=\"AJOUTER UN COMMENTAIRE ...\"
                                          name=\"comment\"
                                          maxlength=\"500\"
                                          required></textarea>
                              </div>
                              <div class=\"form-row\">
                                <input type=\"submit\" value=\"COMMENTER\">
                              </div>
                            </form>
                            <div class=\"commCont\">");
                  }else{
                    echo("<h1 style=\"margin-top:20px;\"><a href=\"connexion\" class=\"underline\">Connectez-vous</a> pour commenter.</h1>
                    <div class=\"commCont\">");
                  }
                            
                            $comm = "SELECT * FROM commentevent WHERE commentevent_events_id = ". $event_id ." ORDER BY commentevent_date DESC;";
                            $statement3 = $pdo->query($comm);
                            $commentaire = $statement3->fetchAll();
                            if(isset($_GET['page'])){
                              if($_GET['page'] > 0){
                                $page = $_GET['page'];
                              }else{
                                $page = 1;
                              }
                            }else{
                              $page = 1;
                            }
                            for($i=(($page-1)*10); $i<($page*10) && $i < $statement3->rowCount();$i++){
                              $username = "SELECT user_username FROM user WHERE user_id = ". $commentaire[$i]['commentevent_user_id'] .";";
                              $statement4 = $pdo->query($username);
                              if($statement4->rowCount() > 0){
                                $user = $statement4->fetch();
                                $user_username = $user['user_username'];
                              }else{
                                $user_username = "Utilisateur supprimé";
                              }
                              $comtimeint = explode(" ",$commentaire[$i]['commentevent_date']);
                              $com = explode("-",$comtimeint[0]);
                              $timecom = explode(":",$comtimeint[1]);
                              $datecom = $com[2]."/".$com[1]."/".$com[0]." | ".$timecom[0].":".$timecom[1].":".$timecom[2];
                              echo ("<div class=\"commentBody\">
                              <div class=\"commentHeader\">
                                <a href=\"organisateur?organisateur=". $commentaire[$i]['commentevent_user_id'] ."\"><div class=\"commentUser\">
                                  ". $user_username ."
                                </div></a>
                                <div class=\"commentDate\">
                                  ". $datecom ."
                                </div>
                              </div>
                              <div class=\"commentText\">
                              ". $commentaire[$i]['commentevent_content'] ."
                              </div>
                            </div>");
                            }
                            if($statement3->rowCount()>10){
                              if($page == 1){
                                echo("<div class=\"gridComm\"><div></div><div class=\"pageNum\">Page ".$page."</div><a class=\"pageBtn\" href=\"organisateur?organisateur=". $event_id ."&page=". $page+1 ."\" >&rarr;</a></div>");
                              }elseif($page > 1 && $i < $statement3->rowCount()){
                                echo("<div class=\"gridComm\"><a class=\"pageBtn\" href=\"organisateur?organisateur=". $event_id."&page=". $page-1 ."\" >&larr;</a><div class=\"pageNum\">Page ".$page."</div>
                                <a class=\"pageBtn\" href=\"organisateur?organisateur=". $event_id ."&page=". $page+1 ."\" >&rarr;</a></div>");
                              }else{
                                echo("<div class=\"gridComm\"><a class=\"pageBtn\" href=\"organisateur?organisateur=". $event_id ."&page=". $page-1 ."\" >&larr;</a><div class=\"pageNum\">Page ".$page."</div><div></div></div>");
                              }
                            }
                    echo ("
                            </div>
                          </div>
                          
                        </div>
                      </section>
                    ");
                }
              }else{
                echo ("<div style=\"height: 80%;margin-top: 100px;\" class=\"adresseEvent\"><h1>L'évènement sélectionné n'existe pas.<br><br>Veuillez réessayer.</h1></div></section>");
              }
              
            ?>
        <?php
          include './script_php/footer.php'
        ?>
		<script>
      var element = document.getElementById("logo")
      var cont = document.querySelector(".eventCont")
			if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
        element.classList.toggle("logo");
        element.classList.toggle("logo-M");
        cont.classList.toggle("eventCont");
        cont.classList.toggle("eventCont-M");
      }
		</script>
    <script>
      const copyButton = document.querySelector("#copy-button");
      const copied = document.querySelector("#copied")

      copyButton.addEventListener("click", function() {
        // Récupère le lien de la page actuelle
        const currentUrl = window.location.href;
        
        // Crée un élément input invisible
        const input = document.createElement("input");
        
        // Affecte la valeur du lien de la page à l'élément input
        input.value = currentUrl;
        
        // Ajoute l'élément input à la page
        document.body.appendChild(input);
        
        // Sélectionne le contenu de l'élément input
        input.select();
        
        // Copie le contenu sélectionné dans le presse-papiers
        document.execCommand("copy");
        
        // Supprime l'élément input
        document.body.removeChild(input);
        
        // Affiche un message indiquant que le lien a été copié
        /* var tooltip = document.getElementById("myTooltip");
        tooltip.classList.toggle("hidden");
        setTimeout(function() {
          $('#myTooltip').fadeOut('fast');
        }, 2000) */
        var tooltip = document.getElementById("myTooltip");
        tooltip.innerHTML = "Lien copié";
        tooltip.style.backgroundColor = "#80bd6a";
      });

      function outFunc() {
        var tooltip = document.getElementById("myTooltip");
        tooltip.innerHTML = "Copier le lien";
        tooltip.style.backgroundColor = "#6c6c6c";
      }
    </script>
    <script>
        if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            document.getElementById("computer").classList.toggle("hidden");
            document.getElementById("mobile").classList.toggle("hidden");
        }
        function openNav() {
            document.getElementById("sidemenu").style.width = "40%";
            document.getElementById("menuBack").style.visibility = "visible";
            
        }

        function closeNav() {
            document.getElementById("sidemenu").style.width = "0";
            document.getElementById("menuBack").style.visibility = "hidden";
        }
    </script>
    </body>
</html>
