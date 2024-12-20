<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un devoir</title>
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

        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #DDE1E6;
            border-radius: 4px;
            background-color: #F9FAFB;
            font-size: 16px;
        }

        textarea {
            height: 120px;
            resize: vertical;
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
    <h1>Ajouter un devoir</h1>

    <form action="control.php?action=addHomework" method="POST" enctype="multipart/form-data">
        <div>
            <label for="devoir_nom">Nom du devoir :</label>
            <input type="text" id="devoir_nom" name="devoir_nom" required>
        </div>

        <div>
            <label for="devoir_desc">Description du devoir :</label>
            <textarea id="devoir_desc" name="devoir_desc" required></textarea>
        </div>

        <div>
            <label for="devoir_date_fin">Date de fin :</label>
            <input type="date" id="devoir_date_fin" name="devoir_date_fin" required>
        </div>

        <div>
            <label for="fk_matiere_id">Matière :</label>
            <select id="fk_matiere_id" name="fk_matiere_id" required>
                <?php
                $db = dbConnect();
                $stmt = $db->query('SELECT matiere_id, matiere_nom FROM matiere');
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row['matiere_id'] . '">' . $row['matiere_nom'] . '</option>';
                }
                ?>
            </select>
        </div>

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
            <button type="submit">Ajouter le devoir</button>
        </div>
    </form>
</body>
</html>