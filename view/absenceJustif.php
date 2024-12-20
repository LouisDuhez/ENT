<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Absences</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            padding: 2rem;
            background: #f4f4f9;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-top: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #007bff;
            color: white;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        tr:hover {
            background: #f1f1f1;
        }

        td a {
            color: #007bff;
            text-decoration: none;
        }

        td a:hover {
            text-decoration: underline;
        }

        .center {
            text-align: center;
            font-style: italic;
            color: #555;
        }

        .btn {
            padding: 0.5rem 1rem;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<h2>Liste des Absences</h2>

<table>
    <thead>
        <tr>
            <th>Étudiant</th>
            <th>Matière</th>
            <th>Date de début</th>
            <th>Date de fin</th>
            <th>Durée</th>
            <th>Justificatif</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $absences = showAllAbsences(); 

        if (empty($absences)): ?>
            <tr>
                <td colspan="7" class="center">Aucune absence à justifier</td>
            </tr>
        <?php else: 
            foreach ($absences as $absence):
                $duree = calculerTemps($absence['abs_date_debut'], $absence['abs_date_fin']);
            ?>
                <tr>
                    <td><?= htmlspecialchars($absence['user_nom']) . " " . htmlspecialchars($absence['user_prenom']) ?></td>
                    <td><?= htmlspecialchars($absence['matiere_nom']) ?></td>
                    <td><?= htmlspecialchars($absence['abs_date_debut']) ?></td>
                    <td><?= htmlspecialchars($absence['abs_date_fin']) ?></td>
                    <td><?= gmdate("H:i:s", $duree) ?></td>
                    <td>
                        <?php if (!empty($absence['abs_justif_file'])): ?>
                            <a href="absence_justif/<?= htmlspecialchars($absence['abs_justif_file']) ?>" target="_blank">Voir le fichier</a>
                        <?php else: ?>
                            Aucun fichier
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($absence['abs_justif_valid'] == 1): ?>
                            <strong>Justifiée</strong>
                        <?php elseif ($absence['abs_justif'] == 1): ?>
                            <form action="control.php?action=validateAbsence" method="POST">
                                <input type="hidden" name="absence_id" value="<?= htmlspecialchars($absence['abs_id']) ?>">
                                <button type="submit" class="btn">Valider</button>
                            </form>
                        <?php else: ?>
                            Non justifiée
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; 
        endif; ?>
    </tbody>
</table>

</body>
</html>