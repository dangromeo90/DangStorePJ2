<?php 
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
  unset($_SESSION['recipientname']);
  unset($_SESSION['deliveryaddress']);
  unset($_SESSION['email-guest']);
  unset($_SESSION['phone-guest']);
  unset($_SESSION['note']);
  unset($_SESSION['payment']);
?>
<div class="container">
    <div class="arrow-steps clearfix">
        <div class="step current"> <span>Thông tin giao hàng</span> </div>
        <div class="step"> <span>Xác nhận thanh toán<span></div>
        <div class="step"> <span>Lịch sử đơn hàng<span> </div>
    </div>
    <div class="row">
        <div class="col-sm-12 " >
            <div class="wrapper-content-profile wrapper-delivery ">
                <div class="content-profile-title">
                    <p> Thông tin giao hàng</p>
                </div>
                <form action="?pages=order-confirm" method="post" class="main-profile-body">
                    <div class="wrapper-content-profile-left">
                        <div class="form-group form-group-profile">
                            <input type="text" class="form-control form-control-profile txt-confirm" placeholder="" id="name" name="name"required
                            value="<?php 
                                        if(isset($_SESSION['lastname']) && isset($_SESSION['firstname']))
                                            echo $_SESSION['lastname'] .' '.$_SESSION['firstname'];
                                        elseif(isset($_SESSION['recipientname']))
                                            echo $_SESSION['recipientname'];
                                        else echo ''; 
                                    ?>">
                            <label for="text">Họ Tên (<span>*</span>)</label>
                        </div>
                        <div class="form-group form-group-profile">
                            <input type="text" class="form-control form-control-profile txt-confirm" placeholder="" id="address" name="address"required 
                            value="<?php 
                                        if(isset($_SESSION['address']))echo $_SESSION['address'];
                                        else if(isset($_SESSION['deliveryaddress']))echo $_SESSION['deliveryaddress'];
                                        else echo '';
                                    ?>">
                            <label for="text">Địa chỉ giao hàng (<span>*</span>)</label>
                        </div> 
                        <div class="form-group form-group-profile">
                            <input type="text" class="form-control form-control-profile" placeholder=""   id="phone" name="phone" required
                              value="<?php 
                                        if(isset($_SESSION['phone'])) echo $_SESSION['phone'];
                                        elseif(isset($_SESSION['phone-guest'])) echo $_SESSION['phone-guest'];
                                        else echo '';
                                    ?>">
                            <label for="text">Số điện thoại (<span>*</span>)</label>
                        </div>
                        <div class="form-group form-group-profile">
                            <input type="email" class="form-control form-control-profile" placeholder=""id="email" name="email" onblur="addtxtEmail()" 
                            value="<?php 
                                        if(isset($_SESSION['email'])) echo $_SESSION['email'];
                                        elseif(isset($_SESSION['email-guest'])) echo $_SESSION['email-guest'];
                                        else echo '';
                                    ?>" >
                            <label for="email">Email (nếu có)</label>
                        </div>
                        <div class="form-group form-group-profile">
                            <input type="text" class="form-control form-control-profile" placeholder="" id="note" name="note"
                            value="<?php 
                                        if(isset($_SESSION['note'])) echo $_SESSION['note'];
                                        else echo '';
                                    ?>">
                            <label for="text">Ghi chú (nếu có)</label>
                        </div>
                       
                    </div> 
                    <div class="wrapper-content-profile-right wrapper-payment-method">
                        <div class="wrapper-method">
                            <div class="method-title">
                                 <b>Phương thức thanh toán (<span>*</span>)</b>
                            </div>
                            <div class="form-check">
                                <img src="img/icon/cash.png" alt="" width="35px">
                                <input type="radio" class="form-check-input" id="radio1" name="payment" value="Tiền mặt" checked>Tiền mặt
                            </div>
                            <div class="form-check">
                                <img src="img/icon//bank.png" alt="" width="35px">
                                <input type="radio" class="form-check-input" id="radio2" name="payment" value="Chuyển khoản" >Chuyển khoản
                            </div>
                            <div class="form-check">
                                <img src="img/icon/momo.png" alt="" width="35px" >
                                <input type="radio" class="form-check-input" id="radio3" name="payment" value="Thanh toán MoMo">Momo
                                <label class="form-check-label" for="radio2"></label>
                            </div>
                            <div class="form-check">
                                <img src="img/icon/payvn.png" alt="" width="35px" height="40px">
                                <input type="radio" class="form-check-input" id="radio4" name="payment" value="Thanh toán VnPay">VnPay
                                <label class="form-check-label" for="radio2"></label>
                            </div>
                        </div>
                        <div class="btn-save-profile">
                           <input type="submit" name="btn-cont" id="btn-save-profile" value="Tiếp tục">
                           <div class="wrapper-btn-back">
                           <a href="?pages=cart" class="btn-back">Trở về</a>
                           </div>
                         </div>
                   </div>
              </form>  
           </div>     
       </div>
   </div>
</div>
<style>
    .txt-confirm{
        text-transform: capitalize;
    }
    .main-profile-body{
        margin-top: -35px;
    }
   .content-profile-title p{
    font-size: 26px;
    font-weight: bold;
    text-align: center;
   }
  .form-check{
    margin: 10px;
    display: flex;
  }
  .form-check img{
    margin-left: 5px;
    margin-right: 10px;
    margin-top: -5px;
  }
.wrapper-delivery{
    margin: 0;
    margin-top: 10px;
    font-family: quicksand;
}
.form-group-profile span,
.wrapper-method span{
    color: red;
}
.wrapper-payment-method{
     margin: 0;
    font-family: quicksand;
}
.wrapper-method {
    border: 0;
    width: 60%;
    margin: 0 auto;
    box-shadow: 0 0 4px rgba(2, 41, 199);
    padding:10px;
    text-align: center;
    }
    .wrapper-method b{
    font-size: 18px;
    }
    .method-title{
        padding-bottom: 10px;
    }
    .btn-back{
        padding: 12px 20px;
        background-color: rgb(240, 3, 3);
        border: 0;
        border-radius: 5px;
        color: white;
    }
    .wrapper-btn-back{
        margin-top: -10px;
        transition: all 80ms;

    }
    .wrapper-btn-back:active{
        transform: scale(0.97);
    }
    .btn-save-profile {
    margin-top: 50px;
    display: flex; 
    justify-content: center;
    width: 80%;
    margin-left: auto;
    margin-right: auto;

    }
    #btn-save-profile {
        background-color:  #ee2d7a ;
        padding: 10px 90px;  
        margin-right: 10px;
    }
    #btn-save-profile:hover{
        background-color:  #f20362 ;
    }
    .wrapper-content-profile {
        height: 90%;
    }
</style>
