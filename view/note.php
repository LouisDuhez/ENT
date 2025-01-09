<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes - ENT</title>
    <link rel="stylesheet" href="./notes.css">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
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
                <div class="menu-item active">
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
            <div class="table">
                <h1>Notes</h1>
                <table class="table-notes">
                    <thead>
                        <tr>
                            <th>Compétences</th>
                            <th>Matières</th>
                            <th>Coefficients</th>
                            <th>Moyennes</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $competences = [1, 2, 3, 4, 5];
                        $competence_notes = [];
                        foreach ($competences as $competence_id) {
                            $stmt = showNoteCompetence($_SESSION['user_id'], $competence_id);
                            $listNote = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            // Organiser les matières et notes sous chaque compétence
                            if (count($listNote) > 0) {
                                foreach ($listNote as $note) {
                                    $competence_notes[$note['competence_nom']][] = $note;
                                }
                            }
                        }
                        // Affichage des compétences et des matières avec leurs notes
                        foreach ($competence_notes as $competence_nom => $notes) {
                            foreach ($notes as $note) {
                                echo "<tr>";
                                echo "<td>" . $competence_nom . "</td>";
                                echo "<td>" . $note['matiere_nom'] . "</td>";
                                echo "<td>" . $note['note_coef'] . "</td>";
                                echo "<td>" . $note['note_number'] . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="footer-label">Moyenne générale</td>
                            <td>
                                <?php
                                // Calcul de la moyenne générale (ajuster selon la logique du calcul)
                                $total_notes = 0;
                                $total_coefficients = 0;
                                foreach ($competence_notes as $notes) {
                                    foreach ($notes as $note) {
                                        $total_notes += $note['note_number'] * $note['note_coef'];
                                        $total_coefficients += $note['note_coef'];
                                    }
                                }
                                $moyenne_generale = $total_notes / $total_coefficients;
                                echo round($moyenne_generale, 2);
                                ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>