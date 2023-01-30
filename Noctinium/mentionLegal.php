<?php
    require './script_php/database-connection.php';
    include './script_php/sessions.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="asset/style.css">
        <meta charset="utf-8" />
        <title>Mentions légales</title>
        <link rel="icon" href="image/logo_noctinium_16x16.png">
    </head>
    <body>
        <header>
            <a href="index.php"><img class="logo" id="logo" src="image/logo_noctinium.png" alt="Logo"></a>
            <nav>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="eventlist.php">Liste des évènements</a></li>
                <li><a href="contact.php">Nous contacter</a></li>
                <li><a href="sponsor.php">Sponsors</a></li>
                <li class="active"><a href="propos.php">A propos</a></li>
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
</html>