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

    <title>User information</title>
</head>
<body>

<header>
<?php

require 'Nav.php';
?>

</header>

    <div class="container mt-5"  style="padding-top: 60px;">

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
                        if (isset($_GET['id'])) {
                            $User_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM user JOIN bureau ON user.Bureau = bureau.id_Bureau WHERE id='$User_id' ";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                $User = mysqli_fetch_array($query_run);
                                ?>

                                <div class="mb-3">
                                    <label>User Name</label>
                                    <p class="form-control">
                                        <?= $User['prenom'] . ' ' . $User['nom']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>User Email</label>
                                    <p class="form-control">
                                        <?= $User['Email']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>User Phone</label>
                                    <p class="form-control">
                                        <?= $User['Telephone']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>User Bureau</label>
                                    <p class="form-control">
                                        <?= $User['Bureau_name']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Sexe</label>
                                    <p class="form-control">
                                        <?= $User['Sexe']; ?>
                                    </p>
                                </div>
                                <?php
                                    if($User['admin_y_n']!=0){
                                        $a = "admin";
                                    }
                                    else{
                                        $a = "user";
                                    }
                                ?>
                                <div class="mb-3">
                                    <label>Role</label>
                                    <p class="form-control">
                                        <?= $a; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Username</label>
                                    <p class="form-control">
                                        <?= $User['USER']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Password</label>
                                    <p class="form-control">
                                        <?= $User['PASS']; ?>
                                    </p>
                                </div>

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
