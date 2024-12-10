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
    $requete = ('SELECT * FROM note WHERE fk_user_id =:user_id'); // jointure nécessaire
    $stmt = $db -> prepare($requete);
    $stmt -> bindParam(":user_id" , $user_id, PDO::PARAM_STR);
    $stmt -> execute();  
    return $stmt;
}

function showAbsence($user_id) {
    $db = dbConnect();
    $requete = ('SELECT * FROM absence WHERE fk_user_id =:user_id'); // jointure nécessaire
    $stmt = $db -> prepare($requete);
    $stmt -> bindParam(":user_id" , $user_id, PDO::PARAM_STR);
    $stmt -> execute();
    return $stmt;
}


?>