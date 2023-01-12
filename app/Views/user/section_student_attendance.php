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
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/evo-calendar@1.1.2/evo-calendar/css/evo-calendar.min.css"/>

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
              <a href="/event">Event/ Upcoming Event</a>
            </li>
            <li>
              <!-- <a href="/user_homepage">Add Student</a> -->
            </li>
            <li>
              <a href="/studentrecords">Student Records</a>
            </li>
            <!-- <li>
              <a href="/studentattendance">Year Level Records</a>
            </li> -->
            <li>
              <a href="/teachersettings">Settings</a>
            </li>
            <li>
              <a href="attendance" class="text-warning">Attendance</a>
            </li>
            <!-- <li>
              <a href="/section_list" class="text-warning">Attendance</a>
            </li> -->
            <li>
              <a href="/notification" class="notification">
                  <span>Notification</span>
                  <?php if(session()->has("notification_number") && session()->get("notification_number") > 0):?>
                    <span class="badge">
                    <?php 
                      $notifNumber = session()->get("notification_number");
                      echo $notifNumber;
                    ?>
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
          <h1 class="fw-bold text-info">Student Attendance</h1>
          <div class="">

          </div>
          <div class="table-responsive  mt-2">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col" class="fs-6">TIME IN</th>
                    <th scope="col" class="fs-6">FIRST NAME</th>
                    <th scope="col" class="fs-6">LAST NAME</th>
                    <th scope="col" class="fs-6">DATE START</th>
                    <th scope="col" class="fs-6">DATE END</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php
                      foreach($studentsAttendance->getResult() as $data){
                        
                    ?>
                      <tr class="">
                          <td><?php echo ($data->TIME_IN == NULL) ? "NULL" : $data->TIME_IN;?></td>
                          <td><?php echo $data->FIRSTNAME;?></td>
                          <td><?php echo $data->LASTNAME;?></td>
                          <td><?php echo $data->DATE_START;?></td>
                          <td><?php echo $data->DATE_END;?></td>
                      </tr>
                    <?php 
                      }
                    ?>
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