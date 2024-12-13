<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absence</title>
</head>
<body>
    <?php
        $stmt = showAbsence($_SESSION['user_id']);
        $listAbsence = $stmt -> fetchall(PDO::FETCH_ASSOC);
        $tempTotal = 0;
        $nbAbsence = 0;
        foreach ($listAbsence as $absence) {
            $tempsAbsence = calculerTemps($absence['abs_date_debut'], $absence['abs_date_fin']);
            $tempTotal += $tempsAbsence;
            $nbAbsence += 1;
            ?>
            <div>
                <p><?=$absence['abs_date_debut']?></p>
                <p><?=$absence['matiere_nom']?></p>
                <p><?=$absence['abs_desc']?></p>
                <p><?php 
                echo gmdate("H:i:s", $tempsAbsence);
                ?></p>
                

                <?php
                if ($absence['abs_justif'] == 0) {
                    echo "<a href=''>A justifier</a>";
                } else {
                    echo "<p>Absence Justifée </p>";
                }
                ?>

            </div>
            <?php
        }
        ?>
        <p>
        <?php  
        echo "Temps total d'absence: " . gmdate("H:i:s", $tempTotal);
        ?>
        </p>
        <p>
        <?php  
        echo "Nombre total d'absence : ". $nbAbsence
        ?>
        </p>
        

        
        

</body>
</html>