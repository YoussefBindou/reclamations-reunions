<?php
require 'connection.php';
require 'session.php';

$errors = array();
$success = array();

///////////////////////////////////////// Delete User
if (isset($_POST['delete_User'])) {
    $user_id = $_POST['delete_User'];

    // Retrieve user details
    $query1 = "SELECT * FROM user WHERE id='$user_id'";
    $q_run = mysqli_query($con, $query1);
    $row = mysqli_fetch_assoc($q_run);
    $nom = $row['nom'];
    $prenom = $row['prenom'];
    $email = $row['Email'];

    // Delete the user from the database
    $query = "DELETE FROM user WHERE id='$user_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $subject = 'Account Details';
        $message = "Hello $prenom $nom,\n\nYour account has been deleted successfully";
        $sender = "From: items.swap@gmail.com";
        
        if (mail($email, $subject, $message, $sender)) {
            $success[] = "User deleted successfully";
            $_SESSION['success'] = $success;
            header("Location: index.php");
            exit(0);
        } else {
            $errors[] = "Failed to send email notification";
            $_SESSION['errors'] = $errors;
            header("Location: index.php");
            exit(0);
        }
    } else {
        $errors[] = "Failed to delete user";
        $_SESSION['errors'] = $errors;
        header("Location: index.php");
        exit(0);
    }
}

