<?php
    session_start();

    if (!isset($_SESSION['userLoggedIn'])){
      header('Location: userlogin.php');
      exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col">
    </div>

    <div class="col-md-6 mt-5">
        <div class="card text-center mt-5">
            <div class="card-body">
                <h2 class="card-title text-info">My Account</h2>
                <p class="card-text fw-bold">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Delectus architecto ratione quis sunt voluptate libero assumenda dicta inventore repellat quaerat harum eligendi ipsa illo esse dignissimos dolore ipsam, officiis error vero.</p>
                <a href="userlogout.php" class="btn btn-secondary">Logout</a>
            </div>
            </div>
    </div>

    <div class="col">
    </div>
  </div>
</div>

</body>
</html>