<?php
    require './script_php/database-connection.php';
    require './script_php/sessions.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="asset/style.css">
        <meta charset="utf-8" />
        
        <meta name="title" content="Page coming soon page en cours de finition">
        <meta name="viewport" content="width=100vw, initial-scale=0.5">
        <meta name="description" content="Noctinium est la nouvelle boîte de nuit à Genève. Soyez parmi les premiers à découvrir notre nouvel établissement. Restez à l'affût pour l'annonce de notre ouverture officielle.">
        <meta name="keywords" content="soirée proche, faire la fête genève, voir soirée genève, soirée près de chez moi, soirée thèmes genève, genève, club libertin genève, programme soirée genève, bon plan genève, libertin club genève, décadense, boite de nuit, boite de nuit proche, quoi faire à genève, soirée genève, boite de nuit près de moi, concert genève, motel campo, la décadense, fête de la musique genève, village du soir, événements genève, club genève, évènements genève, boite de nuit genève">
        <title>Soon...</title>
        <link rel="icon" href="image/logo_noctinium_16x16.png">
        <meta name="viewport" content="width=100vw, initial-scale=0.5">
    </head>
    <body>
        <header>
            <a href="index"><img class="logo" id="logo" src="image/logo_noctinium.webp" alt="Logo"></a>
            <nav>
                <li><a href="index">Accueil</a></li>
                <li><a href="eventlist">Évènements</a></li>
                <li><a href="contact">Contact</a></li>
				<li><a href="propos">A propos</a></li>
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
        </header>
        <section class="content">
            <div class="container">
                <h1 class="gradient-subtext">Coming Soon ...</h1>
                <p>
                    La page que vous cherchez n'est pas disponible mais le sera bientôt.<br>Encore un peu de patience.
                </p>
                <br>
                <a class="button" href="index">
                    RETOURNER A L'ACCUEIL
                </a>
            </div>
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
