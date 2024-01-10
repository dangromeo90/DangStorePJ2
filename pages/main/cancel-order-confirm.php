<?php
session_start();
    unset($_SESSION['recipientname']);
    unset($_SESSION['deliveryaddress']);
    unset($_SESSION['email-guest']);
    unset($_SESSION['phone-guest']);
    unset($_SESSION['note']);
    unset($_SESSION['payment']);
    
    header("location:../../index.php?pages=cart");
    exit();

?>
