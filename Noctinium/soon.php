<?php
    require './script_php/database-connection.php';
    require './script_php/sessions.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="asset/style.css">
        <meta charset="utf-8" />
        <title>Soon...</title>
        <link rel="icon" href="image/logo_noctinium_16x16.png">
    </head>
    <body>
        <header>
            <a href="index.php"><img class="logo" id="logo" src="image/logo_noctinium.webp" alt="Logo"></a>
            <nav>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="eventlist.php">Évènements</a></li>
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
        <section class="content">
            <div class="container">
                <h1 class="gradient-subtext">Coming Soon ...</h1>
                <p>
                    La page que vous cherchez n'est pas disponible mais le sera bientôt.<br>Encore un peu de patience.
                </p>
                <br>
                <a class="button" href="index.php">
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
