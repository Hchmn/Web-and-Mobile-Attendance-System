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
  <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
</head>

<body class=" ">

  <div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
      <div class="p-4 pt-5">
        <div>
          <a href="#" class="img logo rounded-circle mb-2" style="background-image: url(<?php echo base_url(); ?>/assets/images/user_logo.png);">
          </a>
          <p class="mb-3 mt-3 text-center"><?php echo session()->get('fname') . " " . session()->get('lname') ?></p>
        </div>

        <ul class="list-unstyled components mb-5">
          <li>
            <a href="user_homepage">Homepage</a>
          </li>
          <li>
            <a href="studentrecords">Student Records</a>
          </li>
          <li>
            <a href="studentattendance">Load Students Attendance</a>
          </li>
          <li>
            <a href="event">Event/ Upcoming Event</a>
          </li>
          <li>
            <a href="/" onclick="return confirm('Are you sure you want to log out?');">Logout</a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">
      <h2 class="mb-2 fw-bold">Student Records</h2>
      <div class="searchbar mb-3 mt-4  justify-content-between align-items-center">
        <input class="form-control rounded-pill border border-dark" type="text" id="searchData" placeholder="Search.." style="width:250px;">
      </div>
      <div class="table-responsive  ">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col" class="fs-6">#</th>
              <th scope="col" class="fs-6">Name Of Event</th>
              <th scope="col" class="fs-6">Date and Time</th>
              <th scope="col" class="fs-6">Event Venue</th>
            </tr>
          </thead>

          <tbody id="tableBody">
            <?php foreach ($eventData->getResult() as  $event) {
              $ID = $event->ID;
              $eventNAME = $event->NAME;
              $eventVENUE = $event->VENUE;
              $eventSCHEDULE = $event->SCHEDULE;
            ?>
              <tr>
                <td><?php echo $ID; ?></td>
                <td><?php echo $eventNAME ?></td>
                <td><?php echo $eventSCHEDULE ?></td>
                <td><?php echo $eventVENUE ?></td>
              </tr>
            <?php } ?>

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