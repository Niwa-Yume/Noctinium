<?php
    require './script_php/database-connection.php';
    require './script_php/sessions.php';
    if($logged_in){
      header('Location: compte');
    }
?>
<html>
<head>
    <title>Connexion</title>
	<meta charset="utf-8" />
    <link rel="stylesheet" href="asset/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
        <link rel="icon" href="image/logo_noctinium.ico">
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
					echo("inscription");
				};?>"><?php 
				if($logged_in == true){
					echo("Compte");
				}else{
					echo("Inscription");
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
        <p class="follow-text">Si vous ne possédez pas déjà un compte, <a href="inscription" class="underline">inscrivez-vous ici.</a></p>
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
</html>