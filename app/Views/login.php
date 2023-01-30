<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/b24469f289.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body class="h-100 overflow-hidden bg-secondary" >
  <div class="row h-100">
    <div class="col">
    </div>
    <div class="col h-100 d-flex align-items-center">
      <div class="container">
        <form class="" action="login" method="POST">
          <div class="mb-3 row">
            <label for="" class="col-sm-2 col-form-label text-white ">Username</label>
            <div class="col-sm-10">
              <input type="text" class="form-control border border-grey border-2" name="username" required id="inputUsername" value="">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label text-white">Password</label>
            <div class="col-sm-10">
              <input aria-describedby="inputPasswordFeedback" type="password" class="form-control border border-grey border-2" name="password" required id="inputPassword">
            </div>

          </div>
          <?php if (session()->get('invalidAccDetails')) : ?>
            <div class="mb-3 row ">
              <div class="alert alert-danger text-center" role="alert">
                Invalid Username or Password
              </div>
            </div>
          <?php endif; ?>
          <div class="mt-3 mb-3 row d-flex justify-content-center">
            <input type="submit" name="submit" class="btn btn-primary w-25 border-grey border-2">
          </div>
        </form>
      </div>
    </div>
    <div class="col">
    </div>
  </div>

</body>

</html>