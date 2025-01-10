<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une absence</title>
<link rel="stylesheet" href="backAddAbsence.css">    </link>
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

        <a href="control.php?action=backAddNote">
            <div class="menu-item">
                <div class="icon">
                    <i class="fa-solid fa-pencil-alt"></i>
                </div>
                <div class="text">Ajouter des notes</div>
            </div>
        </a>

        <a href="control.php?action=backAddAbsence">
            <div class="menu-item active">
                <div class="icon">
                    <i class="fa-solid fa-calendar-times"></i>
                </div>
                <div class="text">Ajouter des absences</div>
            </div>
        </a>

       
        <a href="control.php?action=backJustifAbsence">
            <div class="menu-item">
                <div class="icon">
                    <i class="fa-solid fa-file-alt"></i>
                </div>
                <div class="text">Gérer les absences</div>
            </div>
        </a>

        <a href="control.php?action=backHomeworkJustif">
            <div class="menu-item">
                <div class="icon">
                    <i class="fa-solid fa-check-square"></i>
                </div>
                <div class="text">Voir les devoirs</div>
            </div>
        </a>

        <a href="control.php?action=backAddHomework">
            <div class="menu-item">
                <div class="icon">
                    <i class="fa-solid fa-book"></i>
                </div>
                <div class="text">Ajouter des devoirs</div>
            </div>
        </a>


        <!-- Déconnexion link -->
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
            <form method="POST" action="control.php?action=addAbsence">
            <h1>Ajouter une absence</h1>
                <label for="student">Étudiant :</label>
                <select name="student" id="student" required>
                    <?php
                    $stmt = showStudent();
                    $listStudent = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <?php foreach ($listStudent as $student): ?>
                        <option value="<?= htmlspecialchars($student['user_id']) ?>">
                            <?= htmlspecialchars($student['user_nom']) ?> <?= htmlspecialchars($student['user_prenom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label for="subject">Matière :</label>
                <select name="subject" id="subject" required>
                    <?php
                    $stmt = showMatiere();
                    $listMatiere = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <?php foreach ($listMatiere as $subject): ?>
                        <option value="<?= htmlspecialchars($subject['matiere_id']) ?>">
                            <?= htmlspecialchars($subject['matiere_nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label for="date">Date de l'absence :</label>
                <input type="date" name="date" id="date" required>
                <label for="end_date">Date de fin de l'absence :</label>
                <input type="date" name="end_date" id="end_date" required>
                <label for="description">Description du retard (facultatif) :</label>
                <textarea name="description" id="description"></textarea>
                <label for="justif">Justification :</label>
                <select name="justif" id="justif" required>
                    <option value="0">Non justifiée</option>
                    <option value="1">Justifiée</option>
                </select>
                <button type="submit">Ajouter l'absence</button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
