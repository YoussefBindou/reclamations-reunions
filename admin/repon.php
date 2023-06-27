<?php
require 'connection.php';
require 'session.php';

$id = $_SESSION['id'];
$supportId = $_GET['id'];
$req = "select id_user from support where id =$supportId";
$result = mysqli_query($con, $req);
$row = mysqli_fetch_assoc($result);
$id = $row['id_user'];
$successMessage = '';
$errorMessage = '';

// Check if the form is submitted
if (isset($_POST['send'])) {
  // Get the input data
  $response = $_POST['detail'];

  if (!empty($response)) {
    // Insert or update the data in the "repon" table
    $checkQuery = "SELECT * FROM support WHERE id = ? AND id_user = ?";
    $checkStatement = mysqli_prepare($con, $checkQuery);
    mysqli_stmt_bind_param($checkStatement, "ii", $supportId, $id);
    mysqli_stmt_execute($checkStatement);
    $result = mysqli_stmt_get_result($checkStatement);

    if (mysqli_num_rows($result) > 0) {
      // Update existing response
      $updateQuery = "UPDATE support SET repons = ? WHERE id = ? AND id_user = ?";
      $updateStatement = mysqli_prepare($con, $updateQuery);
      mysqli_stmt_bind_param($updateStatement, "sii", $response,$supportId, $id);
      mysqli_stmt_execute($updateStatement);
      mysqli_stmt_close($updateStatement);
      $successMessage = 'Response updated successfully.';
    } 
  } else {
    $errorMessage = 'Please enter a response.';
  }
}

// Get the existing response if available
$existingResponse = '';
$checkQuery = "SELECT repons FROM support WHERE id = ? AND id_user = ?";
$checkStatement = mysqli_prepare($con, $checkQuery);
mysqli_stmt_bind_param($checkStatement, "ii", $supportId, $id);
mysqli_stmt_execute($checkStatement);
$result = mysqli_stmt_get_result($checkStatement);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $existingResponse = $row['repons'];
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
      <div class="card mt-2" style="background-color: #ffffff00;">
        <div class="card-body">
          <?php if (!empty($successMessage)) : ?>
            <div class="alert alert-success" role="alert">
              <?php echo $successMessage; ?>
            </div>
          <?php endif; ?>

          <?php if (!empty($errorMessage)) : ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $errorMessage; ?>
            </div>
          <?php endif; ?>

          <form method="post" id="contact-form" role="form" enctype="multipart/form-data">
            <div class="form-group">
              <label for="detail">Response:</label>
              <textarea name="detail" class="form-control" rows="4" required="required"><?php echo $existingResponse; ?></textarea>
            </div>
            <div class="row justify-content-center">
              <div class="col-md-6">
                <input type="submit" class="btn btn-success btn-block" value="Send" name="send" onclick="return confirm('Are you sure you want to send this response request?')">
              </div>
              <div class="col-md-6">
                <input type="reset" class="btn btn-secondary btn-block" value="Cancel">
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
