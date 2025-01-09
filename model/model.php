<?php


function dbConnect()
{
    $db = new PDO('mysql:host=localhost;dbname=ent;port=3306', 'root', '');
    // $db = new PDO('mysql:host=localhost;dbname=ent;port=8889', 'root', 'root');
    
    return $db;
}


function connectUser($user, $mdp)
{
    $db = dbConnect();
    $requete = ("SELECT * FROM user WHERE user_email =:email");
    $stmt = $db->prepare($requete);
    $stmt->bindParam(":email", $user, PDO::PARAM_STR);
    $stmt->execute();

    if ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if (
            // password_verify($mdp, $result["user_mdp"])

            $mdp == $result["user_mdp"]

        ) {
            $_SESSION["email"] = $user;
            return ['user' => true, 'mdpValid' => true];
        } else {
            return ['user' => true, 'mdpValid' => false];
        }
    } else {
        return ['user' => false, 'mdpValid' => false];
    }
}

function logOutUser()
{
    session_destroy();
}


function saveInfoUser($userEmail)
{
    $db = dbConnect();
    $requete = ("SELECT user_id FROM user WHERE user_email =:email");
    $stmt = $db->prepare($requete);
    $stmt->bindParam(":email", $userEmail, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt;
}

function userIsAdmin($userEmail){
    $db = dbConnect();
    $requete = ("SELECT user_admin FROM user WHERE user_email =:email");
    $stmt = $db->prepare($requete);
    $stmt->bindParam(":email", $userEmail, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt;
}

function showNote($user_id)
{
    $db = dbConnect();
    $requete = ('SELECT * FROM `note` 
    INNER JOIN user ON note.fk_user_id = user.user_id
    INNER JOIN matiere ON note.fk_matiere_id = matiere.matiere_id
    INNER JOIN competence ON matiere.fk_competence_id = competence.competence_id
    WHERE user.user_id = :user_id
    ORDER BY competence.competence_id');

    $stmt = $db->prepare($requete);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt;
}
function showNoteCompetence($user_id, $competence_id)
{
    $db = dbConnect();
    $requete = ('SELECT * FROM `note` 
    INNER JOIN user ON note.fk_user_id = user.user_id
    INNER JOIN matiere ON note.fk_matiere_id = matiere.matiere_id
    INNER JOIN competence ON matiere.fk_competence_id = competence.competence_id
    WHERE user.user_id = :user_id AND competence.competence_id = :competence
    ORDER BY matiere.matiere_id');

    $stmt = $db->prepare($requete);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->bindParam(":competence", $competence_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt;
}

function showAbsence($user_id)
{
    $db = dbConnect();
    $requete = ('SELECT * FROM `absence` 
    INNER JOIN matiere ON absence.fk_matiere_id = matiere.matiere_id
    INNER JOIN user ON absence.fk_user_id = user.user_id
    WHERE user.user_id = :user_id
    ORDER BY abs_justif');
    $stmt = $db->prepare($requete);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt;
}

function updateAbsenceJustif($absenceID, $fileName)
{
    $db = dbConnect();
    $query = "UPDATE absence SET abs_justif = 1, abs_justif_file = :fileName WHERE abs_id = :absenceID";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':absenceID', $absenceID, PDO::PARAM_INT);
    $stmt->bindParam(':fileName', $fileName, PDO::PARAM_STR);
    $stmt->execute();
}

function calculerTemps($date1, $date2)
{
    $datetime1 = new DateTime($date1);
    $datetime2 = new DateTime($date2);

    $interval = $datetime1->diff($datetime2);

    $totalSecondes = $interval->y * 365 * 24 * 60 * 60  // Années en secondes
        + $interval->m * 30 * 24 * 60 * 60  // Mois en secondes
        + $interval->d * 24 * 60 * 60      // Jours en secondes
        + $interval->h * 60 * 60            // Heures en secondes
        + $interval->i * 60                 // Minutes en secondes
        + $interval->s;

    return $totalSecondes;
}

function showHomework($user_id)
{
    $db = dbConnect();
    $requete = ('SELECT * FROM `devoir`
    INNER JOIN matiere ON devoir.fk_matiere_id = matiere.matiere_id
    INNER JOIN user ON devoir.fk_user_id = user.user_id
    WHERE user.user_id = :user_id 
    ORDER BY devoir_date_fin');
    $stmt = $db->prepare($requete);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt;
}

function showHomeworkMatiere()
{
    $db = dbConnect();
    $requete = ('SELECT DISTINCT matiere.matiere_nom
    FROM devoir
    INNER JOIN matiere ON devoir.fk_matiere_id = matiere.matiere_id;');
    $stmt = $db->prepare($requete);
    $stmt->execute();
    return $stmt;

}

function showChat($user_id)
{
    $db = dbConnect();
    $requete = ('SELECT 
    chat.chat_id,
    CASE 
        WHEN chat.fk_user_id1 = :user_id THEN user2.user_prenom 
        WHEN chat.fk_user_id2 = :user_id THEN user1.user_prenom 
    END AS user_prenom,
	CASE 
        WHEN chat.fk_user_id1 = :user_id THEN user2.user_nom 
        WHEN chat.fk_user_id2 = :user_id THEN user1.user_nom 
    END AS user_nom
    FROM chat
    INNER JOIN user AS user1 ON chat.fk_user_id1 = user1.user_id
    INNER JOIN user AS user2 ON chat.fk_user_id2 = user2.user_id
    WHERE fk_user_id1 = :user_id OR fk_user_id2 = :user_id;');
    $stmt = $db->prepare($requete);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt;
}

function openChat($chat_id)
{
    $db = dbConnect();
    $requete = ('SELECT * FROM `message` 
    INNER JOIN user ON message.fk_user_id = user.user_id
    WHERE fk_chat_id = :chat_id
    ORDER BY message_id');
    $stmt = $db->prepare($requete);
    $stmt->bindParam(":chat_id", $chat_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt;
}

function addMessage($chatID, $userID, $message_text)
{
    $db = dbConnect();
    $requete = "INSERT INTO message (fk_chat_id, fk_user_id, message_text) 
                VALUES (:chatID, :userID, :message_text)";
    $stmt = $db->prepare($requete);
    $stmt->bindParam(':chatID', $chatID, PDO::PARAM_INT);
    $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
    $stmt->bindParam(':message_text', $message_text, PDO::PARAM_STR);
    $stmt->execute();
}

function showFolder($user_id)
{
    $db = dbConnect();
    $requete = ('SELECT * FROM folder 
    INNER JOIN user ON folder.fk_user_id = user.user_id
    WHERE fk_user_id = :user_id
    
    ');
    $stmt = $db->prepare($requete);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt;
}

function showFiles($folder_id)
{
    $db = dbConnect();
    $requete = 'SELECT * FROM file WHERE fk_folder_id = :folder_id';
    $stmt = $db->prepare($requete);
    $stmt->bindParam(":folder_id", $folder_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt;
}

function deleteFile($fileId)
{
    $db = dbConnect();

    // Récupérer le nom du fichier
    $requete = 'SELECT file_name FROM file WHERE file_id = :file_id';
    $stmt = $db->prepare($requete);
    $stmt->bindParam(':file_id', $fileId, PDO::PARAM_INT);
    $stmt->execute();
    $file = $stmt->fetch();

    if ($file && unlink('uploads/' . $file['file_name'])) {
        // Supprimer l'entrée de la base de données
        $requete = 'DELETE FROM file WHERE file_id = :file_id';
        $stmt = $db->prepare($requete);
        $stmt->bindParam(':file_id', $fileId, PDO::PARAM_INT);
        return $stmt->execute();
    }
    return false;
}


function createFolder($folderName, $user_id)
{
    $db = dbConnect();
    $requete = "INSERT INTO folder (folder_id, fk_user_id, folder_name) 
    VALUES (NUll, :user_id, :folder_name)";
    $stmt = $db->prepare($requete);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':folder_name', $folderName, PDO::PARAM_STR);
    $stmt->execute();
}

function deleteFolder($folderId)
{
    $db = dbConnect();
    $requete = "DELETE FROM folder WHERE folder_id = :folder_id";
    $stmt = $db->prepare($requete);
    $stmt->bindParam(':folder_id', $folderId, PDO::PARAM_INT);
    return $stmt->execute();
}

function uploadHomeworkFile($file, $homework_id)
{

    if (isset($file['homework_file']) && $file['homework_file']['error'] == 0) {

        $uploadDir = 'homeWorkUploads/';


        $fileName = uniqid() . '-' . basename($file['homework_file']['name']);
        $uploadFile = $uploadDir . $fileName;


        if (move_uploaded_file($file['homework_file']['tmp_name'], $uploadFile)) {

            $db = dbConnect();
            $query = "UPDATE devoir SET devoir_rendu = 1, devoir_fichier = :fileName WHERE devoir_id = :homework_id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':homework_id', $homework_id, PDO::PARAM_INT);
            $stmt->bindParam(':fileName', $fileName, PDO::PARAM_STR);
            $stmt->execute();


            return true;
        } else {

            return "Une erreur est survenue lors du téléchargement du fichier.";
        }
    } else {

        return "Aucun fichier n'a été téléchargé ou il y a eu un problème avec l'upload.";
    }
}
?>


<!-- BackOffice -->

<?php
function addNote($user_id, $matiere_id, $note_number, $note_coef = 1)
{
    $db = dbConnect();
    $requete = "INSERT INTO note (fk_user_id, fk_matiere_id, note_number, note_coef) 
                VALUES (:user_id, :matiere_id, :note_valeur, :note_commentaire)";
    
    $stmt = $db->prepare($requete);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':matiere_id', $matiere_id, PDO::PARAM_INT);
    $stmt->bindParam(':note_valeur', $note_number, PDO::PARAM_INT);
    $stmt->bindParam(':note_commentaire', $note_coef, PDO::PARAM_INT);
    
    return $stmt->execute();
}

function showStudent() {
    $db = dbConnect();
    $requete = ("SELECT * FROM user WHERE user_admin!=1");
    $stmt = $db->prepare($requete);
    $stmt->execute();
    return $stmt;
}
function showMatiere() {
    $db = dbConnect();
    $requete = ("SELECT * FROM matiere");
    $stmt = $db->prepare($requete);
    $stmt->execute();
    return $stmt;
}

function addAbsence($user_id, $matiere_id, $absence_date, $end_date, $justif, $description = null)
{
    $db = dbConnect();
    $requete = "INSERT INTO absence (fk_user_id, fk_matiere_id, abs_date_debut, abs_date_fin, abs_justif, abs_desc) 
                VALUES (:user_id, :matiere_id, :absence_date, :end_date, :justif, :description)";
    
    $stmt = $db->prepare($requete);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':matiere_id', $matiere_id, PDO::PARAM_INT);
    $stmt->bindParam(':absence_date', $absence_date, PDO::PARAM_STR);
    $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
    $stmt->bindParam(':justif', $justif, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    
    return $stmt->execute();
}


function addHomework($devoir_nom, $devoir_desc, $devoir_date_fin, $fk_matiere_id, $fk_user_id, $devoir_fichier = null)
{
    $db = dbConnect();
    
    $requete = "INSERT INTO devoir (devoir_nom, devoir_desc, devoir_date_fin, fk_matiere_id, fk_user_id, devoir_rendu) 
                VALUES (:devoir_nom, :devoir_desc, :devoir_date_fin, :fk_matiere_id, :fk_user_id, 0)";
    
    $stmt = $db->prepare($requete);

    $stmt->bindParam(':devoir_nom', $devoir_nom, PDO::PARAM_STR);
    $stmt->bindParam(':devoir_desc', $devoir_desc, PDO::PARAM_STR);
    $stmt->bindParam(':devoir_date_fin', $devoir_date_fin, PDO::PARAM_STR);
    $stmt->bindParam(':fk_matiere_id', $fk_matiere_id, PDO::PARAM_INT);
    $stmt->bindParam(':fk_user_id', $fk_user_id, PDO::PARAM_INT);
    return $stmt->execute();
}

function updateHomework($devoir_id, $fichier, $user_id) {
    $db = dbConnect();

    // Mise à jour uniquement si nécessaire
    if (!empty($fichier) && $fichier['error'] == 0) {
        $uploadDir = 'homeWorkUploads/';
        $filename = basename($fichier['name']);
        $target_path = $uploadDir . $filename;

        if (move_uploaded_file($fichier['tmp_name'], $target_path)) {
            // Mise à jour du fichier dans la DB
            $updateFile = 'UPDATE devoir
                           SET devoir_fichier = :filename
                           WHERE devoir_id = :devoir_id AND fk_user_id = :user_id';
            $stmt = $db->prepare($updateFile);
            $stmt->bindParam(':filename', $filename);
            $stmt->bindParam(':devoir_id', $devoir_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    return true;
}

function showAllAbsences()
{
    $db = dbConnect();
    $requete = ('SELECT absence.*, matiere.matiere_nom, user.user_nom, user.user_prenom 
                 FROM `absence` 
                 INNER JOIN matiere ON absence.fk_matiere_id = matiere.matiere_id
                 INNER JOIN user ON absence.fk_user_id = user.user_id
                 WHERE abs_justif = 1 AND abs_justif_valid = 0
                 ORDER BY abs_justif_valid ASC, abs_justif DESC');
    $stmt = $db->prepare($requete);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function validateAbsence($absence_id)
{
    $db = dbConnect();
    $requete = "UPDATE absence SET abs_justif_valid = 1 WHERE abs_id = :absence_id";
    $stmt = $db->prepare($requete);
    $stmt->bindParam(':absence_id', $absence_id, PDO::PARAM_INT);
    return $stmt->execute();
}

function getAllHomeworks() {
    $db = dbConnect();
    $requete = 'SELECT * FROM devoir
                INNER JOIN matiere ON devoir.fk_matiere_id = matiere.matiere_id
                INNER JOIN user ON devoir.fk_user_id = user.user_id
                WHERE devoir_rendu = 1
                ORDER BY matiere.matiere_nom, devoir.devoir_date_fin';
    $stmt = $db->prepare($requete);
    $stmt->execute();
    return $stmt;
}

?>

