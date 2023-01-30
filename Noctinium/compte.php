<?php
    require './script_php/database-connection.php';
    include './script_php/sessions.php';
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
            </div>
          </div>
          <div class="profilCompte">
            <div class="imgCont">
              <img id="pp" src="image/david.png" class="PP-Big" alt="Image de profil">
              <div id="btnChangeImg" class="form-group-insc hidden">
                <div class="col-sm-12">
                  <label class="uploadFile">
                    <input type="file" class="btnUpload" accept="images/*" name="newImg" value="" required>
                    Choisir une image
                  </label>
                  <label class="uploadFile" id="margin">
                    <input type="submit" class="btnUpload" name="addImg" value="" required>
                    Upload Images
                  </label>
                  <label class="uploadFile">
                    <input type="submit" class="btnUpload" name="deleteImg" value="" required>
                    Supprimer l'image
                  </label>
                </div>
              </div>
            </div>
            <div>
            <div class="formUserCont" action="">
              <div class="formGrid">
              <h3 class="labelInfo" id="labelNom">NOM:</h3>
              <h3 class="labelInfo" id="labelPrenom">PRENOM:</h3>
            <div id="formNom" class="form-group-insc">
              <div class="col-sm-12">
                <div id="infoNom" class="infoUser">David</div>
              </div>
            </div>
      
            <div id="formPrenom" class="form-group-insc">
              <div class="col-sm-12">
                <div id="infoPrenom" class="infoUser">Pierella</div>
              </div>
            </div>
            <h3 class="labelInfo" id="labelPseudo">PSEUDO:</h3>
            <h3 class="labelInfo" id="labelTel">TÉLÉPHONE:</h3>
            <div id="formPseudo" class="form-group-insc">
              <div class="col-sm-12">
                <div id="infoPseudo" class="infoUser">D4Ly</div>
              </div>
            </div>

            <div id="formTel" class="form-group-insc">
              <div class="col-sm-12">
                <div id="infoEmail" class="infoUser">+41 12 345 67 89</div>
              </div>
            </div>

            <h3 class="labelInfo" id="labelEmail">EMAIL:</h3>
            <div id="formEmail" class="form-group-insc">
              <div class="col-sm-12">
                <div id="infoEmail" class="infoUser">d.pierella01@gmail.com</div>
              </div>
            </div>

            <h3 class="labelInfo" id="labelBio">BIO:</h3>
            <div id="formBio" class="form-group-insc">
              <div class="col-sm-12">
                <div id="infoBio" class="infoUser">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae voluptate repellendus magni illo ea animi? Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae voluptate repellendus magni illo ea animi? Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur, adipisicing?</div>
              </div>
            </div>
            </div>
            <div id="btnChange" class="form-group-insc hidden">
              <div class="col-sm-12">
                <label class="uploadFile">
                  <input type="submit" class="btnUpload" name="changerInfo" value="" required>
                  Modifier
                </label>
              </div>
            </div>
          </div>
            </div>
          </div>
          <div id="socialView">
            <ul class="link-list">
              <li><a href="#" target="_blank" class="contact-icon">
                <i class="fa fa-social fa-instagram" aria-hidden="true"></i></a>
              </li>
              <li><a href="#" target="_blank" class="contact-icon">
                <i class="fa fa-social fa-twitter" aria-hidden="true"></i></a>
              </li>
              <li><a href="#" target="_blank" class="contact-icon">
                <i class="fa fa-social fa-link" aria-hidden="true"></i></a>
              </li>      
            </ul>
          </div>
        </section>
        <hr class="gradient">
        <section class="subscribe">
          <div>
            <h1 class="myeventTitle gradient-text">Mes Évènements</h1>
            <div class="myeventCont">
              <div>
                <h2>Mon Event</h2>
                <div>jj.mm.aaaa</div>
              </div>
              <button class="eventParam">Modifier</button>
              <form action="">
                <button class="eventParam">Supprimer</button>
              </form>
            </div>
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
    </body>
</html>