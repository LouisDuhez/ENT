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
            <?php
             $stmt = userIsAdmin($_SESSION['user']);
             $infoUser = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($infoUser['user_admin'] == 1) {
                ?>
                <a href="control.php?action=showBackOffice">
                <div class="menu-item">
                    <div class="icon wallet">
                        <i class="fa-solid fa-money-check-dollar"></i>
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

    <!-- Main Content -->
    <section class="main-content">
        <div class="header">
            <h1>Accueil</h1>
        </div>
        <div class="container">
            <!-- Contenu ici -->
        </div>
    </section>

</body>

</html>