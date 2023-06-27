<?php
require 'connection.php';
require 'session.php';

// Retrieve session variables
if ($_SESSION['admin'] == 0) {
    header('location: ../user/index.php');
    exit(); // Add this line to stop executing the rest of the code
}

if (isset($_POST['send'])) {
  // Get form data
  $date_reunion = mysqli_real_escape_string($con, $_POST['date_reunion']);
  $id_admin =  $_SESSION['id'];
  $heure_reunion = mysqli_real_escape_string($con, $_POST['heure_reunion']);
  $objet = mysqli_real_escape_string($con, $_POST['objet']);
  $detail = mysqli_real_escape_string($con, $_POST['detail']);
  $duree = mysqli_real_escape_string($con, $_POST['duree']);
  $local = mysqli_real_escape_string($con, $_POST['local']);
  $id_Bureau = mysqli_real_escape_string($con, $_POST['id_Bureau']);

  // Insert data into the database
  $query = "INSERT INTO meetings (id_admin, date_reunion, heure_reunion, objet, detail, duree, local, id_Bureau) VALUES ($id_admin, '$date_reunion', '$heure_reunion', '$objet', '$detail', '$duree', '$local', '$id_Bureau')";
  $result = mysqli_query($con, $query);

  if ($result) {
    // Data inserted successfully
    echo '<script>alert("Meeting added successfully!");</script>';
  } else {
    // Error occurred
    echo '<script>alert("Error: ' . mysqli_error($con) . '");</script>';
  }
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
  <title>Date d'enregistrement</title>
</head>
<body>
  <header>
    <?php require 'Nav.php'; ?>
    <style>
      .dark {
        color: white;
      }

      .white {
        color: white;
      }

      .bg-light {
        --bs-bg-opacity: 0;
        background-color: rgba(var(--bs-light-rgb), var(--bs-bg-opacity))!important;
      }
    </style>
  </header>
  <div class="container" style="padding-top: 45px;">
    <div class="text-center mt-5">
      <h1>Add Meeting</h1>
    </div>

    <div class="row">
      <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4 bg-light">
          <div class="card-body bg-light">
            <div class="container">
              <form method="post" id="contact-form" role="form" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to send this?');">
                <div class="form-group">
                  <label for="form_date">Date réunion:</label>
                  <input id="form_date" type="date" name="date_reunion" class="form-control" required="required" min="<?php echo date('Y-m-d', strtotime('+0 day')); ?>" onchange="updateMinTime()">
                </div>
                <div class="form-group">
                  <label for="form_heure">Heure de la réunion:</label>
                  <input id="form_heure" type="time" name="heure_reunion" class="form-control" required="required" min="<?php echo date('H:i'); ?>">
                </div>
                <div class="form-group">
                  <label for="form_objet">Objet:</label>
                  <input id="form_objet" type="text" name="objet" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <label for="form_detail">Détail:</label>
                  <textarea id="form_detail" name="detail" class="form-control" placeholder="Enter the details" rows="4" required="required"></textarea>
                </div>
                <div class="form-group">
                  <label for="form_duree">Durée:</label>
                  <input id="form_duree" type="text" name="duree" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <label for="form_local">Local:</label>
                  <input id="form_local" type="text" name="local" class="form-control" required="required">
                </div>
                <div class="mb-3">
                  <label>Bureau</label>
                  <select name="id_Bureau" class="form-select" required>
                    <?php
                    $req = "SELECT * FROM bureau";
                    $rs = mysqli_query($con, $req);
                    while ($row = mysqli_fetch_row($rs)) {
                    ?>
                      <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <input type="submit" class="btn btn-success btn-block" value="Envoyer" name="send"></input>
                  </div>
                  <div class="col-md-6">
                    <input type="reset" class="btn btn-secondary btn-block" value="Cancel"></input>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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
</body>
</html>
