<?php
require 'connection.php';
require 'session.php';
$user = $_SESSION['user'];
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
    <title>Meeting_list</title>
    <link rel="shortcut icon" href="../logo.webp" type="image/x-icon">
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
                <h2>Meeting</h2>
                <div class="table-container">
                    <table class="table table-hover">
                    <thead>
                  <tr>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Location</th>
                                <th>Action</th>
                           
                  </tr>
                </thead>
                <tbody>
                            <?php
                            $query = "SELECT * FROM meetings where id_Bureau = ".$_SESSION['Bureau'];
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                while ($meeting = mysqli_fetch_assoc($query_run)) {
                                    ?>
                                    <tr>
                                        <td><?= $meeting['objet']; ?></td>
                                        <td><?= $meeting['date_reunion']; ?></td>
                                        <td><?= $meeting['heure_reunion']; ?></td>
                                        <td><?= $meeting['local']; ?></td>
                                        <td>
                                            <a href="view_meeting.php?id=<?= $meeting['id']; ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='5'>No Meetings Found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
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
