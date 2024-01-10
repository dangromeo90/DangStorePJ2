<?php
session_start();
// Check if the user is logged in
if (isset($_SESSION['email'])) {
    // Unset session variables
    unset($_SESSION['email']);
    unset($_SESSION['password']);
    unset($_SESSION['lastname']);
    unset($_SESSION['firstname']);
    unset($_SESSION['phone']);
    unset($_SESSION['address']);
    unset($_SESSION['avatar']);

    
    // Redirect to index.php after logout
    header("location:../../index.php");
} else {
    // If not logged in, handle accordingly
    echo "You are not logged in.";
}
?>
