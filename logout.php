<?php 

    // Start the session
    session_start();
    
    // Destroy the session and unset session variables
    session_destroy();
    unset($_SESSION['customer_id']); // Change 'user' to the appropriate session variable used for user authentication
    
    // Redirect to the login page or any other page you prefer
    header('Location: index.php');
    exit();
    ?>