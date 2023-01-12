<!doctype html>
<html lang="en">

<head>
  <title>HOMEPAGE | TEACHER DATA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>

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
            <a href="admin_homepage">Homepage</a>
          </li>
          <li>
            <a href="admin_add_user">Add User</a>
          </li>
          <li>
            <a href="admin_print_records">Print Records</a>
          </li>
          <li>
            <a href="admin_settings">Administrator Settings</a>
          </li>
          <li>
            <a href="admin_student">Add Student</a>
          </li>
          <li>
            <a href="admin_student_status">Student Status</a>
          </li>
          <li>
            <a href="admin_teachers">Teachers</a>
          </li>
          <li>
            <a href="admin_grade_level">Year Levels</a>
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
      <div class="searchbar mb-3 mt-4  justify-content-between align-items-center">
        <input class="form-control rounded-pill border border-dark" type="text" id="searchData" placeholder="Search.." style="width:250px;">
      </div>

      <div class="table-responsive  ">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col" class="fs-6">First Name</th>
              <th scope="col" class="fs-6">Last Name</th>
              <th scope="col" class="fs-6">AGE</th>
              <th scope="col" class="fs-6">ADVISORY</th>
              <th scope="col" class="qr-code fs-6">ACTION</th>
            </tr>
          </thead>
          <?php if(count($teacherData->getResult()) > 0): ?>
          <tbody id="tableBody">
            <?php foreach ($teacherData->getResult() as $teacher) {
                $firstName = $teacher->FNAME;
                $lastName = $teacher->LNAME;
                $age = $teacher->AGE;
                $advisory = ($teacher->YEAR + 6)." - ".$teacher->SECTION;
            ?>
              <tr>
                <td><?php echo $firstName; ?></td>
                <td><?php echo $lastName; ?></td>
                <td><?php echo $age; ?></td>
                <td><?php echo $advisory; ?></td>
                <td>
                  <!-- Button trigger modal -->
                  <a href="admin_teacher_subjects/<?php echo $teacher->ID;?>" class="btn" style="color: #fff;
                        background-color: #007bff;
                        border-color: #007bff;">
                    SECTIONS
                </a>
                </td>

              </tr>
            <?php } ?>
          </tbody>
          <?php endif; ?>
          <?php if(count($teacherData->getResult()) == 0):?>
          <tbody id="tableBody">
            <tr>
              <td class="text-danger fw-bold">N/A</td>
              <td class="text-danger fw-bold">N/A</td>
              <td class="text-danger fw-bold">N/A</td>
              <td class="text-danger fw-bold">N/A</td>
            </tr>
          </tbody>
          <?php endif; ?>
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