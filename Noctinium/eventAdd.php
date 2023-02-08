<?php
    require './script_php/database-connection.php';
    include './script_php/sessions.php';
?>
<html>
<head>
    <title>Ajout d'évènement</title>
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
            <li class="active"><a href="eventlist.php">Évènements</a></li>
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
            <h1 class="gradient-text">Ajout d'évènements</h1>
        </div>
    </section>
    <hr class="gradient">
    <section class="subscribe">
    <?php
        if(isset($_GET['error'])){
          if($_GET['error'] == 1){
            if(isset($_GET['address'])){
              if($_GET['address'] == 1){
                echo ('<div id="error" class="errorCont"><div id="errorMessage" class="errorMessage"><h1>Erreur</h1><br>Cette adresse est introuvable ou n\'existe pas.<br><button onclick="closeError()">Continuer</button></div></div>');
              }
            }
            if(isset($_GET['date'])){
              if($_GET['date'] == 1){
                echo ('<div id="error" class="errorCont"><div id="errorMessage" class="errorMessage"><h1>Erreur</h1><br>La date sélectionée est antérieure à aujourd\'hui.<br><button onclick="closeError()">Continuer</button></div></div>');
              }
            }
            if(isset($_GET['masked'])){
              if($_GET['masked'] == 1){
                echo ('<div id="error" class="errorCont"><div id="errorMessage" class="errorMessage"><h1>Erreur</h1><br>Vous ne pouvez pas révéler la date de l\'évènement après celui-ci.<br><button onclick="closeError()">Continuer</button></div></div>');
              }
            }
          }
        }
      ?>
    <div class="login">
        <div class="heading">
            <div class="insc-cont">
          <form id="contact-form" class="insc-cont-1" role="form" method="POST" action="script_php/new_event.php" enctype="multipart/form-data">
       
            <div class="form-group-insc">
              <div class="col-sm-12">
                <input type="text" class="form-control insc-form" id="name" placeholder="NOM DE L'ÉVÈNEMENT" name="nom_event" value="" required autofocus>
              </div>
            </div>
            
            <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="datetime-local" class="form-control insc-form" id="date_event" name="date_event" value="" required>
                </div>
              </div>
            
              <div class="form-group-insc">
                <div class="col-sm-12">
                  <textarea class="text-control" id="description" rows="10" placeholder="DESCRIPTION DE L'ÉVÈNEMENT (1000 caractères maximum)" name="description_event" maxlength="1000" required></textarea>
                </div>
              </div>

            <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="text" class="form-control insc-form" id="adresse" placeholder="ADRESSE (Format : N° Rue, Ville)" name="adresse_event" value="" required>
                </div>
              </div>
              <div class="form-group-insc">
                <div class="col-sm-12">
                  <div class="chBox-F">
                    <!-- <input type="radio" id="Techno" name="musique" value="Techno" required/>
                    <label class="insc-form-checkbox-txt-date" for="Techno">Techno</label><br>
                    <input type="radio" id="Latino" name="musique" value="Latino" required/>
                    <label class="insc-form-checkbox-txt-date" for="Latino">Latino</label><br>
                    <input type="radio" id="Rap" name="musique" value="Rap" required/>
                    <label class="insc-form-checkbox-txt-date" for="Rap">Rap</label><br>
                    <input type="radio" id="AllStyles" name="musique" value="AllStyles" required/>
                    <label class="insc-form-checkbox-txt-date" for="AllStyles ">All Styles</label><br> -->
                    <select name="musique" id="musique" class="form-control">
                      <option value="">--Veuillez choisir un style de musique--</option>
                      <option value="1">Techno</option>
                      <option value="2">House</option>
                      <option value="3">Électro</option>
                      <option value="4">Rap</option>
                      <option value="5">Latino</option>
                      <option value="6">Années 80</option>
                      <option value="7">Années 90</option>
                      <option value="8">Années 2000</option>
                      <option value="9">Punk</option>
                      <option value="10">Rock</option>
                      <option value="11">Jazz</option>
                      <option value="12">Blues</option>
                      <option value="13">All Styles</option>
                      <option value="14">Autres</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group-insc">
                <div class="col-sm-12">
                  <div class="chBox-F">
                    <!-- <input type="radio" id="Before" name="type" value="Before" required/>
                    <label class="insc-form-checkbox-txt-date" for="Before">Before</label><br>
                    <input type="radio" id="Soiree" name="type" value="Soiree"/>
                    <label class="insc-form-checkbox-txt-date" for="Soiree" required>Soirée</label><br>
                    <input type="radio" id="After" name="type" value="After"/>
                    <label class="insc-form-checkbox-txt-date" for="After" required>After</label><br> -->
                    <select name="type" id="type" class="form-control">
                    <option value="">--Veuillez choisir un type d'évènement--</option>
                      <option value="1">Before</option>
                      <option value="2">After</option>
                      <option value="3">Soirée</option>
                      <option value="4">Concert/Showcase</option>
                      <option value="5">Open Mic/Karaoké</option>
                      <option value="6">Autres</option>
                    </select>
                  </div>
                </div>
              </div>
            <div class="form-group-insc">
              <div class="col-sm-12">
                <div class="chBox">
                  <div class="col-sm-25">
                    <input type="checkbox" class="insc-form-checkbox-date" id="prive" name="private" value="prive"/>
                    <label class="insc-form-checkbox-txt-date" id="txtprive" for="prive">Soirée privée</label><br>
                  </div>
                  <div class="col-sm-25">
                    <input type="checkbox" class="insc-form-checkbox-date" id="date-mask" name="date-mask" value="date-mask" onclick="datemask()"/>
                    <label class="insc-form-checkbox-txt-date" id="txtdate" for="date-mask">Adresse masquée</label><br>
                  </div>
                  <div>
                    <input type="checkbox" class="insc-form-checkbox-date" id="payant" name="payant" value="payant" onclick="privatiser()"/>
                    <label class="insc-form-checkbox-txt-date" id="txtpayant" for="payant">Payant</label><br>
                  </div>
                  </div>
              </div>
            </div>
            <div class="form-group-insc">
                <div class="col-sm-20">
                  <label class="addImg">
                    <input type="file" class="btnUpload" accept="images/*" id="img_event" name="img_event" value="">
                    Upload Images
                  </label>
                </div>
              </div>

              <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="datetime-local" class="form-control insc-form hidden" id="adresse_cachee" name="date_event_mask" value="">
                </div>
              </div>

              <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="number" class="form-control insc-form hidden" id="prix" placeholder="PRIX" name="prix_event" value="">
                </div>
              </div>

            <div class="form-group-insc">
                <div class="col-sm-15">
                  <input type="checkbox" required class="insc-form-checkbox" id="termes-conditions" name="conditions" value="accept"/>
                  <label class="insc-form-checkbox-txt" for="termes-conditions">J'ai lu et j'accepte les <a href="" class="underline">termes et conditions d'utilisation</a> de G-Project</label>
                </div>
              </div>
            
            <button class="btn btn-primary send-button gradient insc-form-btn" id="submit" type="submit" value="SEND">
              <div class="alt-send-button">
                <i class="fa fa-paper-plane fa-paper-plane-1"></i><span class="send-text send-text-1">Ajouter l'évènement</span>
              </div>
            
            </button>
            
          </form>
    </div>
    </section>
    <?php
          include './script_php/footer.php'
        ?>
