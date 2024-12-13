<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note</title>
</head>
<body>
    <?php
    $stmt = showNote($_SESSION['user_id']);
    $listNote = $stmt -> fetchall(PDO::FETCH_ASSOC);
    $currentCompetence = null;
    $currentMatiere = null;
    $currentCompetence = null;
$currentMatiere = null;

foreach ($listNote as $note) {
    
    if ($currentCompetence !== $note["competence_nom"]) {
        
        if ($currentCompetence !== null) {
            echo "</ul>"; 
        }
        
        $currentCompetence = $note["competence_nom"];
        ?>
        
        <h1><?=$currentCompetence?></h1>
        <ul> 
        <?php
    }


    if ($currentMatiere !== $note['matiere_nom']) {
       
        if ($currentMatiere !== null) {
            echo "</ul>"; 
            echo "</li>"; 
        }
        
        $currentMatiere = $note['matiere_nom'];
        ?>
        
        <li>
            Matière : <?=$note['matiere_nom']?>
            <ul> 
        <?php
    }


    ?>
    <li>Note : <?=$note['note_number']?></li>
    <?php
}


if ($currentMatiere !== null) {
    echo "</ul>";
    echo "</li>"; 
}


if ($currentCompetence !== null) {
    echo "</ul>"; 
}

$stmt = showNoteCompetence($_SESSION['user_id'],1);
$listNote = $stmt -> fetchall(PDO::FETCH_ASSOC);
foreach ($listNote as $note) {
    echo $note['competence_nom'];
    echo $note['matiere_nom'];
    echo $note['note_number'];
}

$stmt = showNoteCompetence($_SESSION['user_id'],2);
$listNote = $stmt -> fetchall(PDO::FETCH_ASSOC);
foreach ($listNote as $note) {
    echo $note['competence_nom'];
    echo $note['matiere_nom'];
    echo $note['note_number'];
}

$stmt = showNoteCompetence($_SESSION['user_id'],3);
$listNote = $stmt -> fetchall(PDO::FETCH_ASSOC);
foreach ($listNote as $note) {
    echo $note['competence_nom'];
    echo $note['matiere_nom'];
    echo $note['note_number'];
}

$stmt = showNoteCompetence($_SESSION['user_id'],4);
$listNote = $stmt -> fetchall(PDO::FETCH_ASSOC);
foreach ($listNote as $note) {
    echo $note['competence_nom'];
    echo $note['matiere_nom'];
    echo $note['note_number'];
}

$stmt = showNoteCompetence($_SESSION['user_id'],5);
$listNote = $stmt -> fetchall(PDO::FETCH_ASSOC);
foreach ($listNote as $note) {
    echo $note['competence_nom'];
    echo $note['matiere_nom'];
    echo $note['note_number'];
}
?>

</body>
</html>