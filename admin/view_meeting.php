<?php
require 'connection.php';
require 'session.php';

// Check if the user is an admin
if ($_SESSION['admin'] == 0) {
    header('location: ../user/index.php');
    exit;
}

// Check if the meeting ID is provided
if (isset($_GET['id'])) {
    $meetingId = $_GET['id'];

    // Retrieve the meeting from the database
    $query = "SELECT * FROM meetings m
    JOIN bureau b ON b.id_Bureau = m.id_Bureau
    JOIN user u ON u.id = m.id_admin
    WHERE m.id = $meetingId";

$result = mysqli_query($con, $query);


    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $date = $row['date_reunion'];
        $time = $row['heure_reunion'];
        $object = $row['objet'];
        $detail = $row['detail'];
        $duration = $row['duree'];
        $location = $row['local'];
    } else {
        echo "Meeting not found.";
        exit;
    }
} else {
    echo "Meeting ID not provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- Bootstrap CSS --><link rel="shortcut icon" href="../logo.webp" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Meeting</title>
</head>
   
<body>
    <header>
        <?php require 'Nav.php'; ?>
    </header>
    <div class="container" style="padding-top:45px;">
        <div class="text-center mt-5">
            <h1>View Meeting</h1>
        </div>

        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="card mt-2 mx-auto p-4 bg-light">
                    <div class="card-body bg-light">
                        <div class="container">
                            <div class="form-group">
                                <label for="form_date">Date:</label>
                                <input id="form_date" type="text" class="form-control" value="<?php echo $date; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="form_time">Time:</label>
                                <input id="form_time" type="text" class="form-control" value="<?php echo $time; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="form_object">Object:</label>
                                <input id="form_object" type="text" class="form-control" value="<?php echo $object; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="form_detail">Detail:</label>
                                <textarea id="form_detail" class="form-control" rows="4" disabled><?php echo $detail; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="form_duration">Duration:</label>
                                <input id="form_duration" type="text" class="form-control" value="<?php echo $duration; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="form_location">Location:</label>
                                <input id="form_location" type="text" class="form-control" value="<?php echo $location; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="form_time">ADD by :</label>
                                <input id="form_time" type="text" class="form-control" value="<?php echo $row['prenom']." ". $row['nom']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="form_time">Bureau :</label>
                                <input id="form_time" type="text" class="form-control" value="<?php echo $row['Bureau_name']; ?>" disabled>
                            </div>
                            <div class="form-group">
                            <label for="form_voters">Voters:</label>
                            <select id="form_voters" class="form-control" >
                                <?php
                                // Retrieve the list of users who voted for the meeting
                                $votersQuery = "SELECT prenom , nom  FROM user INNER JOIN votes ON user.id = votes.id_user WHERE votes.id_meeting = $meetingId";
                                $votersResult = mysqli_query($con, $votersQuery);

                                while ($voterRow = mysqli_fetch_assoc($votersResult)) {
                                    $voterName =  $voterRow['prenom'] . ' ' . $voterRow['nom'];;
                                    echo "<option>$voterName</option>";
                                }
                                ?>
                            </select>
                        </div>

                            <div class="row">
                                <div class="col-md-12">
                                <?php
                                            if($row["id_admin"] == $_SESSION['id'] || $_SESSION['admin'] == 2){
                                            ?>
                                    <a href="edit_meeting.php?id=<?php echo $meetingId; ?>" class="btn btn-primary btn-block">Edit</a>
                                    <?php
                                            }   
                                            else {
                                                echo '<a href="#" class="btn btn-primary btn-block" onclick="goBack()">Go BACK</a>';

                                                        echo '<script>
                                                        function goBack() {
                                                            window.history.back();
                                                        }
                                                        </script>';
                                            }
                                            ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<style>
  .dark{
    color: white;
  }

  .white {
    color: white;
  }
  .bg-light {
    --bs-bg-opacity: 0; 
    background-color: rgba(var(--bs-light-rgb),var(--bs-bg-opacity))!important;
}
</style> 