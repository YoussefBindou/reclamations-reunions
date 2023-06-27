<?php
include_once 'connection.php';
session_start();
$user = "";
$pass = "";
$errors = array();
?>
<?php
if (isset($_POST['Login'])) {
    $user = mysqli_real_escape_string($con, $_POST['user']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $check_user = "SELECT * FROM user WHERE USER = '$user'";
    $res = mysqli_query($con, $check_user);
    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['PASS'];
        if ($password == $fetch_pass) {//password_verify($password, $fetch_pass
                $_SESSION['user'] = $user;
                $_SESSION['password'] = $password;
                $_SESSION['id'] = $fetch['id'];
                $_SESSION['admin'] = $fetch['admin_y_n'];
                $_SESSION['Bureau'] = $fetch['Bureau'];
                $_SESSION['name'] = $fetch['prenom']." ". $fetch['nom'];
                if($fetch['admin_y_n']==2){
                    header('location: ../user/index.php');
                }
                else {
                    header('location: ../admin/Index.php');
                }
                
            }
            else{
            $errors['user']="Le mot de passe n'est pas correct";} 
        }
        else {
            $errors['user'] = "It's look like you're not yet a member! contact admin to create acc .";
        }
    } 
?>
