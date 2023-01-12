<!doctype html>
<html lang="en">

<head>
  <title>HOMEPAGE | STUDENT RECORDS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
          <p class="mb-3 mt-3 text-center">ADMIN</p>
        </div>

        <ul class="list-unstyled components mb-5">
          <li>
            <a href="/admin_homepage">Homepage</a>
          </li>
          <li>
            <a href="/admin_add_user">Add User</a>
          </li>
          <li>
            <a href="/admin_print_records">Print Records</a>
          </li>
          <li>
            <a href="/admin_settings">Administrator Settings</a>
          </li>
          <li>
            <a href="/admin_student">Add Student</a>
          </li>
          <li>
            <a href="/admin_student_status">Student Status</a>
          </li>
          <li>
            <a href="/admin_teachers">Teachers</a>
          </li>
          <li>
            <a href="/admin_grade_level">Year Levels</a>
          </li>
          <li>
            <a href="/" onclick="return confirm('Are you sure you want to log out?');">Logout</a>
          </li>
        </ul>
      </div>
    </nav>
        <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">
      <h1 class="mb-2 fw-bold text-info">Student Records</h1>
      <div class="table-responsive mt-5">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col" class="fs-6">Year</th>
              <th scope="col" class="fs-6">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">First Year</th>
              <td>
                <a href="admin_year/1" class="btn btn-success">
                  View
                </a>
              </td>
            </tr>

            <tr>
              <th scope="row">Second Year</th>
              <td>
                <a href="admin_year/2" class="btn btn-success">
                  View
                </a>
              </td>
            </tr>

            <tr>
              <th scope="row">Third Year</th>
              <td>
                <a href="admin_year/3" class="btn btn-success">
                  View
                </a>
              </td>
            </tr>

            <tr>
              <th scope="row">Fourth Year</th>
              <td>
                <a href="admin_year/4" class="btn btn-success">
                  View
                </a>
              </td>
            </tr>
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

  $(document).ready(function(e) {
    var slides = document.getElementsByClassName("qrcode-container");
    for (var i = 0; i < slides.length; i++) {
      let element = slides[i];
      new QRCode(element, element.children[0].value);
      element.style.display = "block";
    }

  });
</script>