///////////////////////////////////////// Update User
if (isset($_POST['update_User'])) {
    $user_id = mysqli_real_escape_string($con, $_POST['User_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $prenom = mysqli_real_escape_string($con, $_POST['prenom']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $bureau = mysqli_real_escape_string($con, $_POST['bureau']);
    $sexe = mysqli_real_escape_string($con, $_POST['sexe']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Update the user in the database
    $query = "UPDATE user SET nom='$name', prenom='$prenom', Email='$email', Telephone='$phone', Bureau='$bureau', Sexe='$sexe', USER='$username', PASS='$password' WHERE id='$user_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $subject = 'Account Details';
        $message = "<html>
        <head>
        <style>
            img {
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
        </style>
        </head>
        <body>
            <img src='https://ci3.googleusercontent.com/mail-sig/AIorK4ygxuFATywoHwbIxmbju1krjs1mq4NKWimktk-RUQHZFkBBWcbTEStyzbFaK0G3gmtb3_4RqRKowP-QtJDOEzQ0EHaF2fYMueSFR6Y57w=w1920-h937' alt='Centered Image'>
            <br><br>
            <center>
            Hello $prenom $name,<br><br>
            Your account has been updated successfully.<br><br>
            Username: $username<br>
            Password: $password<br><br>
            Please keep this information secure.<br><br>
            Best regards,<br>
            Your Website
            </center>
        </body>
        </html>";

        $headers = "From: items.swap@gmail.com\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        if (mail($email, $subject, $message, $headers)) {
            $_SESSION['success'] = "User updated successfully";
            header("Location: ".$_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['error'] = "Failed to send email";
            header("Location: ".$_SERVER['HTTP_REFERER']);
            exit();
        }
    } else {
        $_SESSION['error'] = "Failed to update user";
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    }
}


///////////////////////////////////////// Add User
if (isset($_POST['add_user'])) {
    function generateRandomString($length = 8) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    $username = generateRandomString();
    $password = generateRandomString();
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sexe = $_POST['sexe'];
    $bureau = $_POST['Bureau'];
    $admin = 0;

    // Check if the email already exists in the database
    $email_check = "SELECT * FROM user WHERE Email = '$email'";
    $res = mysqli_query($con, $email_check);
    if (mysqli_num_rows($res) > 0) {
        header("Location: add_user.php");
        exit(0);
    } else {
        // Insert the user into the database
        $query = "INSERT INTO user (nom, prenom, Sexe, Bureau, Email, Telephone, USER, PASS, admin_y_n) VALUES ('$nom', '$prenom', '$sexe', '$bureau', '$email', '$phone', '$username', '$password', '$admin')";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            if ($query_run) {
                $subject = 'Account Details';
    $message = "
    <html>
    <head>
    <style>
        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    </head>
    <body>
        <img src='https://ci3.googleusercontent.com/mail-sig/AIorK4ygxuFATywoHwbIxmbju1krjs1mq4NKWimktk-RUQHZFkBBWcbTEStyzbFaK0G3gmtb3_4RqRKowP-QtJDOEzQ0EHaF2fYMueSFR6Y57w=w1920-h937' alt='Centered Image'>
        <br><br>
        Hello $prenom $nom,<br>
        Your account has been created successfully.<br>
        Username: $username<br>
        Password: $password<br><br>
        Please keep this information secure.<br><br>
        Best regards,<br>
        Your Website
    </body>
    </html>";
    $sender = "From: items.swap@gmail.com\r\n";
$sender .= "MIME-Version: 1.0\r\n";
$sender .= "Content-Type: text/html; charset=UTF-8\r\n";
            mail($email, $subject, $message, $sender);

            header("Location: add_user.php");
            exit(0);
        } else {
            header("Location: add_user.php");
            exit(0);
        }
    }
}
}
/////////////////////////////////////////add admin
if (isset($_POST['add_admin'])) {
    function generateRandomString($length = 8) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    $username = generateRandomString();
    $password = generateRandomString();
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sexe = $_POST['sexe'];
    $bureau = $_POST['Bureau'];
    $admin = 1;

    // Check if the email already exists in the database
    $email_check = "SELECT * FROM user WHERE Email = '$email'";
    $res = mysqli_query($con, $email_check);
    if (mysqli_num_rows($res) > 0) {
        header("Location: add_user.php");
        exit(0);
    } else {
        // Insert the user into the database
        $query = "INSERT INTO user (nom, prenom, Sexe, Bureau, Email, Telephone, USER, PASS, admin_y_n) VALUES ('$nom', '$prenom', '$sexe', '$bureau', '$email', '$phone', '$username', '$password', '$admin')";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $subject = 'Account Details';
$message = "
<html>
<head>
<style>
    img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
</style>
</head>
<body>
    <img src='https://ci3.googleusercontent.com/mail-sig/AIorK4ygxuFATywoHwbIxmbju1krjs1mq4NKWimktk-RUQHZFkBBWcbTEStyzbFaK0G3gmtb3_4RqRKowP-QtJDOEzQ0EHaF2fYMueSFR6Y57w=w1920-h937' alt='Centered Image'>
    <br><br>
    Hello $prenom $nom,<br>
    Your account has been created successfully.<br>
    Username: $username<br>
    Password: $password<br><br>
    Please keep this information secure.<br><br>
    Best regards,<br>
    Your Website
</body>
</html>";

$sender = "From: items.swap@gmail.com\r\n";
$sender .= "MIME-Version: 1.0\r\n";
$sender .= "Content-Type: text/html; charset=UTF-8\r\n";

if (mail($email, $subject, $message, $sender)) {
    echo "Email sent successfully to $email";
} else {
    echo "Sorry, failed while sending mail!";
}



            header("Location: add_user.php");
            exit(0);
        } else {
            header("Location: add_user.php");
            exit(0);
        }
    }
}
///////////////////////////////////////// Delete Meeting
// Delete Meeting
if (isset($_POST['delete_Meeting'])) {
    $meetingId = $_POST['delete_Meeting'];

    // Delete the meeting from the database
    $query = "DELETE FROM meetings WHERE id = $meetingId";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo '<script>alert("Meeting deleted successfully!");</script>';
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        echo '<script>alert("Error: ' . mysqli_error($con) . '");</script>';
    }
} 
///////////////////////////////////////// Delete Bureau
if (isset($_POST['delete_Bureau'])) {
    $bureauId = mysqli_real_escape_string($con, $_POST['delete_Bureau']);
    $deleteQuery = "DELETE FROM bureau WHERE id_Bureau = '$bureauId'";
    $deleteResult = mysqli_query($con, $deleteQuery);

    if ($deleteResult) {
        // Bureau deleted successfully
        echo '<script>alert("Bureau deleted successfully!");</script>';
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        // Error occurred
        echo '<script>alert("Error: ' . mysqli_error($con) . '");</script>';
    }
}
///////////////////////////////////////// Delete category
if (isset($_POST['delete_categorie'])) {
    $categorieId = mysqli_real_escape_string($con, $_POST['delete_categorie']);
    $deleteQuery = "DELETE FROM categorie WHERE id_categorie = '$categorieId'";
    $deleteResult = mysqli_query($con, $deleteQuery);

    if ($deleteResult) {
        // categorie deleted successfully
        echo '<script>alert("categorie deleted successfully!");</script>';
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        // Error occurred
        echo '<script>alert("Error: ' . mysqli_error($con) . '");</script>';
    }
}

?>
