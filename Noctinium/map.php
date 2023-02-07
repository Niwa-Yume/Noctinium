<?php
    require './script_php/database-connection.php';
    include './script_php/sessions.php';
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

                $sql = "SELECT * FROM events WHERE event_id = '". $event_id ."';";
        
                $statement = mysqli_query($mysqli, $sql);
                $event = mysqli_fetch_array($statement);

                $sql2 = "SELECT user_imageuser_id FROM user WHERE user_id = '". $event['event_user_id'] ."';";

                $statement2 = mysqli_query($mysqli, $sql2);
                $user = mysqli_fetch_array($statement2);

                $sql3 = "SELECT imageuser_url FROM imageuser WHERE imageuser_id = '". $user['user_imageuser_id'] ."';";

                $statement3 = mysqli_query($mysqli, $sql3);
                $user_image = mysqli_fetch_array($statement3);
              }
              $address = $event['event_location'];

            // Envoi de la requête à Nominatim
            //$url = "https://nominatim.openstreetmap.org/search?q=".urlencode($address)."&limit=1&format=json";
            
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

            $response = geocode($address);

            // Récupération des coordonnées GPS
            $lat = $response[0]['lat'];
            $lon = $response[0]['lon'];

        ?>
            <div id="map" class="mapBig">
                <script>
                    // Make sure you put this AFTER Leaflet's CSS
                    var map = L.map('map').setView([<?php echo ($lat)?>, <?php echo ($lon)?>], 18);
                     L.tileLayer('https://a.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
                     minZoom: 1,
                     maxZoom: 19,
                     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                     }).addTo(map);
                
                    var eventsPointeur = {
                        '<?php echo ("<a href=\"event.php?event=". $event_id ."\"><img class=\"imgMap\" src=\"". $user_image['imageuser_url'] ."\"></a><br><a href=\"event.php?event=". $event_id ."\">".$event['event_title'] ."</a>")?>':            {"lat":<?php echo ($lat)?>      ,   "lon":<?php echo ($lon)?>}
                    };

                    for(lieu in eventsPointeur){
                // On va mettre un pointeur sur une des zone de la map selon des coordonéees GPS
                // Une pop va apparaitre sur le pointeur en mode pop up
                var marker = L.marker([eventsPointeur[lieu].lat, eventsPointeur[lieu].lon])
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
