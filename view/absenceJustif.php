<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="backAbsenceJustif.css">    </link>
    <title>Liste des Absences</title>
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
            <div class="menu-item active">
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
        <h1>Liste des Absences</h1>
        
        <table>
            <thead>
                <tr>
                    <th>Étudiant</th>
                    <th>Matière</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Durée</th>
                    <th>Justificatif</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $absences = showAllAbsences();
        
                if (empty($absences)): ?>
                    <tr>
                        <td colspan="7" class="center">Aucune absence à justifier</td>
                    </tr>
                <?php else:
                    foreach ($absences as $absence):
                        $duree = calculerTemps($absence['abs_date_debut'], $absence['abs_date_fin']);
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($absence['user_nom']) . " " . htmlspecialchars($absence['user_prenom']) ?></td>
                            <td><?= htmlspecialchars($absence['matiere_nom']) ?></td>
                            <td><?= htmlspecialchars($absence['abs_date_debut']) ?></td>
                            <td><?= htmlspecialchars($absence['abs_date_fin']) ?></td>
                            <td><?= gmdate("H:i:s", $duree) ?></td>
                            <td>
                                <?php if (!empty($absence['abs_justif_file'])): ?>
                                    <a href="absence_justif/<?= htmlspecialchars($absence['abs_justif_file']) ?>" target="_blank">Voir le fichier</a>
                                <?php else: ?>
                                    Aucun fichier
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($absence['abs_justif_valid'] == 1): ?>
                                    <strong>Justifiée</strong>
                                <?php elseif ($absence['abs_justif'] == 1): ?>
                                    <form action="control.php?action=validateAbsence" method="POST">
                                        <input type="hidden" name="absence_id" value="<?= htmlspecialchars($absence['abs_id']) ?>">
                                        <button type="submit" class="btn">Valider</button>
                                    </form>
                                <?php else: ?>
                                    Non justifiée
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach;
                endif; ?>
            </tbody>
        </table>
    </div>
</div>
<script src="script.js"></script>
</body>
</html>