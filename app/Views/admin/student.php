<!doctype html>
<html lang="en">

<head>
  <title>ADMIN | ADD STUDENT</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/registration.js" charset="utf-8"></script>
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
        <h2 class="mb-3 fw-bold">Add Student</h2>
        <p class="text-danger">Kindly fill up the event information here</p>
        <?php if (session()->has('message')){ ?>
            <div class="alert <?=session()->getFlashdata('alert-class') ?>">
                <?=session()->getFlashdata('message') ?>
            </div>
        <?php } ?>

        <form action="admin_add_student" method="post" enctype="multipart/form-data">
            <div class="w-100">
              <label for="exampleInputEmail1" class="form-label fs-6">GRADE</label>
              <select class="year form-select w-50" name="grade" id="year" onchange="updateOption()" required>
                <option></option>
                <option value="1" id="1">First Year</option>
                <option value="2" id="2">Second Year</option>
                <option value="3" id="3">Third Year</option>
                <option value="4" id="4">Fourth Year</option>
              </select>
            </div>

            <div class="w-100">
              <label for="exampleInputEmail1" class="form-label fs-6">SECTION</label>
              <select class="section form-select w-50" name="section" required>
              </select>
            </div>

            <div class="form-group mb-3 w-50 mt-3">
                <div class="mb-3">
                    <input type="file" name="file" class="form-control" id="file">
                </div>					   
            </div>
            <div class="d-grid w-50 mt-4">
                <input type="submit" name="submit" value="Upload" class="btn btn-dark" />
            </div>
            
        </form>
		</div>
    </div>
  </div>

<script>

function updateOption() {
  gradeSections = <?php echo json_encode($gradeSection)?>;  
  var year = document.getElementById("year").value;
  var sectionNodeList = document.getElementsByClassName("section");

  for (var i = 0; i < sectionNodeList.length; i++) {
    while (sectionNodeList[i].options.length) {
      sectionNodeList[i].remove(0);
    }
  }
  
  let counter = 0;
  gradeSections.map((item,index) => {
    if(item.YEAR == year){
      var section = new Option(item.SECTION);
      sectionNodeList[0].options.add(section);
    }
    
  })
}

function generateQRCode() {
  let username = document.getElementById("firstname").value;
  let password = document.getElementById("lastname").value;

  let qrcode = username + password;

  if (username && password) {
    let qrcodeContainer = document.getElementById("qrcode");
    qrcodeContainer.innerHTML = "";
    new QRCode(qrcodeContainer, qrcode);
    document.getElementById("qrcode-container").style.display = "block";
    document.getElementById("qrcode-container").style.marginBottom = "40px";
  } else {
    alert("YOU MUST FILL ALL THE REQUIREMENTS BEFORE GENERATING THE QRCODE");
  }
}
</script>

</body>

</html>