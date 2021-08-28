<?php
    session_start();

    unset($_SESSION['userLoggedIn']);
    session_destroy();
    header('Location: userlogin.php');
    exit();

    
?>