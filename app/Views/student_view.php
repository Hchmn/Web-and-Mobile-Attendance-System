<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Codeigniter 4 PDF Example - positronx.io</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h2>Student  <?php echo " ".$fullname; ?></h2>
    <div class="table-responsive  ">
        <table border="1" cellpadding="10" cellspacing="0" width="100%">
          <thead>
          <thead>
            <tr>
              <th scope="col" class="fs-6">Student Name</th>
              <th scope="col" class="fs-6">Professor</th>
              <th scope="col" class="fs-6">TIME IN</th>
              <th scope="col" class="fs-6">DATE START</th>
              <th scope="col" class="fs-6">DATE END</th>
            </tr>
          </thead>
          </thead>
          <tbody id="tableBody">
            <?php 
                if($student_data != NULL): ?>
                <?php 
                    for($x = 0; $x < sizeof($student_data); $x++){
                        $studentName = $student_data[$x][0];
                        $teacherName = $student_data[$x][1];
                        $timeIn = ($student_data[$x][2] == NULL) ? "ABSENT" : $student_data[$x][2];
                        $dateStart = $student_data[$x][3];
                        $dateEnd = $student_data[$x][4];
                ?>
                    <tr class="">
                        <td><?php echo $studentName;?></td>
                        <td><?php echo $teacherName;?></td>
                        <td><?php echo $timeIn;?></td>
                        <td><?php echo $dateStart;?></td>
                        <td><?php echo $dateEnd;?></td>
                    </tr>
                <?php 
                    }
                ?>
            <?php endif; ?>
          </tbody>

        </table>
      </div>
  </div>
</body>
</html>

<script>
$(document).ready(function(e) {
  var slides = document.getElementsByClassName("qrcode-container");
  for (var i = 0; i < slides.length; i++) {
    let element = slides[i];
    new QRCode(element, element.children[0].value);
    element.style.display = "block";
  }
});
</script>