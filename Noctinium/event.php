<?php
    require './script_php/database-connection.php';
    require './script_php/sessions.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="asset/style.css">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
      <meta charset="utf-8" />
      <link rel="stylesheet" href="asset/event.css">
      <title>Évènement</title>
      <link rel="icon" href="image/logo_noctinium_16x16.png">
    </head>
    <body>
        <header>
            <a href="index.php"><img class="logo" id="logo" src="image/logo_noctinium.webp" alt="Logo"></a>
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
        <section class="subscribe">
            <?php
              if (isset($_GET['event'])){
                $event_id = $_GET['event'];

                $sql = "SELECT * FROM events WHERE event_id = '". $event_id ."';";
        
                $statement = $pdo->query($sql);
                if ($statement->rowCount() == 0){
                  echo ("<div style=\"height: 80%;margin-top: 100px;\" class=\"adresseEvent\"><h1>L'évènement sélectionné n'existe pas.<br><br>Veuillez réessayer.</h1></div></section>");
                }else{
                  $event = $statement->fetch();
                  $event_description = htmlspecialchars($event['event_description'], ENT_QUOTES, 'utf-8');

                  $image = "SELECT imageevent_url FROM imageevent WHERE imageevent_id = '". $event['event_imageevent_id'] ."';";
                  $statement2 = $pdo->query($image);
                  $image_event = $statement2->fetch();

                  $orga = "SELECT user_username FROM user WHERE user_id = '". $event['event_user_id'] ."';";
                  $statement3 = $pdo->query($orga);
                  
                  if($statement3->rowCount() > 0){
                    $organisateur = $statement3->fetch();
                  }else{
                    $organisateur['user_username'] = "Utilisateur supprimé";
                  }

                  $today = date('Y-m-d H:i:s');
                  if($event['event_maskedlocation'] > $today ){
                    $adresse = "Adresse masquée jusqu'au ".$event['event_maskedlocation'];
                  }else{
                    $adresse = $event['event_location'];
                  }

                  echo ("
                  <div class=\"eventCont\">
                    <div class=\"returnBtnCont\">
                      <a title=\"Retour\" class=\"returnBtn\" onclick=\"history.back()\">&#60;</a>
                    </div>
                    <div class=\"titreEvent\">". $event['event_title'] ."</div>
                  <div class=\"eventGrid\">
                    <img class=\"imgEvent\" src=\"". $image_event['imageevent_url'] ."\" alt=\"Image de l'évènement\">
                    <div class=\"infoSup\">
                      <span class=\"dateEvent\">". $event['event_datetime'] ."</span>
                      <div class=\"adresseEvent\">". $adresse ."</div>
                      <div class=\"userEvent\"><a href=\"organisateur.php?organisateur=". $event['event_user_id'] ."\">". $organisateur['user_username'] ."</a></div>
                    </div>
                  </div>
                  <div class=\"blog-slider__content infoCont\">
                    <div class=\"txtEvent\">". $event_description ."</div>
                    <a href=\"map.php?event=". $event_id ."\" class=\"btnEvent\">TROUVER L'ÉVENEMENT</a>
                  </div>
                  </div>
                  </section>");
                  if($logged_in){
                    echo ("<hr class=\"gradient\">
                      <section class=\"attends\">
                        <div class=\"interaction\">
                          <div class=\"comment-form\">
                            <!-- Comment Avatar -->
                            <div >
                              <img class=\"comment-pp\" src=\"". $_SESSION['user_img'] ."\" alt=\"Image de profil\">
                            </div>
                        
                            <form class=\"form\" name=\"form\" method=\"POST\" action=\"script_php/comment_event.php?event=". $event_id ."\">
                              <div class=\"form-row\">
                                <textarea
                                          class=\"input\"
                                          ng-model=\"cmntCtrl.comment.text\"
                                          placeholder=\"COMMENTAIRE\"
                                          name=\"comment\"
                                          maxlength=\"500\"
                                          required></textarea>
                              </div>
                              <div class=\"form-row\">
                                <input type=\"submit\" value=\"COMMENTER\">
                              </div>
                            </form>
                            <div class=\"commCont\">");
                            $comm = "SELECT * FROM commentevent WHERE commentevent_events_id = ". $event_id ." ORDER BY commentevent_date DESC;";
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
                              $username = "SELECT user_username FROM user WHERE user_id = ". $commentaire[$i]['commentevent_user_id'] .";";
                              $statement4 = $pdo->query($username);
                              if($statement4->rowCount() > 0){
                                $user = $statement4->fetch();
                                $user_username = $user['user_username'];
                              }else{
                                $user_username = "Utilisateur supprimé";
                              }
                              echo ("<div class=\"commentBody\">
                              <div class=\"commentHeader\">
                                <a href=\"organisateur.php?organisateur=". $commentaire[$i]['commentevent_user_id'] ."\"><div class=\"commentUser\">
                                  ". $user_username ."
                                </div></a>
                                <div class=\"commentDate\">
                                  ". $commentaire[$i]['commentevent_date'] ."
                                </div>
                              </div>
                              <div class=\"commentText\">
                              ". $commentaire[$i]['commentevent_content'] ."
                              </div>
                            </div>");
                            }
                            if($statement3->rowCount()>10){
                              if($page == 1){
                                echo("<div class=\"gridComm\"><div></div><div class=\"pageNum\">Page ".$page."</div><a class=\"pageBtn\" href=\"organisateur.php?organisateur=". $event_id ."&page=". $page+1 ."\" >&rarr;</a></div>");
                              }elseif($page > 1 && $i < $statement3->rowCount()){
                                echo("<div class=\"gridComm\"><a class=\"pageBtn\" href=\"organisateur.php?organisateur=". $event_id."&page=". $page-1 ."\" >&larr;</a><div class=\"pageNum\">Page ".$page."</div>
                                <a class=\"pageBtn\" href=\"organisateur.php?organisateur=". $event_id ."&page=". $page+1 ."\" >&rarr;</a></div>");
                              }else{
                                echo("<div class=\"gridComm\"><a class=\"pageBtn\" href=\"organisateur.php?organisateur=". $event_id ."&page=". $page-1 ."\" >&larr;</a><div class=\"pageNum\">Page ".$page."</div><div></div></div>");
                              }
                            }
                    echo ("
                            </div>
                          </div>
                          
                        </div>
                      </section>
                    ");
                  }else{
                    echo ("<hr class=\"gradient\">
                    <section class=\"attends\">
                    <div style=\"width: 100%;\" class=\"container\">
                      <h1>Connectez-vous pour commenter.</h1>
                    </div>
                    </section>");
                  }
                }
              }else{
                echo ("<div style=\"height: 80%;margin-top: 100px;\" class=\"adresseEvent\"><h1>L'évènement sélectionné n'existe pas.<br><br>Veuillez réessayer.</h1></div></section>");
              }
              
            ?>
        <?php
          include './script_php/footer.php'
        ?>
		<script>
      var element = document.getElementById("logo")
      var cont = document.querySelector(".eventCont")
			if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
        element.classList.toggle("logo");
        element.classList.toggle("logo-M");
        cont.classList.toggle("eventCont");
        cont.classList.toggle("eventCont-M");
      }
		</script>
    </body>
</html>
