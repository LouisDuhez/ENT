<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BackOffice - ENT</title>
    <link rel="shortcut icon" type="image/png" href="./images/icon.png">
    <link rel="stylesheet" href="./style.css">
</head>
<body>

<div class="sidebar">
    <div class="profile-section">
        <div class="profile-picture">
            <div class="profile-icon"></div>
        </div>
    </div>

    <nav class="menu">
        <a href="view/home.php">
            <div class="menu-item active">
                <div class="icon">
                    <i class="fa-solid fa-house"></i>
                </div>
                <div class="text">Accueil</div>
            </div>
        </a>

        <h1>BackOffice</h1>
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

        <a href="control.php?action=backAddHomework">
            <div class="menu-item">
                <div class="icon">
                    <i class="fa-solid fa-book"></i>
                </div>
                <div class="text">Ajouter des devoirs</div>
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
</body>
</html>
