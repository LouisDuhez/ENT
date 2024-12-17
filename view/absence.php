<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absence</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            padding: 2rem;
            background-color: #f5f5f5;
        }

        .absence-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .absence-block {
            background: white;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 1rem;
            width: calc(33.33% - 2rem);
            min-width: 250px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .absence-block p {
            margin: 0.5rem 0;
            color: #333;
        }

        .absence-block form {
            margin-top: 1rem;
        }

        .absence-block form label, .absence-block form input, 
        .absence-block form button {
            display: block;
            width: 100%;
            margin: 0.5rem 0;
        }

        .absence-block form button {
            background: #007bff;
            color: white;
            border: none;
            padding: 0.5rem;
            border-radius: 4px;
            cursor: pointer;
        }

        .absence-block form button:hover {
            background: #0056b3;
        }

        .absence-info {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: white;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 1.5rem;
            width: 300px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .absence-info h3 {
            margin-bottom: 1rem;
            color: #007bff;
        }

        .absence-info ul {
            list-style: none;
        }

        .absence-info li {
            margin: 0.5rem 0;
            color: #333;
        }
    </style>
</head>
<body>

<!-- Conteneur principal -->
<div class="absence-container">
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
        <div class="absence-block">
            <p><strong>Date de début:</strong> <?= $absence['abs_date_debut'] ?></p>
            <p><strong>Matière:</strong> <?= $absence['matiere_nom'] ?></p>
            <p><strong>Description:</strong> <?= $absence['abs_desc'] ?></p>
            <p><strong>Durée:</strong> <?= gmdate("H:i:s", $tempsAbsence) ?></p>

            <?php if ($absence['abs_justif'] == 0): ?>
                <form action="control.php?action=justifAbsence" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="absence_id" value="<?= $absence['abs_id'] ?>">
                    <label for="justif_file">Télécharger un justificatif :</label>
                    <input type="file" name="justif_file" required>
                    <button type="submit">Envoyer</button>
                </form>
            <?php else: ?>
                <p><strong>Status:</strong> En attente de validation</p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
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

</body>
</html>