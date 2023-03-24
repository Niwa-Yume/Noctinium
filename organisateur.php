<?php
    require './script_php/database-connection.php';
    require './script_php/sessions.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="asset/style.css">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=100vw, initial-scale=0.5">
      <meta charset="utf-8" />
      <link rel="stylesheet" href="asset/user.css">
      <title>Organisateur</title>
      <link rel="icon" href="image/logo_noctinium.ico">
    </head>
    <body>
        <header>
            <a href="index"><img class="logo" id="logo" src="image/logo_noctinium.webp" alt="Logo"></a>
            <nav id="computer">
              <li><a href="index">Accueil</a></li>
              <li><a href="eventlist">Évènements</a></li>
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
        <?php
              if (isset($_GET['organisateur'])){
                $sql = "SELECT user_username, user_description, user_imageuser_id, user_instagram, user_twitter, user_site FROM user WHERE user_id = '". $_GET['organisateur'] ."';";
        
                $statement = $pdo->query($sql);
                if ($statement->rowCount() === 0){
                  echo ("<section class=\"content content-small\">
                    <div class=\"container\">
                      <h1 class=\"gradient-text\">Organisateur</h1>
                    </div>
                  </section>
                  <hr class=\"gradient\">
                  <section class=\"subscribe\">
                    <div style=\"height: 80%;margin-top: 100px;\" class=\"container\">
                      <h1>Cet utilisateur n'existe plus.</h1>
                    </div>
                  </section>");
                }else{
                  $organisateur = $statement->fetch();

                  $orga_img = "SELECT imageuser_url FROM imageuser WHERE imageuser_id = ". $organisateur['user_imageuser_id'] .";";
                  $statement2 = $pdo->query($orga_img);
                  $orga_image = $statement2->fetch();

                  if ($organisateur['user_description'] == ""){
                    $organisateur['user_description'] = "<div style=\"text-align: center;font-size: 1.5rem;\">Aucune description.</div>";
                  }else{
                    $organisateur['user_description']=htmlspecialchars($organisateur['user_description'], ENT_QUOTES, 'utf-8');
                  }
                  $note = "SELECT rating_value FROM rating WHERE rating_organiser_id = ". $_GET['organisateur'] .";";
                    $query = $pdo->query($note);
                    if($query->rowCount() > 0){
                      $total = 0;
                      $i = 0;
                      while($rating = $query->fetch()){
                        $total += $rating['rating_value']/2;
                        $i += 1;
                      }
                      $final = round($total/$i, 1, PHP_ROUND_HALF_UP);
                    }else{
                      $final = "";
                    }
                  echo ("<section class=\"content content-small\">
                    <div class=\"container\">
                      <h1 class=\"gradient-text\">". $organisateur['user_username'] ."</h1>
                    </div>
                    </section>
                    <hr class=\"gradient\">
                    <section class=\"subscribe\">
                    <div class=\"profilCompte\">
                        <div>
                            <img src=\"". $orga_image['imageuser_url'] ."\" class=\"img-Orga\" alt=\"Organisateur\">
                        </div>
                        <div class=\"infoCont\">
                            <p id=\"infoBio\" class=\"infoUser\">". $organisateur['user_description'] ."</p>
                        </div>
                    </div>");

                    if($organisateur['user_instagram'] != [] or $organisateur['user_twitter'] != [] or $organisateur['user_site'] != []){
                      echo ("<ul class=\"link-list\">");
                      if($organisateur['user_instagram'] != []){
                        echo("<li class=\"orga\" onclick=\"insta()\"><a href=\"#\" target=\"_blank\" class=\"contact-icon\">
                        <i class=\"fa fa-social fa-instagram\" aria-hidden=\"true\"></i></a>
                        </li>
                        <script>
                          function insta(){
                            window.open(\"". $organisateur['user_instagram'] ."\");
                          }
                        </script>");
                      }
                      if($organisateur['user_twitter'] != []){
                        echo ("<li class=\"orga\" onclick=\"twitter()\"><a href=\"#\" target=\"_blank\" class=\"contact-icon\">
                        <i class=\"fa fa-social fa-twitter\" aria-hidden=\"true\"></i></a>
                        </li>
                        <script>
                          function twitter(){
                            window.open(\"". $organisateur['user_twitter'] ."\");
                          }
                        </script>");
                      }
                      if($organisateur['user_site'] != []){
                        echo ("<li class=\"orga\" onclick=\"site()\"><a href=\"#\" target=\"_blank\" class=\"contact-icon\">
                        <i class=\"fa fa-social fa-link\" aria-hidden=\"true\"></i></a>
                        </li>
                        <script>
                          function site(){
                            window.open(\"". $organisateur['user_site'] ."\");
                          }
                        </script>");
                      }
                      echo ("</ul>");
                    }
                  echo ("
                    </section>");
                    echo("<hr class=\"gradient\">
                    <section class=\"attends\">
                        <div class=\"interaction\">
                        <div class=\"comment-form\">");
                  if($logged_in){
                    echo("<!-- Comment Avatar -->
                            <div >
                              <img class=\"comment-pp\" src=\"". $_SESSION['user_img'] ."\" alt=\"Image de profil\">
                            </div>
                        
                            <form class=\"form\" name=\"form\" method=\"POST\" action=\"script_php/comment_orga.php?organisateur=". $_GET['organisateur'] ."\">
                              <div class=\"form-row\">
                                <textarea
                                          class=\"input\"
                                          ng-model=\"cmntCtrl.comment.text\"
                                          placeholder=\"AJOUTER UN COMMENTAIRE ...\"
                                          name=\"comment\"
                                          maxlength=\"500\"
                                          required></textarea>
                              </div>
                              <div class=\"form-row\">
                                <input type=\"submit\" value=\"COMMENTER\">
                              </div>
                            </form>
                            <div class=\"commCont\">");
                  }else{
                    echo("<h1 style=\"margin-top:20px;\"><a href=\"connexion\" class=\"underline\">Connectez-vous</a> pour commenter.</h1>
                    <div class=\"commCont\">");
                  }
                    $comm = "SELECT * FROM commentorganiser WHERE commentorganiser_organiser_id = ". $_GET['organisateur'] ." ORDER BY commentorganiser_date DESC;";
                    $statement3 = $pdo->query($comm);
                    $commentaire = $statement3->fetchAll();
                    if(isset($_GET['page'])){
                      if($_GET['page'] > 0){
                        $page = $_GET['page'];
                      }else{
                        $page = 1;
                      }
                    }else{
                      $page = 1;
                    }
                    for($i=(($page-1)*10); $i<($page*10) && $i < $statement3->rowCount();$i++){
                      $username = "SELECT user_username FROM user WHERE user_id = ". $commentaire[$i]['commentorganiser_user_id'] .";";
                      $statement4 = $pdo->query($username);
                      if($statement4->rowCount() > 0){
                        $user = $statement4->fetch();
                        $user_username = $user['user_username'];
                      }else{
                        $user_username = "Utilisateur supprimé";
                      }
                      $comtimeint = explode(" ",$commentaire[$i]['commentorganiser_date']);
                      $com = explode("-",$comtimeint[0]);
                      $timecom = explode(":",$comtimeint[1]);
                      $datecom = $com[2]."/".$com[1]."/".$com[0]." | ".$timecom[0].":".$timecom[1].":".$timecom[2];
                      echo ("<div class=\"commentBody\">
                      <div class=\"commentHeader\">
                        <a href=\"organisateur?organisateur=". $commentaire[$i]['commentorganiser_user_id'] ."\"><div class=\"commentUser\">
                          ". $user_username ."
                        </div></a>
                        <div class=\"commentDate\">
                          ". $datecom ."
                        </div>
                      </div>
                      <div class=\"commentText\">
                      ". $commentaire[$i]['commentorganiser_content'] ."
                      </div>
                    </div>");
                    }
                    if($statement3->rowCount()>10){
                      if($page == 1){
                        echo("<div class=\"gridComm\"><div></div><div class=\"pageNum\">Page ".$page."</div><a class=\"pageBtn\" href=\"organisateur?organisateur=". $_GET['organisateur'] ."&page=". $page+1 ."\" >&rarr;</a></div>");
                      }elseif($page > 1 && $i < $statement3->rowCount()){
                        echo("<div class=\"gridComm\"><a class=\"pageBtn\" href=\"organisateur?organisateur=". $_GET['organisateur'] ."&page=". $page-1 ."\" >&larr;</a><div class=\"pageNum\">Page ".$page."</div>
                        <a class=\"pageBtn\" href=\"organisateur?organisateur=". $_GET['organisateur'] ."&page=". $page+1 ."\" >&rarr;</a></div>");
                      }else{
                        echo("<div class=\"gridComm\"><a class=\"pageBtn\" href=\"organisateur?organisateur=". $_GET['organisateur'] ."&page=". $page-1 ."\" >&larr;</a><div class=\"pageNum\">Page ".$page."</div><div></div></div>");
                      }
                    }
                    echo ("</div>
                          </div>
                          <div class=\"star\">
                            <h3 class=\"starTitle\">Note : ". $final ."/5</h3>");
                    if($logged_in){
                      echo("
                            <form class=\"starCont\" method=\"POST\" action=\"script_php/rating.php?organisateur=". $_GET['organisateur'] ."\">
                              <fieldset class=\"rate\">
                                <input type=\"radio\" id=\"rating10\" name=\"rating\" value=\"10\" /><label for=\"rating10\" title=\"5 stars\"></label>
                                <input type=\"radio\" id=\"rating9\" name=\"rating\" value=\"9\" /><label class=\"half\" for=\"rating9\" title=\"4 1/2 stars\"></label>
                                <input type=\"radio\" id=\"rating8\" name=\"rating\" value=\"8\" /><label for=\"rating8\" title=\"4 stars\"></label>
                                <input type=\"radio\" id=\"rating7\" name=\"rating\" value=\"7\" /><label class=\"half\" for=\"rating7\" title=\"3 1/2 stars\"></label>
                                <input type=\"radio\" id=\"rating6\" name=\"rating\" value=\"6\" /><label for=\"rating6\" title=\"3 stars\"></label>
                                <input type=\"radio\" id=\"rating5\" name=\"rating\" value=\"5\" /><label class=\"half\" for=\"rating5\" title=\"2 1/2 stars\"></label>
                                <input type=\"radio\" id=\"rating4\" name=\"rating\" value=\"4\" /><label for=\"rating4\" title=\"2 stars\"></label>
                                <input type=\"radio\" id=\"rating3\" name=\"rating\" value=\"3\" /><label class=\"half\" for=\"rating3\" title=\"1 1/2 stars\"></label>
                                <input type=\"radio\" id=\"rating2\" name=\"rating\" value=\"2\" /><label for=\"rating2\" title=\"1 star\"></label>
                                <input type=\"radio\" id=\"rating1\" name=\"rating\" value=\"1\" /><label class=\"half\" for=\"rating1\" title=\"1/2 star\"></label>
                            </fieldset>
                                <div class=\"form-row\">
                                  <input class=\"noter\" type=\"submit\" value=\"NOTER\">
                              </div>
                            </form>");
                    }else{
                      echo("<h1 style=\"margin-top:20px;\"><a href=\"connexion\" class=\"underline\">Connectez-vous</a> pour noter.</h1>
                      <div class=\"commCont\">");
                    }
                    echo("
                          </div>
                        </div>
                    </section>");
                }
              }else{
                echo ("<section class=\"content content-small\">
                <div class=\"container\">
                  <h1 class=\"gradient-text\">Organisateur</h1>
                </div>
              </section>
              <hr class=\"gradient\">
              <section class=\"subscribe\">
                <div style=\"height: 80%;margin-top: 100px;\" class=\"container\">
                  <h1>Cet utilisateur n'existe plus.</h1>
                </div>
              </section>");
              }
              
            ?>
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
    </body>
</html>
