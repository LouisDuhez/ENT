<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une absence</title>
</head>
<body>
    <h1>Ajouter une absence</h1>
<form method="POST" action="control.php?action=addAbsence">
    <label for="student">Étudiant :</label>
    <select name="student" id="student" required>
        <?php 
        $stmt = showStudent();
        $listStudent = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <?php foreach ($listStudent as $student): ?>
            <option value="<?= htmlspecialchars($student['user_id']) ?>">
                <?= htmlspecialchars($student['user_nom']) ?> <?= htmlspecialchars($student['user_prenom']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="subject">Matière :</label>
    <select name="subject" id="subject" required>
        <?php 
        $stmt = showMatiere();
        $listMatiere = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <?php foreach ($listMatiere as $subject): ?>
            <option value="<?= htmlspecialchars($subject['matiere_id']) ?>">
                <?= htmlspecialchars($subject['matiere_nom']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="date">Date de l'absence :</label>
    <input type="date" name="date" id="date" required>

    <label for="end_date">Date de fin de l'absence :</label>
    <input type="date" name="end_date" id="end_date" required>

    <label for="description">Description du retard (facultatif) :</label>
    <textarea name="description" id="description"></textarea>

    <label for="justif">Justification :</label>
    <select name="justif" id="justif" required>
        <option value="0">Non justifiée</option>
        <option value="1">Justifiée</option>
        
    </select>

    <button type="submit">Ajouter l'absence</button>
</form>
</body>
</html>




