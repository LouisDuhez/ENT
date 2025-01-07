<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une absence</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #001947;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            color: white;
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            width: 100%;
            max-width: 600px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #21272A;
        }

        select, input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #DDE1E6;
            border-radius: 4px;
            font-size: 16px;
            background-color: #F9FAFB;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #A31F21;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #850f14;
        }

        a {
            text-decoration: none;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            padding: 24px 16px;
            background: white;
            border-right: 1px solid #DDE1E6;
            display: flex;
            flex-direction: column;
        }

        .profile-section {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 16px;
        }

        .profile-picture {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            background-image: url(img/jesse.jpeg); /* Remplace cette URL par l'image de profil appropriée */
            background-size: cover;
        }

        .menu {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 8px;
            border-bottom: 1px solid #F2F4F8;
            transition: background-color 0.3s;
        }

        .menu-item.active {
            background: #A31F21;
        }

        .menu-item.active .text {
            color: white;
        }

        .menu-item .icon {
            width: 24px;
            height: 24px;
            margin-top: 5px;
            margin-right: 8px;
        }

        .menu-item .text {
            flex: 1;
            font-size: 16px;
            font-weight: 500;
            color: #21272A;
        }

        .menu-item.logout {
            padding-top: 150px;
        }

        a {
            text-decoration: none;
        }

        .header {
            width: 100%;
            background-color: red;
            height: 50px;
            display: flex;
        }

        .header h1 {
            margin-top: 10px;
            margin-right: auto;
            margin-left: auto;
            color: white;
        }

        .container {
            margin-top: 30px;
            width: 260px;
            height: 350px;
            background-color: white;
            margin-right: auto;
            margin-left: auto;
        }

        @media screen and (min-width: 1024px) {
            .sidebar {
                display: block;
            }

            .profile-section {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-bottom: 16px;
            }

            .profile-picture {
                width: 130px;
                height: 130px;
                border-radius: 50%;
                background-image: url(img/jesse.jpeg);
            }

            .menu {
                flex: 1;
                display: flex;
                flex-direction: column;
                gap: 8px;
            }

            .menu-item {
                display: flex;
                align-items: center;
                padding: 12px 8px;
                border-bottom: 1px solid #F2F4F8;
            }

            .menu-item.active {
                background: #A31F21;
            }

            .menu-item.active .text {
                color: white;
            }

            .menu-item .icon {
                width: 24px;
                height: 24px;
                margin-top: 5px;
                margin-right: 8px;
            }

            .menu-item .text {
                flex: 1;
                font-size: 16px;
                font-weight: 500;
                color: #21272A;
            }

            .menu-item.logout {
                padding-top: 150px;
            }

            .header {
                width: 100%;
                background-color: red;
                height: 50px;
                display: flex;
            }

            .header h1 {
                margin-top: 10px;
                margin-right: auto;
                margin-left: auto;
                color: white;
            }

            .container {
                margin-top: 30px;
                width: 260px;
                height: 350px;
                background-color: white;
                margin-right: auto;
                margin-left: auto;
            }
        }
    </style>
</head>
<body>
    <h1>Ajouter une absence</h1>
    <form method="POST" action="control.php?action=addAbsence">
        <label for="student">Étudiant :</label>
        <select name="student" id="student" required>
            <?php 
            $stmt = showStudent();
            $listStudent = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach ($listStudent as $student): ?>
                <option value="<?= htmlspecialchars($student['user_id']) ?>">
                    <?= htmlspecialchars($student['user_nom']) ?> <?= htmlspecialchars($student['user_prenom']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="subject">Matière :</label>
        <select name="subject" id="subject" required>
            <?php 
            $stmt = showMatiere();
            $listMatiere = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach ($listMatiere as $subject): ?>
                <option value="<?= htmlspecialchars($subject['matiere_id']) ?>">
                    <?= htmlspecialchars($subject['matiere_nom']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="date">Date de l'absence :</label>
        <input type="date" name="date" id="date" required>

        <label for="end_date">Date de fin de l'absence :</label>
        <input type="date" name="end_date" id="end_date" required>

        <label for="description">Description du retard (facultatif) :</label>
        <textarea name="description" id="description"></textarea>

        <label for="justif">Justification :</label>
        <select name="justif" id="justif" required>
            <option value="0">Non justifiée</option>
            <option value="1">Justifiée</option>
        </select>

        <button type="submit">Ajouter l'absence</button>
    </form>
</body>
</html>
