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
          <link rel="stylesheet" href="asset/map.css">
          <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.1/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin=""/>
          <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
          <script src="https://unpkg.com/leaflet@1.9.1/dist/leaflet.js" integrity="sha256-NDI0K41gVbWqfkkaHj15IzU7PtMoelkzyKp8TOaFQ3s=" crossorigin=""></script>
          <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
          <meta charset="utf-8" />
          <meta name="viewport" content="width=100vw, initial-scale=0.5">
      <title>Map</title>
      <link rel="icon" href="image/logo_noctinium.ico">
    </head>
    
    <!--CECI EST LE CORPPS DE LA PAGE-->
    <body onload="init()">
        <header>
            <a href="index"><img class="logo" id="logo" src="image/logo_noctinium.webp" alt="Logo"></a>
            <nav id="computer">
              <li><a href="index">Accueil</a></li>
              <li><a href="eventlist">Évènements</a></li>
              <li><a href="contact">Contact</a></li>
              <li><a href="propos">À propos</a></li>
              <li><a href="faq">FAQ</a></li>
              <li><a href="
              <?php 
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

        <!--DEBUT MAP-->
        <section class="subscribe">
        <?php
                if (isset($_GET['event'])){
                    $event_id = $_GET['event'];

                    $sql = "SELECT event_id, event_title, event_location, event_lat, event_lon, event_description, event_maskedlocation, event_user_type FROM events WHERE event_id = '". $event_id ."';";
            
                    $statement = $pdo->query($sql);
                    if($statement->rowCount() > 0){
                        $event = $statement->fetch();

                        $today = date('Y-m-d H:i:s');
                        if($today < $event['event_maskedlocation']){
                            header('Location: event?event='.$event['event_id']);
                            exit;
                        }

                        $desc_cut = str_split($event['event_description'], 150);
                                            $desc_test = $desc_cut[0];
                                            if(strlen($desc_test)==150){
                                            $desc_test .= '...';
                                            }
                                            $desc_test2 = str_replace("\r\n", " ", $desc_test);
                                            $desc_test3 = str_replace("\n", " ", $desc_test2);
                                            $description = htmlspecialchars($desc_test3, ENT_QUOTES, 'utf-8');
                    }else{
                        header('Location: error');
                    }
                }
        ?>
            <div id="map" class="mapBig">
                <script>
                    // Make sure you put this AFTER Leaflet's CSS
                    function init() {
                        map = new L.Map('map');
                        L.tileLayer('https://a.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
                            minZoom: 1,
                            maxZoom: 19,
                            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                        }).addTo(map);

                        // map view before we get the location
                        map.setView(new L.LatLng(<?php echo ($event['event_lat'])?>, <?php echo ($event['event_lon'])?>), 18);
                        
                        var eventsPointeur = {
                        "<?php echo ('<a title=\"Voir cet évènement\" href=\"event?event='. $event['event_id'] .'\"><div class=\"popup-container\"><h1 class=\"titleEvent\">'. $event['event_title'] .'</h1><div class=\"descEvent\">'. $description .'</div></div></a>')?>": {"lat":<?php echo ($event['event_lat'])?>, "lon":<?php echo ($event['event_lon'])?>, "icone":<?php if($event['event_user_type'] == 3){echo("pointeurVerreViolet");}elseif($event['event_user_type'] == 2){echo("pointeurNoteViolet");}else{echo("pointeurMaisonViolet");} ?>}
                        };
                        for(lieu in eventsPointeur){
                                // On va mettre un pointeur sur une des zone de la map selon des coordonéees GPS
                                // Une pop va apparaitre sur le pointeur en mode pop up
                                var marker = L.marker([eventsPointeur[lieu].lat, eventsPointeur[lieu].lon],{icon: eventsPointeur[lieu].icone})
                                .addTo(map); 
                                marker.bindPopup(lieu);
                        }
                    }
                    var route = null
                    function createRoute(latlng){
                        if (route == null){
                            route = L.Routing.control({
                                waypoints: [
                                    L.latLng(latlng),
                                    L.latLng(<?php echo ($event['event_lat'])?>, <?php echo ($event['event_lon'])?>)
                                ],
                                language: 'fr',
                                createMarker: function() { return null; },
                                lineOptions : {
                                    addWaypoints: false,
                                    draggableWaypoints: false,
                                    styles: [
                                        {color: 'white', opacity: 0.9, weight: 9},
                                        {color: 'purple', opacity: 1, weight: 3}
                                    ]
                                }
                            }).addTo(map);
                        }else{
                            map.removeControl(route);
                            route = null;
                            route = L.Routing.control({
                                waypoints: [
                                    L.latLng(latlng),
                                    L.latLng(<?php echo ($event['event_lat'])?>, <?php echo ($event['event_lon'])?>)
                                ],
                                language: 'fr',
                                createMarker: function() { return null; },
                                lineOptions : {
                                    addWaypoints: false,
                                    draggableWaypoints: false,
                                    styles: [
                                        {color: 'white', opacity: 0.9, weight: 9},
                                        {color: 'purple', opacity: 1, weight: 3}
                                    ]
                                }
                            }).addTo(map);
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
                        createRoute(e.latlng);
                    }

                    function onLocationError(e) {
                        alert("Nous n'avons pas accès à votre localisation.");
                    }

                    function getLocationLeaflet() {
                        map.on('locationfound', onLocationFound);
                        map.on('locationerror', onLocationError);

                        map.locate({setView: true, maxZoom: 15});
                    }
                    var pointeurUser = L.icon({
                        iconUrl: 'marker/UserPointer-min.png',
                        iconSize:     [40, 58], // size of the icon
                        iconAnchor:   [19, 57], // point of the icon which will correspond to marker's location
                        popupAnchor:  [1.5, -54]
                    });
                    var pointeurMaisonViolet = L.icon({
                        iconUrl: 'marker/HouseV.png',
                        iconSize:     [49.1, 83], // size of the icon
                        iconAnchor:   [24, 81], // point of the icon which will correspond to marker's location
                        popupAnchor:  [-0.5, -78]
                    });
                    var pointeurVerreViolet = L.icon({
                        iconUrl: 'marker/VerreV.png',
                        iconSize:     [50.6, 83], // size of the icon
                        iconAnchor:   [25.5, 81], // point of the icon which will correspond to marker's location
                        popupAnchor:  [1.5, -78]
                    });
                    var pointeurNoteViolet = L.icon({
                        iconUrl: 'marker/MusicNoteV.png',
                        iconSize:     [49.1, 83], // size of the icon
                        iconAnchor:   [24, 81], // point of the icon which will correspond to marker's location
                        popupAnchor:  [-0.5, -78]
                    });
                </script>
            </div>
            <button class="route" onclick="getLocationLeaflet()">Itinéraire <i class="fa-solid fa-map-location-dot"></i></button>
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
