<!DOCTYPE html>
<html lang="en-vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>
    <link href="https://fonts.googleapis.com/css?family=Alatsi&display=swap"rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap"rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap"rel="stylesheet"/>
    <style>.container-fluid a{text-decoration: none;} .container-fluid ul{list-style:none;}</style>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animation.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/productdetail.css">
    <link rel="stylesheet" href="css/dropdown.css">
    <link rel="stylesheet" href="css/reponsive.css">
    <link rel="stylesheet" href="css/cart.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.min.css" rel="stylesheet">

</head>
<body >
   
    <div class="container-fluid"> 
       <?php 
          session_start();
          include "database/database.php";
          include "pages/menu-bar.php";
          include "pages/main.php";
          include "pages/footer.php";
        ?>
   </div>
<script src="js/slide.js"></script>
<script src="js/checkform.js"></script>

</body>
</html>
<?php 
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
?>