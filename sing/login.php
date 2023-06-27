<?php
require 'code.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../logo.webp" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
    <title>Login Form</title>
    <style>
        .btn-color {
            background-color: #0e1c36;
            color: #fff;
        }

        .profile-image-pic {
            height: 200px;
            width: 200px;
            object-fit: cover;
        }

        .cardbody-color {
            background-color: #ebf2fa;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>
<body style="">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-dark mt-5">Login</h2>
                
                <div class="card my-5">
                    <form action="login.php" method="POST" autocomplete="off" class="card-body cardbody-color p-lg-5">
                        <div class="text-center">
                            <img src="https://yt3.googleusercontent.com/WitBfSvDX0mJDVrfNufNe0mpNU7rERfLzMIJfhbXZhMnbxBdCvgU6XWJlk6EJ_AU7pv5y9ku3g=s176-c-k-c0x00ffffff-no-rj" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                                width="200px" alt="profile">
                        </div>
                        <?php
                        if (count($errors) > 0) {
                            foreach ($errors as $showerror) {
                                echo '<div class="alert alert-danger text-center">' . $showerror . '</div>';
                            }
                        }
                        ?>
                        <div class="mb-3">
                        <input type="text" class="form-control" id="Username" name="user" aria-describedby="emailHelp" placeholder="User Name" required>

                        </div>
                        <div class="mb-3">
                           <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>

                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-color px-5 mb-5 w-100"  name="Login">Login</button>
                        </div>
                        <div id="emailHelp" class="form-text text-center mb-5 text-dark">
                            do you have problim? <a href="form_req.php" class="text-dark fw-bold">Contact Support</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
