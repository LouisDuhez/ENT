<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
        }
        .chat-container {
            display: flex;
            width: 100%;
        }
        .chat-list {
            width: 25%;
            background: #f4f4f4;
            border-right: 2px solid #ddd;
            padding: 20px;
            overflow-y: auto;
        }
        .chat-list a {
            display: block;
            padding: 10px;
            margin: 5px 0;
            text-decoration: none;
            color: #333;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .chat-list a:hover {
            background: #e1e1e1;
        }
        .chat-window {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: #fff;
        }
        .messages {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
            overflow-y: auto;
            padding-right: 10px;
            margin-bottom: 20px;
        }
        .message {
            max-width: 70%;
            padding: 10px 15px;
            border-radius: 20px;
            font-size: 14px;
            line-height: 1.4;
            position: relative;
            word-wrap: break-word;
        }
        .message.sent {
            background: #d1e7ff;
            align-self: flex-end;
            border-bottom-right-radius: 0;
        }
        .message.received {
            background: #e1ffe1;
            align-self: flex-start;
            border-bottom-left-radius: 0;
        }
        .message-form textarea {
            width: 100%;
            height: 80px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: none;
            font-size: 14px;
        }
        .message-form button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .message-form button:hover {
            background: #0056b3;
        }
        .placeholder {
            color: #999;
            font-size: 18px;
            text-align: center;
            margin-top: 20%;
        }
    </style>
</head>
<body>

<div class="chat-container">
    <div class="chat-list">
        <h3>Chats</h3>
        <?php
            $stmt = showChat($_SESSION['user_id']);
            $listChat = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($listChat as $chat) {
                $id_chat = $chat['chat_id'];
                echo "<a href='control.php?action=openChat&chatID=$id_chat'>{$chat['user_nom']} {$chat['user_prenom']}</a>";
            }
        ?>
    </div>

    <div class="chat-window">
        <div class="messages">
            <?php 
                if (isset($_GET['chatID']) && is_numeric($_GET['chatID'])) {
                    $stmt = openChat($_GET['chatID']);
                    $listMessage = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($listMessage) > 0) {
                        foreach ($listMessage as $msg) {
                            $messageClass = $msg['fk_user_id'] == $_SESSION['user_id'] ? 'sent' : 'received';
                            echo "<div class='message $messageClass'>
                                    <strong>{$msg['user_prenom']}:</strong> {$msg['message_text']}
                                  </div>";
                        }
                    } else {
                        echo "<p class='placeholder'>Aucun message pour ce chat.</p>";
                    }
                } else {
                    echo "<p class='placeholder'>Sélectionnez un chat à gauche.</p>";
                }
            ?>
        </div>

        <?php if (isset($_GET['chatID']) && is_numeric($_GET['chatID'])): ?>
            <form action="control.php?action=addMessage" method="POST" class="message-form">
                <input type="hidden" name="chatID" value="<?= $_GET['chatID'] ?>">
                <textarea name="message_text" placeholder="Entrez votre message" required></textarea>
                <button type="submit">Envoyer</button>
            </form>
        <?php endif; ?>
    </div>
</div>

</body>
</html>