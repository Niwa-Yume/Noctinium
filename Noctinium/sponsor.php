<?php
    require './script_php/database-connection.php';
    require './script_php/sessions.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="asset/style.css">
        <link rel="stylesheet" href="asset/sponsor.css">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
      <meta charset="utf-8" />
      <title>Sponsors</title>
      <link rel="icon" href="image/logo_noctinium_16x16.png">
    </head>
    <body>
        <header>
            <a href="index.php"><img class="" id="logo" src="image/logo_noctinium.png" alt="Logo"></a>
            <nav>
                <li><a href="index.php">Accueil</a></li>
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
            </nav>
        </header>
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
    </body>
</html>
