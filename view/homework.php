<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cahier de Texte</title>
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
        <div class="container">
            <header>
                <h1>Cahier de Texte</h1>
                <div class="filters">
                    <button>Anglais</button>
                    <button>SAÉ 3.02-A</button>
                    <button>Motion design</button>
                    <button>Droit</button>
                    <button>SAÉ 3.01</button>
                </div>
            </header>
            <main class="task-list">
                <?php
                $stmt = showHomework($_SESSION['user_id']);
                $listHomework = $stmt->fetchall(PDO::FETCH_ASSOC);
                foreach ($listHomework as $work) {
                ?>
                    <div class="task">
                        <h3><?= $work['devoir_date_fin'] ?></h3>
                        <p><strong><?= $work['matiere_nom'] ?></strong></p>
                        <p><?= $work['devoir_nom'] ?></p>
                        <p><?= $work['devoir_desc'] ?></p>
                        <?php

                        if ($work['devoir_rendu'] == 0) {

                            echo '<a class="action-link rendre-link" href="control.php?action=pushHomework&idWork=' . $work['devoir_id'] . '">Rendre le devoir</a>';


                            if (isset($_GET['idWork']) && $_GET['idWork'] == $work['devoir_id']) {

                                echo '
                        <form action="control.php?action=uploadHomework&idWork=' . $work['devoir_id'] . '" method="POST" enctype="multipart/form-data" class="upload-form">
                            <input type="file" name="homework_file" required>
                            <button type="submit" class="action-link rendre-link">Déposer le fichier</button>
                        </form>';
                            }
                        } else {

                            echo "<a class='action-link modif-link' href='control.php?action=modifHomework&idWork=" . $work['devoir_id'] . "'>Modifier le devoir rendu</a>";
                        }
                        ?>
                    </div>
                <?php
                }
                ?>
            </main>
        </div>


</body>