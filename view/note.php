<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes et Compétences</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding-top: 30px;
        }

        h1 {
            text-align: center;
            color: #444;
        }

        .competence {
            background-color: #fff;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .competence h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #0056b3;
        }

        .matiere {
            font-size: 1.2rem;
            margin-left: 20px;
            color: #444;
        }

        .note {
            font-size: 1.1rem;
            color: #e67e22;
            font-weight: bold;
        }

        .matiere .note {
            color: #2ecc71;
        }

        .note {
            display: inline-block;
            margin-left: 10px;
            padding: 3px 10px;
            background-color: #f1c40f;
            border-radius: 5px;
            color: white;
        }

        .matiere {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mes Notes et Compétences</h1>

        <?php
        $competences = [1, 2, 3, 4, 5];
        
        // Tableau pour organiser les matières par compétence
        $competence_notes = [];

        foreach ($competences as $competence_id) {
            $stmt = showNoteCompetence($_SESSION['user_id'], $competence_id);
            $listNote = $stmt->fetchall(PDO::FETCH_ASSOC);

            // Si des notes existent pour cette compétence
            if (count($listNote) > 0) {
                // Organiser les matières et notes sous chaque compétence
                foreach ($listNote as $note) {
                    $competence_notes[$note['competence_nom']][] = $note;
                }
            }
        }

        // Affichage des compétences et des matières avec leurs notes
        foreach ($competence_notes as $competence_nom => $notes) {
            echo "<div class='competence'>";
            echo "<h2>Compétence: " . $competence_nom . "</h2>";

            foreach ($notes as $note) {
                echo "<div class='matiere'>";
                echo "<span>" . $note['matiere_nom'] . "</span>";
                echo "<span class='note'>" . $note['note_number'] . "</span>";
                echo "</div>";
            }

            echo "</div>";
        }
        ?>
    </div>
</body>
</html>