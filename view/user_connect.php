<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="./user_connect.css">
</head>

<body>

    <main class="connexion">

        <div class="container">
            <div class="form-container">
                <h1>Connexion</h1>
                <?php
                if (isset($userTest) && $userTest == false) {
                    echo "<p class='error-message'>Le nom d'utilisateur est incorrect. Veuillez réessayer.</p>";
                }
                if (isset($mdpTest) && $mdpTest == false) {
                    echo "<p class='error-message'>Le mot de passe est incorrect. Veuillez réessayer.</p>";
                }
                ?>
                <form action="control.php?action=ConnectUser" method="post" class="form-connexion">
                    <label for="email">Adresse email</label>
                    <input id="email" name="email" type="text" required>

                    <label for="mdp">Mot de passe</label>
                    <input id="mdp" name="mdp" type="password" required>

                    <input type="submit" value="Se connecter">

                </form>

                <div class="settings-connexion">
                    <input type="radio" id="remember" name="rememberme" value="huey" checked />
                    <label for="remember">Se souvenir de moi</label>
                    <a href="">Mot de passe oublié ?</a>
                </div>

                <br><br>

                <p>Un problème ? Veuillez contacter l’<a href="https://www.univ-gustave-eiffel.fr/contacts">Université Gustave Eiffel</a></p>
            </div>
            <div class="image-container"></div>
        </div>

        <img src="img/logo-university.png" alt="" class="logo-university">
    </main>

</body>

</html>