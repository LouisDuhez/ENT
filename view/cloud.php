<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Cloud</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        /* Mise en page générale */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f1f2f6;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            height: 80vh;
            margin: 20px;
        }

        /* Section des dossiers à gauche */
        .folders {
            width: 250px;
            border-right: 2px solid #ccc;
            padding-right: 20px;
            overflow-y: auto;
            background-color: #fff;
        }

        .folders h2 {
            font-size: 1.5em;
            color: #333;
            margin-bottom: 20px;
        }

        .folder-item {
            display: flex;
            align-items: center;
            font-size: 1.2em;
            color: #333;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            cursor: pointer;
            text-decoration: none;
        }

        .folder-item:hover {
            background-color: #007bff;
            color: white;
        }

        .folder-item i {
            margin-right: 10px;
        }

        .folder-item a {
            text-decoration: none;
            color: inherit;
        }

        /* Section des fichiers à droite */
        .files {
            flex: 1;
            padding-left: 20px;
            background-color: #fff;
            overflow-y: auto;
        }

        .files h2 {
            font-size: 1.5em;
            color: #333;
        }

        .files ul {
            list-style-type: none;
            padding: 0;
        }

        .files li {
            margin: 10px 0;
            padding: 8px 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fafafa;
            transition: background-color 0.3s ease;
        }

        .files li:hover {
            background-color: #007bff;
            color: white;
        }

        .files a {
            color: #007bff;
            text-decoration: none;
        }

        .no-folder {
            font-size: 1.2em;
            color: #999;
            margin-top: 50px;
        }

        /* Formulaire de téléchargement */
        .upload-form {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
        }

        .upload-form input[type="file"] {
            margin-bottom: 10px;
        }

        .upload-form button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .upload-form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Dossiers à gauche -->
        <div class="folders">
            <h2>Mes Dossiers</h2>
            <?php
            $stmt = showFolder($_SESSION['user_id']);
            $listFolder = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($listFolder as $folder) {
                // Affichage des dossiers avec l'icône cliquable
                echo '<a href="control.php?action=showCloud&folderId=' . $folder['folder_id'] . '" class="folder-item">';
                echo '<i class="fa-solid fa-folder"></i>';
                echo $folder['folder_name'];
                echo '</a>';
            }
            
            ?>
        </div>

        <!-- Fichiers à droite -->
        <div class="files">
            <?php
            if (isset($_GET['folderId']) && is_numeric($_GET['folderId'])) {
                // Afficher les fichiers seulement si un dossier est sélectionné
                $folderId = $_GET['folderId'];
                $stmt = showFiles($folderId);
                $listFiles = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($listFiles) > 0) {
                    echo '<h2>Fichiers du Dossier</h2>';
                    echo '<ul>';
                    foreach ($listFiles as $file) {
                        echo '<li><a href="uploads/' . $file['file_name'] . '" target="_blank">' . $file['file_name'] . '</a></li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p>Aucun fichier dans ce dossier.</p>';
                }

                // Formulaire de téléchargement de fichier
                echo '<div class="upload-form">';
                echo '<h3>Ajouter un fichier</h3>';
                echo '<form action="control.php?action=uploadFile" method="POST" enctype="multipart/form-data">';
                echo '<input type="file" name="file" required>';
                echo '<button type="submit">Télécharger</button>';
                echo '<input type="hidden" name="folderId" value="' . $folderId . '">';
                echo '</form>';
                echo '</div>';
            } else {
                // Si aucun dossier n'est sélectionné, afficher un message
                echo '<div class="no-folder">Aucun dossier sélectionné.</div>';
            }
            ?>
        </div>
    </div>

</body>
</html>