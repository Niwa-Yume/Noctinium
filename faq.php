<?php
    require './script_php/database-connection.php';
    require './script_php/sessions.php';
?>
<html>
<head>


    <meta name="title" content="FAQ - Noctinium, cette page répond à toute les questions que vous pouvez concernant la plateforme et les soirées de Genève">
    <meta name="viewport" content="width=100vw, initial-scale=0.5">
    <meta name="description" content="Vous avez des questions sur la nouvelle boîte de nuit Noctinium à Genève ? Consultez notre FAQ pour trouver toutes les réponses.">
    <meta name="keywords" content="soirée proche, faire la fête genève, voir soirée genève, soirée près de chez moi, soirée thèmes genève, genève, club libertin genève, programme soirée genève, bon plan genève, libertin club genève, décadense, boite de nuit, boite de nuit proche, quoi faire à genève, soirée genève, boite de nuit près de moi, concert genève, motel campo, la décadense, fête de la musique genève, village du soir, événements genève, club genève, évènements genève, boite de nuit genève, DJ, programmation">
    <title>FAQ</title>

    
	<meta charset="utf-8" />
    <link rel="stylesheet" href="asset/style.css">
        <link rel="stylesheet" href="asset/fontawesome/css/all.css">
    <link rel="icon" href="image/logo_noctinium.ico">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
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
            <li class="active"><a href="faq">FAQ</a></li>
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
            <h1 class="gradient-text">Foire Aux Questions</h1>
        </div>
    </section>
    <hr class="gradient">
    <section class="faq">
        <div class="container">
            <ul class="faq-question">
                <li>
                    <h2 class="faq-title">
                        C'est quoi Noctinium ?
                    </h2>
                    <svg height="24" viewBox="0 0 24 24" version="1.1" width="24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M5.22 8.72a.75.75 0 000 1.06l6.25 6.25a.75.75 0 001.06 0l6.25-6.25a.75.75 0 00-1.06-1.06L12 14.44 6.28 8.72a.75.75 0 00-1.06 0z">
                        </path>
                    </svg>
                    <div class="faq-content">
                        <p>
                            C'est une application/site permettant à n'importe qui de pouvoir trouver ou poster sa propre
                            soirée simplement dans sa ville et autour de soi-même.
                        </p>
                    </div>
                </li>
                <li>
                    <h2 class="faq-title">
                        Qui peut-poster un évènement ?
                    </h2>
                    <svg height="24" viewBox="0 0 24 24" version="1.1" width="24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M5.22 8.72a.75.75 0 000 1.06l6.25 6.25a.75.75 0 001.06 0l6.25-6.25a.75.75 0 00-1.06-1.06L12 14.44 6.28 8.72a.75.75 0 00-1.06 0z">
                        </path>
                    </svg>
                    <div class="faq-content">
                        <p>
                            N'importe qui peut poster son propre évènement. Cependant, pour éviter un nombre trop élevé d'évènement "poubelles" chaque personne, excepté les partenaires et les utilisateurs premium, ne pourra poster qu'un évènement par semaine.
                        </p>
                    </div>
                </li>
                <li>
                    <h2 class="faq-title">
                        Qui utilise l'application Noctinium ?
                    </h2>
                    <svg height="24" viewBox="0 0 24 24" version="1.1" width="24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M5.22 8.72a.75.75 0 000 1.06l6.25 6.25a.75.75 0 001.06 0l6.25-6.25a.75.75 0 00-1.06-1.06L12 14.44 6.28 8.72a.75.75 0 00-1.06 0z">
                        </path>
                    </svg>
                    <div class="faq-content">
                        <p>
                            Noctinium n'a pas de public visé spécifique, cependant la majorité des personnes utilisant l'application/site sont les 18-25 ans.
                        </p>
                        <p>
                            Les utilisateurs de l'application/site veulent trouver des soirées près de chez eux organisées par d'autres personnes, associations et boites de nuit ou les poster eux-mêmes.
                        </p>
                        <p>
                            Ils auront la possibilité de visualiser les évènements organisés par le monde de la nuit et les associations, voir où ils se situent sur la carte et pourront les trier selon leurs critères.
                        </p>
                    </div>
                </li>
                <li>
                    <h2 class="faq-title">
                        Comment puis-je poster mes soirées ?
                    </h2>
                    <svg height="24" viewBox="0 0 24 24" version="1.1" width="24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M5.22 8.72a.75.75 0 000 1.06l6.25 6.25a.75.75 0 001.06 0l6.25-6.25a.75.75 0 00-1.06-1.06L12 14.44 6.28 8.72a.75.75 0 00-1.06 0z">
                        </path>
                    </svg>
                    <div class="faq-content">
                        <p>
                            Avant de vouloir poster un évènement, vous devez vous créer un compte sur le site ou l'application.
                        </p>
                        <p>
                            Ensuite, vous devrez rentrer les informations nécessaires à la création de la soirée (date, lieu, prix d'entrée si nécessaire, heure de début/fin, etc.) et pourrez enfin créer l'identité visuelle de la soirée.
                        </p>
                    </div>
                </li>
                <li>
                    <h2 class="faq-title">
                        Je suis une associtations/organistation du monde de la nuit, comment puis-je devenir partenaire ?
                    </h2>
                    <svg height="24" viewBox="0 0 24 24" version="1.1" width="24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M5.22 8.72a.75.75 0 000 1.06l6.25 6.25a.75.75 0 001.06 0l6.25-6.25a.75.75 0 00-1.06-1.06L12 14.44 6.28 8.72a.75.75 0 00-1.06 0z">
                        </path>
                    </svg>
                    <div class="faq-content">
                        <p>
                            Il suffit d'organiser des évènements régulièrement (hebdomadaire, mensuel et/ou annuel). Il faut ensuite nous contacter par mail ou téléphone pour procéder à la création d'un partenariat.
                        </p>
                    </div>
                </li>
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