<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un devoir</title>
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
        <!-- Accueil link -->
        <a href="control.php?action=home">
                  <div class="menu-item">
                    <div class="icon">
                      <i class="fa-solid fa-house"></i>
                    </div>
                    <div class="text">Accueil</div>
                  </div>
              </a>

        <!-- BackOffice links -->
        <a href="control.php?action=backAddNote">
            <div class="menu-item">
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
            <div class="menu-item active">
                <div class="icon">
                    <i class="fa-solid fa-book"></i>
                </div>
                <div class="text">Ajouter des devoirs</div>
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
            <form action="control.php?action=addHomework" method="POST" enctype="multipart/form-data">
            <h1>Ajouter un devoir</h1>
                <div>
                    <label for="devoir_nom">Nom du devoir :</label>
                    <input type="text" id="devoir_nom" name="devoir_nom" required>
                </div>
                <div>
                    <label for="devoir_desc">Description du devoir :</label>
                    <textarea id="devoir_desc" name="devoir_desc" required></textarea>
                </div>
                <div>
                    <label for="devoir_date_fin">Date de fin :</label>
                    <input type="date" id="devoir_date_fin" name="devoir_date_fin" required>
                </div>
                <div>
                    <label for="fk_matiere_id">Matière :</label>
                    <select id="fk_matiere_id" name="fk_matiere_id" required>
                        <?php
                        $db = dbConnect();
                        $stmt = $db->query('SELECT matiere_id, matiere_nom FROM matiere');
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $row['matiere_id'] . '">' . $row['matiere_nom'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
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
                    <button type="submit">Ajouter le devoir</button>
                </div>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>