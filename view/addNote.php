<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une note</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f4f7fc;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        h1 {
            color: #21272A;
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            width: 100%;
            max-width: 600px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        div {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #21272A;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #DDE1E6;
            border-radius: 4px;
            background-color: #F9FAFB;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #A31F21;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #850f14;
        }

        @media screen and (max-width: 768px) {
            form {
                padding: 15px;
                max-width: 100%;
            }

            h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <h1>Ajouter une note</h1>

    <form method="POST" action="control.php?action=addNote">
        <div>
            <label for="user_id">Étudiant :</label>
            <select name="user_id" id="user_id" required>
                <?php 
                $stmt = showStudent();
                $listStudent = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($listStudent as $student): ?>
                    <option value="<?= htmlspecialchars($student['user_id']) ?>">
                        <?= htmlspecialchars($student['user_nom']) ?> <?= htmlspecialchars($student['user_prenom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="matiere_id">Matière :</label>
            <select name="matiere_id" id="matiere_id" required>
                <?php 
                $stmt = showMatiere();
                $listMatiere = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($listMatiere as $subject): ?>
                    <option value="<?= htmlspecialchars($subject['matiere_id']) ?>">
                        <?= htmlspecialchars($subject['matiere_nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="note_value">Note :</label>
            <input type="number" name="note_value" id="note_value" min="0" max="20" required>
        </div>

        <div>
            <label for="note_coef">Coefficient :</label>
            <input type="number" name="note_coef" id="note_coef" min="1" max="10" value="1" required>
        </div>

        <div>
            <button type="submit">Ajouter</button>
        </div>
    </form>
</body>
</html>