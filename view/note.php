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
                <div class="top-container">
                <div class="trait-blanc"></div>
                  <h1>Notes</h1>
                  <div class="trait-blanc"></div>
                </div>
                <?php
$user_id = $_SESSION['user_id'];
$competences = [1, 2, 3, 4, 5]; // ID des compétences
echo "<div class='tableNote'>";

foreach ($competences as $competence_id) {
    // Récupérer le nom de la compétence
    $db = dbConnect();
    $stmt = $db->prepare("SELECT competence_nom FROM competence WHERE competence_id = :competence_id");
    $stmt->bindParam(":competence_id", $competence_id, PDO::PARAM_INT);
    $stmt->execute();
    $competence = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifie si la compétence existe
    if ($competence) {
        echo "<h2>Compétence : {$competence['competence_nom']}</h2>";
    } else {
        echo "<h2>Compétence inconnue (ID : $competence_id)</h2>";
        continue;
    }

    // Récupérer les notes pour cette compétence
    $notes = showNoteCompetence($user_id, $competence_id);

    // Initialisation des variables pour la moyenne générale de la compétence
    $total_moyenne_competence = 0;
    $total_coef_competence = 0;

    echo "<table border='1'>
            <tr>
              <th>Matière</th>
              <th>Coefficient</th>
              <th>Notes</th>
              <th>Moyenne</th> <!-- Colonne pour la moyenne -->
            </tr>";

    while ($row = $notes->fetch(PDO::FETCH_ASSOC)) {
        // Récupérer la chaîne des notes
        $notes_string = $row['notes'];  // Exemple: "15<sup>1</sup>, 5<sup>1</sup>"

        // Initialisation des variables pour la somme des notes pondérées et des coefficients
        $note_number = 0;
        $note_coef = 0;

        // Séparer la chaîne en éléments individuels (notes et coefficients)
        $notes_array = explode(", ", $notes_string);

        // Parcourir chaque élément (note avec son coefficient)
        foreach ($notes_array as $note) {
            // Utiliser une expression régulière pour extraire la note et le coefficient
            preg_match('/(\d+)<sup>(\d+)<\/sup>/', $note, $matches);

            // Si une correspondance est trouvée, on récupère la note et le coefficient
            if (isset($matches[1]) && isset($matches[2])) {
                $note_value = (int)$matches[1];      // La note
                $coef_value = (int)$matches[2];      // Le coefficient

                // Ajouter la note pondérée à la somme
                $note_number += $note_value * $coef_value;
                // Ajouter le coefficient à la somme des coefficients
                $note_coef += $coef_value;
            }
        }

        // Calcul de la moyenne pondérée pour la matière
        if ($note_coef > 0) {
            $moyenne_matiere = $note_number / $note_coef;
        } else {
            $moyenne_matiere = 0;  // Si aucun coefficient n'est trouvé, la moyenne est 0
        }

        // Ajouter la moyenne pondérée de la matière à la somme des moyennes pondérées de la compétence
        $total_moyenne_competence += $moyenne_matiere * $note_coef;
        // Ajouter le coefficient de la matière à la somme des coefficients de la compétence
        $total_coef_competence += $note_coef;

        // Affichage de la ligne du tableau avec la moyenne pour chaque matière
        echo "<tr>
                <td>{$row['matiere_nom']}</td>
                <td>{$row['note_coef']}</td>
                <td>{$row['notes']}</td>
                <td>" . number_format($moyenne_matiere, 2) . "</td> <!-- Moyenne par matière -->
              </tr>";
    }

    // Calcul de la moyenne générale pour la compétence
    if ($total_coef_competence > 0) {
        $moyenne_competence = $total_moyenne_competence / $total_coef_competence;
    } else {
        $moyenne_competence = 0;  // Si aucun coefficient n'est trouvé, la moyenne est 0
    }

    // Affichage de la moyenne générale de la compétence
    echo "<tr>
            <td colspan='3'>Moyenne générale de la compétence</td>
            <td>" . number_format($moyenne_competence, 2) . "</td>
          </tr>";

    echo "</table>";
}

echo "</div>";
?>
                
            
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>