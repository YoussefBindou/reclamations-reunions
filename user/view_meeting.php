<?php
require 'connection.php';
require 'session.php';

// Check if the user is an admin
if ($_SESSION['admin'] == 1) {
    header('location: ../admin/index.php');
    exit;
}

// Check if the meeting ID is provided
if (isset($_GET['id'])) {
    $meetingId = $_GET['id'];

    // Retrieve the meeting from the database
    $query = "SELECT * FROM meetings WHERE id = ?";
    $statement = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($statement, 'i', $meetingId);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

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

// Check if the user has already voted
$userId = $_SESSION['id'];
$checkVoteQuery = "SELECT * FROM votes WHERE id_meeting = ? AND id_user = ?";
$checkVoteStatement = mysqli_prepare($con, $checkVoteQuery);
mysqli_stmt_bind_param($checkVoteStatement, 'ii', $meetingId, $userId);
mysqli_stmt_execute($checkVoteStatement);
$checkVoteResult = mysqli_stmt_get_result($checkVoteStatement);
$hasVoted = (mysqli_num_rows($checkVoteResult) > 0);

// Handle vote submission
if (isset($_GET['id']) && isset($_SESSION['id']) && !$hasVoted) {
    $meetingId = $_GET['id'];
    $userId = $_SESSION['id'];

    // Insert the vote into the database
    $insertVoteQuery = "INSERT INTO votes (id_meeting, id_user) VALUES (?, ?)";
    $insertVoteStatement = mysqli_prepare($con, $insertVoteQuery);
    mysqli_stmt_bind_param($insertVoteStatement, 'ii', $meetingId, $userId);
    mysqli_stmt_execute($insertVoteStatement);

    header('Location: view_meeting.php?id=' . $meetingId);
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="shortcut icon" href="../logo.webp" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- Bootstrap CSS -->
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
                            <div class="row">
                                <div class="col-md-12">
                                        <button class="btn btn-primary btn-block" onclick="goBack()">go BACK</button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
  function goBack() {
    window.history.back();
  }
</script>

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
