<?php
    require './script_php/database-connection.php';
    include './script_php/sessions.php';
?>
<html>
    <head>
      <link rel="stylesheet" href="asset/style.css">
      <link rel="stylesheet" href="asset/eventlist.css">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
      <meta charset="utf-8" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
      <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
      <title>Évènements</title>
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
                <h1 class="gradient-text">Liste des évènements</h1>
            </div>
        </section>
        <hr class="gradient">
        <section class="eventlist">
          <div class="searchCont">
            <div class="filtreCont">
              <a class="openFiltre" onclick="filtreMenu()">Filtres &#9776;</a>
            </div>
            <div class="searchBarCont">
              <form class="searchBar">
                <input type="text" class="search insc-form" id="search" placeholder="RECHERCHE ..." name="search" value="">
                <button class="searchBtn" id="searchBtn" type="submit"><i class="fa fa-search"></i></button>
              </form>
            </div>
            <div class="newEventCont">
              <?php
                if($logged_in == true){
                  echo('<a href="eventAdd.php" id="newEvent" class="newEvent">Ajouter</a>');
                }
              ?>
            </div>
          </div>
        <div id="main" class="main-f">
          <div id="mySidenav" class="sidenav">
            <h2>Filtres</h2>
            <form action="">
              <h3>Musique:</h3>
              <div class="typeCont">
                <input type="checkbox" id="Teckno" name="Teckno"><label for="Teckno"> Teckno</label><br>
                <input type="checkbox" id="Latino" name="Latino"><label for="Latino"> Latino</label><br>
                <input type="checkbox" id="Rap" name="Rap"><label for="Rap"> Rap</label><br>
                <input type="checkbox" id="AllStyles" name="AllStyles"><label for="AllStyles"> All Styles</label><br>
              </div>
              <h3>Type d'évènement:</h3>
              <div class="typeCont">
                <input type="checkbox" id="before" name="before"><label for="before"> Before</label><br>
                <input type="checkbox" id="soiree" name="soiree"><label for="soiree"> Soirée</label><br>
                <input type="checkbox" id="after" name="after"><label for="after"> After</label><br>
              </div>
              <h3>Date de l'évènement:</h3>
              <div class="typeCont">
                <div class="form-group-insc">
                  <div class="col-sm-12">
                    <input type="date" class="filtreDate insc-form" id="adresse_cachee" name="date_event" value="">
                  </div>
                </div>
              </div>
              <h3>Organisateurs:</h3>
              <div class="typeCont">
                <input type="checkbox" id="Particuliers" name="Particuliers"><label for="Particuliers"> Particuliers</label><br>
                <input type="checkbox" id="Associations" name="Associations"><label for="Associations"> Associations</label><br>
                <input type="checkbox" id="Professionnels" name="Professionnels"><label for="Professionnels"> Professionnels</label><br>
              </div>
              <h3>Heure de début:</h3>
              <div class="typeCont">
                <input type="radio" id="HeureDebut" name="ordrecroissant"><label for="HeureDebut"> Ordre croissant</label><br>
                <input type="radio" id="HeureFin" name="ordrecroissant"><label for="HeureFin"> Ordre décroissant</label><br>
              </div>
              <input class="filtreBtn" type="submit" value="FILTRER">
            </form>
          </div>
        <div class="eventCont">
        <div class="blog-slider">
            <div class="blog-slider__wrp swiper-wrapper">
              <div class="blog-slider__item swiper-slide">
                <div class="blog-slider__img">
                  
                  <img class="eventimg" src="image/l-usine-geneve.jpg" alt="Image de l'évènement">
                </div>
                <div class="blog-slider__content">
                  <span class="blog-slider__code">26 December 2019</span>
                  <div class="blog-slider__title">L'usine</div>
                  <div class="blog-slider__text">Ouverte depuis 1989, L’Usine est un centre culturel autogéré important en Suisse et plébiscité par ses voisin-e-s européen-ne-s. L’association faîtière revendique une éthique de travail fondée sur l’autogestion, le multiculturalisme et l’ouverture aux autres.</div>
                  <a href="event.php" class="blog-slider__button">En savoir plus</a>
                </div>
              </div>
              <div class="blog-slider__item swiper-slide">
                <div class="blog-slider__img">
                  <img class="eventimg" src="image/ob_1876c1_len-faki-audiography-gabriel-asper.jpeg" alt="Image de l'évènement">
                </div>
                <div class="blog-slider__content">
                  <span class="blog-slider__code">26 December 2019</span>
                  <div class="blog-slider__title">L'usine</div>
                  <div class="blog-slider__text">L’Usine est une association faîtière qui regroupe une vingtaine de collectifs et associations dont les plus visibles sont les lieux publics qui proposent une programmation de spectacles vivants, concerts, cinéma, expositions, performances, festivals et fêtes.</div>
                  <a href="event.php" class="blog-slider__button">En savoir plus</a>
                </div>
              </div>
              
              <div class="blog-slider__item swiper-slide">
                <div class="blog-slider__img">
                  <img class="eventimg" src="image/2625-zoo-usine-led-outdoor-2014.jpg" alt="Image de l'évènement">
                </div>
                <div class="blog-slider__content">
                  <span class="blog-slider__code">26 December 2019</span>
                  <div class="blog-slider__title">L'usine</div>
                  <div class="blog-slider__text">Si chaque groupe possède son fonctionnement propre, certaines idées et pratiques sont partagées par toutes et tous : rejet du profit comme seul but des activités, de toute forme de concurrence ou de hiérarchie entre les individus ainsi qu’entre les disciplines.                  </div>
                  <a href="event.php" class="blog-slider__button">En savoir plus</a>
                </div>
              </div>
              
            </div>
            <div class="blog-slider__pagination"></div>
          </div>
          <div class="blog-slider">
            <div class="blog-slider__wrp swiper-wrapper">
              <div class="blog-slider__item swiper-slide">
                <div class="blog-slider__img">
                  
                  <img class="eventimg" src="https://res.cloudinary.com/muhammederdem/image/upload/q_60/v1535759872/kuldar-kalvik-799168-unsplash.webp" alt="Image de l'évènement">
                </div>
                <div class="blog-slider__content">
                  <span class="blog-slider__code">26 December 2019</span>
                  <div class="blog-slider__title">Lorem Ipsum Dolor</div>
                  <div class="blog-slider__text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae voluptate repellendus magni illo ea animi? </div>
                  <a href="#" class="blog-slider__button">READ MORE</a>
                </div>
              </div>
              <div class="blog-slider__item swiper-slide">
                <div class="blog-slider__img">
                  <img class="eventimg" src="https://res.cloudinary.com/muhammederdem/image/upload/q_60/v1535759871/jason-leung-798979-unsplash.webp" alt="Image de l'évènement">
                </div>
                <div class="blog-slider__content">
                  <span class="blog-slider__code">26 December 2019</span>
                  <div class="blog-slider__title">Lorem Ipsum Dolor2</div>
                  <div class="blog-slider__text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae voluptate repellendus magni illo ea animi?</div>
                  <a href="#" class="blog-slider__button">READ MORE</a>
                </div>
              </div>
              
              <div class="blog-slider__item swiper-slide">
                <div class="blog-slider__img">
                  <img class="eventimg" src="https://res.cloudinary.com/muhammederdem/image/upload/q_60/v1535759871/alessandro-capuzzi-799180-unsplash.webp" alt="Image de l'évènement">
                </div>
                <div class="blog-slider__content">
                  <span class="blog-slider__code">26 December 2019</span>
                  <div class="blog-slider__title">Lorem Ipsum Dolor</div>
                  <div class="blog-slider__text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae voluptate repellendus magni illo ea animi?</div>
                  <a href="#" class="blog-slider__button">READ MORE</a>
                </div>
              </div>
              
            </div>
            <div class="blog-slider__pagination"></div>
          </div>
        </div>
        </div>
        </section>
        <?php
          include './script_php/footer.php'
        ?>
        <button id="btnretour" onclick="topScroll()"> &#8613; </button>
		<script>
			var swiper = new Swiper('.blog-slider', {
    spaceBetween: 30,
    effect: 'fade',
    loop: true,
    mousewheel: {
      invert: false,
    },
    // autoHeight: true,
    pagination: {
      el: '.blog-slider__pagination',
      clickable: true,
    }
  });
		</script>
    <script>
      var element = document.getElementById("logo")
      var search = document.getElementById("search")
      var searchBtn = document.getElementById("searchBtn")
			if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
        element.classList.toggle("logo");
        element.classList.toggle("logo-M");
        search.classList.toggle("search");
        search.classList.toggle("search-M");
        searchBtn.classList.toggle("searchBtn");
        searchBtn.classList.toggle("searchBtn-M");
      }
      var verif = false
      var menu = document.getElementById("mySidenav")
      var main = document.getElementById("main")
      function filtreMenu(){
        if(verif == false){
          main.classList.toggle("main")
          main.classList.toggle("main-f")
          if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            menu.style.width = "200%";
          }else{
            menu.style.width = "100%";
          }
          verif = true;
        } else {
          menu.style.width = "0";
          verif = false
          setTimeout(closefiltre, 350);
          function closefiltre(){
            main.classList.toggle("main-f")
            main.classList.toggle("main")
          }
        }
      }

      let retour = document.getElementById("btnretour");

      window.onscroll = function() {scroll()};

      function scroll() {
        if (document.body.scrollTop > 475 || document.documentElement.scrollTop > 475) {
          retour.style.display = "block";
        } else {
          retour.style.display = "none";
        }
      }

      function topScroll() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
    </script>
    </body>
</html>
