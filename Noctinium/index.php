<?php
    require 'script_php/database-connection.php';
    require 'script_php/sessions.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="asset/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="asset/fontawesome/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
          <link rel="stylesheet" href="asset/map.css">
          <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.1/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin=""/>
          <script src="https://unpkg.com/leaflet@1.9.1/dist/leaflet.js" integrity="sha256-NDI0K41gVbWqfkkaHj15IzU7PtMoelkzyKp8TOaFQ3s=" crossorigin=""></script>
        <meta charset="utf-8" />
        <meta name="description" content="Page d'accueil du site Noctinium sur laquelle vous retrouverez notre map affichant les évènements du jours.">
        <title>Accueil</title>
        <link rel="icon" href="image/logo_noctinium.ico">
    </head>
    <body onload="init()">
        <header>
            <a href="index"><img class="logo" id="logo" alt="Logo" src="image/logo_noctinium.webp"></a>
            <nav id="computer">
                <ul>
                    <li class="active"><a href="index">Accueil</a></li>
                    <li><a href="eventlist">Évènements</a></li>
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
                </ul>
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
        <section class="main">
            <div class="container">
                <h1 class="gradient-text">Noctinium</h1>
                <p>
                    Trouvez vos soirées simplement et rapidement sur Genève et vos alentours !<br><br>
                    Vous pouvez aussi <a class="underline" href="soon">télécharger</a> l'application mobile !<br><br>
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
                $today2 = date('Y-m-d H:i:s', strtotime(' -6 hours'));
                $tomorrow = date('Y-m-d H:i:s', strtotime($today. ' + 3 days'));;
                $event_param['today'] = $today2;
                $event_param['tomorrow'] = $tomorrow;
                $sql = "SELECT event_id, event_title, event_location, event_lat, event_lon, event_description, event_user_type FROM events WHERE event_datetime < :tomorrow AND event_datetime > :today;";
                $statement = $pdo->prepare($sql);
                $statement->execute($event_param);
            // Envoi de la requête à Nominatim
            //$url = "https://nominatim.openstreetmap.org/search?q=".urlencode($address)."&limit=1&format=json";
        ?>
        <section class="subscribe">
            <h1 class="gradient-text titleMap">Évènements du <?php $date_1 = explode(" ", $today); $date_2 = explode(" ", $tomorrow); $date1 = explode("-", $date_1[0]); $date2 = explode("-", $date_2[0]); echo ($date1[2]."/".$date1[1]."/".$date1[0]." au ".$date2[2]."/".$date2[1]."/".$date2[0]); ?></h1>
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
                    function init() {
                        map = new L.Map('map');
                        L.tileLayer('https://a.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
                            minZoom: 1,
                            maxZoom: 19,
                            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                        }).addTo(map);

                        // map view before we get the location
                        map.setView(new L.LatLng(46.19620, 6.14020), 13);
                        <?php
                            echo ("var eventsPointeur = {");
                        
                            if ($statement->rowCount() > 0){
                                while($event = $statement->fetch()){
                                    $desc_cut = str_split($event['event_description'], 150);
                                    $desc_test = $desc_cut[0];
                                    if(strlen($desc_test)==150){
                                    $desc_test .= '...';
                                    }
                                    $desc_test2 = str_replace("\r\n", " ", $desc_test);
                                    $desc_test3 = str_replace("\n", " ", $desc_test2);
                                    $description = htmlspecialchars($desc_test3, ENT_QUOTES, 'utf-8');

                                    if($event['event_user_type'] == 3){
                                        $icone = "pointeurVerreViolet";
                                    }elseif($event['event_user_type'] == 2){
                                        $icone = "pointeurNoteViolet";
                                    }else{
                                        $icone = "pointeurMaison";
                                    }

                                    echo ('"<a title=\"Voir cet évènement\" href=\"event?event='. $event['event_id'] .'\"><div class=\"popup-container\"><h1 class=\"titleEvent\">'. $event['event_title'] .'</h1><div class=\"descEvent\">'. $description .'</div></div></a>": {\'lat\':'. $event['event_lat'] .',\'lon\':'. $event['event_lon'] .', \'icone\':'. $icone .'},');
                                }
                            }
                        
                            echo ("};");
                        ?>
                        for(lieu in eventsPointeur){
                                // On va mettre un pointeur sur une des zone de la map selon des coordonéees GPS
                                // Une pop va apparaitre sur le pointeur en mode pop up
                                var marker = L.marker([eventsPointeur[lieu].lat, eventsPointeur[lieu].lon],{icon: eventsPointeur[lieu].icone})
                                .addTo(map); 
                                marker.bindPopup(lieu);
                        }
                    }
                    var gpsMarker = null;
                    function onLocationFound(e) {
                        if (gpsMarker == null) {
                            gpsMarker = L.marker(e.latlng, {icon: pointeurUser}).addTo(map);
                            gpsMarker.bindPopup("<h1>Vous êtes ici</h1>").openPopup();
                            }
                        else {
                            gpsMarker.getPopup().setContent("<h1>Vous êtes ici</h1>");   
                            gpsMarker.setLatLng(e.latlng);
                        }
                    }

                    function onLocationError(e) {
                        alert("Nous n'avons pas accès à votre localisation.");
                    }

                    function getLocationLeaflet() {
                        map.on('locationfound', onLocationFound);
                        map.on('locationerror', onLocationError);

                        map.locate({setView: true, maxZoom: 16});
                    }
                    var pointeurUser = L.icon({
                        iconUrl: 'marker/UserPointer-min.png',
                        iconSize:     [40, 58], // size of the icon
                        iconAnchor:   [19, 57], // point of the icon which will correspond to marker's location
                        popupAnchor:  [1.5, -54]
                    });
                    var pointeurMaison = L.icon({
                        iconUrl: 'marker/MaisonVioletBlack-min.png',
                        iconSize:     [49.1, 83], // size of the icon
                        iconAnchor:   [24, 81], // point of the icon which will correspond to marker's location
                        popupAnchor:  [-0.5, -78]
                    });
                    var pointeurVerreViolet = L.icon({
                        iconUrl: 'marker/GobeletVioletBlack-min.png',
                        iconSize:     [50.6, 83], // size of the icon
                        iconAnchor:   [25.5, 81], // point of the icon which will correspond to marker's location
                        popupAnchor:  [1.5, -78]
                    });
                    var pointeurNoteViolet = L.icon({
                        iconUrl: 'marker/MusiqueVioletBlack-min.png',
                        iconSize:     [49.1, 83], // size of the icon
                        iconAnchor:   [24, 81], // point of the icon which will correspond to marker's location
                        popupAnchor:  [-0.5, -78]
                    });
                        // 'Usine':            {'lat': 46.204      ,   'lon':6.13628},
                        // "Motel Campo":      {"lat": 46.185281864,   "lon": 6.1290354},
                        // "Village du soir":  {"lat": 46.176426   ,   "lon":6.127385},
                        // "MonteCristo Club": {"lat": 46.1900356995,  "lon":6.1382010525},
                </script>
            </div>
            <button class="locate" onclick="getLocationLeaflet()"><i class="fa-solid fa-location-crosshairs"></i></button>
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
</html>
