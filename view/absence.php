<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absence</title>
    <link rel="stylesheet" href="style_homework.css" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
</head>

<body>
    <div class="page">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="profile-section">
                <div class="profile-picture">
                    <div class="profile-icon"></div>
                </div>
            </div>
            <nav class="menu">
                <div class="menu-item active">
                    <div class="icon">
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <div class="text">Accueil</div>
                </div>
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
        <!-- Main content -->
        <div class="container">
            <header>
                <h1>Absence</h1>
                <div class="filters"></div>
            </header>
            <main class="task-list">
        
                    <?php
                    $stmt = showAbsence($_SESSION['user_id']);
                    $listAbsence = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $tempTotal = 0;
                    $tempJustifie = 0;
                    $tempNonJustifie = 0;
                    $nbAbsence = 0;
                    foreach ($listAbsence as $absence):
                        $tempsAbsence = calculerTemps($absence['abs_date_debut'], $absence['abs_date_fin']);
                        $tempTotal += $tempsAbsence;
                        $nbAbsence++;
                        if ($absence['abs_justif'] == 1) {
                            $tempJustifie += $tempsAbsence;
                        } else {
                            $tempNonJustifie += $tempsAbsence;
                        }
                    ?>
                    <div class="task">
                        <p><strong>Date de début:</strong> <?= $absence['abs_date_debut'] ?></p>
                        <p><strong>Matière:</strong> <?= $absence['matiere_nom'] ?></p>
                        <p><strong>Description:</strong> <?= $absence['abs_desc'] ?></p>
                        <p><strong>Durée:</strong> <?= gmdate("H:i:s", $tempsAbsence) ?></p>
                        <?php if ($absence['abs_justif'] == 0): ?>
                            <form action="control.php?action=justifAbsence" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="absence_id" value="<?= htmlspecialchars($absence['abs_id']) ?>">
                                <label for="justif_file">Télécharger un justificatif :</label>
                                <input type="file" name="justif_file" required>
                                <button type="submit">Envoyer</button>
                            </form>
                        <?php else: ?>
                            <?php if ($absence['abs_justif_valid'] == 1): ?>
                                <p><strong>Status:</strong> Absence justifiée</p>
                            <?php else: ?>
                                <p><strong>Status:</strong> En attente de validation</p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </main>
        </div>
        <!-- Bloc des statistiques -->
        <div class="absence-info">
            <h3>Statistiques d'absences</h3>
            <ul>
                <li><strong>Nombre total d'absences :</strong> <?= $nbAbsence ?></li>
                <li><strong>Temps total justifié :</strong> <?= gmdate("H:i:s", $tempJustifie) ?></li>
                <li><strong>Temps total non justifié :</strong> <?= gmdate("H:i:s", $tempNonJustifie) ?></li>
                <li><strong>Temps total :</strong> <?= gmdate("H:i:s", $tempTotal) ?></li>
            </ul>
        </div>
    </div>

</body>
</html>