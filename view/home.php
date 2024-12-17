<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <!--FONT AWESOME-->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <title>Home</title>
</head>

<body>
    <?php
    $stmt = saveInfoUser($email);
    $infoUser = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['user_id'] = $infoUser['user_id'];
    ?>
    <!-- <h1>Accueil</h1> -->

    <div class="sidebar">
        <div class="profile-section">
            <div class="profile-picture">
                <div class="profile-icon"></div>
            </div>
        </div>
        <div class="menu">
            <div class="menu-item active">
                <div class="icon">
                    <i class="fa-solid fa-house" style="color: #ffffff"></i>
                </div>
                <div class="text">Accueil</div>
            </div>
            <a href="control.php?action=showSchedule">
                <div class="menu-item">
                    <div class="icon timetable">
                        <i class="fa-regular fa-calendar-days" style="color: #000000"></i>
                    </div>
                    <div class="text">Emploi du temps</div>
                </div>
            </a>
            <a href="control.php?action=showHomework">
                <div class="menu-item">
                    <div class="icon text-book">
                        <i class="fa-solid fa-book" style="color: #000000"></i>
                    </div>
                    <div class="text">Cahier de texte</div>
                </div>
            </a>
            <a href="control.php?action=showNote">
                <div class="menu-item">
                    <div class="icon notes">
                        <i class="fa-regular fa-newspaper" style="color: #000000"></i>
                    </div>
                    <div class="text">Notes</div>
                </div>
            </a>
            <a href="control.php?action=showAbsence">
                <div class="menu-item">
                    <div class="icon attendance">
                        <i class="fa-solid fa-graduation-cap" style="color: #000000"></i>
                    </div>
                    <div class="text">Absences/Retards</div>
                </div>
            </a>
            <a href="control.php?action=showChat">
                <div class="menu-item">
                    <div class="icon chat">
                        <i class="fa-regular fa-comments" style="color: #000000"></i>
                    </div>
                    <div class="text">Chat rapide</div>
                </div>
            </a>
            <a href="control.php?action=showCloud">
                <div class="menu-item">
                    <div class="icon cloud">
                        <i class="fa-solid fa-cloud" style="color: #000000"></i>
                    </div>
                    <div class="text">Cloud</div>
                </div>
            </a>
            <a href="control.php?action=showCash">
                <div class="menu-item">
                    <div class="icon wallet">
                        <i
                            class="fa-solid fa-money-check-dollar"
                            style="color: #000000"></i>
                    </div>
                    <div class="text">Porte monnaie</div>
                </div>
            </a>
            <a href="control.php?action=deConnect">
                <div class="menu-item logout">
                    <div class="icon">
                        <i
                            class="fa-solid fa-arrow-right-from-bracket"
                            style="color: #000000"></i>
                    </div>
                    <div class="text">Déconnexion</div>

                </div>
            </a>
        </div>
    </div>

</body>

</html>