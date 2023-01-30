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
              <h1 class="gradient-text">Modification</h1>
          </div>
        </section>
        <hr class="gradient">
        <section class="subscribe">
          <div id="page" class="profilCompteModif">
            <div class="imgCont">
              <img id="pp" src="image/david.png" class="PP" alt="Image de profil">
              <div id="btnChangeImg" class="form-group-insc">
                <div class="col-sm-12">
                  <label class="uploadFile">
                    <input id="select" type="file" class="btnUpload" accept="images/*" name="newImg" value="" required>
                    Changer d'image
                  </label>
                  <form action="">
                    <input id="change" type="submit" class="btnUpload" name="addImg" value="" required>
                  </form>
                  <form action="">
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
              <form class="col-sm-12">
                <input type="text" class="formUser insc-form" id="nom" placeholder="NOM" name="name" value="" required autofocus>
                <label class="uploadFile">
                  <input type="submit" class="btnUpload" name="changerInfo" value="" required>
                  Modifier
                </label>
              </form>
            </div>
      
            <div id="formPrenom" class="form-group-insc">
              <form class="col-sm-12">
                <input type="text" class="formUser insc-form" id="prenom" placeholder="PRENOM" name="prenom" value="" required>
                <label class="uploadFile">
                  <input type="submit" class="btnUpload" name="changerInfo" value="" required>
                  Modifier
                </label>
              </form>
            </div>
            <div id="formPseudo" class="form-group-insc">
              <form class="col-sm-12">
                <input type="text" class="formUser insc-form" id="pseudo" placeholder="PSEUDO" name="pseudo" value="" required autofocus>
                <label class="uploadFile">
                  <input type="submit" class="btnUpload" name="changerInfo" value="" required>
                  Modifier
                </label>
              </form>
            </div>
      
            <div id="formEmail" class="form-group-insc">
              <form class="col-sm-12">
                <input type="email" class="formUser insc-form" id="email" placeholder="EMAIL" name="email" value="" required>
                <label class="uploadFile">
                  <input type="submit" class="btnUpload" name="changerInfo" value="" required>
                  Modifier
                </label>
              </form>
            </div>

            <div id="formTel" class="form-group-insc">
              <form class="col-sm-12">
                <input type="tel" class="formUser insc-form" id="tel" placeholder="TÉLÉPHONE (FORMAT: 07[6-9]xxxxxxx)" name="tel" value="" pattern="[07][6-9]\d[0-9]{7}" required>
                <label class="uploadFile">
                  <input type="submit" class="btnUpload" name="changerInfo" value="" required>
                  Modifier
                </label>
              </form>
            </div>
          </div>
            </div>

            <div>
              <form id="formBio" class="form-group-insc">
                <div class="col-sm-12">
                  <textarea class="formUserBio" rows="10" placeholder="DESCRIPTION (500 caractères maximum)" id="bio" name="description_event" required maxlength="500"></textarea>
                  <label class="uploadFile">
                    <input type="submit" class="btnUpload" name="changerInfo" value="" required>
                    Modifier
                  </label>
                </div>
              </form>
            </div>
          </div>
          <form class="mdp" action="">
            <div id="formMdp" class="form-group-insc">
              <div class="col-sm-12">
                <input type="password" class="formUser insc-form" id="mdp" placeholder="NOUVEAU MOT DE PASSE" name="mdp" value="" required autofocus>
                <input type="password" class="formUser insc-form" id="mdp2" placeholder="CONFIRMATION" name="mdp2" value="" required>
                <input type="password" class="formUser insc-form" id="mdp3" placeholder="ANCIEN MOT DE PASSE" name="mdp3" value="" required>
                <label class="uploadFile">
                  <input type="submit" class="btnUpload" name="changerInfo" value="" required>
                  Modifier
                </label>
              </div>
            </div>
          </form>
          <div id="social" class="addSocialGrid">
            <form action="">
              <div class="form-group">
                <div class="col-sm-12 ajout">
                  <input type="text" class="form-control" id="insta" placeholder="INSTAGRAM (LIEN)" name="name" value="" required>
                  <label class="uploadFile">
                    <input type="submit" class="btnUpload" name="changerInfo" value="" required>
                    Ajouter
                  </label>
                </div>
            </form>
            </div>
            <form action="">
              <div class="form-group">
                <div class="col-sm-12 ajout">
                  <input type="text" class="form-control" id="twitter" placeholder="TWITTER (LIEN)" name="name" value="" required>
                  <label class="uploadFile">
                    <input type="submit" class="btnUpload" name="changerInfo" value="" required>
                    Ajouter
                  </label>
                </div>
              </div>
            </form>
            <form action="">
              <div class="form-group">
                <div class="col-sm-12 ajout">
                  <input type="text" class="form-control" id="siteweb" placeholder="SITE WEB (LIEN)" name="name" value="" required>
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
    </body>
</html>