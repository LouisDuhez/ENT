<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloud</title>
    
</head>
<body>
    <?php
         $stmt = showFolder($_SESSION['user_id']);
         $listFolder = $stmt->fetchAll(PDO::FETCH_ASSOC);
         foreach($listFolder as $folder) {
            echo $folder['folder_name'];

         }
    ?>
</body>
</html>