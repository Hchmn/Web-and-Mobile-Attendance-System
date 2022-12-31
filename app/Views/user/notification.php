<!doctype html>
<html lang="en">

<head>
  <title>HOMEPAGE | NOTIFICATION</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
</head>
<style>
</style>

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
            <!-- <a href="user_homepage">Add Student</a> -->
          </li>
          <li>
            <a href="studentrecords">Student Records</a>
          </li>
          <li>
            <a href="studentattendance">Year Level Records</a>
          </li>
          <li>
            <a href="teachersettings">Settings</a>
          </li>
          <li>
              <a href="section_list">Attendance</a>
          </li>
          <li>
            <a href="notification" class="notification text-warning">
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
        <h1 class="mb-2 fw-bold text-info">Student Status Notification</h1>
        <div class="searchbar mb-3 mt-4  justify-content-between align-items-center">
            <input class="form-control rounded-pill border border-dark" type="text" id="searchData" placeholder="Search.." style="width:250px;">
        </div>
        <?php if (session()->has('success_update')) : ?>
            <div class="alert alert-success w-100">
            Student Status Successfully Updated
            </div>
        <?php endif; ?>
        <?php if((session()->has('failed_update'))) : ?>
            <div class="alert alert-danger w-100">
            Failed To Updated Student Status
            </div>
        <?php endif; ?>
      <div class="table-responsive  ">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col" class="fs-6">LRN</th>
              <th scope="col" class="fs-6">Student Name</th>
              <th scope="col" class="fs-6">Academic Status</th>
              <th scope="col" class="fs-6">Action Taken</th>
              <th scope="col" class="fs-6">Update</th>
            </tr>
          </thead>
          <?php if(session()->get("studentData")):?>
          <tbody id="tableBody">
            <?php 
                foreach ($studentData->getResult() as $student){
                $LRN = $student->LRN;
                $fullName = $student->FIRSTNAME." ".$student->LASTNAME;
                $academicStatus = ($student->STATUS == "1") ? "Has 3 or more than absences": "Performing Well";
                $actionTaken = ($student->STATUS == "1") ? "Not Settled" : "Settled";
                $background = ($student->STATUS == "1") ? "alert alert-danger w-100" : "";
            ?>
              <tr class="<?php echo $background;?>">
                <td><?php echo $LRN;?></td>
                <td><?php echo $fullName;?></td>
                <td><?php echo $academicStatus;?></td>
                <td><?php echo $actionTaken;?></td>
                <td>
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#Edit<?php echo $student->ID;?>" style="color: #fff;
                        background-color: #007bff;
                        border-color: #007bff;">
                            UPDATE
                    </button>
                  <!-- Modal -->
                  <div class="modal fade" id="Edit<?php echo $student->ID;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form method="post" action="update_student_status">
                          <div class="modal-header" style="justify-content: center; font-weight:bolder;">
                            <h3 class="modal-title">UPDATE STUDENT STATUS</h3>
                          </div>
                          <div class="modal-body">
                            <div class="col-md-12">
                                <label for="exampleInputEmail1" class="form-label fs-6 px-2 mt-2 text-danger">Note: Input 1 IF ITS NOT SETTLED AND 0 IF ITS SETTLED </label>
                            </div>
                            <div class="col-md-8">
                              <div class="form-group " style="width:140%; height:120%;">
                                <div class="mb-2 w-100 d-flex align-items-center">
                                  <label for="exampleInputEmail1" class="form-label fs-6 px-2 mt-2 fw-bold">Status:</label>
                                  <input type="text" name="status"  value="<?php echo $student->STATUS;?>" class="form-control w-100">
                                  <input type="hidden" value="<?php echo $student->ID?>" name="id">
                                </div>
                              </div>
                            </div>
                            <div style="clear:both;"></div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success">Save changes</button>
                            </div>
                          </div>
                        </form>
                      </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>

            <?php 
                }
            ?>
          </tbody>
          <?php endif;?>

          <?php if(!(session()->get("studentData"))):?>
          <tbody id="tableBody">
              <tr>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
              </tr>
          </tbody>
          <?php endif;?>
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