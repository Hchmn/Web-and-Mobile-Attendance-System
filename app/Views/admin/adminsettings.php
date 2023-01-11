<!doctype html>
<html lang="en">

<head>
  <title>ADMIN | SETTINGS</title>
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
      <h2 class="mb-2 fw-bold">Account Records</h2>
      <div class="searchbar mb-3 mt-4  justify-content-between align-items-center">
        <input class="form-control rounded-pill border border-dark" type="text" id="searchMedicine" placeholder="Search.." style="width:250px;">
      </div>
      <?php if (session()->has('deleted')) : ?>
        <div class="alert alert-danger w-25">
          User successfully deleted!
        </div>
      <?php endif; ?>
      <div class="table-responsive  ">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col" class="fs-6">First Name</th>
              <th scope="col" class="fs-6">Last Name</th>
              <th scope="col" class="fs-6">Age</th>
              <th scope="col" class="fs-6">Username</th>
              <th scope="col" class="fs-6">Password</th>
            </tr>
          </thead>

          <tbody id="tableBody">
            <?php foreach ($accountData->getResult() as $account) {
              $fName = $account->FNAME;
              $lName = $account->LNAME;
              $userName = $account->USERNAME;
              $age = $account->AGE;
            ?>
              <tr>
                <td><?php echo $fName; ?></td>
                <td><?php echo $lName; ?></td>
                <td><?php echo $userName; ?></td>
                <td>*********</td>
                <td>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#Edit<?php echo $account->ID; ?>" style="color: #fff;
                        background-color: #007bff;
                        border-color: #007bff;">
                    UPDATE
                  </button>

                  <!-- DELETE -->
                  <?php if (session()->get('id') == $account->ID) : ?>
                    <button class="btn btn-danger" disabled>DELETE</button>
                  <?php else : ?>
                    <a href="/delete/<?php echo $account->ID; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete');">DELETE</a>
                  <?php endif; ?>

                  <!-- Modal -->
                  <div class="modal fade" id="Edit<?php echo $account->ID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form method="post" action="/update_account">
                          <div class="modal-header" style="justify-content: center; font-weight:bolder;">
                            <h3 class="modal-title">Account Information</h3>
                          </div>
                          <div class="modal-body">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                              <div class="form-group " style="width:140%; height:120%;">
                                <div class="mb-2 w-100 d-flex align-items-center ">
                                  <label for="exampleInputEmail1" class="form-label fs-6 px-2 mt-2 fw-bold">FIRSTNAME</label>
                                  <input type="text" name="firstname" value="<?php echo $fName; ?>" class="form-control w-100">
                                  <input type="hidden" value="<?php echo $account->ID; ?>" name="id">
                                </div>
                                <div class="mb-2 w-100 d-flex align-items-center ">
                                  <label for="exampleInputEmail1" class="form-label fs-6 px-2 mt-2 fw-bold">LASTNAME</label>
                                  <input type="text" name="lastname" value="<?php echo $lName; ?>" class="form-control w-100">
                                </div>
                                <div class="mb-2 w-100 d-flex align-items-center ">
                                  <label for="exampleInputEmail1" class="form-label fs-6 px-2 mt-2 fw-bold">USERNAME</label>
                                  <input type="text" name="username" value="<?php echo $userName; ?>" class="form-control w-100">
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
    <?php } ?>
    </tr>
    </tbody>
    </table>
    </div>


  </div>
  </div>

</body>

</html>

<script>
  $('#searchMedicine').on('keyup', function() {
    var value = $(this).val().toLowerCase();
    $("#tableBody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
</script>