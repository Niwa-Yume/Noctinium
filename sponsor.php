<?php
    require './script_php/database-connection.php';
    require './script_php/sessions.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="asset/style.css">
        <link rel="stylesheet" href="asset/sponsor.css">
        <link rel="stylesheet" href="asset/fontawesome/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
      <meta charset="utf-8" />
      <title>Sponsors</title>
      <link rel="icon" href="image/logo_noctinium.ico">
      <meta name="viewport" content="width=100vw, initial-scale=0.5">
    </head>
    <body>
        <header>
            <a href="index"><img class="" id="logo" src="image/logo_noctinium.webp" alt="Logo"></a>
            <nav id="computer">
                <li><a href="index">Accueil</a></li>
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
            </nav>
            <nav id="mobile" class="hidden">
                <ul>
                    <li class="bread"><a class="burger" onclick="openNav()">&#9776;</a></li>
                </ul>
            </nav>
        </header>
        <div id="menuBack" class="menuBack" onclick="closeNav()">
            <div id="sidemenu" class="menu">
                <a class="closebtn" onclick="closeNav()">&times;</a>
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
                <h1 class="gradient-text">Sponsor et aide précieuse </h1>
            </div>
        </section>
        <hr class="gradient">
        <section class="subscribe flexible">
        <div class="flexible" id="flex">
          <div class="flex">
            <h1>McDonald's</h1>
            <a href=""><img src="image/mcdo.jpg" alt="Sponsor"></a>
            <div class="description">
                McDonald's nous a permis d'optenir les fonds nécessaires pour héberger notre site.
            </div>
          </div>
          <div class="flex">
            <h1>McDonald's</h1>
            <a href=""><img src="image/mcdo.jpg" alt=""></a>
            <div class="description">
                McDonald's nous a permis d'optenir les fonds nécessaires pour héberger notre site.
            </div>
          </div>
          <div class="flex">
            <h1>McDonald's</h1>
            <a href=""><img src="image/mcdo.jpg" alt=""></a>
            <div class="description">
                McDonald's nous a permis d'optenir les fonds nécessaires pour héberger notre site.
            </div>
          </div>
          <div class="flex">
            <h1>McDonald's</h1>
            <a href=""><img src="image/mcdo.jpg" alt=""></a>
            <div class="description">
                McDonald's nous a permis d'optenir les fonds nécessaires pour héberger notre site.
            </div>
          </div>
          <div class="flex">
            <h1>McDonald's</h1>
            <a href=""><img src="image/mcdo.jpg" alt=""></a>
            <div class="description">
                McDonald's nous a permis d'optenir les fonds nécessaires pour héberger notre site.
            </div>
          </div>
          <div class="flex">
            <h1>McDonald's</h1>
            <a href=""><img src="image/mcdo.jpg" alt=""></a>
            <div class="description">
                McDonald's nous a permis d'optenir les fonds nécessaires pour héberger notre site.
            </div>
          </div>
          <div class="flex">
            <h1>McDonald's</h1>
            <a href=""><img src="image/mcdo.jpg" alt=""></a>
            <div class="description">
                McDonald's nous a permis d'optenir les fonds nécessaires pour héberger notre site.
            </div>
          </div>
          <div class="flex">
            <h1>McDonald's</h1>
            <a href=""><img src="image/mcdo.jpg" alt=""></a>
            <div class="description">
                McDonald's nous a permis d'optenir les fonds nécessaires pour héberger notre site.
            </div>
          </div><div class="flex">
            <h1>McDonald's</h1>
            <a href=""><img src="image/mcdo.jpg" alt=""></a>
            <div class="description">
                McDonald's nous a permis d'optenir les fonds nécessaires pour héberger notre site.
            </div>
          </div>
          <div class="flex">
            <h1>McDonald's</h1>
            <a href=""><img src="image/mcdo.jpg" alt=""></a>
            <div class="description">
                McDonald's nous a permis d'optenir les fonds nécessaires pour héberger notre site.
            </div>
          </div>
        </div>
        </section>
        <hr>
        <section class="attends partenaire">
                <h4>Merci à nos partenaires !!!</h4>
            <div class="flexible" id="flex2">
              <div class="flex">
                <h1>McDonald's</h1>
                <a href=""><img src="image/alieu.jfif" alt=""></a>
                <div class="description">
                    McDonald's nous a permis d'optenir les fonds nécessaires pour héberger notre site.
                </div>
              </div>
              <div class="flex">
                <h1>McDonald's</h1>
                <a href=""><img src="image/david.png" alt=""></a>
                <div class="description">
                    McDonald's nous a permis d'optenir les fonds nécessaires pour héberger notre site.
                </div>
              </div>
              <div class="flex">
                <h1>McDonald's</h1>
                <a href=""><img src="image/alieu.jfif" alt=""></a>
                <div class="description">
                    McDonald's nous a permis d'optenir les fonds nécessaires pour héberger notre site.
                </div>
              </div>
              <div class="flex">
                <h1>McDonald's</h1>
                <a href=""><img src="image/david.png" alt=""></a>
                <div class="description">
                    McDonald's nous a permis d'optenir les fonds nécessaires pour héberger notre site.
                </div>
              </div>
              <div class="flex">
                <h1>McDonald's</h1>
                <a href=""><img src="image/alieu.jfif" alt=""></a>
                <div class="description">
                    McDonald's nous a permis d'optenir les fonds nécessaires pour héberger notre site.
                </div>
              </div>
              <div class="flex">
                <h1>McDonald's</h1>
                <a href=""><img src="image/david.png" alt=""></a>
                <div class="description">
                    McDonald's nous a permis d'optenir les fonds nécessaires pour héberger notre site.
                </div>
              </div>
              <div class="flex">
                <h1>McDonald's</h1>
                <a href=""><img src="image/alieu.jfif" alt=""></a>
                <div class="description">
                    McDonald's nous a permis d'optenir les fonds nécessaires pour héberger notre site.
                </div>
              </div>
              <div class="flex">
                <h1>McDonald's</h1>
                <a href=""><img src="image/david.png" alt=""></a>
                <div class="description">
                    McDonald's nous a permis d'optenir les fonds nécessaires pour héberger notre site.
                </div>
              </div>
            </div>
        </section>
        <?php
          include './script_php/footer.php'
        ?>
        <script>
            var element = document.getElementById("logo")
                if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
                    element.classList.toggle("logo-M");
                }else{
                    element.classList.toggle("logo");
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
