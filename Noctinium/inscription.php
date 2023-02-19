<?php
    require './script_php/database-connection.php';
    require './script_php/sessions.php';
    if($logged_in){
      header('Location: ../compte.php');
    }
?>
<html>
<head>
    <title>Inscription</title>
	<meta charset="utf-8" />
    <link rel="stylesheet" href="asset/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
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
            <h1 class="gradient-text">Inscription</h1>
        </div>
    </section>
    <hr class="gradient">
    <section class="subscribe">
      <?php
        if(isset($_GET['error'])){
          if($_GET['error'] == 1){
            if(isset($_GET['email'])){
              if($_GET['email'] == 1){
                echo ('<div id="error" class="errorCont"><div id="errorMessage" class="errorMessage"><h1>Erreur</h1><br>Cet email est déjà utilisé.<br><button onclick="closeError()">Continuer</button></div></div>');
              }
            }
            if(isset($_GET['telephone'])){
              if($_GET['telephone'] == 1){
                echo ('<div id="error" class="errorCont"><div id="errorMessage" class="errorMessage"><h1>Erreur</h1><br>Ce numéro de téléphone est déjà utilisé.<br><button onclick="closeError()">Continuer</button></div></div>');
              }
            }
            if(isset($_GET['birth'])){
              if($_GET['birth'] == 1){
                echo ('<div id="error" class="errorCont"><div id="errorMessage" class="errorMessage"><h1>Erreur</h1><br>La date de naissance n\'est pas valide.<br><button onclick="closeError()">Continuer</button></div></div>');
              }
            }
          }
        }
      ?>
    <div class="login">
        <div class="heading">
            <div class="insc-cont">
          <form id="contact-form" class="insc-cont-1" role="form" method="POST" action="./script_php/new_user.php">
       
            <div class="form-group-insc">
              <div class="col-sm-12">
                <input type="text" class="form-control insc-form" id="nom" placeholder="NOM" name="surname" value="" required autofocus>
              </div>
            </div>
      
            <div class="form-group-insc">
              <div class="col-sm-12">
                <input type="text" class="form-control insc-form" id="prenom" placeholder="PRENOM" name="name" value="" required>
              </div>
            </div>

            <div class="form-group-insc">
              <div class="col-sm-12">
                <input type="text" class="form-control insc-form" id="pseudo" placeholder="PSEUDO" name="username" value="" required>
              </div>
            </div>

            <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="date" class="form-control insc-form" id="date" placeholder="DATE DE NAISSANCE" name="birthdate" value="" required>
                </div>
              </div>
            
            <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="email" class="form-control insc-form" id="email" placeholder="EMAIL" name="email" value="" required>
                </div>
              </div>

            <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="tel" class="form-control insc-form" id="tel" placeholder="TÉLÉPHONE (FORMAT: 07[6-9]xxxxxxx)" name="telephone" value="" pattern="[07][6-9]\d[0-9]{7}" required>
                </div>
              </div>

            <div class="form-group-insc">
              <div class="col-sm-12">
                <input type="password" class="form-control insc-form" id="mdp" placeholder="MOT DE PASSE" name="mdp" value="" required>
              </div>
            </div>

            <div class="form-group-insc">
              <div class="col-sm-12">
                <input type="password" class="form-control insc-form" id="mdp2" placeholder=" CONFIRMATION MOT DE PASSE" name="mdp2" value="" required>
              </div>
            </div>

            <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="checkbox" required class="insc-form-checkbox" id="termes-conditions" name="conditions" value="accept"/>
                  <label class="insc-form-checkbox-txt" for="termes-conditions">J'ai lu et j'accepte les <a href="asset/conditions.pdf" target="_blank" class="underline">termes et conditions d'utilisation</a> de Noctinium</label>
                </div>
              </div>
            
            <button class="btn btn-primary send-button gradient insc-form-btn" id="submit" type="submit" value="SEND">
              <div class="alt-send-button">
                <i class="fa fa-paper-plane fa-paper-plane-1"></i><span class="send-text send-text-1">Inscription</span>
              </div>
            
            </button>
            
          </form>
        </div>
        <p class="follow-text">Si vous possédez déjà un compte, <a href="connexion.php" class="underline">connectez vous ici.</a></p>
        </div>
    </div>
    </section>
    <?php
          include './script_php/footer.php'
        ?>
</body>
<script>
  var element = document.getElementById("logo");
  var formN = document.getElementById("nom");
  var formE = document.getElementById("email");
  var formD = document.getElementById("date");
  var formP = document.getElementById("prenom");
  var formPS = document.getElementById("pseudo");
  var formM = document.getElementById("mdp");
  var formM2 = document.getElementById("mdp2");
  if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
    element.classList.toggle("logo");
    element.classList.toggle("logo-M");
    formN.classList.toggle("form-control");
        formN.classList.toggle("form-control-M");
        formE.classList.toggle("form-control");
        formE.classList.toggle("form-control-M");
        formM.classList.toggle("form-control");
        formM.classList.toggle("form-control-M");
        formP.classList.toggle("form-control");
        formP.classList.toggle("form-control-M");
        formD.classList.toggle("form-control");
        formD.classList.toggle("form-control-M");
        formPS.classList.toggle("form-control");
        formPS.classList.toggle("form-control-M");
        formM2.classList.toggle("form-control");
        formM2.classList.toggle("form-control-M");
  }
</script>
<script>
  function closeError() {
    var error = document.getElementById("error");
    var errorMessage = document.getElementById("errorMessage");
    error.classList.toggle("hidden");
  }; 
</script>
</html>