<?php 

    // Start the session
    session_start();
    
    // Destroy the session and unset session variables
    session_destroy();
    // Redirect to the login page or any other page you prefer
    header('Location: login.php');
    exit();
    ?>