</body>
<script>
  var element = document.getElementById("logo")
  var formN = document.getElementById("name");
  var formE = document.getElementById("description");
  var formD = document.getElementById("date_event");
  var formPS = document.getElementById("adresse");
  var formM = document.getElementById("musique");
  var formT = document.getElementById("type");
  if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
    element.classList.toggle("logo");
    element.classList.toggle("logo-M");
    formN.classList.toggle("form-control");
        formN.classList.toggle("form-control-M");
        formE.style.margin = "";
        formD.classList.toggle("form-control");
        formD.classList.toggle("form-control-M");
        formPS.classList.toggle("form-control");
        formPS.classList.toggle("form-control-M");
        formM.classList.toggle("form-control");
        formM.classList.toggle("form-control-M");
        formT.classList.toggle("form-control");
        formT.classList.toggle("form-control-M");
  }
  function datemask(){
    var mask = document.getElementById("date-mask")
    if (mask.checked){
      document.getElementById("adresse_cachee").classList.toggle("hidden");
    }else{
      document.getElementById("adresse_cachee").classList.toggle("hidden");

    }
  }
  function privatiser(){
    var mask = document.getElementById("payant")
    if (mask.checked){
      document.getElementById("prix").classList.toggle("hidden");
    }else{
      document.getElementById("prix").classList.toggle("hidden");
    }
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