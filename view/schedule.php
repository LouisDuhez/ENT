<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./schedule.css">
    <title>Emploi du temps</title>
</head>
<body>
<div class="page">
    <!-- ------------------------ Début menu ------------------------------- -->
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
                  <div class="menu-item">
                    <div class="icon">
                      <i class="fa-solid fa-house"></i>
                    </div>
                    <div class="text">Accueil</div>
                  </div>
              </a>
    
              <a href="control.php?action=showSchedule">
                <div class="menu-item active">
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
    
    
    
    
    
    
          <div class="container">
          <div class="top-container">
                  <div class="trait-blanc"></div>
                  <h1>Emploi&nbsp;du&nbsp;temps</h1>
                  <div class="trait-blanc"></div>
          </div>
    <div class="edt-container">
        <div class="edt-container-table">
          <?php
          date_default_timezone_set('Europe/Paris');
          // URL de ton iCalendar
          $icsUrl = 'https://edt.univ-eiffel.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=1486&projectId=26&calType=ical&nbWeeks=4';
          // Récupérer la semaine demandée (par défaut : semaine actuelle)
          $currentWeek = isset($_GET['week']) ? (int)$_GET['week'] : 0;
          // Empêcher currentWeek d'être négatif
          if ($currentWeek < 0) {
              $currentWeek = 0;
          }
          $startOfWeek = strtotime("monday this week +$currentWeek week");
          $endOfWeek = strtotime("sunday this week +$currentWeek week");
          // Récupérer et filtrer les événements
          $events = parseICS($icsUrl);
          $weekEvents = filterEventsByWeek($events, $startOfWeek, $endOfWeek);
          // Calcul des dates de la semaine
          $daysOfWeek = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
          $weekDates = [];
          for ($i = 0; $i < 7; $i++) {
              $weekDates[$i] = date('d/m/Y', strtotime("+$i day", $startOfWeek));
          }
          // Affichage HTML avec navigation par semaine
          echo "<h2 style='text-align: center;'>Semaine du " . date('d/m/Y', $startOfWeek) . " au " . date('d/m/Y', $endOfWeek) . "</h2>";
          // Navigation
          echo "<div style='margin-bottom: 20px; text-align: center;'>";
          if ($currentWeek > 0) {
              echo "<a href='control.php?action=showSchedule&week=" . ($currentWeek - 1) . "'>&laquo; Semaine précédente</a> | ";
          }
          echo "<a href='control.php?action=showSchedule&week=" . ($currentWeek + 1) . "'>Semaine suivante &raquo;</a>";
          echo "</div>";
          // Table d'affichage
          echo "<table border='1' style='width:100%; text-align:center;'>";
          echo "<tr>";
          foreach ($daysOfWeek as $index => $day) {
              $highlight = (date('d/m/Y') == $weekDates[$index]) ? "style='background-color:#fff; color:#000;'" : '';
              echo "<th $highlight>$day <br> {$weekDates[$index]}</th>";
          }
          echo "</tr>";
          // Affichage des événements pour chaque jour
          echo "<tr>";
          for ($i = 1; $i <= 7; $i++) {
              echo "<td style='vertical-align:top; padding:10px;'>";
              if (!empty($weekEvents[$i])) {
                  foreach ($weekEvents[$i] as $event) {
                      $start = date('H:i', strtotime($event['DTSTART']));
                      $end = date('H:i', strtotime($event['DTEND']));
                      $summary = $event['SUMMARY'] ?? 'Sans titre';
                      $location = $event['LOCATION'] ?? 'N/A';
                      $color = getEventColor($summary);
                      echo "<div style='margin-bottom:10px; padding:8px; border:1px solid #ddd; background-color:$color;'>";
                      echo "<strong>$summary</strong><br>";
                      echo "$start - $end<br>";
                      echo "<em>$location</em>";
                      echo "</div>";
                  }
              } else {
                  echo "Aucun événement";
              }
              echo "</td>";
          }
          echo "</tr>";
          echo "</table>";
          ?>
          </div>
        </div>
      
</div>
        </div>
</div>
<script src="script.js"></script>
</body>
</html>
