<!DOCTYPE html>
<html lang="fr">
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
            $_SESSION['user'] = $email;
            $_SESSION['mdp'] = $mdp;
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
        case 'home' :
            include("view/home.php");
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
            
            $homeWork_id = $_GET['idWork'];
            $pushHomework = true;
            
            
            include('view/Homework.php');
            break;
                
        case 'uploadHomework':
            
            $homeWork_id = $_GET['idWork'];
        
            
            $uploadResult = uploadHomeworkFile($_FILES, $homeWork_id);
            
           
            if ($uploadResult === true) {
                
                header('Location: control.php?action=showHomework');
                exit;
            } else {
                echo $uploadResult;
            }
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
            case 'showCloud';

            case 'showAddFolder':
                $addFolder = true;
                include('view/cloud.php');
                break;
            case 'showAddFile':
                
                header('Location: control.php?action=showCloud&addFile=true&folderId=' . $_GET['folderId']);
                break;
            
            if (isset($_GET['folderId']) && is_numeric($_GET['folderId'])) {
                $folderId = $_GET['folderId'];
                $folderOpen = true;
                include('view/cloud.php'); 
                break;
            } else {
                echo "ID de cloud invalide.";
            }
            break;
            case 'uploadFile':
                if (isset($_FILES['file']) && isset($_POST['folderId']) && is_numeric($_POST['folderId'])) {
                    $folderId = $_POST['folderId'];
                    $fileName = $_FILES['file']['name'];
                    $fileTmpName = $_FILES['file']['tmp_name'];
                    $uploadDir = 'uploads/';
                    $targetFilePath = $uploadDir . basename($fileName);
            
                    
                    if (move_uploaded_file($fileTmpName, $targetFilePath)) {
                        $db = dbConnect();
                        $requete = "INSERT INTO file (file_name, fk_folder_id, fk_user_id) VALUES (:fileName, :folderId, :userId)";
                        $stmt = $db->prepare($requete);
            
                        
                        $userId = $_SESSION['user_id']; 
            
                       
                        $stmt->bindParam(':fileName', $fileName, PDO::PARAM_STR);
                        $stmt->bindParam(':folderId', $folderId, PDO::PARAM_INT);
                        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            
                        
                        $stmt->execute();
            
                       
                        header("Location: control.php?action=showCloud&folderId=$folderId");
                    } else {
                        echo 'Erreur lors du téléchargement du fichier.';
                    }
                } else {
                    echo 'Fichier ou dossier manquant.';
                }
                break;
                case 'confirmDelete';
                    $fileId = $_GET['fileId'];
                    $folderId = $_GET['folderId'];
                    $confirmFileId = $fileId;
                    include('view/cloud.php');
                break;
                
                
                case 'deleteFile';
                    $fileId = $_GET['fileId'];
                
                    if (deleteFile($fileId)) {
                        echo "<p>Fichier supprimé avec succès.</p>";
                    } else {
                        echo "<p>Erreur lors de la suppression du fichier.</p>";
                    }
                    echo '<a href="control.php?action=showFolder&folderId=' . $_GET['folderId'] . '">Retour au dossier</a>';

                break;

                case 'createFolder';
                $folderName = $_POST['folderName'];
                createFolder($folderName, $_SESSION['user_id']);
                include('view/cloud.php');
                break;

                case 'confirmDeleteFolder':
                    $folderId = $_GET['folderId'];
                    $confirmDeleteFolder = true;
                    include('view/cloud.php');
                break;
                
                case 'deleteFolder':
                    if (isset($_GET['folderId']) && is_numeric($_GET['folderId'])) {
                        $folderId = $_GET['folderId'];
                        if (deleteFolder($folderId)) {
                            echo "<p>Dossier supprimé avec succès.</p>";
                        } else {
                            echo "<p>Erreur : impossible de supprimer le dossier.</p>";
                        }
                    }
                    header("Location: control.php?action=showCloud");
                    exit;
                    break;

                case 'showBackOffice' : 
                    include('view/backOffice.php');
                    break;
                case 'backAddNote' : 
                    include('view/addNote.php');
                    break;
                case 'backAddAbsence' : 
                    include('view/addAbsence.php');
                    break;
                case 'backAddHomework' : 
                    include('view/addHomework.php');
                    break;
                case 'addNote':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $user_id = $_POST['user_id'];
                        $matiere_id = $_POST['matiere_id'];
                        $note_value = $_POST['note_value'];
                        $note_coef = $_POST['note_coef'];
                
                        if (addNote($user_id, $matiere_id, $note_value, $note_coef)) {
                            echo "Succès Note ajouté !";
                            include('view/addNote.php');
                        } else {
                            echo "Erreur Note non ajouté";
                            include('view/addNote.php');
                        }
                    }
                    ;
                    break;
            
                    case 'addAbsence':
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $user_id = $_POST['student'];  
                            $matiere_id = $_POST['subject']; 
                            $absence_date = $_POST['date'];  
                            $end_date = $_POST['end_date'];  
                            $justif = $_POST['justif']; 
                            $description = isset($_POST['description']) ? $_POST['description'] : null; 
                    
                            
                            $result = addAbsence($user_id, $matiere_id, $absence_date, $end_date, $justif, $description);
                    
                            
                            if ($result) {
                                echo "Absence Ajoutée";
                                include('view/addAbsence.php'); 
                        break;
                            } else {
                                echo "Erreur";
                                include('view/addAbsence.php'); 
                        break;
                            }
                        }
                        
            
                case 'addHomework':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $devoir_nom = $_POST['devoir_nom'];
                        $devoir_desc = $_POST['devoir_desc'];
                        $devoir_date_fin = $_POST['devoir_date_fin'];
                        $fk_matiere_id = $_POST['fk_matiere_id'];
                        $fk_user_id = $_POST['user_id'];
                        if (addHomework($devoir_nom, $devoir_desc, $devoir_date_fin, $fk_matiere_id, $fk_user_id)) {
                            echo "Succès !";
                            include('view/addHomework.php');
                    break;
                        } else {
                            echo "Erreur";
                            include('view/addHomework.php');
                    break;
                        }
                    }
                    case 'updateHomework':
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idWork'])) {
                            $devoir_id = $_POST['idWork'];
                            $fichier = $_FILES['fichier'] ?? null;
                    
                            // Mise à jour du devoir
                            
                    
                            if ($result = updateHomework($devoir_id, $fichier, $_SESSION['user_id'])) {
                                echo "Devoir modifié avec succès.";
                                include('view/homework.php');
                            } else {
                                echo "Erreur lors de la modification.";
                            }
                        }
                        break;
                case 'backJustifAbsence' :
                include ('view/absencejustif.php');
                break;
                case 'validateAbsence':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $absence_id = $_POST['absence_id'];
                        validateAbsence($absence_id);
                        echo "Absence validé !";
                        break;
                    }
                break;
                case 'backHomeworkJustif' :
                include('view/backHomeworkJustif.php');
                break;


            }
                

    }

?>