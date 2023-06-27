<?php
require 'connection.php';
require 'session.php';

$id = $_SESSION['id'];
$supportId = $_GET['id'];
$successMessage = '';
$errorMessage = '';

// Check if the form is submitted
if (isset($_POST['send'])) {
    // Delete the support from the "seport" table
    $deleteQuery = "DELETE FROM support WHERE id = ? AND id_user = ?";
    $deleteStatement = mysqli_prepare($con, $deleteQuery);
    mysqli_stmt_bind_param($deleteStatement, "ii", $supportId, $id);
    if (mysqli_stmt_execute($deleteStatement)) {
        mysqli_stmt_close($deleteStatement);
        header("Location: ../user/seport_list.php"); // Redirect to your support list page
        exit();
    } else {
        $errorMessage = "Error deleting the support: " . mysqli_error($con);
    }
}

// Get the existing response if available
$existingResponse = '';
$checkQuery = "SELECT repons FROM support WHERE id = ? AND id_user = ?";
$checkStatement = mysqli_prepare($con, $checkQuery);
mysqli_stmt_bind_param($checkStatement, "ii", $supportId, $id);
if (mysqli_stmt_execute($checkStatement)) {
    $result = mysqli_stmt_get_result($checkStatement);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $existingResponse = $row['repons'];
    }
} else {
    $errorMessage = "Error executing the query: " . mysqli_error($con);
}
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
  <style>
    .dark{
  color: white;
}

.white  {
  color: white;
}

.card {
  background-color: #28282800;
}
</style>   

<div class="container" style="padding-top: 35px;">
    <div class="text-center mt-5">
        <h1>View Response</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card mt-2">
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
                            <textarea name="detail" class="form-control" rows="4"
                                      readonly><?php echo $existingResponse; ?></textarea>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-danger btn-block" value="Delete" name="send"
                                       onclick="return confirm('Are you sure you want to delete this support?')">
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
