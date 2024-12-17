<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
</head>

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

            include('view/pushHomework.php');
            break;
        case 'openChat':
            if (isset($_GET['chatID']) && is_numeric($_GET['chatID'])) {
                $chatID = $_GET['chatID'];
                $chatOpen = true;
                include('view/chat.php'); 
                break;
            } else {
                echo "ID de chat invalide.";
            }
            break;
        case 'addMessage':
            if (isset($_POST['chatID'], $_POST['message_text']) && is_numeric($_POST['chatID'])) {
                $chatID = $_POST['chatID'];
                $message_text = trim($_POST['message_text']);
                
                if (isset($_SESSION['user_id']) && !empty($message_text)) {
                    addMessage($chatID, $_SESSION['user_id'], $message_text);
                }
            }
            header("Location: control.php?action=openChat&chatID=$chatID");
            exit();
        
        case 'justifAbsence':
            if (isset($_POST['absence_id']) && !empty($_FILES['justif_file']['name'])) {
                $absenceID = $_POST['absence_id'];
                $uploadDir = 'absence_justif/';
                $fileName = basename($_FILES['justif_file']['name']);
                $targetFilePath = $uploadDir . $fileName;
        
                // Vérification et téléchargement du fichier
                if (move_uploaded_file($_FILES['justif_file']['tmp_name'], $targetFilePath)) {
                    updateAbsenceJustif($absenceID, $fileName); 
                    echo "Justificatif téléchargé avec succès.";
                } else {
                    echo "Erreur lors du téléchargement du fichier.";
                }
            } else {
                echo "Fichier ou ID d'absence manquant.";
            }
            include('view/absence.php');
            break;
    }
}

?>