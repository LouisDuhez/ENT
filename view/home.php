<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css"> 
    <title>Accueil</title>
</head>

<body>
    <?php
    
    $stmt = saveInfoUser($_SESSION['user']);
    $infoUser = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['user_id'] = $infoUser['user_id'];
    ?>

    <!-- Sidebar -->
    <!-- ------------------------ Début menu ------------------------------- -->
    <div class="page">
        <div class="burger-menu">
            <button id="menu-toggle">
              <i class="fa-solid fa-bars"></i>
            </button>
          </div>
          <div class="sidebar">
            <div class="close-button">
              <i class="fa-solid fa-times"></i>
            </div>
            <div class="profile-section">
              <div class="profile-picture">
                <div class="profile-icon"></div>
              </div>
            </div>
            <nav class="menu">
              <a href="control.php?action=home">
                  <div class="menu-item active">
                    <div class="icon">
                      <i class="fa-solid fa-house"></i>
                    </div>
                    <div class="text">Accueil</div>
                  </div>
              </a>
              <a href="control.php?action=showSchedule">
                <div class="menu-item">
                  <div class="icon timetable">
                    <i class="fa-regular fa-calendar-days"></i>
                  </div>
                  <div class="text">Emploi du temps</div>
                </div>
              </a>
              <a href="control.php?action=showHomework">
                <div class="menu-item">
                  <div class="icon text-book">
                    <i class="fa-solid fa-book"></i>
                  </div>
                  <div class="text">Cahier de texte</div>
                </div>
              </a>
              <a href="control.php?action=showNote">
                <div class="menu-item">
                  <div class="icon notes">
                    <i class="fa-regular fa-newspaper"></i>
                  </div>
                  <div class="text">Notes</div>
                </div>
              </a>
              <a href="control.php?action=showAbsence">
                <div class="menu-item">
                  <div class="icon attendance">
                    <i class="fa-solid fa-graduation-cap"></i>
                  </div>
                  <div class="text">Absences/Retards</div>
                </div>
              </a>
              <a href="control.php?action=showChat">
                <div class="menu-item">
                  <div class="icon chat">
                    <i class="fa-regular fa-comments"></i>
                  </div>
                  <div class="text">Chat rapide</div>
                </div>
              </a>
              <a href="control.php?action=showCloud">
                <div class="menu-item">
                  <div class="icon cloud">
                    <i class="fa-solid fa-cloud"></i>
                  </div>
                  <div class="text">Cloud</div>
                </div>
              </a>
              <a href="control.php?action=showCash">
                <div class="menu-item">
                  <div class="icon wallet">
                    <i class="fa-solid fa-money-check-dollar"></i>
                  </div>
                  <div class="text">Porte monnaie</div>
                </div>
              </a>
              <?php
                 $stmt = userIsAdmin($_SESSION['user']);
                 $infoUser = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($infoUser['user_admin'] == 1) {
                    ?>
                    <a href="control.php?action=showBackOffice">
                    <div class="menu-item">
                        <div class="icon wallet">
                        <i class="fa-solid fa-lock"></i>
                        </div>
                        <div class="text">Admin</div>
                    </div>
                </a>
                <?php
                }
        
                ?>
              <a href="control.php?action=deConnect">
                <div class="menu-item logout">
                  <div class="icon">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                  </div>
                  <div class="text">Déconnexion</div>
                </div>
              </a>
            </nav>
          </div>
          <!-- ------------------------ Fin menu ------------------------------- -->
        <!-- Main Content -->
        <section class="container">
          <div class="top-container">
            <div class="trait-blanc"></div>
            <h1>Accueil</h1>
            <div class="trait-blanc"></div>
            
          </div>
          <div class="grid-container">
              <div class="homework">
              <div class="top-item">
                  <h2>Travaux à rendre</h2>
                  <a href="control.php?action=showHomework">Voir plus de travaux <i class="fa-solid fa-plus"></i>  </a>
                </div>
                <div class="homework-container">
                  <?php
                    $stmt = showHomework($_SESSION['user_id']);
                   $listwork = $stmt->fetchAll(PDO::FETCH_ASSOC);
                   foreach ($listwork as $work) {
                    ?>
                    <div class="work-container">
                      <div class="work-title"><?= $work['devoir_nom']?>
                        <p><?= $work['devoir_desc']?></p>
                        <p><?= $work['devoir_date_fin']?></p>
                      </div>
                    </div>
                    <?php
                   }
                
              ?>
              </div>
              </div>
              <div class="absences">
              <div class="top-item">
                  <h2>Absences </h2>
                  <a href="control.php?action=showAbsence">Toutes les absences <i class="fa-solid fa-plus"></i>  </a>
                </div>
                  <?php
                  setlocale(LC_TIME, 'fr');
                  $stmt = showAbsence($_SESSION['user_id']);
                  $listabs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  foreach ($listabs as $abs) {
                    ?>

                      <div class="abs-container">
                          <div class="abs-title">
                              <?php
                              $date_debut = new DateTime($abs['abs_date_debut']);
                              

                              $jour = $date_debut->format('l'); 
                              $jour = ucfirst($jour); 

                              $mois = $date_debut->format('F'); 
                              $mois = ucfirst($mois); 
                              
                              $jours_francais = [
                                  'Monday' => 'Lundi', 'Tuesday' => 'Mardi', 'Wednesday' => 'Mercredi',
                                  'Thursday' => 'Jeudi', 'Friday' => 'Vendredi', 'Saturday' => 'Samedi', 'Sunday' => 'Dimanche'
                              ];

                              $mois_francais = [
                                  'January' => 'Janvier', 'February' => 'Février', 'March' => 'Mars',
                                  'April' => 'Avril', 'May' => 'Mai', 'June' => 'Juin', 'July' => 'Juillet',
                                  'August' => 'Août', 'September' => 'Septembre', 'October' => 'Octobre',
                                  'November' => 'Novembre', 'December' => 'Décembre'
                              ];

                              // Remplacement en français
                              $jour = $jours_francais[$jour];
                              $mois = $mois_francais[$mois];

                              // Formater la date avec les parties en français
                              echo "{$jour}, " . $date_debut->format('d') . " {$mois} " . $date_debut->format('Y') . " à " . $date_debut->format('H:i');
                              ?>
                          </div>
                          <div class="abs-info">
                              <p><?= $abs['abs_desc']?>/20</p>
                              <p>
                                  <?php
                                  if ($abs['abs_justif'] == 1) {
                                      if ($abs['abs_justif_valid'] == 1) {
                                          echo "Absence Justifiée";
                                      } else {
                                          echo "En attente de validation";
                                      }
                                  } else {
                                      echo "Absence Non Justifiée";
                                  }
                                  ?>
                              </p>
                          </div>
                      </div>

                    <?php
                  }

                  ?>
              </div>
              <div class="note">
              <div class="top-item">
                  <h2>Notes : </h2>
                  <a href="control.php?action=showNote">Voir plus de notes <i class="fa-solid fa-plus"></i>  </a>
                </div>
                  <?php
                  $stmt = showNote($_SESSION['user_id']);
                  $listNote = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  foreach ($listNote as $note) {
                    ?>

                    <div class="note-container">
                      <div class="note-title"><?= $note['matiere_nom']?>
                      <div class="note-info">
                        <p><?= $note['note_number']?>/20</p>
                        <p><?= $note['note_name']?></p>
                      </div>
                      </div>
                    </div>

                    <?php
                  }

                  ?>
              </div>
              <div class="schedule">
                <div class="top-item">
                  <h2>EDT : </h2>
                  <a href="control.php?action=showSchedule">EDT de la semaine <i class="fa-solid fa-plus"></i>  </a>
                </div>
                <div class="schedule-container">
                  <?php
                  $icsUrl = 'https://edt.univ-eiffel.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=1486&projectId=26&calType=ical&nbWeeks=4';
                  $events = parseICS($icsUrl);
                  
                  if (is_string($events)) {
                      echo $events;
                      return;
                  }
                  
                  $targetDate = date('d/m/Y');
                  
                  $filteredEvents = filterEventsByDay($events, $targetDate);
                  ?>
                  <div class="edt-container">
                  
                      <table style='width:100%; text-align:center;'>
                          <tr><th>Événements du jour</th></tr>
                          <?php if (!empty($filteredEvents)): ?>
                              <?php foreach ($filteredEvents as $event): ?>
                                  <?php
                                      $start = date('H:i', strtotime($event['DTSTART']));
                                      $end = date('H:i', strtotime($event['DTEND']));
                                      $summary = $event['SUMMARY'] ?? 'Sans titre';
                                      $location = $event['LOCATION'] ?? 'N/A';
                                      $color = getEventColor($summary);
                                  ?>
                                  <tr>
                                      <td style="padding:10px;">
                                          <div style="margin-bottom:10px; padding:8px; border:1px solid #ddd; background-color:<?= $color ?>;">
                                              <strong><?= $summary ?></strong><br>
                                              <?= $start ?> - <?= $end ?><br>
                                              <em><?= $location ?></em>
                                          </div>
                                      </td>
                                  </tr>
                              <?php endforeach; ?>
                          <?php else: ?>
                              <tr><td>Aucun événement aujourd'hui</td></tr>
                          <?php endif; ?>
                      </table>
                  </div>
                                </div>
                </div>
            </div>
          </div>
        </section>
    </div>
    <script src="script.js"></script>
</body>

</html>