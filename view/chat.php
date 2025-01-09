<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./chat.css">
    <title>Chat</title>
</head>
<body>
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
                <div class="menu-item active">
                    <div class="icon chat">
                        <i class="fa-regular fa-comments"></i>
                    </div>
                    <div class="text">Chat rapide</div>
                </div>
            </a>

            <a href="control.php?action=showCloud">
                <div class="menu-item">
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


    <div class="chat-container">
        <div class="chat-list">
            <h1>Chats</h1>
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
                    <label for="message_text" class="msg">Votre message</label>
                    <textarea id="message_text" name="message_text" placeholder="Écrivez ici..." required></textarea>
                    <button type="submit">Envoyer</button>
                </form>

            <?php endif; ?>
        </div>
    </div>
</body>
</html>