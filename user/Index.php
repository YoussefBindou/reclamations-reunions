<?php
require 'connection.php';
require 'session.php';
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="../logo.webp" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Response</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<header>
    <?php require 'Nav.php'; ?>
  </header>
  
</body>
