<!doctype html>
<html lang="en">

<head>
  <title>STUDENT ATTENDANCE | YEAR & SECTION</title>


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
      <!-- Button trigger modal -->
      <button class="btn btn-success mb-2" type="submit" data-bs-toggle="modal" data-bs-target="#Edit">
          ADD SECTION
      </button>

      <?php if (session()->has('add_section_success')) : ?>
          <div class="alert alert-success w-100 mt-3">
            <?php echo session()->get('add_section_success');?>
          </div>
      <?php endif; ?>
      
      <?php if (session()->has('add_section_fail')) : ?>
          <div class="alert alert-danger w-100 mt-3">
            <?php echo session()->get('add_section_fail');?>
          </div>
      <?php endif; ?>

      <!-- Modal -->
      <div class="modal fade" id="Edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Section</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="/add_section" method="POST">
              <div class="modal-body">

                <div>
                  <label for="exampleInputEmail1" class="form-label fs-6">Grade & Section</label>
                    <select name="section" class="form-select w-50" id="">
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

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save changes</button>
              </div>
              </form>
            </div>
          
        </div>
      </div>


      <div class="table-responsive">
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