<?php
    require './script_php/database-connection.php';
    require './script_php/sessions.php';
?>
<html>
    <head>
      <link rel="stylesheet" href="asset/style.css">
      <link rel="stylesheet" href="asset/eventlist.css">
      <link rel="stylesheet" href="asset/fontawesome/css/all.css">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
      <meta charset="utf-8" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
      <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

      <meta name="title" content="Page liste les Événements avec les informations essentitels comme infos pratiques, adresse, Type d'événement, Type de musique, Prix et heure.">
      <meta name="viewport" content="width=100vw, initial-scale=0.5">
      <meta name="description" content="Découvrez les soirées, festivals, boite de nuits et autre événements de la ville de Genève. Trouvez toutes les informations pratiques sur les horaires, les prix et le trajet pour vous y rendre. Créer et Rejoignez dès maintenant sur noctinium.com !">
      <meta name="keywords" content="soirée proche, faire la fête genève, voir soirée genève, soirée près de chez moi, soirée thèmes genève, genève, club libertin genève, programme soirée genève, bon plan genève, libertin club genève, décadense, boite de nuit, boite de nuit proche, quoi faire à genève, soirée genève, boite de nuit près de moi, concert genève, motel campo, la décadense, fête de la musique genève, village du soir, événements genève, club genève, évènements genève, boite de nuit genève">

      <title>Liste des évènements</title>
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
        <section class="content content-small">
            <div class="container">
                <h1 class="gradient-text">Liste des évènements</h1>
            </div>
        </section>
        <hr class="gradient">
        <section class="eventlist">
          <div class="searchCont">
            <div class="filtreCont">
              <a class="openFiltre" onclick="filtreMenu()">Filtres &#9776;</a>
            </div>
            <div class="searchBarCont">
              <form class="searchBar" method="POST" action="script_php/search.php">
                <input type="text" class="search insc-form" id="search" placeholder="RECHERCHE ..." name="search" value="">
                <button class="searchBtn" id="searchBtn" type="submit"><i class="fa fa-search"></i></button>
              </form>
            </div>
            <div class="newEventCont">
              <a href="eventAdd" id="newEvent" class="newEvent">Ajouter</a>
            </div>
          </div>
        <div id="main" class="main-f">
          <div id="mySidenav" class="sidenav">
            <h2>Filtres</h2>
            <form action="script_php/filtres.php" method="POST">
              <h3>Type d'évènement:</h3>
              <div class="typeCont">
              <select name="type" id="type" class="form-control">
                      <option value="">--Veuillez choisir un type d'évènement--</option>
                      <option value="1">Before</option>
                      <option value="2">After</option>
                      <option value="3">Soirée</option>
                      <option value="4">Concert/Showcase</option>
                      <option value="5">Open Mic/Karaoké</option>
                      <option value="6">Gaming</option>
                      <!-- <option value="7">Art</option> -->
                      <option value="7">Autres</option>
                </select>
              </div>
              <h3>Catégorie:</h3>
              <div class="typeCont">
              <select name="musique" id="musique" class="form-control">
                      <option value="">--Veuillez choisir une catégorie--</option>
                </select>
              </div>
              <h3>Date de l'évènement:</h3>
              <div class="typeCont">
                <div class="form-group-insc">
                  <div class="col-sm-12">
                    <input type="text" class="filtreDate insc-form" id="date" name="date" value="" placeholder="DATE DE L'ÉVÈNEMENT">
                  </div>
                </div>
              </div>
              <h3>Organisateurs:</h3>
              <div class="typeCont">
                <select name="orga" id="type" class="form-control">
                    <option value="">--Veuillez choisir un type d'organisateur--</option>
                      <option value="1">Particuliers</option>
                      <option value="2">Associations</option>
                      <option value="3">Professionnels</option>
                </select>
              </div>
              <h3>Heure de début:</h3>
              <div class="typeCont">
                <input type="radio" id="HeureDebut" name="ordre" value="1" checked><label for="HeureDebut"> Ordre croissant</label><br>
                <input type="radio" id="HeureFin" name="ordre" value="2"><label for="HeureFin"> Ordre décroissant</label><br>
              </div>
              <input class="filtreBtn" type="submit" value="FILTRER">
            </form>
          </div>
        <div class="eventCont">
        <?php
          $today = date('Y-m-d H:i:s', strtotime(' -6 hours'));
          $event_param['today'] = $today;
          if(isset($_GET['filtre'])){
            if($_GET['filtre'] == 1){
              $sql = "SELECT event_id, event_title, event_datetime, event_description, event_music, event_type, event_price,event_imageevent_id FROM events WHERE event_private = 0";
              if(isset($_GET['date'])){
                if($_GET['date'] >= $today){
                  $event_param['today'] = date('Y-m-d', strtotime($_GET['date']));
                  $event_param['tomorrow'] = date('Y-m-d', strtotime($_GET['date']. ' + 1 days'));
                  $sql .= " AND event_datetime >= :today AND event_datetime < :tomorrow";
                }else{
                  $sql .= " AND event_datetime > :today";
                }
              }else{
                $sql .= " AND event_datetime > :today";
              }
              if(isset($_GET['music'])){
                if(1 <= $_GET['music'] and $_GET['music'] <= 14){
                  $sql .= " AND event_music = ".$_GET['music'];
                }
              }
              if(isset($_GET['type'])){
                if(1 <= $_GET['type'] and $_GET['type'] <= 6){
                  $sql .= " AND event_type = ".$_GET['type'];
                }
              }
              if(isset($_GET['orga'])){
                if(1 <= $_GET['orga'] and $_GET['orga'] <= 3){
                  $sql .= " AND event_user_type = ".$_GET['orga'];
                }
              }
              if(isset($_GET['ordre'])){
                if($_GET['ordre'] == 1){
                  $sql .= " ORDER BY event_datetime ASC;";
                }elseif($_GET['ordre'] == 2){
                  $sql .= " ORDER BY event_datetime DESC;";
                }
              }else{
                $sql .= " ORDER BY event_datetime ASC;";
              }
            }else{
              $sql = "SELECT event_id, event_title, event_datetime, event_description, event_music, event_type, event_price, event_imageevent_id FROM events WHERE event_datetime > :today AND event_private = 0 ORDER BY event_datetime ASC";
            }
          }elseif(isset($_GET['search'])){
            $search = urldecode($_GET['search']);
            $sql = "SELECT event_id, event_title, event_datetime, event_description, event_music, event_type, event_price,event_imageevent_id FROM events WHERE (event_datetime > :today AND event_private = 0) AND (event_title LIKE '%".$search."%' OR event_description LIKE '%".$search."%') ORDER BY event_datetime ASC";
          }else{
            $sql = "SELECT event_id, event_title, event_datetime, event_description, event_music, event_type, event_price,event_imageevent_id FROM events WHERE event_datetime > :today AND event_private = 0 ORDER BY event_datetime ASC";
          }
          $statement = $pdo->prepare($sql);
          $statement->execute($event_param);
          if($statement->rowCount() <= 0){
            echo ('<div class="noEvent" style="text-align: center;font-size: 1.5rem;">Aucun évènement disponible.</div>');
          }else{
            $event = $statement->fetchAll();
            if(isset($_GET['page'])){
              if($_GET['page'] > 0){
                $page = $_GET['page'];
              }else{
                $page = 1;
              }
            }else{
              $page = 1;
            }
            for($i=(($page-1)*10); $i<($page*10) && $i < $statement->rowCount();$i++){
              $event_text = str_split($event[$i]['event_description'], 300);
              $event_descr = $event_text[0];
              $event_descri = str_replace("\r\n"," ", $event_descr);
              $event_descrip = str_replace("\n"," ", $event_descri);
              if(strlen($event_descrip) > 295){
                $event_descrip .= "[...]";
              }
              $event_desc = htmlspecialchars($event_descrip, ENT_QUOTES, 'utf-8');

              $image_get = "SELECT imageevent_url FROM imageevent WHERE imageevent_id = ".$event[$i]['event_imageevent_id'].";";
              $statement2 = $pdo->query($image_get);
              $image = $statement2->fetch();

              if($event[$i]['event_type'] == 1){
                $event_type = "Before";
                if($event[$i]['event_music'] == 1){
                  $event_music = "Afrobeat";
                }elseif($event[$i]['event_music'] == 2){
                  $event_music = "All style";
                }elseif($event[$i]['event_music'] == 3){
                  $event_music = "Années '70";
                }elseif($event[$i]['event_music'] == 4){
                  $event_music = "Années '80";
                }elseif($event[$i]['event_music'] == 5){
                  $event_music = "Années '90";
                }elseif($event[$i]['event_music'] == 6){
                  $event_music = "Années '00";
                }elseif($event[$i]['event_music'] == 7){
                  $event_music = "Bachata";
                }elseif($event[$i]['event_music'] == 8){
                  $event_music = "Blues";
                }elseif($event[$i]['event_music'] == 9){
                  $event_music = "Country";
                }elseif($event[$i]['event_music'] == 10){
                  $event_music = "Dancehall";
                }elseif($event[$i]['event_music'] == 11){
                  $event_music = "Dubstep";
                }elseif($event[$i]['event_music'] == 12){
                  $event_music = "Électro";
                }elseif($event[$i]['event_music'] == 13){
                  $event_music = "Funk";
                }elseif($event[$i]['event_music'] == 14){
                  $event_music = "Hip Hop";
                }elseif($event[$i]['event_music'] == 15){
                  $event_music = "House";
                }elseif($event[$i]['event_music'] == 16){
                  $event_music = "Jazz";
                }elseif($event[$i]['event_music'] == 17){
                  $event_music = "Latino";
                }elseif($event[$i]['event_music'] == 18){
                  $event_music = "Métal";
                }elseif($event[$i]['event_music'] == 19){
                  $event_music = "Punk";
                }elseif($event[$i]['event_music'] == 20){
                  $event_music = "R'N'B";
                }elseif($event[$i]['event_music'] == 21){
                  $event_music = "Rap";
                }elseif($event[$i]['event_music'] == 22){
                  $event_music = "Reggae";
                }elseif($event[$i]['event_music'] == 23){
                  $event_music = "Reggaeton";
                }elseif($event[$i]['event_music'] == 24){
                  $event_music = "Rock";
                }elseif($event[$i]['event_music'] == 25){
                  $event_music = "Techno";
                }elseif($event[$i]['event_music'] == 26){
                  $event_music = "Autres";
                }else{
                  $event_music = "Autres";
                }
              }elseif($event[$i]['event_type'] == 2){
                $event_type = "After";
                if($event[$i]['event_music'] == 1){
                  $event_music = "Afrobeat";
                }elseif($event[$i]['event_music'] == 2){
                  $event_music = "All style";
                }elseif($event[$i]['event_music'] == 3){
                  $event_music = "Années '70";
                }elseif($event[$i]['event_music'] == 4){
                  $event_music = "Années '80";
                }elseif($event[$i]['event_music'] == 5){
                  $event_music = "Années '90";
                }elseif($event[$i]['event_music'] == 6){
                  $event_music = "Années '00";
                }elseif($event[$i]['event_music'] == 7){
                  $event_music = "Bachata";
                }elseif($event[$i]['event_music'] == 8){
                  $event_music = "Blues";
                }elseif($event[$i]['event_music'] == 9){
                  $event_music = "Country";
                }elseif($event[$i]['event_music'] == 10){
                  $event_music = "Dancehall";
                }elseif($event[$i]['event_music'] == 11){
                  $event_music = "Dubstep";
                }elseif($event[$i]['event_music'] == 12){
                  $event_music = "Électro";
                }elseif($event[$i]['event_music'] == 13){
                  $event_music = "Funk";
                }elseif($event[$i]['event_music'] == 14){
                  $event_music = "Hip Hop";
                }elseif($event[$i]['event_music'] == 15){
                  $event_music = "House";
                }elseif($event[$i]['event_music'] == 16){
                  $event_music = "Jazz";
                }elseif($event[$i]['event_music'] == 17){
                  $event_music = "Latino";
                }elseif($event[$i]['event_music'] == 18){
                  $event_music = "Métal";
                }elseif($event[$i]['event_music'] == 19){
                  $event_music = "Punk";
                }elseif($event[$i]['event_music'] == 20){
                  $event_music = "R'N'B";
                }elseif($event[$i]['event_music'] == 21){
                  $event_music = "Rap";
                }elseif($event[$i]['event_music'] == 22){
                  $event_music = "Reggae";
                }elseif($event[$i]['event_music'] == 23){
                  $event_music = "Reggaeton";
                }elseif($event[$i]['event_music'] == 24){
                  $event_music = "Rock";
                }elseif($event[$i]['event_music'] == 25){
                  $event_music = "Techno";
                }elseif($event[$i]['event_music'] == 26){
                  $event_music = "Autres";
                }else{
                  $event_music = "Autres";
                }
              }elseif($event[$i]['event_type'] == 3){
                $event_type = "Soirée";
                if($event[$i]['event_music'] == 1){
                  $event_music = "Afrobeat";
                }elseif($event[$i]['event_music'] == 2){
                  $event_music = "All style";
                }elseif($event[$i]['event_music'] == 3){
                  $event_music = "Années '70";
                }elseif($event[$i]['event_music'] == 4){
                  $event_music = "Années '80";
                }elseif($event[$i]['event_music'] == 5){
                  $event_music = "Années '90";
                }elseif($event[$i]['event_music'] == 6){
                  $event_music = "Années '00";
                }elseif($event[$i]['event_music'] == 7){
                  $event_music = "Bachata";
                }elseif($event[$i]['event_music'] == 8){
                  $event_music = "Blues";
                }elseif($event[$i]['event_music'] == 9){
                  $event_music = "Country";
                }elseif($event[$i]['event_music'] == 10){
                  $event_music = "Dancehall";
                }elseif($event[$i]['event_music'] == 11){
                  $event_music = "Dubstep";
                }elseif($event[$i]['event_music'] == 12){
                  $event_music = "Électro";
                }elseif($event[$i]['event_music'] == 13){
                  $event_music = "Funk";
                }elseif($event[$i]['event_music'] == 14){
                  $event_music = "Hip Hop";
                }elseif($event[$i]['event_music'] == 15){
                  $event_music = "House";
                }elseif($event[$i]['event_music'] == 16){
                  $event_music = "Jazz";
                }elseif($event[$i]['event_music'] == 17){
                  $event_music = "Latino";
                }elseif($event[$i]['event_music'] == 18){
                  $event_music = "Métal";
                }elseif($event[$i]['event_music'] == 19){
                  $event_music = "Punk";
                }elseif($event[$i]['event_music'] == 20){
                  $event_music = "R'N'B";
                }elseif($event[$i]['event_music'] == 21){
                  $event_music = "Rap";
                }elseif($event[$i]['event_music'] == 22){
                  $event_music = "Reggae";
                }elseif($event[$i]['event_music'] == 23){
                  $event_music = "Reggaeton";
                }elseif($event[$i]['event_music'] == 24){
                  $event_music = "Rock";
                }elseif($event[$i]['event_music'] == 25){
                  $event_music = "Techno";
                }elseif($event[$i]['event_music'] == 26){
                  $event_music = "Autres";
                }else{
                  $event_music = "Autres";
                }
              }elseif($event[$i]['event_type'] == 4){
                $event_type = "Concert/Showcase";
                if($event[$i]['event_music'] == 1){
                  $event_music = "Afrobeat";
                }elseif($event[$i]['event_music'] == 2){
                  $event_music = "All style";
                }elseif($event[$i]['event_music'] == 3){
                  $event_music = "Années '70";
                }elseif($event[$i]['event_music'] == 4){
                  $event_music = "Années '80";
                }elseif($event[$i]['event_music'] == 5){
                  $event_music = "Années '90";
                }elseif($event[$i]['event_music'] == 6){
                  $event_music = "Années '00";
                }elseif($event[$i]['event_music'] == 7){
                  $event_music = "Bachata";
                }elseif($event[$i]['event_music'] == 8){
                  $event_music = "Blues";
                }elseif($event[$i]['event_music'] == 9){
                  $event_music = "Country";
                }elseif($event[$i]['event_music'] == 10){
                  $event_music = "Dancehall";
                }elseif($event[$i]['event_music'] == 11){
                  $event_music = "Dubstep";
                }elseif($event[$i]['event_music'] == 12){
                  $event_music = "Électro";
                }elseif($event[$i]['event_music'] == 13){
                  $event_music = "Funk";
                }elseif($event[$i]['event_music'] == 14){
                  $event_music = "Hip Hop";
                }elseif($event[$i]['event_music'] == 15){
                  $event_music = "House";
                }elseif($event[$i]['event_music'] == 16){
                  $event_music = "Jazz";
                }elseif($event[$i]['event_music'] == 17){
                  $event_music = "Latino";
                }elseif($event[$i]['event_music'] == 18){
                  $event_music = "Métal";
                }elseif($event[$i]['event_music'] == 19){
                  $event_music = "Punk";
                }elseif($event[$i]['event_music'] == 20){
                  $event_music = "R'N'B";
                }elseif($event[$i]['event_music'] == 21){
                  $event_music = "Rap";
                }elseif($event[$i]['event_music'] == 22){
                  $event_music = "Reggae";
                }elseif($event[$i]['event_music'] == 23){
                  $event_music = "Reggaeton";
                }elseif($event[$i]['event_music'] == 24){
                  $event_music = "Rock";
                }elseif($event[$i]['event_music'] == 25){
                  $event_music = "Techno";
                }elseif($event[$i]['event_music'] == 26){
                  $event_music = "Autres";
                }else{
                  $event_music = "Autres";
                }
              }elseif($event[$i]['event_type'] == 5){
                $event_type = "Open Mic/Karaoké";
                if($event[$i]['event_music'] == 1){
                  $event_music = "Afrobeat";
                }elseif($event[$i]['event_music'] == 2){
                  $event_music = "All style";
                }elseif($event[$i]['event_music'] == 3){
                  $event_music = "Années '70";
                }elseif($event[$i]['event_music'] == 4){
                  $event_music = "Années '80";
                }elseif($event[$i]['event_music'] == 5){
                  $event_music = "Années '90";
                }elseif($event[$i]['event_music'] == 6){
                  $event_music = "Années '00";
                }elseif($event[$i]['event_music'] == 7){
                  $event_music = "Bachata";
                }elseif($event[$i]['event_music'] == 8){
                  $event_music = "Blues";
                }elseif($event[$i]['event_music'] == 9){
                  $event_music = "Country";
                }elseif($event[$i]['event_music'] == 10){
                  $event_music = "Dancehall";
                }elseif($event[$i]['event_music'] == 11){
                  $event_music = "Dubstep";
                }elseif($event[$i]['event_music'] == 12){
                  $event_music = "Électro";
                }elseif($event[$i]['event_music'] == 13){
                  $event_music = "Funk";
                }elseif($event[$i]['event_music'] == 14){
                  $event_music = "Hip Hop";
                }elseif($event[$i]['event_music'] == 15){
                  $event_music = "House";
                }elseif($event[$i]['event_music'] == 16){
                  $event_music = "Jazz";
                }elseif($event[$i]['event_music'] == 17){
                  $event_music = "Latino";
                }elseif($event[$i]['event_music'] == 18){
                  $event_music = "Métal";
                }elseif($event[$i]['event_music'] == 19){
                  $event_music = "Punk";
                }elseif($event[$i]['event_music'] == 20){
                  $event_music = "R'N'B";
                }elseif($event[$i]['event_music'] == 21){
                  $event_music = "Rap";
                }elseif($event[$i]['event_music'] == 22){
                  $event_music = "Reggae";
                }elseif($event[$i]['event_music'] == 23){
                  $event_music = "Reggaeton";
                }elseif($event[$i]['event_music'] == 24){
                  $event_music = "Rock";
                }elseif($event[$i]['event_music'] == 25){
                  $event_music = "Techno";
                }elseif($event[$i]['event_music'] == 26){
                  $event_music = "Autres";
                }else{
                  $event_music = "Autres";
                }
              }elseif($event[$i]['event_type'] == 6){
                $event_type = "Gaming";
                if($event[$i]['event_music'] == 1){
                  $event_music = "Call of Duty";
                }elseif($event[$i]['event_music'] == 2){
                  $event_music = "Counter-Strike";
                }elseif($event[$i]['event_music'] == 3){
                  $event_music = "Dota 2";
                }elseif($event[$i]['event_music'] == 4){
                  $event_music = "FIFA";
                }elseif($event[$i]['event_music'] == 5){
                  $event_music = "Fortnite";
                }elseif($event[$i]['event_music'] == 6){
                  $event_music = "Jeux WII";
                }elseif($event[$i]['event_music'] == 7){
                  $event_music = "League of Legend";
                }elseif($event[$i]['event_music'] == 8){
                  $event_music = "Minecraft";
                }elseif($event[$i]['event_music'] == 9){
                  $event_music = "Mortal Kombat";
                }elseif($event[$i]['event_music'] == 10){
                  $event_music = "Overwatch";
                }elseif($event[$i]['event_music'] == 11){
                  $event_music = "PUBG";
                }elseif($event[$i]['event_music'] == 12){
                  $event_music = "Rainbow 6";
                }elseif($event[$i]['event_music'] == 13){
                  $event_music = "Rocket League";
                }elseif($event[$i]['event_music'] == 14){
                  $event_music = "Street Fighter";
                }elseif($event[$i]['event_music'] == 15){
                  $event_music = "Super Smash Bros.";
                }elseif($event[$i]['event_music'] == 16){
                  $event_music = "Valorant";
                }elseif($event[$i]['event_music'] == 17){
                  $event_music = "Yuh Gi Oh";
                }elseif($event[$i]['event_music'] == 18){
                  $event_music = "Autres";
                }else{
                  $event_music = "Autres";
                }
           /* }elseif($event[$i]['event_type'] == 7){
                $event_type = "Art";
                if($event[$i]['event_music'] == 1){
                  $event_music = "Architecture";
                }elseif($event[$i]['event_music'] == 2){
                  $event_music = "Cinéma";
                }elseif($event[$i]['event_music'] == 3){
                  $event_music = "Cirque";
                }elseif($event[$i]['event_music'] == 4){
                  $event_music = "Comédie";
                }elseif($event[$i]['event_music'] == 5){
                  $event_music = "Danse";
                }elseif($event[$i]['event_music'] == 6){
                  $event_music = "Dessin";
                }elseif($event[$i]['event_music'] == 7){
                  $event_music = "Graffiti";
                }elseif($event[$i]['event_music'] == 8){
                  $event_music = "Littérature";
                }elseif($event[$i]['event_music'] == 9){
                  $event_music = "Peinture";
                }elseif($event[$i]['event_music'] == 10){
                  $event_music = "Sculpture";
                }elseif($event[$i]['event_music'] == 11){
                  $event_music = "Tatoo";
                }elseif($event[$i]['event_music'] == 12){
                  $event_music = "Théâtre";
                }elseif($event[$i]['event_music'] == 13){
                  $event_music = "Autres";
                }else{
                  $event_music = "Autres";
              } */
              }elseif($event[$i]['event_type'] == 7){
                $event_type = "Autres";
                if($event[$i]['event_music'] == 1){
                  $event_music = "Conférence";
                }elseif($event[$i]['event_music'] == 2){
                  $event_music = "Mode";
                }elseif($event[$i]['event_music'] == 3){
                  $event_music = "Urbain";
                }elseif($event[$i]['event_music'] == 4){
                  $event_music = "Autres";
                }else{
                  $event_music = "Autres";
                }
              }else{
                $event_type = "Autres";
                $event_music = "Autres";
              }

              if($event[$i]['event_price'] == 0){
                $event_price = "Gratuit";
              }else{
                $event_price = $event[$i]['event_price']." CHF";
              }
              $datetimeint = explode(" ",$event[$i]['event_datetime']);
              $date = explode("-",$datetimeint[0]);
              $timeevent = explode(":",$datetimeint[1]);
              $dateevent = $date[2]."/".$date[1]."/".$date[0]." | ".$timeevent[0].":".$timeevent[1];

              echo ('<div class="event-presentation">
                    <div>
                    <img src="'. $image['imageevent_url'] .'" alt="" class="imgEvent">
                    </div>
                    <div class="eventInfo">
                    <div class="eventBottom">
                    <div class="eventDate">'.$event_type.' | '.$event_music.'</div>
                    <div class="musiqueEvent">'.$event_price.'</div>
                    </div>
                    <div class="eventTitle">'.$event[$i]['event_title'].'</div>
                    <div class="eventText">'.$event_desc.'</div>
                    <div class="eventBottom">
                    <div>
                    <a href="event?event='.$event[$i]['event_id'].'"><button class="btnEvent">Voir l\'évènement</button></a>
                    </div>
                    <div class="typeEvent">'.$dateevent.'</div>
                    </div>
                    </div>
                    </div>');
            }
            if($statement->rowCount()>10){
              if($page == 1){
                echo("<div class=\"gridComm\"><div></div><div class=\"pageNum\">Page ".$page."</div><a class=\"pageBtn\" href=\"eventlist?page=". $page+1 ."\" >&rarr;</a></div>");
              }elseif($page > 1 && $i < $statement->rowCount()){
                echo("<div class=\"gridComm\"><a class=\"pageBtn\" href=\"eventlist?page=". $page-1 ."\" >&larr;</a><div class=\"pageNum\">Page ".$page."</div>
                <a class=\"pageBtn\" href=\"eventlist?page=". $page+1 ."\" >&rarr;</a></div>");
              }else{
                echo("<div class=\"gridComm\"><a class=\"pageBtn\" href=\"eventlist?page=". $page-1 ."\" >&larr;</a><div class=\"pageNum\">Page ".$page."</div><div></div></div>");
              }
            }
          }
        ?>
        </div>
        </div>
        </section>
        <?php
          include './script_php/footer.php'
        ?>
        <i id="btnretour" onclick="topScroll()" class="fa-solid fa-circle-up"></i>
		<script>
			var swiper = new Swiper('.blog-slider', {
    spaceBetween: 30,
    effect: 'fade',
    loop: true,
    mousewheel: {
      invert: false,
    },
    // autoHeight: true,
    pagination: {
      el: '.blog-slider__pagination',
      clickable: true,
    }
  });
		</script>
    <script>
      var element = document.getElementById("logo")
      var search = document.getElementById("search")
      var searchBtn = document.getElementById("searchBtn")
			if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
        element.classList.toggle("logo");
        element.classList.toggle("logo-M");
        search.classList.toggle("search");
        search.classList.toggle("search-M");
        searchBtn.classList.toggle("searchBtn");
        searchBtn.classList.toggle("searchBtn-M");
      }else{
        let retour = document.getElementById("btnretour");

        window.onscroll = function() {scroll()};

        function scroll() {
          if (document.body.scrollTop > 475 || document.documentElement.scrollTop > 475) {
            retour.style.display = "block";
          } else {
            retour.style.display = "none";
          }
        }

        function topScroll() {
          document.body.scrollTop = 0;
          document.documentElement.scrollTop = 0;
        }
      }
      var verif = false
      var menu = document.getElementById("mySidenav")
      var main = document.getElementById("main")
      function filtreMenu(){
        if(verif == false){
          main.classList.toggle("main")
          main.classList.toggle("main-f")
          if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            menu.style.width = "330%";
          }else{
            menu.style.width = "100%";
          }
          verif = true;
        } else {
          menu.style.width = "0";
          verif = false
          setTimeout(closefiltre, 350);
          function closefiltre(){
            main.classList.toggle("main-f")
            main.classList.toggle("main")
          }
        }
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
    <script>
      document.getElementById('date').addEventListener('input', function(e){
        this.type = 'text';
        var input = this.value;
        if(/\D\/$/.test(input)) input = input.substr(0, input.length - 3);
        var values = input.split('/').map(function(v){return v.replace(/\D/g, '')});
        if(values[0]) values[0] = checkValue(values[0], 31);
        if(values[1]) values[1] = checkValue(values[1], 12);
        var output = values.map(function(v, i){
          return v.length == 2 && i < 2 ?  v + ' / ' : v;
        });
        this.value = output.join('').substr(0, 14);
      });

      function checkValue(str, max){
        if(str.charAt(0) !== '0' || str == '00'){
          var num = parseInt(str);
          if(isNaN(num) || num <= 0 || num > max) num = 1;
          str = num > parseInt(max.toString().charAt(0)) && num.toString().length == 1 ? '0' + num : num.toString();
        };
        return str;
      };

      document.getElementById('date').addEventListener('blur', function(e){
        this.type = 'tel';
        var input = this.value;
        var values = input.split('/').map(function(v){return v.replace(/\D/g, '')});
        var output = '';
        if(values.length == 3){
          var year = values[2].length !== 4 ? parseInt(values[2]) + 2000 : parseInt(values[2]);
          var month = parseInt(values[1]) - 1;
          var day = parseInt(values[0]);
          var d = new Date(year, month, day);
          if(!isNaN(d)){
            var dates = [d.getDate(), d.getMonth() + 1, d.getFullYear()];
            output = dates.map(function(v){
              v = v.toString();
              return v.length == 1 ? '0' + v : v;
            }).join(' / ');
          };
        };
        this.value = output;
      });
    </script>
    <script>
  $(document).ready(function () {
    $("#type").change(function () {
        var val = $(this).val();
        if (val == "1" | val == "2" | val == "3" | val == "4" | val == "5") {
            $("#musique").html('<option value="1">Afrobeat</option><option value="2">All style</option><option value="3">Années \'70</option><option value="4">Années \'80</option><option value="5">Années \'90</option><option value="6">Années \'00</option><option value="7">Bachata</option><option value="8">Blues</option><option value="9">Country</option><option value="10">Dancehall</option><option value="11">Dubstep</option><option value="12">Électro</option><option value="13">Funk</option><option value="14">Hip Hop</option><option value="15">House</option><option value="16">Jazz</option><option value="17">Latino</option><option value="18">Métal</option><option value="19">Punk</option><option value="20">R\'N\'B</option><option value="21">Rap</option><option value="22">Reggae</option><option value="23">Reggaeton</option><option value="24">Rock</option><option value="25">Techno</option><option value="26">Autres</option>');
        } else if (val == "6") {
            $("#musique").html('<option value="1">Call of Duty</option><option value="2">Counter-Strike</option><option value="3">Dota 2</option><option value="4">FIFA</option><option value="5">Fortnite</option><option value="6">Jeux WII</option><option value="7">League of Legend</option><option value="8">Minecraft</option><option value="9">Mortal Kombat</option><option value="10">Overwatch</option><option value="11">PUBG</option><option value="12">Rainbow 6</option><option value="13">Rocket League</option><option value="14">Street Fighter</option><option value="15">Super Smash Bros.</option><option value="16">Valorant</option><option value="17">Yuh Gi Oh</option><option value="18">Autres</option>');
        } /* else if (val == "7") {
            $("#musique").html('<option value="1">Architecture</option><option value="2">Cinéma</option><option value="3">Cirque</option><option value="4">Comédie</option><option value="5">Danse</option><option value="6">Dessin</option><option value="7">Graffiti</option><option value="8">Littérature</option><option value="9">Peinture</option><option value="10">Sculpture</option><option value="11">Tatoo</option><option value="12">Théâtre</option><option value="13">Autres</option>');
        } */ else if (val == "7"){
          $("#musique").html('<option value="1">Conférence</option><option value="2">Mode</option><option value="3">Urbain</option><option value="4">Autres</option>')
        } else{
          $("#musique").html('<option value="">--Veuillez choisir une catégorie--</option>');
        }
    });
  });
</script>
    </body>
</html>
