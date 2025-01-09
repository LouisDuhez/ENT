<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Cloud</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="cloud.css" />

</head>
<body>
   <div class="page">
   <div class="sidebar">
        <div class="profile-section">
          <div class="profile-picture">
            <div class="profile-icon"></div>
          </div>
        </div>

        <nav class="menu">
            <a href="control.php?action=home">
                <div class="menu-item">
                    <div class="icon">
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <div class="text">Accueil</div>
                </div>
            </a>

            <a href="control.php?action=showSchedule">
                <div class="menu-item">
                    <div class="icon timetable">
                        <i class="fa-regular fa-calendar-days"></i>
                    </div>
                    <div class="text">Emploi du temps</div>
                </div>
            </a>

            <a href="control.php?action=showHomework">
                <div class="menu-item">
                    <div class="icon text-book">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <div class="text">Cahier de texte</div>
                </div>
            </a>

            <a href="control.php?action=showNote">
                <div class="menu-item">
                    <div class="icon notes">
                        <i class="fa-regular fa-newspaper"></i>
                    </div>
                    <div class="text">Notes</div>
                </div>
            </a>

            <a href="control.php?action=showAbsence">
                <div class="menu-item">
                    <div class="icon attendance">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <div class="text">Absences/Retards</div>
                </div>
            </a>

            <a href="control.php?action=showChat">
                <div class="menu-item">
                    <div class="icon chat">
                        <i class="fa-regular fa-comments"></i>
                    </div>
                    <div class="text">Chat rapide</div>
                </div>
            </a>

            <a href="control.php?action=showCloud">
                <div class="menu-item active">
                    <div class="icon cloud">
                        <i class="fa-solid fa-cloud"></i>
                    </div>
                    <div class="text">Cloud</div>
                </div>
            </a>

            <a href="control.php?action=showCash">
                <div class="menu-item">
                    <div class="icon wallet">
                        <i class="fa-solid fa-money-check-dollar"></i>
                    </div>
                    <div class="text">Porte monnaie</div>
                </div>
            </a>

            <a class="logout" href="control.php?action=deConnect">
                <div class="menu-item">
                    <div class="icon">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </div>
                    <div class="text">Déconnexion</div>
                </div>
            </a>
        </nav>
      </div>
       <div class="container">
           <!-- Dossiers à gauche -->
        <div class="folders">
       <div class="top-folder">
           <h2>Mes Dossiers</h2>
           <div class="create-folder-form">
           
           <?php


           if (isset($addFolder) and $addFolder = true) {
            ?>
            <form action="control.php?action=createFolder" method="POST">
            <label for="foldername">Nom du dossier :</label><br>
            <input id="foldername"type="text" name="folderName" placeholder="Ex : Mon dossier" required>
            <button type="submit">Créer</button>
            </form>
            <?php
           } else {
            ?>
            <a href="control.php?action=showAddFolder">Nouveau Dossier</a>
            <?php
           }
           
           ?>
       </div>
       </div>
       <?php
       $stmt = showFolder($_SESSION['user_id']);
       $listFolder = $stmt->fetchAll(PDO::FETCH_ASSOC);
       foreach ($listFolder as $folder) {
           echo '<div class="folder-item">';
       
           // Lien vers le dossier
           echo '<a href="control.php?action=showCloud&folderId=' . $folder['folder_id'] . '">';
           echo '<i class="fa-solid fa-folder"></i>' . htmlspecialchars($folder['folder_name']);
           echo '</a>';
       
           // Vérification si une confirmation de suppression est demandée
           if (isset($confirmDeleteFolder) && $folder['folder_id'] == $folderId) {
               echo '<p>Voulez-vous vraiment supprimer ce dossier ?</p>';
               echo '<a href="control.php?action=deleteFolder&folderId=' . $folder['folder_id'] . '" class="confirm-link">Oui, supprimer</a>';
               echo ' | <a href="control.php?action=showCloud" class="cancel-link">Annuler</a>';
           } else {
               // Lien de suppression
               echo '<a href="control.php?action=confirmDeleteFolder&folderId=' . $folder['folder_id'] . '" class="delete-link"><i class="fa-solid fa-trash"></i></a>';
           }
           echo '</div>';
       
       
       }
       ?>
       
       </div>
         <!-- Fichiers à droite -->
            <div class="files-container">
                <div class="top-file">
                    <div class="trait-blanc"></div>
                    <h1>Cloud personnel</h1>
                </div>
                           <div class="files">
                
                       <?php
                       if (isset($_GET['folderId']) && is_numeric($_GET['folderId'])) {
                           $folderId = $_GET['folderId'];
                           $stmt = showFiles($folderId);
                           $listFiles = $stmt->fetchAll(PDO::FETCH_ASSOC);
                           if (count($listFiles) > 0) {
                ?>
                   <div class="top-folder">
                       <h2>Fichiers du Dossier</h2>
                
                        <div>
                
                        <?php
                        if (isset($_GET['addFile']) and $_GET['addFile'] = true) {
                
                
                        ?>
                        <form action="control.php?action=uploadFile" method="POST" enctype="multipart/form-data">
                        <input type="file" name="file" required>
                        <button type="submit">Télécharger</button>
                        <input type="hidden" name="folderId" value="' . $folderId . '">
                        </form>
                        <?php
                        }else {
                            echo  '<a href="control.php?action=showAddFile&folderId='. $folderId.'">Ajouter un fichier</a>';
                        }
                        ?>
                        </div>
                   </div>
                <?php
                   echo '<ul>';
                   foreach ($listFiles as $file) {
                       echo '<li>';
                       echo '<a href="uploads/' . htmlspecialchars($file['file_name']) . '" target="_blank">' . htmlspecialchars($file['file_name']) . '</a> ';
                       // Confirmation de suppression spécifique
                       if (isset($confirmFileId) && $confirmFileId == $file['file_id']) {
                        //    echo "<p>Voulez-vous vraiment supprimer ce fichier ?</p>";
                           echo '<a class ="deleteFile" href="control.php?action=deleteFile&fileId=' . $file['file_id'] . '&folderId=' . $folderId . '">Supprimer</a>';
                           echo '<a class ="validFile" href="control.php?action=showCloud&folderId=' . $folderId . '">Annuler</a>';
                       } else {
                           echo '<a href="control.php?action=confirmDelete&fileId=' . $file['file_id'] . '&folderId=' . $folderId . '" class="delete-link"><i class="fa-solid fa-trash"></i></a>';
                       }
                       echo '</li>';
                   }
                   echo '</ul>';
                           } else {
                   echo '<p>Aucun fichier dans ce dossier.</p>';
                           }
                          
                       } else {
                           echo '<div class="no-folder">Aucun dossier sélectionné.</div>';
                       }
                       ?>
                       </div>
            </div>
       </div>
   </div>

</body>
</html>