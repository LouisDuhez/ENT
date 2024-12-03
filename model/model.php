<?php
function dbConnect () {
    $db = new PDO('mysql:host=localhost;dbname=blog;port=3306;charset=utf8', 'root' , '');
    return $db;
}


function connectUser ($user, $mdp) {
    $db = dbConnect();
    $requete = ("SELECT * FROM user WHERE user_email =:email");
    $stmt = $db -> prepare($requete);
    $stmt -> bindParam(":email" , $user, PDO::PARAM_STR);
    $stmt -> execute();  

    if ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if (password_verify($mdp, $result["user_mdp"])) {
            $_SESSION["pseudo"] = $pseudo;
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
    
?>
?>