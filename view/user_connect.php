<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <?php
         if (isset($userTest) && $userTest == false) {
            echo "<p>Le nom d'utilisateur est incorrect. Vous pouvez vous inscrire <a href='index.php?action=inscription'>ici</a>.</p>";
        }
        if (isset($mdpTest) && $mdpTest == false) {
            echo "<p>Le mot de passe est incorrect. Veuillez réessayer.</p>";
        }

    ?>
    <form action="control.php?action=ConnectUser" method="post">
        <label for="email">Adresse email</label>
        <input id="email" name="email" type="text">
        
        <label for="mdp">Mot de passe</label>
        <input id="mdp" name="mdp" type="text">

        <input type="submit" value="Valider">
    </form>
</body>
</html>

