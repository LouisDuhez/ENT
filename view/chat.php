<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
</head>
<body>
    <?php
        $stmt = showChat($_SESSION['user_id']);
        $listChat = $stmt -> fetchall(PDO::FETCH_ASSOC);
        foreach($listChat as $chat) {
            echo $chat['user_nom'];
            echo $chat['user_prenom'];
            $id_chat = $chat['chat_id']
        ?>
            <a href="control.php?action=openChat?chatID=<?=$id_chat?>">Voir</a>
        <?php
            
        }
    ?>
    
</body>
</html>