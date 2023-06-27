<?php
require 'connection.php';
require 'session.php';
$user = $_SESSION['user'];
if (isset($_POST['delete_Support'])) {
    $supportId = $_POST['delete_Support'];
    // Delete the support from the "seport" table
    $deleteQuery = "DELETE FROM support WHERE id = ? ";
    $deleteStatement = mysqli_prepare($con, $deleteQuery);
    mysqli_stmt_bind_param($deleteStatement, "i", $supportId);
    if (mysqli_stmt_execute($deleteStatement)) {
        mysqli_stmt_close($deleteStatement);
        header("Location: ../user/seport_list.php"); // Redirect to your support list page
        exit();
    } else {
        $errorMessage = "Error deleting the support: " . mysqli_error($con);
    }
}
?>