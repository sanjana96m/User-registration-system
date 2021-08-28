<?php header('Access-Control-Allow-Origin: *'); ?>

<?php
    // Database connection 
    $conn = new mysqli("localhost","root","","admin-db");
    if($conn->connect_error){
        die("Connection Failed".$conn->connect_error);
    }

    $result = array('error'=>false);
    $action = '';

    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }

    // Get users data 
    if($action == 'read'){
        $sql = $conn->query("SELECT * FROM users");
        $users = array();
        while($row = $sql->fetch_assoc()){
            array_push($users, $row);
        }
        $result['users'] = $users;
    }

    // Add Users
    if($action == 'create'){
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = $conn->query("INSERT INTO users (name,phone,email,password) VALUES ('$name','$phone','$email','$password')");
        
        if($sql){
            $result['message'] = "User added successfully";
        }
        else{
            $result['error'] = true;
            $result['message'] = "Failed to add user";
        }
    }

    // Edit User 
    if($action == 'edit'){
        $id =$_POST['id'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = $conn->query("UPDATE users SET name='$name',phone='$phone',email='$email',password='$password' WHERE id='$id'");
        
        if($sql){
            $result['message'] = "User updated successfully";
        }
        else{
            $result['error'] = true;
            $result['message'] = "Failed to update user";
        }
    }

    // Delete user
    if($action == 'delete'){
        $id =$_POST['id'];

        $sql = $conn->query("DELETE FROM users WHERE id='$id'");
        
        if($sql){
            $result['message'] = "User Deleted successfully";
        }
        else{
            $result['error'] = true;
            $result['message'] = "Failed to Delete user";
        }
    }

    $conn->close();

    echo json_encode($result);
?>
