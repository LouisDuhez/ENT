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
        
        case 'showNote' : 
            include('view/note.php');
        case 'showSchedule' : 
            include('view/schedule.php');
        case 'showHomework' : 
            include ('view/homework.php');
        case 'showChat' : 
            include ('view/chat.php');
        case 'showCloud' : 
            include ('view/cloud.php');
        case 'showCash' : 
            include ('view/cash.php');
    }
}

?>