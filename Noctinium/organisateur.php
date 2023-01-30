<?php
    require './script_php/database-connection.php';
    include './script_php/sessions.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="asset/style.css">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
      <meta charset="utf-8" />
      <link rel="stylesheet" href="asset/user.css">
      <title>Organisateur</title>
      <link rel="icon" href="image/logo_noctinium_16x16.png">
    </head>
    <body>
        <header>
            <a href="index.php"><img class="logo" id="logo" src="image/logo_noctinium.png" alt="Logo"></a>
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
        <section class="content content-small">
          <div class="container">
              <h1 class="gradient-text">Organisateur</h1>
          </div>
      </section>
          <hr class="gradient">
        <section class="subscribe">
            <div class="profilCompte">
                <div>
                    <img src="image/alieu.jfif" class="img-Orga" alt="Organisateur">
                </div>
                <div class="infoCont">
                    <p id="infoBio" class="infoUser">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae voluptate repellendus magni illo ea animi? Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae voluptate repellendus magni illo ea animi? Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur, adipisicing?</p>
                </div>
            </div>
            <ul class="link-list">
              <li class="orga"><a href="#" target="_blank" class="contact-icon">
                <i class="fa fa-social fa-instagram" aria-hidden="true"></i></a>
              </li>
              <li class="orga"><a href="#" target="_blank" class="contact-icon">
                <i class="fa fa-social fa-twitter" aria-hidden="true"></i></a>
              </li>
              <li class="orga"><a href="#" target="_blank" class="contact-icon">
                <i class="fa fa-social fa-link" aria-hidden="true"></i></a>
              </li>      
            </ul>
        </section>
        <hr class="gradient">
        <section class="attends">
            <div class="interaction">
              <div class="comment-form">
                <!-- Comment Avatar -->
                <div >
                  <img class="comment-pp" src="image/david.png" alt="Image de profil">
                </div>
            
                <form class="form" name="form" ng-submit="form.$valid && cmntCtrl.addComment()" novalidate>
                  <div class="form-row">
                    <textarea
                              class="input"
                              ng-model="cmntCtrl.comment.text"
                              placeholder="AJOUTER UN COMMENTAIRE ..."
                              required></textarea>
                  </div>
                  <div class="form-row">
                    <input type="submit" value="COMMENTER">
                  </div>
                </form>
                <div class="commCont">

                </div>
              </div>
              <div class="star">
                <h3 class="starTitle">Note : 4.8/5</h3>
                <form class="starCont" action="">
                  <fieldset class="rate">
                    <input type="radio" id="rating10" name="rating" value="10" /><label for="rating10" title="5 stars"></label>
                    <input type="radio" id="rating9" name="rating" value="9" /><label class="half" for="rating9" title="4 1/2 stars"></label>
                    <input type="radio" id="rating8" name="rating" value="8" /><label for="rating8" title="4 stars"></label>
                    <input type="radio" id="rating7" name="rating" value="7" /><label class="half" for="rating7" title="3 1/2 stars"></label>
                    <input type="radio" id="rating6" name="rating" value="6" /><label for="rating6" title="3 stars"></label>
                    <input type="radio" id="rating5" name="rating" value="5" /><label class="half" for="rating5" title="2 1/2 stars"></label>
                    <input type="radio" id="rating4" name="rating" value="4" /><label for="rating4" title="2 stars"></label>
                    <input type="radio" id="rating3" name="rating" value="3" /><label class="half" for="rating3" title="1 1/2 stars"></label>
                    <input type="radio" id="rating2" name="rating" value="2" /><label for="rating2" title="1 star"></label>
                    <input type="radio" id="rating1" name="rating" value="1" /><label class="half" for="rating1" title="1/2 star"></label>
                </fieldset>
                    <div class="form-row">
                      <input class="noter" type="submit" value="NOTER">
                  </div>
                </form>
              </div>
            </div>
        </section>
        <?php
          include './script_php/footer.php'
        ?>
		<script>
      var element = document.getElementById("logo")
			if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
        element.classList.toggle("logo");
        element.classList.toggle("logo-M");
      }
		</script>
    </body>
</html>