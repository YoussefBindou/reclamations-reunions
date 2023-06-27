<?php
require 'connection.php';
require 'session.php';
$user = $_SESSION['user'];
$id = $_SESSION['id'];
?>

<!doctype html>
<html lang="en">
<style>
.dark table tr {
    color: white;
}

.white table tr {
    color: white;
}

.dark {
    color: white;
}

.white {
    color: white;
}

.table-container {
    margin-bottom: 30px;
}
</style>
<head>
    <meta charset="UTF-8" />
    <title>Support Requests List</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <link rel="stylesheet" href="./av/style/navbar.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="../logo.webp" type="image/x-icon">
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

    <!-- Include DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <style>
        /* Add your custom CSS styling here */
        table.dataTable tbody tr {
            background-color: #ffffff00;
        }
    </style>
</head>

<body>
    <header>
        <div class="all" style="padding-top: 80px;">
            <?php require 'Nav.php'; ?>
        </div>
    </header>

<center>
<div class="col-md-6">
                    <h2>Support Requests</h2>
                    <table class="table mb-0">
                    
                        <thead>
                            <tr>
                                <th>Type</th>
                               
                                <th>Priority</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT s.*,u.*,s.id as id_sup FROM support s join user u on s.id_user=u.id where s.id_user=$id";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                while ($support = mysqli_fetch_assoc($query_run)) {
                                    ?>
                                    <tr>
                                        <td><?= $support['type_demande']; ?></td>
                                        
                                        <td><?= $support['priorite']; ?></td>
                                        <td>
                                            <a href="view_support_admin.php?id=<?= $support['id_sup']; ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            <form action="code.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this support request?');">
                                                <button type="submit" id="Confirm" name="delete_Support" value="<?= $support['id_sup']; ?>" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='6'>No Support Requests Found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
 </center>
</body>
<script>
    $(document).ready(function() {
        var $table = $('.table');
        
        if ($table.find('tbody tr').length >= 0) {
            $table.DataTable();
        }
    });
</script>


</html>
