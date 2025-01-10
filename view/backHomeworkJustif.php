<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Devoirs Rendus</title>
<link rel="stylesheet" href="backAbsenceJustif.css">    </link>
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
            <div class="menu-item active">
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
        <h1>Liste des Devoirs Rendus</h1>
    
        <div class="table-container">
            <?php
            $stmt = getAllHomeworks();
            $listdevoir = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($listdevoir)): ?>
                <p class="center">Aucun devoir rendu pour le moment</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Étudiant</th>
                            <th>Matière</th>
                            <th>Description</th>
                            <th>Date de fin</th>
                            <th>Fichier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listdevoir as $devoir): ?>
                            <tr>
                                <td><?= htmlspecialchars($devoir['user_nom']) . " " . htmlspecialchars($devoir['user_prenom']) ?></td>
                                <td><?= htmlspecialchars($devoir['matiere_nom']) ?></td>
                                <td><?= htmlspecialchars($devoir['devoir_desc']) ?></td>
                                <td><?= htmlspecialchars($devoir['devoir_date_fin']) ?></td>
                                <td>
                                    <?php if (!empty($devoir['devoir_fichier'])): ?>
                                        <a href="homeWorkUpload/<?= htmlspecialchars($devoir['devoir_fichier']) ?>" target="_blank">Voir le fichier</a>
                                    <?php else: ?>
                                        Aucun fichier
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
<script src="script.js"></script>
</body>
</html>