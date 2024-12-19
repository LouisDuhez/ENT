<body>
    <div class="container">
        <?php
        $stmt = showHomework($_SESSION['user_id']);
        $listHomework = $stmt->fetchall(PDO::FETCH_ASSOC);
        foreach ($listHomework as $work) {
        ?>
            <div class="devoir-container">
                <p class="devoir-nom"><?= $work['devoir_nom'] ?></p>
                <p class="devoir-desc"><?= $work['devoir_desc'] ?></p>
                <p class="matiere-nom"><?= $work['matiere_nom'] ?></p>
                <p class="devoir-date-fin"><?= $work['devoir_date_fin'] ?></p>
                <?php
                
                if ($work['devoir_rendu'] == 0) {
                    
                    echo '<a class="action-link rendre-link" href="control.php?action=pushHomework&idWork=' . $work['devoir_id'] . '">Rendre le devoir</a>';

                    
                    if (isset($_GET['idWork']) && $_GET['idWork'] == $work['devoir_id']) {
                        
                        echo '
                        <form action="control.php?action=uploadHomework&idWork=' . $work['devoir_id'] . '" method="POST" enctype="multipart/form-data" class="upload-form">
                            <input type="file" name="homework_file" required>
                            <button type="submit" class="action-link rendre-link">Déposer le fichier</button>
                        </form>';
                    }
                } else {
                    
                    echo "<a class='action-link modif-link' href='control.php?action=modifHomework&idWork=" . $work['devoir_id'] . "'>Modifier le devoir rendu</a>";
                }
                ?>
            </div>
        <?php
        }
        ?>
    </div>
</body>