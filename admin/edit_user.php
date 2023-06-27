<?php

require 'connection.php';
require 'session.php';
 
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

    <title>User Edit</title>
</head>
<body>
<header>
<?php

require 'Nav.php';
?>

</header>
    <div class="container mt-5" style="padding-top: 60px;">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>User Edit
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if (isset($_GET['id'])) {
                            $user_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM user JOIN bureau ON user.Bureau = bureau.id_Bureau WHERE id='$user_id' ";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                $User = mysqli_fetch_array($query_run);
                                ?>
                                <form action="code.php" method="POST" onsubmit="return confirm('Are you sure you want to update this user?');">
                                    <input type="hidden" name="User_id" value="<?= $User['id']; ?>">

                                    <div class="mb-3">
                                        <label>User Nom</label>
                                        <input type="text" name="name" value="<?= $User['nom']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>User Prénom</label>
                                        <input type="text" name="prenom" value="<?= $User['prenom']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>User Email</label>
                                        <input type="email" name="email" value="<?= $User['Email']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>User Phone</label>
                                        <input type="text" name="phone" value="<?= $User['Telephone']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>User Bureau</label>
                                        <select name="bureau" class="form-control">
                                            <?php
                                            $bureau_query = "SELECT * FROM bureau";
                                            $bureau_query_run = mysqli_query($con, $bureau_query);
                                            while ($bureau_row = mysqli_fetch_assoc($bureau_query_run)) {
                                                $selected = ($bureau_row['id_Bureau'] == $User['Bureau']) ? 'selected' : '';
                                                echo "<option value='" . $bureau_row['id_Bureau'] . "' $selected>" . $bureau_row['Bureau_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>User Sexe</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sexe" value="Male" <?= ($User['Sexe'] == 'Male') ? 'checked' : ''; ?>>
                                            <label class="form-check-label">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sexe" value="Female" <?= ($User['Sexe'] == 'Female') ? 'checked' : ''; ?>>
                                            <label class="form-check-label">Female</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label>User Username</label>
                                        <input type="text" name="username" value="<?= $User['USER']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>User Password</label>
                                        <input type="password" name="password" value="<?= $User['PASS']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="update_User" class="btn btn-primary">
                                            Update User
                                        </button>
                                    </div>

                                </form>
                                <?php
                            } else {
                                echo "<h4>No Such ID Found</h4>";
                            }
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
<style>
    .dark{
  color: white;
}

.white {
  color: white;
}

.card {
    background-color: #ffffff00;
    
}
</style>

