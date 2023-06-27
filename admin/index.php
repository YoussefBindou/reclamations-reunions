<?php
require 'connection.php';
require 'session.php';
$user = $_SESSION['user'];
?>

<!doctype html>
<html lang="en">
<style>
.dark table tr{
  color: white;
}

.white table tr{
  color: white;
}

.dark {
  color: white;
}

.white {
  color: white;
}

</style>
<head>
<meta charset="UTF-8" />
<link rel="shortcut icon" href="../logo.webp" type="image/x-icon">
    <title>Home</title>
    
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
    <style>
        /* Add your custom CSS styling here */
        table.dataTable tbody tr {
    background-color: #ffffff00;
    
}

 </style>
<style>
  

  .cardBox .iconBx i {
        color: black;
        transition: color 0.3s;
    }
</style>

    <title>Users, Meetings, and bureau</title>
</head>

<body>
    <header>
        <div class="all" style="padding-top: 80px;">
            <?php require 'Nav.php'; ?>
        </div>
    </header>
   

    <div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <a href="user_list.php">
                <div class="cardBox">
                    <div class="card">
                        <div class="cardContent">
                            <div class="countIcon">
                                <div class="numbers">
                                    <?php
                                    $userCountQuery = "SELECT COUNT(*) as count FROM user";
                                    $userCountResult = mysqli_query($con, $userCountQuery);
                                    $userCount = mysqli_fetch_assoc($userCountResult)['count'];
                                    echo $userCount;
                                    ?>
                                </div>
                                <div class="iconBx">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="cardName">Users</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="meeting_list.php">
                <div class="cardBox">
                    <div class="card">
                        <div class="cardContent">
                            <div class="countIcon">
                                <div class="numbers">
                                    <?php
                                    $meetingCountQuery = "SELECT COUNT(*) as count FROM meetings";
                                    $meetingCountResult = mysqli_query($con, $meetingCountQuery);
                                    $meetingCount = mysqli_fetch_assoc($meetingCountResult)['count'];
                                    echo $meetingCount;
                                    ?>
                                </div>
                                <div class="iconBx">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                            <div class="cardName">Meetings</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php
          if($_SESSION['admin']==2){
            
            ?>
        <div class="col-md-3">
            <a href="bureau_list.php">
                <div class="cardBox">
                    <div class="card">
                        <div class="cardContent">
                            <div class="countIcon">
                                <div class="numbers">
                                    <?php
                                    $bureauCountQuery = "SELECT COUNT(*) as count FROM bureau";
                                    $bureauCountResult = mysqli_query($con, $bureauCountQuery);
                                    $bureauCount = mysqli_fetch_assoc($bureauCountResult)['count'];
                                    echo $bureauCount;
                                    ?>
                                </div>
                                <div class="iconBx">
                                    <i class="fas fa-building"></i>
                                </div>
                            </div>
                            <div class="cardName">Bureaus</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php
          }
          ?>
        <div class="col-md-3">
            <a href="supoort_list.php">
                <div class="cardBox">
                    <div class="card">
                        <div class="cardContent">
                            <div class="countIcon">
                                <div class="numbers">
                                    <?php
                                    $supportCountQuery = "SELECT COUNT(*) as count FROM support";
                                    $supportCountResult = mysqli_query($con, $supportCountQuery);
                                    $supportCount = mysqli_fetch_assoc($supportCountResult)['count'];
                                    echo $supportCount;
                                    ?>
                                </div>
                                <div class="iconBx">
                                    <i class="fas fa-hands-helping"></i>
                                </div>
                            </div>
                            <div class="cardName">Support Requests</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php
          if($_SESSION['admin']!=2){
            
            ?>
<div class="col-md-3">
            <a href="extern-dommands.php">
                <div class="cardBox">
                    <div class="card">
                        <div class="cardContent">
                            <div class="countIcon">
                                <div class="numbers">
                                    <?php
                                    $bureauCountQuery = "SELECT COUNT(*) as count FROM supportextern";
                                    $bureauCountResult = mysqli_query($con, $bureauCountQuery);
                                    $bureauCount = mysqli_fetch_assoc($bureauCountResult)['count'];
                                    echo $bureauCount;
                                    ?>
                                </div>
                                <div class="iconBx">
                                <i class="fas fa-hands-helping"></i>
                                </div>
                            </div>
                            <div class="cardName">support extern</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php
          }
          ?>
        </div>
