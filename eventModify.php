<?php
    require './script_php/database-connection.php';
    require './script_php/sessions.php';

    if(!$logged_in){
      header('Location: connexion');
    }

    if(isset($_GET['event'])){
      $test = "SELECT event_user_id FROM events WHERE event_id = ". $_GET['event'] .";";
      $statement_test = $pdo->query($test);
      $id_test = $statement_test->fetch();
      if($id_test['event_user_id'] == $_SESSION['user_id']){
        $sql = "SELECT * FROM events WHERE event_id = ". $_GET['event'] .";";
        $statement = $pdo->query($sql);
        $event = $statement->fetch();
        $sql2 = "SELECT imageevent_url FROM imageevent WHERE imageevent_id = ". $event['event_imageevent_id'] .";";
        $statement2 = $pdo->query($sql2);
        $image = $statement2->fetch();
      }else{
        header('Location: ../compte');
      }
    }else{
      header('Location: ../compte');
    }
?>
<html>
<head>
    <title>Modifier votre évènement</title>
	  <meta charset="utf-8" />
    <link rel="stylesheet" href="asset/style.css">
        <link rel="stylesheet" href="asset/fontawesome/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
    <link rel="icon" href="image/logo_noctinium.ico">
    <link rel="stylesheet" href="asset/easy-autocomplete.min.css">
    <meta name="viewport" content="width=100vw, initial-scale=0.5">
    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="asset/jquery.easy-autocomplete.min.js"></script> 
  </head>
