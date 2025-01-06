<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Devoirs Rendus</title>
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

        .table-container {
            margin-top: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-bottom: 2rem;
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
    </style>
</head>
<body>

<h2>Liste des Devoirs Rendus</h2>

<div class="table-container">
    <?php 
    $stmt = getAllHomeworks(); 
    $listdevoir = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (empty($listdevoir)): ?>
        <p class="center">Aucun devoir rendu pour le moment</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Étudiant</th>
                    <th>Matière</th>
                    <th>Description</th>
                    <th>Date de fin</th>
                    <th>Fichier</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listdevoir as $devoir): ?>
                    <tr>
                        <td><?= htmlspecialchars($devoir['user_nom']) . " " . htmlspecialchars($devoir['user_prenom']) ?></td>
                        <td><?= htmlspecialchars($devoir['matiere_nom']) ?></td>
                        <td><?= htmlspecialchars($devoir['devoir_desc']) ?></td>
                        <td><?= htmlspecialchars($devoir['devoir_date_fin']) ?></td>
                        <td>
                            <?php if (!empty($devoir['devoir_fichier'])): ?>
                                <a href="homeWorkUpload/<?= htmlspecialchars($devoir['devoir_fichier']) ?>" target="_blank">Voir le fichier</a>
                            <?php else: ?>
                                Aucun fichier
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>