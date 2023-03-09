<?php
    require './script_php/database-connection.php';
    require './script_php/sessions.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="asset/style.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
        <meta charset="utf-8" />
        <title>Mentions légales</title>
        <link rel="icon" href="image/logo_noctinium.ico">
    </head>
    <body>
        <header>
            <a href="index"><img class="logo" id="logo" src="image/logo_noctinium.webp" alt="Logo"></a>
            <nav id="computer">
                <li><a href="index">Accueil</a></li>
                <li><a href="eventlist">Liste des évènements</a></li>
                <li><a href="contact">Nous contacter</a></li>
                <li><a href="sponsor">Sponsors</a></li>
                <li class="active"><a href="propos">À propos</a></li>
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
        
        <section class="attends">
            <h2>Mentions légales</h2>

            <h4 class="text-gradient-purple">Raison social</h4>
            <p>Noctinium</p>

            <h4 class="text-gradient-purple">Siège social</h4>
            <p>Genève</p>

            <h4 class="text-gradient-purple">Nom des directeurs</h4>
            <p>Julien Castro et David Pierella</p>
            
            <h4 class="text-gradient-purple">Information sur l'hébérgeur</h4>
            <p>Nom de l'hébérgeur</p>
            <p>Adresse de l'hébérgeur</p>
            <p>Numéro de l'hénérgeur</p>
            
        </section>  
        <hr class="gradient">
        <!-- <hr> -->
        
    
        <?php
          include './script_php/footer.php'
        ?>
</body>
<script>
    var element = document.getElementById("logo")
          if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
      element.classList.toggle("logo");
      element.classList.toggle("logo-M");
    }
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