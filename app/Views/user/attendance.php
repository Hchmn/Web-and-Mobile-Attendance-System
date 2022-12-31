<!doctype html>
<html lang="en">

<head>
  <title>HOMEPAGE | ATTENDANCE MONITORING</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
</head>
<style>
</style>

<body class=" ">

  <div class="wrapper d-flex align-items-stretch">
      <nav id="sidebar">
        <div class="p-4 pt-5">
          <div>
            <a href="#" class="img logo rounded-circle mb-2" style="background-image: url(<?php echo base_url(); ?>/assets/images/user_logo.png);">
            </a>
            <p class="mb-0 mt-3 text-center"><?php echo session()->get('fname') . " " . session()->get('lname') ?></p>
            <p class="mt-0 text-center text-primary fw-bold">Teacher</p>
          </div>

          <ul class="list-unstyled components mb-5">
            <li>
              <a href="event">Event/ Upcoming Event</a>
            </li>
            <li>
              <!-- <a href="user_homepage">Homepage</a> -->
            </li>
            <li>
              <a href="studentrecords">Student Records</a>
            </li>
            <li>
              <a href="studentattendance">Year Level Records</a>
            </li>
            <li>
              <a href="teachersettings">Settings</a>
            </li>
            <li>
              <a href="attendance" class="text-warning">Attendance</a>
            </li>
            <li>
              <a href="notification" class="notification">
                  <span>Notification</span>
                  <?php if(session()->has("notification_number")):?>
                    <span class="badge"><?php echo session()->get("notification_number")?></span>
                  <?php endif; ?>
                  <?php if(!(session()->has("notification_number"))): ?>
                    <span class="badge">0</span>
                  <?php endif; ?>
              </a>
            </li>
            <li>
              <a href="/" onclick="return confirm('Are you sure you want to log out?');">Logout</a>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">
          <h1 class="fw-bold text-info">Classroom Attendance<?php echo ": ".Date("Y-m-d")?></h1>
          <div class="">
            <div>
              <p class="fs-3 fw-bold mb-0 text-info"><?php echo "Grade" .": ".session()->get("grade")?></p>
              <p class="fs-3 fw-bold mb-2 text-info"><?php echo "Section" .": ".session()->get("section")?></p>
            </div>
              <?php
                if($validateAttendanceToday): ?>
                  <button class="btn btn-success" type="submit" data-bs-toggle="modal" data-bs-target="#Edit" disabled = "true">
                    START ATTENDANCE
                  </button>
              <?php endif;?>
              
              <?php
                if(!$validateAttendanceToday): ?>
                  <button class="btn btn-success" type="submit" data-bs-toggle="modal" data-bs-target="#Edit">
                    START ATTENDANCE
                  </button>
              <?php endif;?>

              <?php if (session()->has('added_attendance')) : ?>
                  <div class="alert alert-success w-100 mt-3">
                    <?php echo session()->get('added_attendance');?>
                  </div>
              <?php endif; ?>
              <?php if (session()->has('enroll_students')) : ?>
                  <div class="alert alert-danger w-100 mt-3">
                    <?php echo session()->get('enroll_students');?>
                  </div>
              <?php endif; ?>
              
              <?php if (session()->has('failed_attendance')) : ?>
                  <div class="alert alert-danger w-100 mt-3">
                    <?php echo session()->get('failed_attendance');?>
                  </div>
              <?php endif; ?>
          </div>
          <div class="table-responsive  mt-2">
          <div class="modal fade" id="Edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form method="post" action="add_attendance">
                      <div class="modal-header" style="justify-content: center; font-weight:bolder;">
                        <h3 class="modal-title">START ATTENDANCE</h3>
                      </div>
                      <div class="modal-body">
                        <div class="col-md-12">
                            <label for="exampleInputEmail1" class="form-label fs-6 px-2 mt-2 text-danger">Must fill the required fields</label>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group " style="width:140%; height:120%;">
                            <div class="mb-2 w-100 d-flex align-items-center">
                              <label for="exampleInputEmail1" class="form-label fs-6 w-50 px-2 mt-2 fw-bold">Date Started</label>
                              <input type="datetime-local" name="date_started"  value="" class="form-control w-100">
                              <input type="hidden" value="" name="id">
                            </div>
                            <div class="mb-2 w-100 d-flex align-items-center mt-3">
                              <label for="exampleInputEmail1" class="form-label fs-6 w-50 px-2 mt-2 fw-bold">Date End</label>
                              <input type="datetime-local" name="date_end"  value="" class="form-control w-100">
                              <input type="hidden" value="" name="id">
                            </div>
                          </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success">Save changes</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  </div>
                </div>
              </div>

              
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col" class="fs-6">Name</th>
                    <th scope="col" class="fs-6">Time-In</th>
                    <th scope="col" class="fs-6">Attendance Started</th>
                    <th scope="col" class="fs-6">Attendance Ended</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                  <?php if($validateAttendanceToday):?>
                    <?php
                      for($x = 0; $x < sizeof($attendanceData); $x++){
                        $time_in = ($attendanceData[$x][0] == NULL)? "N/A" : $attendanceData[$x][0];
                        $date_start = $attendanceData[$x][1];
                        $date_end = $attendanceData[$x][2];
                        $fullName = $attendanceData[$x][3];
                    ?>
                      <tr class="">
                          <td><?php echo $fullName;?></td>
                          <td><?php echo $time_in;?></td>
                          <td><?php echo $date_start;?></td>
                          <td><?php echo $date_end;?></td>
                      </tr>
                    <?php 
                      }
                    ?>
                  <?php endif; ?>
                  
                  <?php if(!$validateAttendanceToday):?>
                    <tr class="">
                      <td class="text-danger fw-bold">N/A</td>
                      <td class="text-danger fw-bold">N/A</td>
                      <td class="text-danger fw-bold">N/A</td>
                      <td class="text-danger fw-bold">N/A</td>
                    </tr>
                  <?php endif;?>
                </tbody>
            </table>
          </div>
      </div>
  </div>

</body>

</html>

<script>
  $('#searchData').on('keyup', function() {
    var value = $(this).val().toLowerCase();
    $("#tableBody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
</script>