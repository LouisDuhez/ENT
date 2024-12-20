<h1>Ajouter une note</h1>

<form method="POST" action="control.php?action=addNote">
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

    <label for="note_value">Note :</label>
    <input type="number" name="note_value" id="note_value" min="0" max="20" required>

    <label for="note_coef">Coefficient :</label>
    <input type="number" name="note_coef" id="note_coef" min="1" max="10" value="1" required>

    <button type="submit">Ajouter</button>
</form>