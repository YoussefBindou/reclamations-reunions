<?php
 
require 'connection.php';
require 'session.php';
 
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../logo.webp" type="image/x-icon">
   <link rel="stylesheet" href="style/add_user.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    
    <title>User Create</title>
</head>

<body>
<header>
<?php

require 'Nav.php';
?>
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
</header>
<section>

    <div class="container mt-5"  style="padding-top: 60px;">

    

        
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>User Add
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php"  method="POST">

                            <div class="mb-3">
                                <label>Nom</label>
                                <input type="text" name="nom" class="form-control" Required>
                            </div>
                            <div class="mb-3">
                                <label>Prénom</label>
                                <input type="text" name="prenom" class="form-control"Required>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control"Required>
                            </div>
                            <div class="mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Sexe</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sexe"
                                        id="sexe_m" value="Male" checked>
                                    <label class="form-check-label" for="sexe_m">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sexe"
                                        id="sexe_f" value="Female" >
                                    <label class="form-check-label" for="sexe_f">
                                        Female
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>Bureau</label>
                                <select name="Bureau" class="form-select" required>
                                    <?php
                                    $req = "SELECT * FROM bureau";
                                    $rs = mysqli_query($con, $req);
                                    while ($row = mysqli_fetch_row($rs)) {
                                        ?>
                                        <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                
                                <button type="submit" name="add_user" class="btn btn-primary">Add User</button>
                                <span class="overlay"></span>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    

    </section>
  </body>
</html>

