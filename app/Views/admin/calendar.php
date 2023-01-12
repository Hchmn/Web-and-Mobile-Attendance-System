<!doctype html>
<html lang="en">

<head>
  <title>ADMIN | ADD EVENT</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/js/calendar.js">
  <!-- Add the evo-calendar.css for styling -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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

    <div id="content" class="p-4 p-md-5">
        <div id="" class=" w-100">
        <?php if (session()->has('event_created')) : ?>
            <div class="alert alert-success w-25">
            Event successfully added!
            </div>
        <?php endif; ?>
        <button class="btn btn-success mb-2" type="submit" data-bs-toggle="modal" data-bs-target="#Edit">
            ADD EVENT
        </button>

        <div class="modal fade" id="Edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <form method="post" action="/create_event">
                    <div class="modal-header" style="justify-content: center; font-weight:bolder;">
                    <h3 class="modal-title">EVENT SCHEDULE</h3>
                    </div>
                    <div class="modal-body">
                    <div class="col-md-12">
                        <label for="exampleInputEmail1" class="form-label fs-6 px-2 mt-2 text-danger">Must fill the required fields</label>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group " style="width:140%; height:120%;">
                        <div class="mb-2 w-100 d-flex align-items-center">
                            <label for="exampleInputEmail1" class="form-label fs-6 w-50 px-2 mt-2 fw-bold">Event Name</label>
                            <input type="text" name="eventname"  value="" class="form-control w-100" required>
                            <input type="hidden" value="" name="id">
                        </div>
                        <div class="mb-2 w-100 d-flex align-items-center">
                            <label for="exampleInputEmail1" class="form-label fs-6 w-50 px-2 mt-2 fw-bold">Event Venue</label>
                            <input type="text" name="eventvenue"  value="" class="form-control w-100" required>
                            <input type="hidden" value="" name="id">
                        </div>
                        <div class="mb-2 w-100 d-flex align-items-center">
                            <label for="exampleInputEmail1" class="form-label fs-6 w-50 px-2 mt-2 fw-bold">Date Started</label>
                            <input type="datetime-local" name="eventdate"  value="" class="form-control w-100" required>
                            <input type="hidden" value="" name="id">
                        </div>
                        <div class="mb-2 w-100 d-flex align-items-center">
                            <label for="exampleInputEmail1" class="form-label fs-6 w-50 px-2 mt-2 fw-bold">Event Type</label>
                            <select name="eventtype" class="form-control w-100" id="" required>
                                <option value="Holiday" selected>Holiday</option>
                                <option value="School Event">School Event</option>
                            </select>
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
    <div id="calendar" class ="w-100"></div>
    </div>
<!-- Add jQuery library (required) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>

<!-- Add the evo-calendar.js for.. obviously, functionality! -->
<script src="https://cdn.jsdelivr.net/npm/evo-calendar@1.1.2/evo-calendar/js/evo-calendar.min.js"></script>

<script>
    $(document).ready(function() {
        
        
        var method = <?php echo json_encode($events->getResult());?>;
        console.log(method);
        
        var calendarEvents = [];

        const options = {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "numeric",
        };
        $.each(method, function(key, value) {
            
            console.log(value.SCHEDULE)
            var date = new Date(value.SCHEDULE);
            var month = ["January", "February", "March", "April", "May", "June",
                        "July", "August", "September", "October", "November", "December"][date.getMonth()];
            
            var fullDate = `${month}/${date.getDate()}/${date.getFullYear()}`;
            console.log(fullDate);
            calendarEvents.push(
                {
                    id: "bHay68s" + key,
                    name: value.NAME,
                    type: "holiday",
                    date: fullDate,
                    everyYear: true,
                }
            )
        })
        
        console.log(calendarEvents);
        $('#calendar').evoCalendar({
            theme: 'Midnight Blue',
            todayHighlight: true,
            eventDisplayDefault	: true,
            sidebarDisplayDefault: false,
            calendarEvents,

        });
    });
</script>
</body>
</html>