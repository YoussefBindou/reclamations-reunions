<?php
require 'connection.php';
require 'session.php';
$id = $_SESSION['id'];

// Handle form submission



  // Check if the "Change Password" button was clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['changePassword'])) {
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate the form inputs
    if ($newPassword !== $confirmPassword) {
        echo "<script>alert('New passwords do not match')</script>";
    } else {
        // Fetch the current password from the database
        $fetchPasswordSql = "SELECT PASS FROM user WHERE id = '$id'";
        $result = $con->query($fetchPasswordSql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentPassword = $row['PASS'];

            // Verify the old password
            if ($oldPassword === $currentPassword) {
                // Update the password in the database
                $updatePasswordSql = "UPDATE user SET PASS = '$newPassword' WHERE id = '$id'";
                if ($con->query($updatePasswordSql) === TRUE) {
                    echo "<script>alert('Password updated successfully')</script>";
                } else {
                    echo "<script>alert('Failed to update password')</script>";
                }
            } else {
                echo "<script>alert('Old password is incorrect')</script>";
            }
        } else {
            echo "<script>alert('Failed to fetch current password')</script>";
        }
    }
}
  // Check if the "Change USER" button was clicked
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['changeUSER'])) {
    $oldUSER = $_POST['oldUSER'];
    $newUSER = $_POST['newUSER'];
    $confirmUSER = $_POST['confirmUSER'];

    // Validate the form inputs
    if ($newUSER !== $confirmUSER) {
        echo "<script>alert('New USERs do not match')</script>";
    } else {
        // Fetch the current USER from the database
        $fetchUSERSql = "SELECT USER FROM user WHERE id = '$id'";
        $result = $con->query($fetchUSERSql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentUSER = $row['USER'];

            // Verify the old USER
            if ($oldUSER === $currentUSER) {
                // Update the USER in the database
                $updateUSERSql = "UPDATE user SET USER = '$newUSER' WHERE id = '$id'";
                if ($con->query($updateUSERSql) === TRUE) {
                    echo "<script>alert('USER updated successfully')</script>";
                } else {
                    echo "<script>alert('Failed to update USER')</script>";
                }
            } else {
                echo "<script>alert('Old USER is incorrect')</script>";
            }
        } else {
            echo "<script>alert('Failed to fetch current USER')</script>";
        }
    }
}
    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="../logo.webp" type="image/x-icon">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <title>User information</title>
    </head>
    <body>

    <header>
        <?php
        require 'Nav.php';
        ?>
    </header>
    <style>
    .dark{
  color: white;
}

.white  {
  color: white;
}

.card {
    background-color: #fff0; 
}
</style>   
    <div class="container mt-5" style="padding-top: 60px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>User information
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($id)) {
                            $User_id = mysqli_real_escape_string($con, $id);
                            $query = "SELECT * FROM user JOIN bureau ON user.Bureau = bureau.id_Bureau WHERE id='$User_id' ";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                $User = mysqli_fetch_array($query_run);
                                ?>

                                <form id="editUserForm" method="post">
                                    <div class="mb-3">
                                        <label for="prenom" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $User['prenom']; ?>"readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="nom" name="nom" value="<?= $User['nom']; ?>"readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="Email" name="Email" value="<?= $User['Email']; ?> "readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Telephone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="Telephone" name="Telephone" value="<?= $User['Telephone']; ?>"readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Telephone" class="form-label">Bureau</label>
                                        <input type="text" class="form-control" id="Telephone" name="Telephone" value="<?= $User['Bureau_name']; ?>"readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Telephone" class="form-label">Sexe</label>
                                        <input type="text" class="form-control" id="Telephone" name="Telephone" value="<?= $User['Sexe']; ?>"readonly>
                                    </div>
                                    
                                    <button name="" class="btn btn-primary profile-button" type="button" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</button>
                                    <button name="" class="btn btn-primary profile-button" type="button" data-bs-toggle="modal" data-bs-target="#changeUSERModal">Change USER</button>
                               </form>

                                <?php
                            } else {
                                echo "<h4>No Such ID Found</h4>";
                            }
                        } else {
                            echo "<h4>Invalid ID</h4>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>

    <script>
            function showPreview(event) {
                if (event.target.files.length > 0) {
                    var src = URL.createObjectURL(event.target.files[0]);
                    var preview = document.getElementById("file-ip-1-preview");
                    preview.src = src;
                    preview.style.display = "block";
                }
            }
        </script>
        <!-- Change Password Modal -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="changePasswordForm" method="post">
                            <div class="mb-3">
                                <label for="oldPassword" class="form-label">Old Password</label>
                                <input type="password" class="form-control" id="oldPassword" name="oldPassword" required>
                            </div>
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="changePassword">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
           <!-- Change User Modal -->
           <div class="modal fade" id="changeUSERModal" tabindex="-1" aria-labelledby="changeUSERModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changeUSERModalLabel">Change USER</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="changeUSERForm" method="post">
                            <div class="mb-3">
                                <label for="oldUSER" class="form-label">Old USER</label>
                                <input type="USER" class="form-control" id="oldUSER" name="oldUSER" required>
                            </div>
                            <div class="mb-3">
                                <label for="newUSER" class="form-label">New USER</label>
                                <input type="USER" class="form-control" id="newUSER" name="newUSER" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmUSER" class="form-label">Confirm New USER</label>
                                <input type="USER" class="form-control" id="confirmUSER" name="confirmUSER" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="changeUSER">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


