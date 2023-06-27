<?php
require 'connection.php';
require 'session.php';

$id = $_SESSION['id'];

// Check if the form is submitted
if (isset($_POST['send'])) {
  // Get the form data
  $type = htmlspecialchars($_POST['type']);
  $categorie = htmlspecialchars($_POST['categorie']);
  $resume = htmlspecialchars($_POST['resume']);
  $detail = htmlspecialchars($_POST['detail']);
  $priorite = htmlspecialchars($_POST['priorite']);

  // Generate a unique filename for the uploaded file
  if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $filename = uniqid() . '_' . $_FILES['file']['name'];

    // Set the destination folder for the uploaded file
    $destination = '../user/file_sup/' . $filename;

    // Move the uploaded file to the destination folder
    if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {
      // Prepare the SQL query to insert the data into the 'support' table
      $query = "INSERT INTO support (date_enregistrement, type_demande, categorie, resume_demande, detail, fichier_attache, priorite, id_user) VALUES (CURDATE(), ?, ?, ?, ?, ?, ?, $id)";
      $statement = mysqli_prepare($con, $query);

      // Bind the form data to the query parameters
      mysqli_stmt_bind_param($statement, "sissss", $type, $categorie, $resume, $detail, $filename, $priorite);


      // Execute the query
      if (mysqli_stmt_execute($statement)) {
        // Insertion successful
        echo "<script>alert('Form data inserted successfully.');</script>";
      } else {
        // Insertion failed
        echo "<script>alert('Failed to insert form data.');</script>";
      }

      // Close the prepared statement
      mysqli_stmt_close($statement);
    } else {
      // File upload failed
      echo "<script>alert('Failed to upload the file.');</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="shortcut icon" href="../logo.webp" type="image/x-icon">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Support</title>
</head>
<body>
  <header>
    <?php require 'Nav.php'; ?>
  </header>
  <style>
    .dark{
  color: white;
}

.white  {
  color: white;
}

.bg-light {
    --bs-bg-opacity: 0;
}
</style>   
  <div class="container" style="padding-top: 45px;">
    <div class="text-center mt-5">
      <h1>Support</h1>
    </div>

    <div class="row">
      <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4 bg-light">
          <div class="card-body bg-light">
            <div class="container">
              <form method="post" id="contact-form" role="form" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to send this?');">
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
                  <label for="form_categorie">Catégorie Métiers:</label>
                  <select id="form_categorie" name="categorie" class="form-control" required="required">
                    <?php
                    $query = "SELECT id_categorie, categorie_name FROM categorie";
                    $result = mysqli_query($con, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id_categorie'];
                        $name = $row['categorie_name'];
                        echo "<option value='$id'>$name</option>";
                      }
                    } else {
                      echo "<option value=''>No categories found</option>";
                    }
                    ?>
                  </select>
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
                  <label for="form_file">Fichier attaché:</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="form_file" name="file" accept=".pdf, .doc, .docx" required="required">
                    <label class="custom-file-label" for="form_file">Choose file</label>
                  </div>
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
