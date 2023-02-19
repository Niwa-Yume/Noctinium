<?php
    require 'script_php/database-connection.php';
    require 'script_php/sessions.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="asset/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
          <link rel="stylesheet" href="asset/map.css">
          <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.1/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin=""/>
          <script src="https://unpkg.com/leaflet@1.9.1/dist/leaflet.js" integrity="sha256-NDI0K41gVbWqfkkaHj15IzU7PtMoelkzyKp8TOaFQ3s=" crossorigin=""></script>
        <meta charset="utf-8" />
        <meta name="description" content="Page d'accueil du site Noctinium sur laquelle vous retrouverez notre map affichant les évènements du jours.">
        <title>Accueil</title>
        <link rel="icon" href="image/logo_noctinium_16x16.png">
    </head>
    <body>
        <header>
            <a href="index.php"><img class="logo" id="logo" src="image/logo_noctinium.webp"></a>
            <nav>
                <ul>
                <li class="active"><a href="index.php">Accueil</a></li>
                <li><a href="eventlist.php">Évènements</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="propos.php">A propos</a></li>
                <li><a href="faq.php">FAQ</a></li>
                <li><a href="<?php 
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
                </ul>
            </nav>
        </header>
        <section class="main">
            <div class="container">
                <h1 class="gradient-text">Noctinium</h1>
                <p>
                    Trouvez vos soirées simplement et rapidement sur Genève et vos alentours !<br><br>
                    Vous pouvez aussi <a class="underline" href="">télécharger</a> l'application mobile !<br><br>
                    Suivez-nous sur les réseau <span class="text-gradient-purple">#FindTheNight</span>
                    <ul class="linear-list">
                        <li>
                            <a target="_blank" href="https://twitter.com/NoctiniumGE">
                                <img src="asset/twitter.svg" alt="Twitter">
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://www.instagram.com/noctiniumge">
                                <img src="asset/instagram.svg" alt="Instagram">
                            </a>
                        </li>
                        
                    </ul>
                </p>
                <br>
                <br>
                <a class="button" href="#map" onclick="scroll()">
                    Voir les évènements
                </a>
            </div>
        </section>
       
        <hr class="gradient" id="ancre">
        <?php
                $today = date('Y-m-d H:i:s');
                $today2 = date('Y-m-d H:i:s', strtotime(' -6 hours'));;
                $event_param['today'] = $today;
                $event_param['today2'] = $today2;
                $sql = "SELECT event_id, event_title, event_location, event_lat, event_lon, event_description FROM events WHERE DATEDIFF(event_datetime, :today) < 1 AND event_datetime > :today2;";
                $statement = $pdo->prepare($sql);
                $statement->execute($event_param);
            // Envoi de la requête à Nominatim
            //$url = "https://nominatim.openstreetmap.org/search?q=".urlencode($address)."&limit=1&format=json";
        ?>
        <section class="subscribe">
            <h1 class="gradient-text titleMap">Évènements du jour</h1>
            <div id="map" class="map">
                <script>
                    // Make sure you put this AFTER Leaflet's CSS
                    /* if(navigator.geolocation){
                        navigator.geolocation.getCurrentPosition(showLocation);
                    }
                    function showLocation(position){
                        var latitude = position.coords.latitude;
                        var longitude = position.coords.longitude;
                        if(!latitude){
                            latitude = 46.19620;
                        }
                        if(!longitude){
                            longitude = 6.14020;
                        }
                    } */
                    var map = L.map('map').setView([46.19620, 6.14020], 13.5);
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
                        <?php
                            echo ("var eventsPointeur = {\n");
                            if ($statement->rowCount() > 0){
                                while($event = $statement->fetch()){
                                    $desc_cut = str_split($event['event_description'], 150);
                                    $desc_test = $desc_cut[0];
                                    if(strlen($desc_test)==150){
                                    $desc_test .= '...';
                                    }
                                    $desc_test2 = str_replace("\r\n", " ", $desc_test);
                                    $description = str_replace("\"", "`", $desc_test2);

                                    echo ('"<a title=\"Voir cet évènement\" href=\"event.php?event='. $event['event_id'] .'\"><div class=\"popup-container\"><h1 class=\"titleEvent\">'. $event['event_title'] .'</h1><div class=\"descEvent\">'. $description .'</div></div></a>": {\'lat\':'. $event['event_lat'] .',\'lon\':'. $event['event_lon'] .'},');
                                }
                            }
                            
                            echo ("\n};")
                        ?>
                        // 'Usine':            {'lat': 46.204      ,   'lon':6.13628},
                        // "Motel Campo":      {"lat": 46.185281864,   "lon": 6.1290354},
                        // "Village du soir":  {"lat": 46.176426   ,   "lon":6.127385},
                        // "MonteCristo Club": {"lat": 46.1900356995,  "lon":6.1382010525},

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

        <?php
          include './script_php/footer.php'
        ?>
    </body>
    <script>
        var element = document.getElementById("logo")
        var map = document.getElementById("map")
        var main = document.querySelector(".main")
        var btn = document.querySelector(".button")
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
                element.classList.toggle("logo");
                element.classList.toggle("logo-M");
                map.classList.toggle("map");
                map.classList.toggle("map-M");
                main.classList.toggle("main-M");
                main.classList.toggle("main");
                btn.classList.toggle("hidden")
            }

        var scroll_map = document.getElementById("map")
        function scroll(){
            scrollTo(scroll_map);
        }
    </script>
</html>
