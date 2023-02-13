<?php
    require 'script_php/database-connection.php';
    require 'script_php/sessions.php';
    if ($logged_in != true){
      header('Location: ./connexion.php');
    };
?>
<html>
    <head>
        <link rel="stylesheet" href="asset/style.css">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
      <meta charset="utf-8" />
      <link rel="stylesheet" href="asset/user.css">
      <title>Compte</title>
      <link rel="icon" href="image/logo_noctinium_16x16.png">
    </head>
    <body>
        <header>
            <a href="index.php"><img class="logo" id="logo" src="image/logo_noctinium.png" alt="Logo"></a>
            <nav>
              <li><a href="index.php">Accueil</a></li>
              <li><a href="eventlist.php">Évènements</a></li>
              <li><a href="contact.php">Contact</a></li>
              <li><a href="propos.php">A propos</a></li>
              <li><a href="faq.php">FAQ</a></li>
              <li class="active"><a href="<?php 
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
              <h1 class="gradient-text">Mon Profil</h1>
          </div>
        </section>
        <hr class="gradient">
        <section class="subscribe">
          <div class="changeProfil">
            <div class="changeProfilCont">
              <a href="compteConfiguration.php"><button class="eventParam">Modifier</button></a>
              <form action="script_php/logout.php"><button class="eventParam">Logout</button></form>
            </div>
          </div>
          <div class="profilCompte">
            <div class="imgCont">
              <img id="pp" src="<?php
              echo $_SESSION['user_img'];
              ?>" class="PP-Big" alt="Image de profil">
            </div>
            <div>
            <div class="formUserCont" action="">
              <div class="formGrid">
              <h3 class="labelInfo" id="labelNom">NOM:</h3>
              <h3 class="labelInfo" id="labelPrenom">PRENOM:</h3>
            <div id="formNom" class="form-group-insc">
              <div class="col-sm-12">
                <div id="infoNom" class="infoUser"><?php
                echo $_SESSION['user_surname'];
                ?></div>
              </div>
            </div>
      
            <div id="formPrenom" class="form-group-insc">
              <div class="col-sm-12">
                <div id="infoPrenom" class="infoUser"><?php
                echo $_SESSION['user_name'];
                ?></div>
              </div>
            </div>
            <h3 class="labelInfo" id="labelPseudo">PSEUDO:</h3>
            <h3 class="labelInfo" id="labelTel">TÉLÉPHONE:</h3>
            <div id="formPseudo" class="form-group-insc">
              <div class="col-sm-12">
                <div id="infoPseudo" class="infoUser"><?php
                echo $_SESSION['user_username'];
                ?></div>
              </div>
            </div>

            <div id="formTel" class="form-group-insc">
              <div class="col-sm-12">
                <div id="infoEmail" class="infoUser"><?php
                echo $_SESSION['user_telephone'];
                ?></div>
              </div>
            </div>

            <h3 class="labelInfo" id="labelEmail">EMAIL:</h3>
            <div id="formEmail" class="form-group-insc">
              <div class="col-sm-12">
                <div id="infoEmail" class="infoUser"><?php
                echo $_SESSION['user_email'];
                ?></div>
              </div>
            </div>

            <h3 class="labelInfo" id="labelBio">BIO:</h3>
            <div id="formBio" class="form-group-insc">
              <div class="col-sm-12">
                <div id="infoBio" class="infoUser"><?php
                if ($_SESSION['user_description'] != []){
                  echo $_SESSION['user_description'];
                } else{
                  echo ("<div style=\"text-align: center;\">Vous n'avez pas ajouté de description.</div>");
                }
                ?></div>
                <div style="text-align: center;"></div>
              </div>
            </div>
            </div>
          </div>
            </div>
          </div>
          <div id="socialView">
            <ul class="link-list">
              <li onclick="insta()"><a href="#" target="_blank" class="contact-icon">
                <i class="fa fa-social fa-instagram" aria-hidden="true"></i></a>
              </li>
              <li onclick="twitter()"><a href="#" target="_blank" class="contact-icon">
                <i class="fa fa-social fa-twitter" aria-hidden="true"></i></a>
              </li>
              <li onclick="site()"><a href="#" target="_blank" class="contact-icon">
                <i class="fa fa-social fa-link" aria-hidden="true"></i></a>
              </li>      
            </ul>
          </div>
        </section>
        <hr class="gradient">
        <section class="subscribe">
          <div>
            <h1 class="myeventTitle gradient-text">Mes Évènements</h1>
            <a href="event.php"><div class="myeventCont">
              <div>
                <h2>Mon Event</h2>
                <div>jj.mm.aaaa</div>
              </div>
              <button class="eventParam">Modifier</button>
              <form action="">
                <button class="eventParam">Supprimer</button>
              </form>
            </div></a>
          </div>
        </section>
        <?php
          include './script_php/footer.php'
        ?>
		<script>
      var element = document.getElementById("logo")
			if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
        element.classList.toggle("logo");
        element.classList.toggle("logo-M");
      }
		</script>
    <?php
      if ($_SESSION['user_instagram'] != []){
        echo ('<script>
        function insta(){
          window.open("'. $_SESSION['user_instagram'] .'");
        }
        </script>');
      }
      if ($_SESSION['user_twitter'] != []){
        echo ('<script>
        function twitter(){
          window.open("'. $_SESSION['user_twitter'] .'");
        }
        </script>');
      }
      if ($_SESSION['user_site'] != []){
        echo ('<script>
        function site(){
          window.open("'. $_SESSION['user_site'] .'");
        }
        </script>');
      }
    ?>
    </body>
</html>