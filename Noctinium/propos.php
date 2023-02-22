<?php
    require './script_php/database-connection.php';
    require './script_php/sessions.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="asset/style.css">
        <meta charset="utf-8" />
        <title>À propos</title>
        <link rel="icon" href="image/logo_noctinium_16x16.png">
    </head>
    <body>
        <header>
            <a href="index.php"><img class="logo" id="logo" src="image/logo_noctinium.webp" alt="Logo"></a>
            <nav>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="eventlist.php">Évènements</a></li>
                <li><a href="contact.php">Contact</a></li>
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
            <h2>Pourquoi Noctinium ?</h2>
        <div class="argument">
            <h4 class="text-gradient-purple">Une carte détaillée</h4>
            <p>Nous possédons une carte détaillée qui nous permet de visualiser les évènements sur Genève et autour de soi.</p>
        </div>
        <div class="argument">
            <h4 class="text-gradient-purple">Les évènements</h4>
            <p>Chaque évènement possède sa propre page avec toutes les informations nécessaires et il est possible de trier les divers évènements par catégorie.</p>
        </div>
        <div class="argument">
            <h4 class="text-gradient-purple">Accessible à tous !</h4>
            <p>N'importe qui peut créer son propre évènement et le rendre public sur la carte.</p>
        </div>
        <div class="argument">
            <h4 class="text-gradient-purple">Faire partie d'une communauté</h4>
            <p>Utiliser Noctinium, c'est être un participant actif d'une communauté grandissante !</p>
        </div>
        </section>  
        <hr class="gradient">
        <!-- <hr> -->
        <section class="subscribe">
            <p>
                Il y aura de nouveaux événements chaque jour !<br><br> Inscrivez-vous à la newsletter pour rester informé !    
            </p>
            <br>
            <a href="#subscribe" class="buttonBW" target="_blank">
                <span>Inscrivez-vous à la newsletter</span>
            </a>
        </section>
    
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