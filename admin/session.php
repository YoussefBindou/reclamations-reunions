<?php
session_start();

// Check if the user session is not set
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    // Redirect to the login page or any other suitable action
    header('location: ../index.php');
    exit();
}

    if($_SESSION['admin'] ==0){
    header('location: ../user/');}
   

?>