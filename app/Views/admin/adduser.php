<!doctype html>
<html lang="en">

<head>
  <title>ADMIN | ADD USER</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
            <a href="/" onclick="return confirm('Are you sure you want to log out?');">Logout</a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">
      <h2 class="mb-3 fw-bold">Add Admin or Teacher</h2>
      <p class="text-danger">Kindly fill up the event information here</p>
      <?php if (session()->has('registered')) : ?>
        <div class="alert alert-success w-25">
          User successfully added!
        </div>
      <?php endif; ?>
      <?php if (session()->has('registered_failed')) : ?>
        <div class="alert alert-danger w-25">
          Failed to add user!
        </div>
      <?php endif; ?>
      <form action="/create_user" method="post">
        <div class="row row-cols-2">
          <!-- FIRST COLUMN -->
          <div class="col">
            <div class="mb-2 w-100">
              <label for="exampleInputEmail1" class="form-label fs-6">FIRST NAME</label>
              <input type="text" name="firstname" class="form-control w-50" placeholder="Enter your first name" required>
            </div>

            <div class="mb-2 w-100">
              <label for="exampleInputEmail1" class="form-label fs-6">LAST NAME</label>
              <input type="text" name="lastname" class="form-control w-50" placeholder="Enter your last name" required>
            </div>

            <div class="mb-2 w-100">
              <label for="exampleInputEmail1" class="form-label fs-6">Age</label>
              <input type="text" name="age" class="form-control w-50" placeholder="Enter your last name" required>
            </div>

            <div class="mb-2 w-100">
              <label for="exampleInputEmail1" class="form-label fs-6">USERNAME</label>
              <input type="text" name="username" class="form-control w-50" placeholder="Enter your username" required>
            </div>

            <div class="mb-2 w-100">
              <label for="exampleInputEmail1" class="form-label fs-6">PASSWORD</label>
              <input type="password" name="password" class="form-control w-50" placeholder="Enter your password" required>
            </div>

            <div class="mb-2 w-100">
              <label for="exampleInputEmail1" class="form-label fs-6">USERTYPE</label>
              <select class="form-select w-50" name="usertype" id="userType" onclick="checkType()" required>
                <option value="1" id="1">Admin</option>
                <option value="2" id="2">Teacher</option>
                
              </select>
            </div>

            <div class="mb-2 w-100" style="display:none" id="studentClass">
              <label for="exampleInputEmail1" class="form-label fs-6">Grade & Section</label>
              <select class="form-select w-50" name="classId"  onchange="" required>
              
                <?php 
                foreach($studentSection->getResult() as $section)
                  { 
                ?>
                  <option value="<?php echo $section->ID;?>  "> 
                  <?php 
                    echo $section->YEAR+6 ." - ". $section->SECTION;
                  ?> 
                
                  </option>
                <?php 
                  }
                ?>
              </select>
            </div>


            <button type="submit" class="btn btn-success mt-3 float-center">Submit</button>

          </div>
      </form>
    </div>
  </div>

</body>

</html>

<script>
  function checkType(){
    var userType = document.getElementById("userType");
    console.log(userType.value)
    var classType = document.getElementById("studentClass");
    if(userType.value == 2){
      
      classType.style.display = "block";
      console.log("HERE");
    }
    else{
      classType.style.display = "none";
    }
    
  }
</script>