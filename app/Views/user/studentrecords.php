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
            <a href="user_homepage">Homepage</a>
          </li>
          <li>
            <a href="studentrecords" class="text-warning">Student Records</a>
          </li>
          <li>
            <a href="studentattendance">Year Level Records</a>
          </li>
          <li>
            <a href="event">Event/ Upcoming Event</a>
          </li>
          <li>
            <a href="teachersettings">Settings</a>
          </li>
          <li>
              <a href="attendance">Attendance</a>
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
      <h1 class="mb-2 fw-bold text-info">Student Records</h1>
      <div class="searchbar mb-3 mt-4  justify-content-between align-items-center">
        <input class="form-control rounded-pill border border-dark" type="text" id="searchData" placeholder="Search.." style="width:250px;">
      </div>

      <div class="table-responsive  ">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col" class="fs-6">LRN</th>
              <th scope="col" class="fs-6">First Name</th>
              <th scope="col" class="fs-6">Last Name</th>
              <th scope="col" class="fs-6">Grade</th>
              <th scope="col" class="fs-6">Section</th>
              <th scope="col" class="qr-code fs-6">QR Code</th>
              <th scope="col" class="qr-code fs-6">ACTION</th>
            </tr>
          </thead>
          <?php if(count($studentData->getResult()) > 0): ?>
          <tbody id="tableBody">
            <?php foreach ($studentData->getResult() as $student) {
              $LRN = $student->LRN;
              $ID = $student->ID;
              $fName = $student->FIRSTNAME;
              $lName = $student->LASTNAME;
              $Grade = $student->GRADE;
              $gender = $student->GENDER;
              $Section = $student->SECTION;
              $qr = $fName . " " . $lName . " " . $student->MIDDLENAME . " " . $LRN . " " . $gender . " " . $Grade . " " . $Section;

              $decryptedQRCode = password_verify($qr, $student->QR);
              $qrCode = ($decryptedQRCode) ? $qr : null;
            ?>
              <tr>
                <td><?php echo $LRN; ?></td>
                <td><?php echo $fName; ?></td>
                <td><?php echo $lName; ?></td>
                <td><?php echo ((int)$Grade + 6); ?></td>
                <td><?php echo $Section; ?></td>
                <td>
                  <div class="qrcode-container" id="qrcode-container">
                    <input type="hidden" id="id" value="<?php echo $qrCode; ?>">
                    <div id="qrcode" class="qrcode  mt-2" style="width: 25px;">
                    </div>
                  </div>
                </td>
                <td>
                  <a href="/convertStudentDataToPDF<?php echo "/".$ID?>" class="btn btn-success">
                    DOWNLOAD
                  </a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
          <?php endif; ?>
          <?php if(count($studentData->getResult()) == 0):?>
          <tbody id="tableBody">
            <tr>
              <td class="text-danger fw-bold">N/A</td>
              <td class="text-danger fw-bold">N/A</td>
              <td class="text-danger fw-bold">N/A</td>
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