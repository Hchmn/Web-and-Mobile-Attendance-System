<!doctype html>
<html lang="en">

<head>
  <title>HOMEPAGE | ADD STUDENT</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/registration.js" charset="utf-8"></script>
  <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/evo-calendar@1.1.2/evo-calendar/css/evo-calendar.min.css"/>

</head>

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
            <!-- <a href="user_homepage" class="text-warning">Add Student</a> -->
          </li>
          <li>
            <a href="studentrecords">Student Records</a>
          </li>
          <!-- <li>
            <a href="studentattendance">Year Level Records</a>
          </li> -->
          <li>
            <a href="teachersettings">Settings</a>
          </li>
          <li>
            <a href="section_list">Attendance</a>
          </li>
          <li>
            <a href="notification" class="notification">
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
      <h1 class="mb-2 fw-bold text-info">Add Student</h1>
      <p class="text-danger">Kindly fill up the student information here</p>
      <?php if (session()->has('registered')) : ?>
        <div class="alert alert-success w-25">
          Student successfully added!
        </div>
      <?php endif;?>
      <form action="/register" method="post">
        <div class="row row-cols-2 border-top ">
          <!-- FIRST COLUMN -->
          <div class="col mt-3">
            <div class="mb-2 w-100">
              <label for="exampleInputEmail1" class="form-label fs-6">FIRST NAME</label>
              <input type="text" name="firstname" id="firstname" class="form-control w-50" required>
            </div>

            <div class="mb-2 w-100">
              <label for="exampleInputEmail1" class="form-label fs-6">LASTNAME</label>
              <input type="text" name="lastname" id="lastname" class="form-control w-50" required>
            </div>

            <div class="mb-2 w-100">
              <label for="exampleInputEmail1" class="form-label fs-6">MIDDLE NAME</label>
              <input type="text" name="middlename" class="form-control w-50" required>
            </div>

            <div class="mb-2 w-100">
              <label for="exampleInputEmail1" class="form-label fs-6">AGE</label>
              <input type="text" name="age" class="form-control w-50" required>
            </div>

            <div class="mb-2 w-100">
              <label for="exampleInputEmail1" class="form-label fs-6">GENDER</label>
              <select class="province form-select w-50" name="gender" required>
                <option value="1" selected>Male</option>
                <option value="2">Female</option>
              </select>
            </div>

            <div class="mb-2 w-100">
              <label for="exampleInputEmail1" class="form-label fs-6">GRADE</label>
              <select class="year form-select w-50" name="grade" id="year" onchange="updateOption()" required>
                <option></option>
                <option value="1" id="1">First Year</option>
                <option value="2" id="2">Second Year</option>
                <option value="3" id="3">Third Year</option>
                <option value="4" id="4">Fourth Year</option>
              </select>
            </div>

            <div class="mb-2 w-100">
              <label for="exampleInputEmail1" class="form-label fs-6">SECTION</label>
              <select class="section form-select w-50" name="section" required>
              </select>
            </div>
          </div>

          <div class="col mt-3 ">
            <div class="mb-2 w-100">
              <button type="button" class="btn btn-primary mt-4 mb-2" onclick="generateQRCode()">Generate QR Code</button>
              <div class="qrcode" id="qrcode-container">
                <div id="qrcode" class="qrcode  mt-2">
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-success  float-center" onclick="saveQRCODE()">Submit</button>

          </div>
        </div>

      </form>
    </div>
  </div>

</body>

</html>