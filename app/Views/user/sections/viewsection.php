<!doctype html>
<html lang="en">

<head>
  <title>HOMEPAGE | SECTION</title>
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
      <h2 class="mb-2 fw-bold">Student Records</h2>
      <div class="searchbar mb-3 mt-4  justify-content-between align-items-center">
        <input class="form-control rounded-pill border border-dark" type="text" id="searchData" placeholder="Search.." style="width:250px;">
      </div>
      <div class="d-flex mb-3 bd-highlight">
          <a href="/convertToPDF<?php echo "/".$year."/".$section?>" class="btn btn-success">
            Download PDF
          </a>
      </div>

      <div class="table-responsive  ">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col" class="fs-6">LRN</th>
              <th scope="col" class="fs-6">First Name</th>
              <th scope="col" class="fs-6">Last Name</th>
              <th scope="col" class="fs-6">AGE</th>
              <th scope="col" class="fs-6">GENDER</th>
              <th scope="col" class="fs-6">NUM OF ABSENCES</th>
              <th scope="col" class="fs-6">NUM OF DAYS PRESENT</th>
              <th scope="col" class="fs-6">TOTAL ATTENDANCE</th>
              <th scope="col" class="fs-6">Action</th>
            </tr>
          </thead>

          <tbody id="tableBody">
            <?php foreach ($sectionData->getResult() as  $student) {
              $studentId = $student->ID;
              $ID = $student->LRN;
              $studentFNAME = $student->FIRSTNAME;
              $studentLNAME = $student->LASTNAME;
              $studentAGE = $student->AGE;
              $studentGENDER = ($student->GENDER == 1) ? "Male" : "Female";
              $absences = $student->NUMBER_OF_ABSENCES;
              $present = $student->NUM_OF_PRESENT;
              $total_attendance = $student->TOTAL_ATTENDANCE;        
            ?>
              <tr>
                <td><?php echo $ID; ?></td>
                <td><?php echo $studentFNAME ?></td>
                <td><?php echo $studentLNAME ?></td>
                <td><?php echo $studentAGE  ?></td>
                <td><?php echo $studentGENDER ?></td>
                <td><?php echo $absences ?></td>
                <td><?php echo $present ?></td>
                <td><?php echo $total_attendance?></td>
                <td>
                  <a href="/viewstudentdata<?php echo "/".$studentId?>" class="btn btn-success">
                      View
                  </a>
                </td>
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