<?php
session_start();
require("model/model.php");

if (!isset($_GET['action'])) {
    include("view/user_connect.php");
}
else {
    switch($_GET['action']) {
        case 'ConnectUser' : 
            $email = $_POST["email"];
            $mdp = $_POST["mdp"];
            $resultConnectUser = connectUser($email, $mdp);

            $user = $resultConnectUser['user'];
            $mdpValid = $resultConnectUser['mdpValid'];
            if ($user == false) {
                $userTest = false;
                include("view/user_connect.php");
                
            } else {
                if ($mdpValid == true) {
                    $_SESSION['user']=$email;
                    $_SESSION['mdp']=$mdp;
                    include("view/home.php");
                } else {
                    $mdpTest = false;
                    include("view/user_connect.php"); 
                    
                }
            } 
            break;

        case 'deConnect' : 
            logOutUser();
            include("view/user_connect.php");
            break;
        case 'showAbsence' : 
            include('view/absence.php');
            break;
        
        case 'showNote' : 
            include('view/note.php');
            break;
        case 'showSchedule' : 
            include('view/schedule.php');
            break;
        case 'showHomework' : 
            include ('view/homework.php');
            break;
        case 'showChat' : 
            include ('view/chat.php');
            break;
        case 'showCloud' : 
            include ('view/cloud.php');
            break;
        case 'showCash' : 
            include ('view/cash.php');
            break;
        case 'pushHomework':
            include('pushHomework.php');
            break;
    }
}

?>