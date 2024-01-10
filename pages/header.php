<?php 
include "main/login.php" ;
include "main/signup.php" ;
include "modal/modal-logout.php";
include "main/reset-password.php" ;
?>
<div class="header-label">
    <marquee> Thế giới mỹ phẩm và thực phẩm chức năng</marquee>
</div>
        <!-- hearder start -->
<header class="header">
    <div class="logo">
        <a href="index.html"><img src="img/logo/danglogo.jpg" alt="" width="200px" height="130px"></a>
    </div>
    <div class="wrapper-barsearch">
        <form action="index.php?pages=search" method="POST">
            <div class="barsearch">
                <input type="text" placeholder="Tìm kiếm sản phẩm..." name="keyword">
                <button type="submit" id="btn-search"><i class="fas fa-search"></i></button>         
            </div>
        </form>
        <div class="header-info">
            <ul>
                <li>Miễn phí giao hàng cho hoá đơn từ 500.000đ  </li>
                <li>Hoả tốc 2 giờ trong nội thành Tp.HCM </li>
                <li>Tư vấn - đặt hàng : 
                    <a href="https://id.zalo.me/account?continue=https://chat.zalo.me">0915111916</a> - 
                    <a href="https://id.zalo.me/account?continue=https://chat.zalo.me">0837863333</a>
                </li>
            </ul>
       </div>
    </div>
    <div class="wrapper-header-controller">
        <div class="wrapper-header-cart-top">
            <div class="header-cart">
                <div class="cart">
                    <a href="?pages=cart"><img class="img-bag-icon" src="./img/icon/bag-64-1.png" width="30px"></a>
                </div>
                <div class="wrapper-cart-amount">
                    <div class="cart-amount">
                        <p class="item-amount">
                           <?php 
                                if(isset($_SESSION['cart-count'])){
                                    echo $_SESSION['cart-count'];
                                }
                                else{
                                    echo '0';
                                }
                           ?>
                        </p>
                    </div>
                        <a href="?pages=cart" class="txt-cart">Giỏ hàng</a>
               </div>
           </div>
           <?php
              if(isset($_SESSION['email']))
              {
                echo'<div class="account">
                         <div class="dropbtn">
                            <div class="wrapper-avatar">
                               <img src="img/avatar/'.$_SESSION['avatar'].'">
                            </div>
                            <div class="wrapper-customer">
                            <p class="txt-hello" style="font-size:14px;color:rose">Xin Chào !!!<p>
                                <p class="customer-name">'.$_SESSION['lastname'].' '.$_SESSION['firstname'].'</p>
                            </div>
                          </div>
                             <div class="dropdown-content dropdown-login">
                                 <a href="?pages=profile">Hồ sơ của tôi</a>
                                 <a href="?pages=purchased-order">Đơn mua</a>
                                 <a href= "" data-toggle="modal" data-target="#modal-logout">Đăng xuất</a>
                             </div>
                     </div>';
               }
              else
              {
                echo'<div class="account">
                           <button class="dropbtn-none">Tài khoản</button>
                           <form action="">
                               <div class="dropdown-content" >
                                    <button type="button" data-toggle="modal" data-target="#modal-login">Đăng nhập</button>
                                    <button type="button" data-toggle="modal" data-target="#modal-signup">Đăng Ký</button>
                              </div>
                          </form>
                     </div>';
              }
            ?>   
       </div>
        <div class="social-icon">
            <a href="https://www.tiktok.com/"target="_blank"><img src="./img/icon/tiktok.png"/></a>
            <a href="https://www.facebook.com/"target="_blank"><img src="./img/icon/fb.png"/></a>
            <a href="https://id.zalo.me/" target="_blank"><img src="./img/icon/zalo.png"/></a>
            <a href="https://shopee.vn/" target="_blank"><img src="./img/icon/shoppe.png"/></a>
            <a href="https://www.lazada.vn/"target="_blank"><img src="./img/icon/lazada-1.png"/></a>
        </div>
  </div>
</header>

<style>
    .dropdown-login a {
    color: black;
    width: 230px;
    display: block;
    font-size: 16px;
    text-align: center;
    border-radius: 50px;
    border: none;
    background-color:#86c200;
    margin: 3px;
    padding: 10px;
  }
</style>
