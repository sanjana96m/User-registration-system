<?php
     $msg="";
     if (isset($_POST['register'])){
        $connnection = new mysqli("localhost","root","","admin-db");
        $name = $connnection->real_escape_string( $_POST['name']);
        $phone = $connnection->real_escape_string($_POST['phone']);
        $email = $connnection->real_escape_string($_POST['email']);
        $password = $connnection->real_escape_string($_POST['password']);

        if ($name == "" || $phone == "" || $email == "" || $password == ""){
            $msg = "Please check Your Inputs";
        }else {
            $sql = $connnection->query("SELECT id FROM users WHERE email='$email'");
            if($sql->num_rows > 0){
                $msg ="Email already exists";
            }else{
                $sql = $connnection -> query("INSERT INTO users (name,phone,email,password) VALUES ('$name','$phone','$email','$password')");
                $msg ="Registration Success! Click Login to Continue";
            }
        }
     }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    
    <style>
        body{
                background-color: #eee;
            }
            a{
                text-decoration: none;
                padding-left: 5px;
                font-weight: bold;
            }
            form{
                max-width: 420px;
                margin: 30px auto;
                background-color: #fff;
                padding: 40px;
                border-radius: 10px;
            }
            label{
                color: #aaa;
                text-transform: uppercase;
                letter-spacing: 1px;
                font-weight: bold;
            }
            input{
                display: block;
                padding: 5px 6px;
                width: 100%;
                box-sizing: border-box;
                border: none;
                border-bottom: 1px solid #ddd;
                color: #555;
            }
            .allready-text{
                font-weight: bold;
                color: #404040;
            }
    </style>
  </head>
<body>
    <div id="app">
      <div class="container">
        <div class="row">
          <div class="col">
          </div>
          <div class="col-md-6">
            <div id="form-header">
              <h2 class="text-center pt-5 text-info">Welocome! Register Here</h2>
            </div>
            <form method="post" action="index.php">
                <div class="mb-3">
                  <label class="form-label">Name</label>
                  <input type="text" name="name" required>  
                </div>
                <div class="mb-3">
                  <label class="form-label">Phone</label>
                  <input type="text" name="phone">  
                </div>
                <div class="mb-3">
                  <label class="form-label">Email address</label>
                  <input type="email" name="email" required>  
                </div>
                <div class="mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" name="password" required>
                </div>
                <input type="submit" name="register" class="btn btn-primary col-12 mb-2" value="Register">
                <div class="mt-1
                 allready-text">
                    <?php if ($msg != "") echo $msg . "<br>"
                    
                    ?>
                  <button class="btn btn-primary col-12 mt-1"><a href="users/userlogin.php" class="text-light fw-normal">Login</a></button> 
                </div>
              </form>
          </div>
          <div class="col">
          </div>
        </div>
      </div>
    </div>
    
</body>
</html>