<!doctype html>
<html lang="en">

<head>
  <title>STUDENT ATTENDANCE | YEAR & SECTION</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
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
            <a href="/event">Event/ Upcoming Event</a>
          </li>
          <li>
            <a href="/user_homepage">Add Student</a>
          </li>
          <li>
            <a href="/studentrecords">Student Records</a>
          </li>
          <li>
            <a href="/studentattendance">Year Level Records</a>
          </li>
          <li>
            <a href="/teachersettings">Settings</a>
          </li>
          <li>
            <a href="/section_list" class="text-warning">Attendance</a>
          </li>
          <li>
            <a href="/notification" class="notification">
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
    <h1 class="mb-2 fw-bold text-info">Grade & Sections</h1>
      <div class="table-responsive mt-5">
        <table class="table table-hover">
          <thead>
            
            <tr>
              <th scope="col" class="fs-6">Section Name</th>
              <th scope="col" class="fs-6">Year Level</th>
              <th scope="col" class="fs-6">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if($isSection):?>
                <?php for($x = 0; $x < sizeof($sectionList); $x++){
                    $sectionName = $sectionList[$x][2];
                    $yearLvl = $sectionList[$x][1];
                    $gradeSectionID = $sectionList[$x][0];
                ?>
                <tr>
                    <td class="fs-6"><?php echo $sectionName; ?></td>
                    <td class="fs-6"><?php echo $yearLvl + 6; ?></td>
                    <td>
                        <a href="/gradeSection/<?php echo $sectionName . "/" . $yearLvl . "/" . $gradeSectionID;?>" class="btn btn-success">
                            View
                        </a>
                    </td>
                </tr>
                <?php 
                    }
                ?>
            <?php endif;?>
          </tbody>
        </table>
      </div>


    </div>
  </div>

</body>

</html>