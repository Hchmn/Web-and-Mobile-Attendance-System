<!doctype html>
<html lang="en">

<head>
  <title>ADMIN | ADD EVENT</title>
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
      <h2 class="mb-3 fw-bold">Add Event</h2>
      <p class="text-danger">Kindly fill up the event information here</p>
      <?php if (session()->has('event_created')) : ?>
        <div class="alert alert-success w-25">
          Event successfully added!
        </div>
      <?php endif; ?>
      <form action="/create_event" method="post">
        <div class="row row-cols-2">
          <!-- FIRST COLUMN -->
          <div class="col">
            <div class="mb-2 w-100">
              <label for="exampleInputEmail1" class="form-label fs-6">EVENT NAME</label>
              <input type="text" name="eventname" class="form-control w-50">
            </div>
            <div class="mb-2 w-100">
              <label for="exampleInputEmail1" class="form-label fs-6">EVENT VENUE</label>
              <input type="text" name="eventvenue" class="form-control w-50">
            </div>
            <div class="mb-2 w-100">
              <label for="exampleInputEmail1" class="form-label fs-6">DATE AND TIME</label>
              <input type="datetime-local" name="eventdate" class="form-control w-50">
            </div>
            <button type="submit" class="btn btn-success mt-3 float-center">Submit</button>
          </div>

      </form>
    </div>
  </div>

</body>

</html>