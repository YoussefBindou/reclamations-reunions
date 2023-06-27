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
if (mysqli_num_rows($result) == 1) {
// Check if Delete button is clicked
if (isset($_POST['delete'])) {
  // Delete the support request from the supportextern table
  $deleteQuery = "DELETE FROM supportextern WHERE id = ?";
  $deleteStatement = mysqli_prepare($con, $deleteQuery);
  mysqli_stmt_bind_param($deleteStatement, "i", $id);
  mysqli_stmt_execute($deleteStatement);
  mysqli_stmt_close($deleteStatement);

  // Redirect to the index.php or any other desired page after deletion
  header("Location: extern-dommands.php");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <!-- Bootstrap CSS -->
  <link rel="shortcut icon" href="../logo.webp" type="image/x-icon">
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
              <div class="form-group">
                  <label for="form_date">Date d'enregistrement:</label>
                  <input type="text" name="date" class="form-control" value="<?php echo $row['date_enregistrement']; ?>" readonly>
                </div>
                  <label for="form_date">Name:</label>
                  <input type="text" name="date" class="form-control" value="<?php echo $row['prenom']." ".$row['nom']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="form_date">Adresse:</label>
                  <input type="text" name="date" class="form-control" value="<?php echo $row['adresse']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="form_date">Phone:</label>
                  <input type="text" name="date" class="form-control" value="<?php echo $row['phone']; ?>" readonly>
                </div>  
              
                <div class="form-group">
                  <label for="form_type">Type demande:</label>
                  <input type="text" name="type" class="form-control" value="<?php echo $row['type_demande']; ?>" readonly>
                </div>
                
                <div class="form-group">
                  <label for="form_resume">Résumé de la demande:</label>
                  <input type="text" name="resume" class="form-control" value="<?php echo $row['resume_demande']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="form_detail">Détail:</label>
                  <textarea name="detail" class="form-control" rows="4" readonly><?php echo $row['detail']; ?></textarea>
                </div>
                <div class="form-group">
                  <label for="form_priorite">Priorité:</label>
                  <input type="text" name="priorite" class="form-control" value="<?php echo $row['priorite']; ?>" readonly>
                </div>
               

                <div class="row">
                  <div class="col-md-12">
                    <a href="repon_email.php?id=<?php echo $id ?>" type="submit" name="repponse" class="btn btn-block">Repponse</a>
                    <button type="submit" name="delete" class="btn btn-danger btn-block" onclick="return confirm('Are you sure you want to delete this support request?')">Delete</button>
                  </div>
                </div>
              </form>
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
  </div>

  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>
