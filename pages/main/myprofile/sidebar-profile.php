<div class="col-sm-3 col-md-6 col-lg-4 " >
    <ul class="sidebar-profile-header" >
        <li><img src="img/avatar/customer.jpg" alt=""></li>
        <b> <?php echo $_SESSION['lastname'] .' '. $_SESSION['firstname'] ?></b>
    </ul>
    <ul class="sidebar-profile-body" >
        <li><a href="index.php?pages=myprofile">Hồ sơ của tôi</a></li>
        <li><a href="index.php?pages=customer-address">Địa chỉ giao hàng</a></li>
        <li><a href="index.php?pages=change-password">Đổi mật khẩu</a></li>
        <li><a href="index.php?pages=purchased-order">Đơn mua</a></li>
        <li><a href="" data-toggle="modal" data-target="#modal-logout">Đăng xuất</a></li>
    </ul>
</div>
<?php 
include 'modal/modal-logout.php';
?>