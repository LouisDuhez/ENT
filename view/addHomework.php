<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un devoir</title>
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