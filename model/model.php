<?php


function dbConnect () {
    $db = new PDO('mysql:host=localhost;dbname=ent;port=3306;charset=utf8', 'root' , '');
    return $db;
}


function connectUser ($user, $mdp) {
    $db = dbConnect();
    $requete = ("SELECT * FROM user WHERE user_email =:email");
    $stmt = $db -> prepare($requete);
    $stmt -> bindParam(":email" , $user, PDO::PARAM_STR);
    $stmt -> execute();  

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

function logOutUser() {
    session_destroy();
}


function saveInfoUser($userEmail) {
    $db = dbConnect();
    $requete = ("SELECT user_id FROM user WHERE user_email =:email");
    $stmt = $db -> prepare($requete);
    $stmt -> bindParam(":email" , $userEmail, PDO::PARAM_STR);
    $stmt -> execute();  
    return $stmt;
}

function showNote($user_id) {
    $db = dbConnect();
    $requete = ('SELECT * FROM `note` 
    INNER JOIN user ON note.fk_user_id = user.user_id
    INNER JOIN matiere ON note.fk_matiere_id = matiere.matiere_id
    INNER JOIN competence ON matiere.fk_competence_id = competence.competence_id
    WHERE user.user_id = :user_id
    ORDER BY competence.competence_id'); 

    $stmt = $db -> prepare($requete);
    $stmt -> bindParam(":user_id" , $user_id, PDO::PARAM_STR);
    $stmt -> execute();  
    return $stmt;
}
function showNoteCompetence($user_id, $competence_id) {
    $db = dbConnect();
    $requete = ('SELECT * FROM `note` 
    INNER JOIN user ON note.fk_user_id = user.user_id
    INNER JOIN matiere ON note.fk_matiere_id = matiere.matiere_id
    INNER JOIN competence ON matiere.fk_competence_id = competence.competence_id
    WHERE user.user_id = :user_id AND competence.competence_id = :competence
    ORDER BY matiere.matiere_id'); 

    $stmt = $db -> prepare($requete);
    $stmt -> bindParam(":user_id" , $user_id, PDO::PARAM_INT);
    $stmt -> bindParam(":competence" , $competence_id, PDO::PARAM_INT);
    $stmt -> execute();  
    return $stmt;
}

function showAbsence($user_id) {
    $db = dbConnect();
    $requete = ('SELECT * FROM `absence` 
    INNER JOIN matiere ON absence.fk_matiere_id = matiere.matiere_id
    INNER JOIN user ON absence.fk_user_id = user.user_id
    WHERE user.user_id = :user_id
    ORDER BY abs_justif DESC');
    $stmt = $db -> prepare($requete);
    $stmt -> bindParam(":user_id" , $user_id, PDO::PARAM_STR);
    $stmt -> execute();
    return $stmt;
}

function calculerTemps($date1, $date2) {
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

function showHomework($user_id) {
    $db = dbConnect();
    $requete = ('SELECT * FROM `devoir`
    INNER JOIN matiere ON devoir.fk_matiere_id = matiere.matiere_id
    INNER JOIN user ON devoir.fk_user_id = user.user_id
    WHERE user.user_id = :user_id 
    ORDER BY devoir_date_fin');
    $stmt = $db -> prepare($requete);
    $stmt -> bindParam(":user_id" , $user_id, PDO::PARAM_INT);
    $stmt -> execute();
    return $stmt;
}

?>