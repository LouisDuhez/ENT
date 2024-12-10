<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note</title>
</head>
<body>
    <?php
    $stmt = showNote($_SESSION['user_id']);
    $listNote = $stmt -> fetchall(PDO::FETCH_ASSOC);
    foreach ($listNote as $note) {
        echo $note['note_matiere'];
    }

    ?>
</body>
</html>