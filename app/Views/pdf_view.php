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
    <h2>STUDENT RECORDS IN SECTION <?php echo " ".$section ?></h2>
    <div class="table-responsive  ">
        <table border="1" cellpadding="10" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th scope="col" class="fs-6">LRN</th>
              <th scope="col" class="fs-6">First Name</th>
              <th scope="col" class="fs-6">Last Name</th>
              <th scope="col" class="fs-6">AGE</th>
              <th scope="col" class="fs-6">GENDER</th>
              <th scope="col" class="fs-6">NUM OF ABSENCES</th>
              <th scope="col" class="fs-6">NUM OF DAYS PRESENT</th>
              <th scope="col" class="fs-6">TOTAL ATTENDANCE</th>
            </tr>
          </thead>
          <tbody id="tableBody">
            <?php foreach ($sectionData->getResult() as  $student) {
              $ID = $student->LRN;
              $studentFNAME = $student->FIRSTNAME;
              $studentLNAME = $student->LASTNAME;
              $studentAGE = $student->AGE;
              $studentGENDER = ($student->GENDER == 1) ? "Male" : "Female";
              $absences = $student->NUMBER_OF_ABSENCES;
              $present = $student->NUM_OF_PRESENT;
              $total_attendance = $student->TOTAL_ATTENDANCE; 
            ?>
              <tr>
                <td><?php echo $ID; ?></td>
                <td><?php echo $studentFNAME ?></td>
                <td><?php echo $studentLNAME ?></td>
                <td><?php echo $studentAGE  ?></td>
                <td><?php echo $studentGENDER ?></td>
                <td><?php echo $absences ?></td>
                <td><?php echo $present ?></td>
                <td><?php echo $total_attendance?></td>
              </tr>
            <?php } ?>
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