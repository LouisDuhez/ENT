<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absence</title>
</head>
<body>
    <?php
        $stmt = showAbsence($_SESSION['user_id']);
        $listAbsence = $stmt -> fetchall(PDO::FETCH_ASSOC);
        foreach ($listAbsence as $Absence) {
            echo $Absence['abs_nom'];
        }

    ?>
</body>
</html>