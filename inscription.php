<?php
    require './script_php/database-connection.php';
    require './script_php/sessions.php';
    if($logged_in){
      header('Location: ../compte');
    }
?>
<html>
<head>
    <title>Inscription</title>
	<meta charset="utf-8" />
    <link rel="stylesheet" href="asset/style.css">
        <link rel="stylesheet" href="asset/fontawesome/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
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
                echo ('<div id="error" class="errorCont"><div id="errorMessage" class="errorMessage"><h1>Erreur</h1><br>Vous êtes trop jeune (minimum 16 ans).<br><button onclick="closeError()">Continuer</button></div></div>');
              }
            }
            if(isset($_GET['uname'])){
              if($_GET['uname'] == 1){
                echo ('<div id="error" class="errorCont"><div id="errorMessage" class="errorMessage"><h1>Erreur</h1><br>Ce pseudo est déjà utilisé.<br><button onclick="closeError()">Continuer</button></div></div>');
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
                <input type="text" class="form-control insc-form" id="nom" placeholder="NOM" name="surname" value="<?php if(isset($_GET['surname'])){echo $_GET['surname'];} ?>" required autofocus maxlength="40">
              </div>
            </div>
      
            <div class="form-group-insc">
              <div class="col-sm-12">
                <input type="text" class="form-control insc-form" id="prenom" placeholder="PRENOM" name="name" value="<?php if(isset($_GET['name'])){echo $_GET['name'];} ?>" required maxlength="40">
              </div>
            </div>

            <div class="form-group-insc">
              <div class="col-sm-12">
                <input type="text" class="form-control insc-form" id="pseudo" placeholder="PSEUDO" name="username" value="<?php if(isset($_GET['username'])){echo $_GET['username'];} ?>" required minlength="4" maxlength="40" pattern="([^'()/><\][\\\x22,;|' ']+){4,}">
              </div>
            </div>

            <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="text" class="form-control insc-form" id="date" placeholder="DATE DE NAISSANCE (JJ/MM/AAAA)" name="birthdate" value="<?php if(isset($_GET['birthdate'])){echo $_GET['birthdate'];} ?>" required>
                </div>
              </div>
            
            <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="email" class="form-control insc-form" id="email" placeholder="EMAIL" name="email" value="<?php if(isset($_GET['mail'])){echo $_GET['mail'];} ?>" required>
                </div>
              </div>

            <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="tel" class="form-control insc-form" id="tel" placeholder="TÉLÉPHONE (FORMAT: 07[6-9]xxxxxxx)" name="telephone" value="<?php if(isset($_GET['tel'])){echo $_GET['tel'];} ?>" pattern="[07][6-9]\d[0-9]{7}" required>
                </div>
              </div>

            <div class="form-group-insc">
              <div class="col-sm-12">
                <input type="password" class="form-control insc-form" id="mdp" placeholder="MOT DE PASSE" name="mdp" value="" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
              </div>
            </div>

            <div class="form-group-insc">
              <div class="col-sm-12">
                <input type="password" class="form-control insc-form" id="mdp2" placeholder=" CONFIRMATION MOT DE PASSE" name="mdp2" value="" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
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
        <p class="follow-text">Si vous possédez déjà un compte, <a href="connexion" class="underline">connectez vous ici.</a></p>
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
  var formT = document.getElementById("tel");
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
        formT.classList.toggle("form-control");
        formT.classList.toggle("form-control-M");
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
    <script>
      document.getElementById('date').addEventListener('input', function(e){
        this.type = 'text';
        var input = this.value;
        if(/\D\/$/.test(input)) input = input.substr(0, input.length - 3);
        var values = input.split('/').map(function(v){return v.replace(/\D/g, '')});
        if(values[0]) values[0] = checkValue(values[0], 31);
        if(values[1]) values[1] = checkValue(values[1], 12);
        var output = values.map(function(v, i){
          return v.length == 2 && i < 2 ?  v + ' / ' : v;
        });
        this.value = output.join('').substr(0, 14);
      });

      function checkValue(str, max){
        if(str.charAt(0) !== '0' || str == '00'){
          var num = parseInt(str);
          if(isNaN(num) || num <= 0 || num > max) num = 1;
          str = num > parseInt(max.toString().charAt(0)) && num.toString().length == 1 ? '0' + num : num.toString();
        };
        return str;
      };

      document.getElementById('date').addEventListener('blur', function(e){
        this.type = 'tel';
        var input = this.value;
        var values = input.split('/').map(function(v){return v.replace(/\D/g, '')});
        var output = '';
        if(values.length == 3){
          var year = values[2].length !== 4 ? parseInt(values[2]) + 2000 : parseInt(values[2]);
          var month = parseInt(values[1]) - 1;
          var day = parseInt(values[0]);
          var d = new Date(year, month, day);
          if(!isNaN(d)){
            var dates = [d.getDate(), d.getMonth() + 1, d.getFullYear()];
            output = dates.map(function(v){
              v = v.toString();
              return v.length == 1 ? '0' + v : v;
            }).join(' / ');
          };
        };
        this.value = output;
      });
    </script>
</html>