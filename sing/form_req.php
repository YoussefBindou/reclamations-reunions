<?php
// Assuming you have already established a database connection
// and stored it in the $con variable
include 'connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $prenom = $_POST['prenom'];
  $nom = $_POST['nom'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $adresse = $_POST['adresse'];
  $type_demande = $_POST['type'];
  $resume_demande = $_POST['resume'];
  $detail = $_POST['detail'];
  $priorite = $_POST['priorite'];

  // Prepare the insert statement
  $query = "INSERT INTO supportextern (prenom, nom, email, phone, adresse, date_enregistrement, type_demande, resume_demande, detail, priorite)
            VALUES (?, ?, ?, ?, ?, CURDATE(), ?, ?, ?, ?)";
  $stmt = mysqli_prepare($con, $query);
  mysqli_stmt_bind_param($stmt, "sssssssss", $prenom, $nom, $email, $phone, $adresse, $type_demande, $resume_demande, $detail, $priorite);

  // Execute the statement
  if (mysqli_stmt_execute($stmt)) {
    // Insertion successful
    $successMessage = "Data inserted successfully!";
  } else {
    // Error occurred during insertion
    $errorMessage = "Error: " . mysqli_error($con);
  }

  // Close the prepared statement
  mysqli_stmt_close($stmt);
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <!-- Bootstrap CSS --><link rel="shortcut icon" href="../logo.webp" type="image/x-icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Date d'enregistrement</title>
</head>
<body>  
  <div class="container">
    <div class="text-center mt-5">
      <h1>SEND</h1>
      <?php if (isset($successMessage)): ?>
        <div class="alert alert-success mt-3">
          <?php echo $successMessage; ?>
        </div>
      <?php endif; ?>
      <?php if (isset($errorMessage)): ?>
        <div class="alert alert-danger mt-3">
          <?php echo $errorMessage; ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="row">
      <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4 bg-light">
          <div class="card-body bg-light">
            <div class="container">
              <form method="post" id="contact-form" role="form" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to send this?');">
              <h4>
                            <a href="../" class="btn btn-danger float-end">BACK</a>
                        </h4>
                <div class="form-group">
                  <label for="form_prenom">Prénom:</label>
                  <input id="form_prenom" type="text" name="prenom" class="form-control" placeholder="Enter your first name" required="required">
                </div>
                <div class="form-group">
                  <label for="form_nom">Nom:</label>
                  <input id="form_nom" type="text" name="nom" class="form-control" placeholder="Enter your last name" required="required">
                </div>
                <div class="form-group">
                  <label for="form_email">Email:</label>
                  <input id="form_email" type="email" name="email" class="form-control" placeholder="Enter your email" required="required">
                </div>
                <div class="form-group">
                  <label for="form_phone">Phone:</label>
                  <input id="form_phone" type="tel" name="phone" class="form-control" placeholder="Enter your phone number" required="required">
                </div>
                <div class="form-group">
                  <label for="form_adresse">Adresse:</label>
                  <input id="form_adresse" type="text" name="adresse" class="form-control" placeholder="Enter your address" required="required">
                </div>
                <div class="form-group">
                  <label for="form_type">Type demande:</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" id="support" value="support" required="required">
                    <label class="form-check-label" for="support">Support</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" id="demande" value="demande" required="required">
                    <label class="form-check-label" for="demande">Demande</label>
                  </div>
                </div>
               
                <div class="form-group">
                  <label for="form_resume">Résumé de la demande:</label>
                  <input id="form_resume" type="text" name="resume" class="form-control" placeholder="Enter a one-line summary" required="required">
                </div>
                <div class="form-group">
                  <label for="form_detail">Détail:</label>
                  <textarea id="form_detail" name="detail" class="form-control" placeholder="Enter the details" rows="4" required="required"></textarea>
                </div>
                <div class="form-group">
                  <label for="form_priorite">Priorité:</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="priorite" id="bas" value="bas" required="required">
                    <label class="form-check-label" for="bas">Bas</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="priorite" id="moyenne" value="moyenne" required="required">
                    <label class="form-check-label" for="moyenne">Moyenne</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="priorite" id="haut" value="haut" required="required">
                    <label class="form-check-label" for="haut">Haut</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="priorite" id="bloquant" value="bloquant" required="required">
                    <label class="form-check-label" for="bloquant">Bloquant</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <input type="submit" class="btn btn-success btn-block" value="Envoyer" name="send"></input>
                  </div>
                  <div class="col-md-6">
                    <input type="reset" class="btn btn-secondary btn-block" value="Cancel"></input>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>
