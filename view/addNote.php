
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="backAddAbsence.css">    </link>
    <title>Ajouter note - ENT</title>
    <link rel="shortcut icon" type="image/png" href="./images/icon.png">
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
        <!-- Accueil link -->
        <a href="control.php?action=home">
                  <div class="menu-item">
                    <div class="icon">
                      <i class="fa-solid fa-house"></i>
                    </div>
                    <div class="text">Accueil</div>
                  </div>
              </a>

        <a href="control.php?action=backAddNote">
            <div class="menu-item active">
                <div class="icon">
                    <i class="fa-solid fa-pencil-alt"></i>
                </div>
                <div class="text">Ajouter des notes</div>
            </div>
        </a>

        <a href="control.php?action=backAddAbsence">
            <div class="menu-item">
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
            <form method="POST" action="control.php?action=addNote">
            <h1>Ajouter une note</h1>
                <div>
                    <label for="user_id">Étudiant :</label>
                    <select name="user_id" id="user_id" required>
                        <?php
                        $stmt = showStudent();
                        $listStudent = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($listStudent as $student): ?>
                            <option value="<?= htmlspecialchars($student['user_id']) ?>">
                                <?= htmlspecialchars($student['user_nom']) ?> <?= htmlspecialchars($student['user_prenom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="matiere_id">Matière :</label>
                    <select name="matiere_id" id="matiere_id" required>
                        <?php
                        $stmt = showMatiere();
                        $listMatiere = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($listMatiere as $subject): ?>
                            <option value="<?= htmlspecialchars($subject['matiere_id']) ?>">
                                <?= htmlspecialchars($subject['matiere_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="note_value">Note :</label>
                    <input type="number" name="note_value" id="note_value" min="0" max="20" required>
                </div>
                <div>
                    <label for="note_coef">Coefficient :</label>
                    <input type="number" name="note_coef" id="note_coef" min="1" max="10" value="1" required>
                </div>
                <div>
                    <button type="submit">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
