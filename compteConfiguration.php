<?php
    require './script_php/database-connection.php';
    require './script_php/sessions.php';
    if ($logged_in != true){
      header('Location: ./connexion.php');
    };
?>
<html>
    <head>
        <link rel="stylesheet" href="asset/style.css">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
      <meta charset="utf-8" />
      <link rel="stylesheet" href="asset/user.css">
      <title>Compte</title>
      <link rel="icon" href="image/logo_noctinium.ico">
      <meta name="viewport" content="width=100vw, initial-scale=0.5">
    </head>
    <body>
        <header>
            <a href="index"><img class="logo" id="logo" src="image/logo_noctinium.webp" alt="Logo"></a>
            <nav id="computer">
              <li><a href="index">Accueil</a></li>
              <li><a href="eventlist">Évènements</a></li>
              <li><a href="contact">Contact</a></li>
              <li><a href="propos">À propos</a></li>
              <li><a href="faq">FAQ</a></li>
              <li class="active"><a href="<?php 
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
              <h1 class="gradient-text">Modification</h1>
          </div>
        </section>
        <hr class="gradient">
        <section class="subscribe">
          <div id="page" class="profilCompteModif">
            <div class="imgCont">
              <img id="pp" src="<?php
              echo $_SESSION['user_img'];
              ?>" class="PP" alt="Image de profil">
              <div id="btnChangeImg" class="form-group-insc">
                <div class="col-sm-12">
                <form action="script_php/upload_img.php" method="POST" enctype="multipart/form-data">
                  <label class="uploadFile">
                    <input id="select" type="file" class="btnUpload" accept="images/*" name="newImg" value="" required>
                    Changer d'image
                  </label>
                    <input id="change" type="submit" class="btnUpload" name="addImg" value="" required>
                  </form>
                  <form action="script_php/delete_img.php" method="POST" enctype="multipart/form-data">
                  <label class="uploadFile">
                    <input type="submit" class="btnUpload" name="deleteImg" value="" required>
                    Supprimer l'image
                  </label>
                  </form>
                </div>
              </div>
            </div>
            <div>
            <div class="formUserCont" action="">
            <div id="formNom" class="form-group-insc">
              <form class="col-sm-12" action="script_php/configuration_surname.php" method="POST">
                <input type="text" class="formUser insc-form" id="nom" placeholder="NOM" name="surname" value="" required autofocus>
                <label class="uploadFile">
                  <input type="submit" class="btnUpload" name="changerInfo" value="" required>
                  Modifier
                </label>
              </form>
            </div>
      
            <div id="formPrenom" class="form-group-insc">
              <form class="col-sm-12" action="script_php/configuration_name.php" method="POST">
                <input type="text" class="formUser insc-form" id="prenom" placeholder="PRENOM" name="name" value="" required>
                <label class="uploadFile">
                  <input type="submit" class="btnUpload" name="changerInfo" value="" required>
                  Modifier
                </label>
              </form>
            </div>
            <div id="formPseudo" class="form-group-insc">
              <form class="col-sm-12" action="script_php/configuration_username.php" method="POST">
                <input type="text" class="formUser insc-form" id="pseudo" placeholder="PSEUDO" name="username" value="" required autofocus>
                <label class="uploadFile">
                  <input type="submit" class="btnUpload" name="changerInfo" value="" required>
                  Modifier
                </label>
              </form>
            </div>
      
            <div id="formEmail" class="form-group-insc">
              <form class="col-sm-12" action="script_php/configuration_email.php" method="POST">
                <input type="email" class="formUser insc-form" id="email" placeholder="EMAIL" name="email" value="" required>
                <label class="uploadFile">
                  <input type="submit" class="btnUpload" name="changerInfo" value="" required>
                  Modifier
                </label>
              </form>
            </div>

            <div id="formTel" class="form-group-insc">
              <form class="col-sm-12" action="script_php/configuration_telephone.php" method="POST">
                <input type="tel" class="formUser insc-form" id="tel" placeholder="TÉLÉPHONE (FORMAT: 07[6-9]xxxxxxx)" name="telephone" value="" pattern="[07][6-9]\d[0-9]{7}" required>
                <label class="uploadFile">
                  <input type="submit" class="btnUpload" name="changerInfo" value="" required>
                  Modifier
                </label>
              </form>
            </div>
          </div>
            </div>

            <div>
              <form id="formBio" class="form-group-insc" action="script_php/configuration_description.php" method="POST">
                <div class="col-sm-12">
                  <textarea class="formUserBio" rows="10" placeholder="DESCRIPTION" id="bio" name="description" required maxlength="1000"></textarea>
                  <label class="uploadFile">
                    <input type="submit" class="btnUpload" name="changerInfo" value="" required>
                    Modifier
                  </label>
                </div>
              </form>
            </div>
          </div>
          <form class="mdp" class="form-group-insc" action="script_php/configuration_password.php" method="POST">
            <div id="formMdp" class="form-group-insc">
              <div class="col-sm-12">
                <input type="password" class="formUser insc-form" id="mdp" placeholder="NOUVEAU MOT DE PASSE" name="mdp" value="" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                <input type="password" class="formUser insc-form" id="mdp2" placeholder="CONFIRMATION" name="mdp2" value="" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                <input type="password" class="formUser insc-form" id="mdp3" placeholder="ANCIEN MOT DE PASSE" name="mdp3" value="" required>
                <label class="uploadFile">
                  <input type="submit" class="btnUpload" name="changerInfo" value="" required>
                  Modifier
                </label>
              </div>
            </div>
          </form>
          <div id="social" class="addSocialGrid">
            <form class="form-group-insc" action="script_php/configuration_instagram.php" method="POST">
              <div class="form-group">
                <div class="col-sm-12 ajout">
                  <input type="text" class="form-control" id="insta" placeholder="INSTAGRAM (LIEN)" name="instagram" value="" required maxlength="50">
                  <label class="uploadFile">
                    <input type="submit" class="btnUpload" name="changerInfo" value="" required>
                    Ajouter
                  </label>
                </div>
            </form>
            </div>
            <form class="form-group-insc" action="script_php/configuration_twitter.php" method="POST">
              <div class="form-group">
                <div class="col-sm-12 ajout">
                  <input type="text" class="form-control" id="twitter" placeholder="TWITTER (LIEN)" name="twitter" value="" required maxlength="50">
                  <label class="uploadFile">
                    <input type="submit" class="btnUpload" name="changerInfo" value="" required>
                    Ajouter
                  </label>
                </div>
              </div>
            </form>
            <form class="form-group-insc" action="script_php/configuration_site.php" method="POST">
              <div class="form-group">
                <div class="col-sm-12 ajout">
                  <input type="text" class="form-control" id="siteweb" placeholder="SITE WEB (LIEN)" name="site" value="" required maxlength="50">
                  <label class="uploadFile">
                    <input type="submit" class="btnUpload" name="changerInfo" value="" required>
                    Ajouter
                  </label>
                </div>
              </div>
            </form>
          </div>
        </section>
        <?php
          include './script_php/footer.php'
        ?>
		<script>
      var element = document.getElementById("logo");
      var page = document.getElementById("page");
      var desc = document.getElementById("bio")
			if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
        element.classList.toggle("logo");
        element.classList.toggle("logo-M");
        page.classList.toggle("profilCompteModif");
        page.classList.toggle("profilCompteModifTel");
        desc.classList.toggle("formUserBio")
        desc.classList.toggle("formUserBio-M")
      }

      const change = document.getElementById("change");
      const select = document.getElementById("select");

      select.addEventListener("change", function() {
        change.click();
      });
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
