<?php
    require './script_php/database-connection.php';
    require './script_php/sessions.php';
    if($logged_in){
      header('Location: ../compte.php');
    }
?>
<html>
<head>
    <title>Connexion</title>
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
					echo("inscription.php");
				};?>"><?php 
				if($logged_in == true){
					echo("Compte");
				}else{
					echo("Inscription");
				};?></a></li>
        </nav>
    </header>
    <section class="content content-small">
        <div class="container">
            <h1 class="gradient-text">Connexion</h1>
        </div>
    </section>
    <hr class="gradient">
    <section class="subscribe">
    <?php
        if(isset($_GET['error'])){
          if($_GET['error'] == 1){
            if(isset($_GET['email'])){
              if($_GET['email'] == 1){
                echo ('<div id="error" class="errorCont"><div id="errorMessage" class="errorMessage"><h1>Erreur</h1><br>Le champ email doit être rempli.<br><button onclick="closeError()">Continuer</button></div></div>');
              }
            }
            if(isset($_GET['password'])){
              if($_GET['password'] == 1){
                echo ('<div id="error" class="errorCont"><div id="errorMessage" class="errorMessage"><h1>Erreur</h1><br>Le champ mot de passe doit être rempli.<br><button onclick="closeError()">Continuer</button></div></div>');
              }elseif($_GET['password'] == 2){
                echo ('<div id="error" class="errorCont"><div id="errorMessage" class="errorMessage"><h1>Erreur</h1><br>Le mot de passe est erroné.<br><button onclick="closeError()">Continuer</button></div></div>');
              }
            }
            if(isset($_GET['account'])){
              if($_GET['account'] == 1){
                echo ('<div id="error" class="errorCont"><div id="errorMessage" class="errorMessage"><h1>Erreur</h1><br>Le compte recherché n\'existe pas.<br><button onclick="closeError()">Continuer</button></div></div>');
              }
            }
          }
        }
      ?>
    <div class="login">
        <div class="heading">
            <div class="insc-cont">
          <form id="contact-form" class="insc-cont-1" role="form" method="POST" action="script_php/connection_user.php" enctype="multipart/form-data">
            
            <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="email" class="form-control insc-form" id="email" placeholder="EMAIL" name="email" value="" required autofocus>
                </div>
              </div>

            <div class="form-group-insc">
              <div class="col-sm-12">
                <input type="password" class="form-control insc-form" id="mdp" placeholder="MOT DE PASSE" name="mdp" value="" required>
              </div>
            </div>

            </div>
            
            <button class="btn btn-primary send-button gradient insc-form-btn" id="submit" type="submit" value="SEND">
              <div class="alt-send-button">
                <i class="fa fa-paper-plane fa-paper-plane-1"></i><span class="send-text send-text-1">Connexion</span>
              </div>
            
            </button>
            
          </form>
          <br>
          <br>
          <br>
        </div>
        <p class="follow-text">Si vous ne possédez pas déjà un compte, <a href="inscription.php" class="underline">inscrivez-vous ici.</a></p>
        </div>
    </div>
    </section>
    <?php
          include './script_php/footer.php'
        ?>
</body>
<script>
  var element = document.getElementById("logo")
  var formN = document.getElementById("mdp");
      var formE = document.getElementById("email");
  if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
    element.classList.toggle("logo");
    element.classList.toggle("logo-M");
    formN.classList.toggle("form-control");
    formN.classList.toggle("form-control-M");
    formE.classList.toggle("form-control");
    formE.classList.toggle("form-control-M");
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