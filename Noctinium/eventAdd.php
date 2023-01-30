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
    <div class="login">
        <div class="heading">
            <div class="insc-cont">
          <form id="contact-form" class="insc-cont-1" role="form">
       
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
                  <textarea class="text-control" id="description" rows="10" placeholder="DESCRIPTION DE L'ÉVÈNEMENT" name="description_event" required></textarea>
                </div>
              </div>

              <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="text" class="form-control insc-form" id="note_sup" placeholder="INFOS SUPPLÉMENTAIRES" name="info_sup" value="" required>
                </div>
              </div>
            
            <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="text" class="form-control insc-form" id="adresse" placeholder="ADRESSE (Format : N° Rue, Ville)" name="adresse_event" value="" required>
                </div>
              </div>
              <div class="form-group-insc">
                <div class="col-sm-12 btnCont">
                  <div class="chBox-F">
                    <h2>Musique</h2>
                    <input type="radio" id="Techno" name="musique" value="Techno" required/>
                    <label class="insc-form-checkbox-txt-date" for="Techno">Techno</label><br>
                    <input type="radio" id="Latino" name="musique" value="Latino" required/>
                    <label class="insc-form-checkbox-txt-date" for="Latino">Latino</label><br>
                    <input type="radio" id="Rap" name="musique" value="Rap" required/>
                    <label class="insc-form-checkbox-txt-date" for="Rap">Rap</label><br>
                    <input type="radio" id="AllStyles" name="musique" value="AllStyles" required/>
                    <label class="insc-form-checkbox-txt-date" for="AllStyles ">All Styles</label><br>
                  </div>
                  <div class="chBox-F">
                    <h2>Type</h2>
                    <input type="radio" id="Before" name="type" value="Before" required/>
                    <label class="insc-form-checkbox-txt-date" for="Before">Before</label><br>
                    <input type="radio" id="Soiree" name="type" value="Soiree"/>
                    <label class="insc-form-checkbox-txt-date" for="Soiree" required>Soirée</label><br>
                    <input type="radio" id="After" name="type" value="After"/>
                    <label class="insc-form-checkbox-txt-date" for="After" required>After</label><br>
                  </div>
                </div>
              </div>
            <div class="form-group-insc">
              <h1>Ajouts</h1>
              <div class="col-sm-12">
                <div class="chBox">
                  <input type="checkbox" class="insc-form-checkbox-date" id="prive" name="prive" value="prive"/>
                  <label class="insc-form-checkbox-txt-date" id="txtprive" for="prive">Soirée privée</label><br>
                  <input type="checkbox" class="insc-form-checkbox-date" id="date-mask" name="date-mask" value="date-mask" onclick="datemask()"/>
                  <label class="insc-form-checkbox-txt-date" id="txtdate" for="date-mask">Adresse masquée</label><br>
                  <input type="checkbox" class="insc-form-checkbox-date" id="payant" name="payant" value="payant" onclick="privatiser()"/>
                  <label class="insc-form-checkbox-txt-date" id="txtpayant" for="payant">Payant</label><br>
                </div>
              </div>
            </div>
            <div class="form-group-insc">
                <div class="col-sm-12">
                  <label class="addImg">
                    <input type="file" class="btnUpload" accept="images/*" id="img_event" name="img_event" value="">
                    Upload Images
                  </label>
                </div>
              </div>

              <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="datetime-local" class="form-control insc-form hidden" id="adresse_cachee" name="date_event" value="">
                </div>
              </div>

              <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="number" class="form-control insc-form hidden" id="prix" placeholder="PRIX" name="prix_event" value="">
                </div>
              </div>

            <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="checkbox" required class="insc-form-checkbox" id="termes-conditions" name="termes-conditions" value="termes-conditions-accept"/>
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
  var formP = document.getElementById("note_sup");
  var formPS = document.getElementById("adresse");
  if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
    element.classList.toggle("logo");
    element.classList.toggle("logo-M");
    formN.classList.toggle("form-control");
        formN.classList.toggle("form-control-M");
        formE.style.margin = "";
        formP.classList.toggle("form-control");
        formP.classList.toggle("form-control-M");
        formD.classList.toggle("form-control");
        formD.classList.toggle("form-control-M");
        formPS.classList.toggle("form-control");
        formPS.classList.toggle("form-control-M");
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
</html>