<body>
    <header>
        <a href="index"><img class="logo" id="logo" src="image/logo_noctinium.webp" alt="Logo"></a>
        <nav id="computer">
            <li><a href="index">Accueil</a></li>
            <li class="active"><a href="eventlist">Évènements</a></li>
            <li><a href="contact">Contact</a></li>
            <li><a href="propos">À propos</a></li>
            <li><a href="faq">FAQ</a></li>
            <li><a href="<?php 
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
            <h1 class="gradient-text">Modification d'évènements</h1>
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
            if(isset($_GET['music'])){
              if($_GET['music'] == 1){
                echo ('<div id="error" class="errorCont"><div id="errorMessage" class="errorMessage"><h1>Erreur</h1><br>Veuillez sélectionner un type de musique.<br><button onclick="closeError()">Continuer</button></div></div>');
              }
            }
            if(isset($_GET['type'])){
              if($_GET['type'] == 1){
                echo ('<div id="error" class="errorCont"><div id="errorMessage" class="errorMessage"><h1>Erreur</h1><br>Veuillez sélectionner un type d\'évènement.<br><button onclick="closeError()">Continuer</button></div></div>');
              }
            }
          }
        }
      ?>
    <div class="login">
        <div class="heading">
            <div class="insc-cont">
          <form id="contact-form" class="insc-cont-1" role="form" method="POST" action="script_php/modify_event.php?event=<?php echo $event['event_id'] ?>" enctype="multipart/form-data">
       
            <div class="form-group-insc">
              <div class="col-sm-12">
                <input type="text" class="form-control insc-form" id="name" placeholder="NOM DE L'ÉVÈNEMENT" name="nom_event" value="<?php echo $event['event_title']; ?>" required autofocus maxlength="30" pattern="([^()/><\][\\\x22,;|]+){4,}">
              </div>
            </div>
            
            <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="text" class="form-control insc-form" id="date_event" name="date_event" value="<?php $dateevent = explode(" ", $event['event_datetime']); $date_event = explode("-", $dateevent[0]); echo ($date_event[2]." / ".$date_event[1]." / ".$date_event[0]); ?>" placeholder="DATE DE L'ÉVÈNEMENT (JJ/MM/AAAA)" required>
                </div>
              </div>

              <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="text" class="form-control insc-form" id="time" name="time_event" value="<?php $timeevent = explode(":", $dateevent[1]); echo ($timeevent[0]." : ".$timeevent[1]); ?>" placeholder="HEURE DE L'ÉVÈNEMENT (HH:MM)" required>
                </div>
              </div>
            
              <div class="form-group-insc">
                <div class="col-sm-12">
                  <textarea class="form-control" id="description" rows="10" placeholder="DESCRIPTION DE L'ÉVÈNEMENT" name="description_event" maxlength="1000" required><?php echo $event['event_description']; ?></textarea>
                </div>
              </div>

            <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="text" class="form-control insc-form" id="adresse" placeholder="ADRESSE (Format : Rue N°, Ville)" name="adresse_event" value="<?php echo $event['event_location']; ?>" required maxlength="50">
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
                    <select name="type" id="type" class="form-control" onchange="categorie()">
                      <option value="">--Veuillez choisir un type d'évènement--</option>
                      <option value="1">Before</option>
                      <option value="2">After</option>
                      <option value="3">Soirée</option>
                      <option value="4">Concert/Showcase</option>
                      <option value="5">Open Mic/Karaoké</option>
                      <option value="6">Gaming</option>
                      <!-- <option value="7">Art</option> -->
                      <option value="7">Autres</option>
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
                    <select name="musique" id="musique" class="form-control">
                      <option value="">--Veuillez choisir une catégorie--</option>
                    </select>
                  </div>
                </div>
              </div>
            <div class="form-group-insc">
              <div class="col-sm-12">
                <div class="chBox">
                  <div class="col-sm-25">
                    <input type="checkbox" class="insc-form-checkbox-date" id="prive" name="private" value="prive"<?php if($event['event_private'] == 1){echo ("checked");} ?>/>
                    <label class="insc-form-checkbox-txt-date" id="txtprive" for="prive">Soirée privée</label><br>
                  </div>
                  <div class="col-sm-25">
                    <input type="checkbox" class="insc-form-checkbox-date" id="date-mask" name="date-mask" value="date-mask" onclick="datemask()"<?php if($event['event_maskedlocation'] != $event['event_creation']){echo ("checked");} ?>/>
                    <label class="insc-form-checkbox-txt-date" id="txtdate" for="date-mask">Adresse masquée</label><br>
                  </div>
                  <div>
                    <input type="checkbox" class="insc-form-checkbox-date" id="payant" name="payant" value="payant" onclick="privatiser()"<?php if($event['event_price'] != 0){echo ("checked");} ?>/>
                    <label class="insc-form-checkbox-txt-date" id="txtpayant" for="payant">Payant</label><br>
                  </div>
                  </div>
              </div>
            </div>
            <div class="form-group-insc">
                <div class="col-sm-20">
                <label id="img_txt" for="img_event" class="addImg">Choisir Image</label>
                  <input class="hidden" type="file" accept="image/*" name="img_event" id="img_event" value="">
                </div>
              </div>

              <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="text" class="form-control insc-form <?php if($event['event_maskedlocation'] == $event['event_creation']){echo ("hidden");} ?>" id="adresse_cachee" name="date_event_mask" value="<?php $datemask = explode(" ", $event['event_maskedlocation']); $date_mask = explode("-", $datemask[0]); if($event['event_maskedlocation'] != $event['event_creation']){echo ($date_mask[2]." / ".$date_mask[1]." / ".$date_mask[0]);} ?>" placeholder="RÉVÉLATION DE L'ADRESSE (JJ/MM/AAAA)">
                </div>
              </div>

              <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="text" class="form-control insc-form <?php if($event['event_maskedlocation'] == $event['event_creation']){echo ("hidden");} ?>" id="time_mask" name="time_mask" value="<?php $timemask = explode(":", $datemask[1]); if($event['event_maskedlocation'] != $event['event_creation']){echo ($timemask[0]." : ".$timemask[1]);} ?>" placeholder="RÉVÉLATION DE L'ADRESSE (HH:MM)">
                </div>
              </div>

              <div class="form-group-insc">
                <div class="col-sm-12">
                  <input type="number" step="0.05" class="form-control insc-form <?php if($event['event_price'] == 0){echo ("hidden");} ?>" id="prix" placeholder="PRIX" name="prix_event" value="<?php if($event['event_price'] != 0){echo $event['event_price'];} ?>" min="0.00"  max="9999.99">
                </div>
              </div>

              <div class="form-group-insc">
                <div class="col-sm-15">
                  <div>
                    <div class="checkboxSpacer"></div>
                    <input type="checkbox" required class="insc-form-checkbox" id="termes-conditions" name="conditions" value="accept"/>
                  </div>
                  <label class="insc-form-checkbox-txt" for="termes-conditions">J'ai lu et j'accepte les <a href="asset/conditions.pdf" target="_blank" class="underline">termes et conditions d'utilisation</a> de Noctinium</label>
                </div>
              </div>
            
            <button class="btn btn-primary send-button gradient insc-form-btn" id="submit" type="submit" value="SEND" onclick="getTime()">
              <div class="alt-send-button">
                <i class="fa fa-paper-plane fa-paper-plane-1"></i><span class="send-text send-text-1">Ajouter l'évènement</span>
              </div>
            
            </button>
            <input class="hidden" type="submit" id="trueBtn">
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
  var formH = document.getElementById("time");
  var formH2 = document.getElementById("time_mask");
  var formD2 = document.getElementById("adresse_cachee");
  var formPR = document.getElementById("prix");
  if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
    element.classList.toggle("logo");
    element.classList.toggle("logo-M");
    formN.classList.toggle("form-control");
        formN.classList.toggle("form-control-M");
        formE.classList.toggle("form-control");
        formE.classList.toggle("form-control-M");
        formD.classList.toggle("form-control");
        formD.classList.toggle("form-control-M");
        formPS.classList.toggle("form-control");
        formPS.classList.toggle("form-control-M");
        formM.classList.toggle("form-control");
        formM.classList.toggle("form-control-M");
        formT.classList.toggle("form-control");
        formT.classList.toggle("form-control-M");
        formH.classList.toggle("form-control");
        formH.classList.toggle("form-control-M");
        formH2.classList.toggle("form-control");
        formH2.classList.toggle("form-control-M");
        formD2.classList.toggle("form-control");
        formD2.classList.toggle("form-control-M");
        formPR.classList.toggle("form-control");
        formPR.classList.toggle("form-control-M");
  }
  function datemask(){
    var mask = document.getElementById("date-mask")
    if (mask.checked){
      document.getElementById("adresse_cachee").classList.toggle("hidden");
      document.getElementById("time_mask").classList.toggle("hidden");
    }else{
      document.getElementById("adresse_cachee").classList.toggle("hidden");
      document.getElementById("time_mask").classList.toggle("hidden");

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
  var customTxt = document.getElementById("img_txt");
  var truebtnimg = document.getElementById("img_event");

  truebtnimg.addEventListener("change", function() {
    if (truebtnimg.value) {
      customTxt.innerHTML = truebtnimg.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
    } else {
      btnimg.innerHTML = "Choisir Image";
    }
  });
</script>
<script>
  function closeError() {
    var error = document.getElementById("error");
    var errorMessage = document.getElementById("errorMessage");
    error.classList.toggle("hidden");
  }; 
</script>
<script language="javascript">
var options = {
    url: function(phrase) {
        return "https://ge.ch/teradressews_public/v1/rest/search?searchText=" + phrase;
    },
    getValue: "label"
};

$("#adresse").easyAutocomplete(options);
</script>
<script>
      document.getElementById('date_event').addEventListener('input', function(e){
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

      document.getElementById('date_event').addEventListener('blur', function(e){
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
    <script>
      document.getElementById('adresse_cachee').addEventListener('input', function(e){
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

      document.getElementById('adresse_cachee').addEventListener('blur', function(e){
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
      var time1 = "<?php echo ($timeevent[0]." : ".$timeevent[1]); ?>";

      var timeStart = document.getElementById("time");

      var checkValue = (str, max) => {
        if (str.charAt(0) !== "0" || str === "00") {
          let num = parseInt(str);
          if (isNaN(num) || num < 0 || num > max) num = 0;

          str =
            num === 0 ||
            (num > parseInt(max.toString().charAt(0)) && num.toString().length === 1)
              ? "0" + num
              : num.toString();
        }
        return str;
      };

      var formatTime = (evt) => {
        evt.target.type = "text";
        let input = evt.target.value;

        if (/\D:$/.test(input)) input = input.substr(0, input.length - 3);


        var values = input.split(":").map((v) => v.replace(/\D/g, ""));
        if (values[0]) values[0] = checkValue(values[0], 23);
        if (values[1]) values[1] = checkValue(values[1], 59);


        var output = values.map((v, i) =>
          v.length === 2 && i < 1 ? v + " : " : v
        );


        evt.target.value = output.join("").substr(0, 7);
      };

      var autoFormatTime = (autoFill) => {
        return (evt) => {
          let input = evt.target.value;
          var values = input.split(":").map((v) => v.replace(/\D/g, ""));
          let output = "";

          if (values.length === 2) {

            var minute = !values[1]
              ? autoFill
              : values[1].length === 1
              ? values[1] + 0
              : values[1];
            var times = [values[0], minute];
            output = times
              .map((v, i) => (v.length === 2 && i < 1 ? v + " : " : v))
              .join("");
          }
          evt.target.value = output;
          time1 = output;
        };
      };

      var autoFormatTimeStart = autoFormatTime("00");


      timeStart.addEventListener("input", formatTime);
      timeStart.addEventListener("blur", autoFormatTimeStart);


    var time2 = "<?php if($event['event_maskedlocation'] != $event['event_creation']){ echo ($timeevent[0]." : ".$timeevent[1]);} ?>";

    var timeStart2 = document.getElementById("time_mask");

    var checkValue2 = (str, max) => {
      if (str.charAt(0) !== "0" || str === "00") {
        let num = parseInt(str);
        if (isNaN(num) || num < 0 || num > max) num = 0;

        str =
          num === 0 ||
          (num > parseInt(max.toString().charAt(0)) && num.toString().length === 1)
            ? "0" + num
            : num.toString();
      }
      return str;
    };

    var formatTime2 = (evt) => {
      evt.target.type = "text";
      let input = evt.target.value;

      if (/\D:$/.test(input)) input = input.substr(0, input.length - 3);


      var values = input.split(":").map((v) => v.replace(/\D/g, ""));
      if (values[0]) values[0] = checkValue(values[0], 23);
      if (values[1]) values[1] = checkValue(values[1], 59);


      var output2 = values.map((v, i) =>
        v.length === 2 && i < 1 ? v + " : " : v
      );


      evt.target.value = output2.join("").substr(0, 7);
    };

    var autoFormatTime2 = (autoFill) => {
      return (evt) => {
        let input = evt.target.value;
        var values = input.split(":").map((v) => v.replace(/\D/g, ""));
        let output2 = "";

        if (values.length === 2) {

          var minute = !values[1]
            ? autoFill
            : values[1].length === 1
            ? values[1] + 0
            : values[1];
          var times = [values[0], minute];
          output2 = times
            .map((v, i) => (v.length === 2 && i < 1 ? v + " : " : v))
            .join("");
        }
        evt.target.value = output2;
        time2 = output2;
      };
    };

    var autoFormatTimeStart2 = autoFormatTime2("00");


    timeStart2.addEventListener("input", formatTime2);
    timeStart2.addEventListener("blur", autoFormatTimeStart2);

    var trueBtn = document.getElementById("trueBtn");
    function getTime(){
      timeStart.value = time1;
      timeStart2.value = time2;
      trueBtn.click();
    }

</script>
<script>
  $(document).ready(function () {
    $("#type").change(function () {
        var val = $(this).val();
        if (val == "1" | val == "2" | val == "3" | val == "4" | val == "5") {
            $("#musique").html('<option value="1">Afrobeat</option><option value="2">All style</option><option value="3">Années \'70</option><option value="4">Années \'80</option><option value="5">Années \'90</option><option value="6">Années \'00</option><option value="7">Bachata</option><option value="8">Blues</option><option value="9">Country</option><option value="10">Dancehall</option><option value="11">Dubstep</option><option value="12">Électro</option><option value="13">Funk</option><option value="14">Hip Hop</option><option value="15">House</option><option value="16">Jazz</option><option value="17">Latino</option><option value="18">Métal</option><option value="19">Punk</option><option value="20">R\'N\'B</option><option value="21">Rap</option><option value="22">Reggae</option><option value="23">Reggaeton</option><option value="24">Rock</option><option value="25">Techno</option><option value="26">Autres</option>');
        } else if (val == "6") {
            $("#musique").html('<option value="1">Call of Duty</option><option value="2">Counter-Strike</option><option value="3">Dota 2</option><option value="4">FIFA</option><option value="5">Fortnite</option><option value="6">Jeux WII</option><option value="7">League of Legend</option><option value="8">Minecraft</option><option value="9">Mortal Kombat</option><option value="10">Overwatch</option><option value="11">PUBG</option><option value="12">Rainbow 6</option><option value="13">Rocket League</option><option value="14">Street Fighter</option><option value="15">Super Smash Bros.</option><option value="16">Valorant</option><option value="17">Yuh Gi Oh</option><option value="18">Autres</option>');
        } /* else if (val == "7") {
            $("#musique").html('<option value="1">Architecture</option><option value="2">Cinéma</option><option value="3">Cirque</option><option value="4">Comédie</option><option value="5">Danse</option><option value="6">Dessin</option><option value="7">Graffiti</option><option value="8">Littérature</option><option value="9">Peinture</option><option value="10">Sculpture</option><option value="11">Tatoo</option><option value="12">Théâtre</option><option value="13">Autres</option>');
        } */ else if (val == "7"){
          $("#musique").html('<option value="1">Conférence</option><option value="2">Mode</option><option value="3">Urbain</option><option value="4">Autres</option>')
        } else{
          $("#musique").html('<option value="">--Veuillez choisir une catégorie--</option>');
        }
    });
  });
</script>
</html>