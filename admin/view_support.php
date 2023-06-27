<?php
require 'connection.php';
require 'session.php';

$id = $_SESSION['id'];

// Fetch specific support request information
$supportId = $_GET['id']; // Assuming you have the support request ID from a previous page
$query = "SELECT categorie_name FROM support s JOIN categorie c ON s.categorie = c.id_categorie WHERE id = $supportId";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
if (mysqli_num_rows($result) == 1) {
$query = "SELECT date_enregistrement, type_demande, resume_demande, detail, priorite, fichier_attache FROM support WHERE id = ?";
$statement = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($statement, "i", $supportId);
mysqli_stmt_execute($statement);
mysqli_stmt_bind_result($statement, $date, $type, $resume, $detail, $priorite, $fichier);
mysqli_stmt_fetch($statement);
mysqli_stmt_close($statement);


// Check if Delete button is clicked
if (isset($_POST['delete'])) {
  // Delete the support request from the sopport table
  $deleteQuery = "DELETE FROM support WHERE id = ?";
  $deleteStatement = mysqli_prepare($con, $deleteQuery);
  mysqli_stmt_bind_param($deleteStatement, "i", $supportId);
  mysqli_stmt_execute($deleteStatement);
  mysqli_stmt_close($deleteStatement);

  // Redirect to the index.php or any other desired page after deletion
  header("Location: " . $_SERVER['HTTP_REFERER']);
  exit();
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
  <title>Support Request</title>
</head>
<body>
  <header>
    <?php require 'Nav.php'; ?>
  </header>
  <style>
    .dark {
      color: white;
    }

    .white {
      color: white;
    }

    .bg-light {
      --bs-bg-opacity: 0;
    }
  </style>
  <div class="container" style="padding-top: 35px;">
    <div class="text-center mt-5">
      <h1>Support Request</h1>
    </div>
    <div class="row">
      <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4 bg-light">
          <div class="card-body bg-light">
            <div class="container">
              <form method="post" id="contact-form" role="form" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="form_date">Date d'enregistrement:</label>
                  <input type="text" name="date" class="form-control" value="<?php echo $date; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="form_type">Type demande:</label>
                  <input type="text" name="type" class="form-control" value="<?php echo $type; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="form_categorie">Catégorie Métiers:</label>
                  <input type="text" name="categorie" class="form-control" value="<?php echo $row['categorie_name']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="form_resume">Résumé de la demande:</label>
                  <input type="text" name="resume" class="form-control" value="<?php echo $resume; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="form_detail">Détail:</label>
                  <textarea name="detail" class="form-control" rows="4" readonly><?php echo $detail; ?></textarea>
                </div>
                <div class="form-group">
                  <label for="form_priorite">Priorité:</label>
                  <input type="text" name="priorite" class="form-control" value="<?php echo $priorite; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="form_file">Fichier attaché:</label>
                  <div class="input-group">
                    <input type="text" class="form-control" value="<?php echo $fichier; ?>" readonly>
                    <div class="input-group-append">
                      <a href="file_sup/<?php echo $fichier; ?>" class="btn btn-primary" target="_blank">Open File</a>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <a href="repon.php?id=<?php echo $supportId ?>" type="submit" name="repponse" class="btn btn-block">Repponse</a>
                    <button type="submit" name="delete" class="btn btn-danger btn-block" onclick="return confirm('Are you sure you want to delete this support request?')">Delete</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  }
  else {
                            echo "<h4>Invalid ID</h4>";
                        }
                        ?>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>
