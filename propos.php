<?php
    require './script_php/database-connection.php';
    require './script_php/sessions.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="asset/style.css">
        <link rel="stylesheet" href="asset/fontawesome/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
        <meta charset="utf-8" />

    <meta name="title" content="Découvrez pourquoi choisir Noctinium - Carte des événements à Genève et environs">
    <meta name="viewport" content="width=100vw, initial-scale=0.5">
    <meta name="description" content="Trouvez les meilleurs événements à Genève et ses environs grâce à Noctinium. Découvrez notre carte détaillée pour explorer les événements en un coup d'œil et trouver toutes les informations dont vous avez besoin sur chaque événement. Créez et partagez vos propres événements avec notre communauté grandissante. Inscrivez-vous à notre newsletter pour ne manquer aucun événement !">
    <meta name="keywords" content="soirée proche, faire la fête genève, voir soirée genève, soirée près de chez moi, soirée thèmes genève, genève, club libertin genève, programme soirée genève, bon plan genève, libertin club genève, décadense, boite de nuit, boite de nuit proche, quoi faire à genève, soirée genève, boite de nuit près de moi, concert genève, motel campo, la décadense, fête de la musique genève, village du soir, événements genève, club genève, évènements genève, boite de nuit genève, DJ, programmation">
    <title>À propos</title>

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
                Il y aura de nouveaux évènements chaque jour !<br> Inscrivez-vous à la newsletter pour rester informé !    
            </p>
            <br>
            <form class="newsBar" method="POST" action="">
                <input type="email" class="news insc-form" id="news" placeholder="EMAIL" name="news" value="">
                <button class="newsBtn" id="newsBtn" type="submit"><i class="fa-solid fa-paper-plane"></i></button>
            </form>
        </section>
    
        <?php
          include './script_php/footer.php'
        ?>
</body>
<script>
    var element = document.getElementById("logo")
    var news = document.getElementById("news")
    var newsBtn = document.getElementById("newsBtn")
          if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
      element.classList.toggle("logo");
      element.classList.toggle("logo-M");
      news.classList.toggle("news");
        news.classList.toggle("news-M");
        newsBtn.classList.toggle("newsBtn");
        newsBtn.classList.toggle("newsBtn-M");
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