</div>

    <div class="container mt-4">
        
            <div class="row">
                
                <div class="col-md-6">
                    <h2>Users</h2>
                    <table class="table mb-0">
                    <caption><a href="user_list.php" style="text-decoration: none;">List of Users</a></caption>

                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>bureau</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($user == "admin") {
                                $query = "SELECT * FROM user JOIN bureau ON user.bureau = bureau.id_Bureau WHERE user != 'admin' ORDER BY RAND() LIMIT 5";
                            } else {
                                $query = "SELECT * FROM user JOIN bureau ON user.bureau = bureau.id_Bureau WHERE admin_y_n = 0 ORDER BY RAND() LIMIT 5";
                            }

                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                while ($user = mysqli_fetch_assoc($query_run)) {
                                    ?>
                                    <tr>
                                        <td><?= $user['prenom'] . ' ' . $user['nom']; ?></td>
                                        <td><?= $user['Bureau_name']; ?></td>
                                        <td>
                                            <a href="view_user.php?id=<?= $user['id']; ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="edit_user.php?id=<?= $user['id']; ?>" class="btn btn-success btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="code.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                <button type="submit" id="Confirm" name="delete_User" value="<?= $user['id']; ?>" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='3'>No Users Found</td></tr>";
                            }
                           

                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <h2>Meetings</h2>
                    <table class="table mb-0">
                    <caption><a href="meeting_list.php" style="text-decoration: none;">List of Meetings</a></caption>

                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Date</th>
                                <th>count</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $query = "SELECT * FROM meetings  ORDER BY RAND() LIMIT 5";
                            $query_run = mysqli_query($con, $query);
                            

                            if (mysqli_num_rows($query_run) > 0) {
                                while ($meeting = mysqli_fetch_assoc($query_run)) {
                                    $req = "SELECT COUNT(*) AS count FROM votes WHERE id_meeting = " . $meeting['id'];
                                    $voteCountResult = mysqli_query($con, $req);
                                    $supportCount = mysqli_fetch_assoc($voteCountResult)['count'];
                                  

                                    ?>
                                    <tr>
                                        <td><?= $meeting['objet']; ?></td>
                                        <td><?= $meeting['date_reunion']; ?></td>
                                        <td><?= $supportCount; ?></td>
                                        <td>
                                            <a href="view_meeting.php?id=<?= $meeting['id']; ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <?php
                                              if($meeting["id_admin"] == $_SESSION['id'] || $_SESSION['admin'] == 2){
                                            ?>
                                            <a href="edit_meeting.php?id=<?= $meeting['id']; ?>" class="btn btn-success btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="code.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this meeting?');">
                                                <button type="submit" id="Confirm" name="delete_Meeting" value="<?= $meeting['id']; ?>" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            <?php
                                            }
                                            ?>
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

            <div class="row">
            <?php
          if($_SESSION['admin']==2){
            
            ?>
            <div class="col-md-6">

                    <h2>bureau</h2>
                    <table class="table mb-0">
                    <caption><a href="bureau_list.php" style="text-decoration: none;">List of bureau</a></caption>

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>bureau Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM bureau where id_Bureau <> 14 ORDER BY RAND() LIMIT 5";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                while ($bureau = mysqli_fetch_assoc($query_run)) {
                                    ?>
                                    <tr>
                                        <td><?= $bureau['id_Bureau']; ?></td>
                                        <td><?= $bureau['Bureau_name']; ?></td>
                                        <td>
                                        <form action="code.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this bureau?');">
                                        <button type="submit" name="delete_Bureau" value="<?= $bureau['id_Bureau']; ?>" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                         </form>

                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='3'>No bureaus Found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                
                <?php
          }
          ?>
                <div class="col-md-6">
                    <h2>Support Requests</h2>
                    <table class="table mb-0">
                    <caption><a href="supoort_list.php" style="text-decoration: none;">List of Support Requests</a></caption>

                        <thead>
                            <tr>
                                <th>Type</th>
                               
                                <th>Priority</th>
                                <th>User ID</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($_SESSION['admin']==2){
                                $query = "SELECT s.*,u.*,s.id as id_cat FROM support s join user u on s.id_user=u.id ORDER BY RAND() LIMIT 5";}
                                else{
                                    $query = "SELECT s.*,u.*,s.id as id_cat FROM support s join user u on s.id_user=u.id where admin_y_n <> 1 ORDER BY RAND() LIMIT 5  ";
                                }
                            
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                while ($support = mysqli_fetch_assoc($query_run)) {
                                    ?>
                                    <tr>
                                        <td><?= $support['type_demande']; ?></td>
                                        
                                        <td><?= $support['priorite']; ?></td>
                                        <td><?= $support['prenom'] . ' ' . $support['nom']; ?></td>
                                        <td>
                                            <a href="view_support.php?id=<?= $support['id_cat']; ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
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
            </div>
        </div>
    </div>
    <div>
</body>
<script>
       
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</html>
<style>
<style>
    .cardContent {
        display: flex;
        align-items: center;
    }

    .countIcon {
        display: flex;
        align-items: center;
    }

    .numbers {
        margin-right: 10px;
    }

    .iconBx {
        margin-right: 10px;
    }

    .cardName {
        cursor: pointer;
    }

  


.cardBox {
    margin-bottom: 20px;
}

.card {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: background-color 0.3s ease;
}

.card:hover {
    background-color: #f5f5f5;
}

.numbers {
    font-size: 32px;
    font-weight: bold;
    color: #000;
}

.cardName {
    underline
    font-size: 18px;
    font-weight: bold;
    color: #333333;
}

.iconBx {
    font-size: 40px;
    color: #4e73df;
}

a:link {
      text-decoration: none;
}







</style>
