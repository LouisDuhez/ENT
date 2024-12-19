<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_homework.css" />
    <title>Devoir</title>
</head>

<body>
    <?php
    $stmt = showHomework($_SESSION['user_id']);
    $listHomework = $stmt->fetchall(PDO::FETCH_ASSOC);
    foreach ($listHomework as $work) {
    ?>
        <div>
            <p><?= $work['devoir_nom'] ?></p>
            <p><?= $work['devoir_desc'] ?></p>
            <p><?= $work['matiere_nom'] ?></p>
            <p><?= $work['devoir_date_fin'] ?></p>
            <?php
            if ($work['devoir_rendu'] == 0) {
                echo "<a href='control.php?action=pushHomework'>Rendre le devoir</a>";
            } else {
                echo "<a href='control.php?action=modifHomework'>modifier le devoir rendu</a>";
            }
            ?>
        </div>
    <?php

    }

    ?>

    <section>
        <div class="header"></div>
        <div class="container"></div>
        <div class="container"></div>
        <div class="container"></div>
        <div class="container"></div>
        <div class="container"></div>
        <div class="container"></div>
    </section>
</body>

</html>