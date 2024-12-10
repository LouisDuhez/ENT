<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <?php
        $stmt = saveInfoUser($email);
        $infoUser = $stmt -> fetch(PDO::FETCH_ASSOC);
        $_SESSION['user_id'] = $infoUser['user_id'];
    ?>
    <h1>Accueil</h1>
    <a href="control.php?action=deConnect">Déconnexion</a>
    <a href="control.php?action=showAbsence">Absence</a>
    <a href="control.php?action=showNote">Note</a>
    <a href="control.php?action=showSchedule">Emploi du temps</a>

</body>
</html>