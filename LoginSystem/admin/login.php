<?php
    session_start();
    if (isset($_SESSION['loggedIn'])){
      
      header('Location: dashboard.php');
      exit();
    }
    // database connection
    if (isset($_POST['login'])){
      $connnection = new mysqli("localhost","root","","admin-db");
      $username = $connnection->real_escape_string( $_POST['username']);
      $pwd = $connnection->real_escape_string($_POST['pwd']);

      // query 
      $data = $connnection->query(query:"SELECT id FROM admind WHERE username='$username' AND pwd='$pwd'");
      if($data->num_rows > 0){

        $_SESSION['loggedIn']= '1';
        $_SESSION['username']=$username;
        $_SESSION['pwd']=$pwd;
        exit('<font color="green">Login Success</font>');
      }else
        exit('<font color="red">Username or Password is incorrect</font>');
      
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
                  <h2 class="text-center pt-5 text-info">Admin Login Here</h2>
                </div>
                <form method="post" action="#" class="pb-4">
                    <div class="mb-3">
                      <label class="form-label">Username</label>
                      <input type="text" name="username" id="username"  required>  
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Password</label>
                      <input type="password" name="pwd" id="pwd"  required>
                    </div>
                    <input type="button" value="Login" class="btn btn-primary col-12 mb-4" id="login">
                    <h6 id="response"></h6>
                </form>
                   
              </div>
              <div class="col">
              </div>
            </div>
          </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
          // click event
          $("#login").on('click', function(){
            var username = $("#username").val();
            var pwd = $("#pwd").val();
                
            if (username == "" || pwd == "")
            alert('please check your inputs');
            else{
                $.ajax({
                    url: 'login.php',
                    method: 'POST',
                    data:{
                        login: 1,
                        username: username,
                        pwd: pwd
                    },
                    success: function (response) {
                        $("#response").html(response);

                        if(response.indexOf('success') <= 0){
                          window.location = 'dashboard.php';
                        }   
                    },
                    dataType: 'text'
                });
              }
                
            });
        });
    </script>
</body>
</html>

