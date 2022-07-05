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
          <p class="mb-3 mt-3 text-center">Nasrollah L. Gandamato</p>
        </div>

        <ul class="list-unstyled components mb-5">
          <li>
            <a href="/user_homepage">Homepage</a>
          </li>
          <li>
            <a href="/studentrecords">Student Records</a>
          </li>
          <li>
            <a href="/studentattendance">Load Students Attendance</a>
          </li>
          <li>
            <a href="/event">Event/ Upcoming Event</a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">
      <h2 class="mb-2 fw-bold"><?php echo $yearName; ?>Student Records</h2>
      <div class="table-responsive mt-5">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col" class="fs-6">Section Name</th>
              <th scope="col" class="fs-6">Action</th>
            </tr>
          </thead>
          <tbody>
          <tbody>
            <?php foreach ($sectionData->getResult() as  $section) {
              $year = $section->YEAR;
              $section = $section->SECTION;
            ?>
              <tr>
                <th scope="row"><?php echo $section ?></th>
                <td>
                  <a href="/section/<?php echo $year . "/" . $section; ?>" class="btn btn-success">
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

</script>