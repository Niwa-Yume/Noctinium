<?php
    require './script_php/database-connection.php';
    require './script_php/sessions.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="asset/style.css">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
          <link rel="stylesheet" href="asset/map.css">
          <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.1/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin=""/>
          <script src="https://unpkg.com/leaflet@1.9.1/dist/leaflet.js" integrity="sha256-NDI0K41gVbWqfkkaHj15IzU7PtMoelkzyKp8TOaFQ3s=" crossorigin=""></script>
          <meta charset="utf-8" />
      <title>Map</title>
      <link rel="icon" href="image/logo_noctinium_16x16.png">
    </head>
    
    <!--CECI EST LE CORPPS DE LA PAGE-->
    <body>
        <header>
            <a href="index.php"><img class="logo" id="logo" src="image/logo_noctinium.png" alt="Logo"></a>
            <nav>
              <li><a href="index.php">Accueil</a></li>
              <li><a href="eventlist.php">Évènements</a></li>
              <li><a href="contact.php">Contact</a></li>
              <li><a href="propos.php">A propos</a></li>
              <li><a href="faq.php">FAQ</a></li>
              <li><a href="
              <?php 
				if($logged_in == true){
					echo("compte.php");
				}else{
					echo("connexion.php");
				};?>"><?php 
				if($logged_in == true){
					echo("Compte");
				}else{
					echo("Connexion");
				};?></a></li>
          </nav>
        </header>

        <!--DEBUT MAP-->
        <section class="subscribe">
        <?php
              if (isset($_GET['event'])){
                $event_id = $_GET['event'];

                $sql = "SELECT event_id, event_title, event_location, event_lat, event_lon, event_description FROM events WHERE event_id = '". $event_id ."';";
        
                $statement = $pdo->query($sql);
                $event = $statement->fetch();

                $desc_cut = str_split($event['event_description'], 150);
                                    $desc_test = $desc_cut[0];
                                    if(strlen($desc_test)==150){
                                    $desc_test .= '...';
                                    }
                                    $desc_test2 = str_replace("\r\n", " ", $desc_test);
                                    $desc_test3 = str_replace("<", " ", $desc_test2);
                                    $desc_test4 = str_replace(">", " ", $desc_test3);
                                    $description = str_replace("\"", "`", $desc_test4);
              }
        ?>
            <div id="map" class="mapBig">
                <script>
                    // Make sure you put this AFTER Leaflet's CSS
                    var map = L.map('map').setView([<?php echo ($event['event_lat'])?>, <?php echo ($event['event_lon'])?>], 18);
                     L.tileLayer('https://a.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
                     minZoom: 1,
                     maxZoom: 19,
                     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                     }).addTo(map);
                    var pointeurMaison = L.icon({
                        iconUrl: 'image/pointeurmaison-min.png',
                        iconSize:     [49.1, 80], // size of the icon
                        iconAnchor:   [24, 78], // point of the icon which will correspond to marker's location
                        popupAnchor:  [1, -75]
                    });
                    var eventsPointeur = {
                        "<?php echo ('<a title=\"Voir cet évènement\" href=\"event.php?event='. $event['event_id'] .'\"><div class=\"popup-container\"><h1 class=\"titleEvent\">'. $event['event_title'] .'</h1><div class=\"descEvent\">'. $description .'</div></div></a>')?>":            {"lat":<?php echo ($event['event_lat'])?>      ,   "lon":<?php echo ($event['event_lon'])?>}
                    };

                    for(lieu in eventsPointeur){
                // On va mettre un pointeur sur une des zone de la map selon des coordonéees GPS
                // Une pop va apparaitre sur le pointeur en mode pop up
                var marker = L.marker([eventsPointeur[lieu].lat, eventsPointeur[lieu].lon],{icon: pointeurMaison})
                .addTo(map); 
                marker.bindPopup(lieu)
            }
                </script>
            </div>
        </section>
        <!--FIN DE LA MAP-->
        <?php
          include './script_php/footer.php'
        ?>
        <script>
        var element = document.getElementById("logo")
        var map = document.getElementById("map")
			if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
        element.classList.toggle("logo");
        element.classList.toggle("logo-M");
        map.classList.toggle("mapBig");
        map.classList.toggle("mapBig-M");
      }
		</script>

    </body>
</html>
