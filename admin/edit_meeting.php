<?php
require 'connection.php';
require 'session.php';

// Check if the user is an admin
if ($_SESSION['admin'] == 0) {
    header('location: ../user/index.php');
    exit;
}

// Fetch the meeting to be updated
if (isset($_GET['id'])) {
    $meetingId = $_GET['id'];

    $query = "SELECT * FROM meetings WHERE id = $meetingId";
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
}

// Update meeting in the database
if (isset($_POST['update'])) {
    $newDate = $_POST['date'];
    $newTime = $_POST['time'];
    $newObject = $_POST['object'];
    $newDetail = $_POST['detail'];
    $newDuration = $_POST['duration'];
    $newLocation = $_POST['location'];

    $query = "UPDATE meetings SET date_reunion = '$newDate', heure_reunion = '$newTime', objet = '$newObject', detail = '$newDetail', duree = '$newDuration', local = '$newLocation' WHERE id = $meetingId";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo '<script>alert("Meeting updated successfully!");</script>';
        header("location: view_meeting.php?id=$meetingId");

        exit;
    } else {
        echo '<script>alert("Error: ' . mysqli_error($con) . '");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../logo.webp" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Meeting</title>
</head>

<body>
    <header>
        <?php
        require 'Nav.php';
        ?>
    </header>
    <div class="container" style="padding-top:45px;">
        <div class="text-center mt-5">
            <h1>Edit Meeting</h1>
        </div>

        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="card mt-2 mx-auto p-4 bg-light">
                    <div class="card-body bg-light">
                        <div class="container">
                            <form method="post" id="contact-form" role="form" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to update this meeting?');">
                                <div class="form-group">
                                    <label for="form_date">Date:</label>
                                    <input id="form_date" type="date" name="date" class="form-control" required="required" value="<?php echo $date; ?>" min="<?php echo date('Y-m-d', strtotime('+0 day')); ?>" onchange="updateMinTime()">
                                </div>
                                <div class="form-group">
                                    <label for="form_time">Time:</label>
                                    <input id="form_time" type="time" name="time" class="form-control" required="required" value="<?php echo $time; ?>" min="<?php echo date('H:i'); ?>"    >
                                </div>
                                <div class="form-group">
                                    <label for="form_object">Object:</label>
                                    <input id="form_object" type="text" name="object" class="form-control" required="required" value="<?php echo $object; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="form_detail">Detail:</label>
                                    <textarea id="form_detail" name="detail" class="form-control" rows="4" required="required"><?php echo $detail; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="form_duration">Duration:</label>
                                    <input id="form_duration" type="text" name="duration" class="form-control" required="required" value="<?php echo $duration; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="form_location">Location:</label>
                                    <input id="form_location" type="text" name="location" class="form-control" required="required" value="<?php echo $location; ?>">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="submit" class="btn btn-success btn-block" value="Update" name="update"></input>
                                    </div>
                                    <div class="col-md-6">
                                    <a href="view_meeting.php?id=<?= $row['id']; ?>" class="btn btn-secondary btn-block">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    function updateMinTime() {
      var currentDate = new Date();
      var selectedDate = new Date(document.getElementById("form_date").value);

      if (selectedDate.toDateString() === currentDate.toDateString()) {
        // Same day, set the min time to current time plus one minute
        var currentMinutes = currentDate.getMinutes();
        var currentMinutesPadded = currentMinutes < 10 ? "0" + currentMinutes : currentMinutes;
        var minTime = currentDate.getHours() + ":" + currentMinutesPadded;

        document.getElementById("form_heure").min = minTime;
      } else {
        // Different day, remove the min time restriction
        document.getElementById("form_heure").removeAttribute("min");
      }
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