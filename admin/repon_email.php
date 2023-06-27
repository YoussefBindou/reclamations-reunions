<?php
require 'connection.php';
require 'session.php';

$id = $_GET['id'];
$query = "SELECT * FROM supportextern WHERE id = ?";
$statement = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($statement, "i", $id);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
$row = mysqli_fetch_assoc($result);
mysqli_stmt_close($statement);

// Check if the form is submitted
if (isset($_POST['send'])) {
  // Get the input data
  $nom = $row['nom'];
  $prenom = $row['prenom'];
  $email = $row['email'];
  $response = $_POST['detail'];
  $subject = 'Réponse de réclamation : ' . $row['resume_demande'];
  $message = "<html>
  <head>
  <style>
      img {
          display: block;
          margin-left: auto;
          margin-right: auto;
      }
  </style>
  </head>
  <body>
      <img src='https://ci3.googleusercontent.com/mail-sig/AIorK4ygxuFATywoHwbIxmbju1krjs1mq4NKWimktk-RUQHZFkBBWcbTEStyzbFaK0G3gmtb3_4RqRKowP-QtJDOEzQ0EHaF2fYMueSFR6Y57w=w1920-h937' alt='Centered Image'>
      <br><br>
      <center>
      Hello $prenom $nom,\n\n La réponse de l'académie est : $response
      </center>
  </body>
  </html>";

  $headers = "From: items.swap@gmail.com\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        if (mail($email, $subject, $message, $headers)) {
            $_SESSION['success'] = "User updated successfully";
            header('Location: view_extern_dom.php?id='.$row['id']);
            exit();
        } else {
            $_SESSION['error'] = "Failed to send email";
            header("Location: ".$_SERVER['HTTP_REFERER']);
            exit();
        }
      }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Send Response</title>
  <!-- Bootstrap CSS --><link rel="shortcut icon" href="../logo.webp" type="image/x-icon">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<style>
    .dark card-body {
      color: white;
    }

    .white card-body{
      color: white;
    }

  
  </style>
<body>
<header>
  <?php require 'Nav.php'; ?>
</header>
<div class="container" style="padding-top: 35px;">
  <div class="text-center mt-5">
    <h1>Send Response</h1>
  </div>

  <div class="row justify-content-center">
    <div class="col-lg-7">
      <div class="card mt-2" style="background-color: #ffffff00; ">
        <div class="card-body">
          <form method="post" id="contact-form" role="form" enctype="multipart/form-data"
                >
            <div class="form-group">
              <label for="detail">Response:</label>
              <textarea name="detail" class="form-control" rows="4" required="required"></textarea>
            </div>
            <div class="row justify-content-center">
              <div class="col-md-6">
                <input type="submit" class="btn btn-success btn-block" value="Send" name="send" onclick="return confirm('Are you sure you want to send this response request?')">
              </div>
              <div class="col-md-6">
                <input type="reset" class="btn btn-secondary btn-block" value="Cancel" >
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
