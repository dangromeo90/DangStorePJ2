<div class="wrapper-cart-page">
    <div class="cart-title">
        <strong>Giỏ hàng của 
        <?php if(isset( $_SESSION['firstname']))
                  echo '<span style=" text-transform: capitalize;">'.$_SESSION["firstname"].'</span>';
              else 
                echo '<span>bạn</span>';
            ?> 
        </strong>
        <?php if(!isset($_SESSION['cart-count']) ) 
                echo'<p>Không có sản phẩm trong giỏ hàng</p>';
            else
               echo'<p>Có <span>'.$_SESSION['cart-count'].'</span> sản phẩm trong giỏ hàng</p>';
            ?>
    </div>
    <div class="row row-cart">
        <div class="col-sm-8 ">
            <table class="table table-cart">
                <tbody>
                    <?php 
                    if(!isset($_SESSION['cart'])){
                        echo '
                            <tr>
                                <td style = "text-align: center; font-size: 18px; font-weight: bold">
                                    Giỏ hàng của bạn đang trống
                                </td>
                            </tr>';
                    }else{
                        $i=0;
                        $total = 0;
                        foreach ($_SESSION['cart'] as $value) {
                            $thanhtien = $value['proAmount'] * $value['prosalePrice'];
                            $total += $thanhtien;
                            $i++;
                            echo '
                                <tr>
                                    <td class="table-cart-img">
                                        <img src="./img/products/'.$value['proImage'].'" alt="abc" width="100px">
                                    </td>
                                    <td class="table-cart-item">
                                        <p>'.$value['proName'].'
                                            <a href="pages/main/addtoCart.php?delete='.$value['proid'].'"><img src="./img/icon/delete.png" width="25"></a>
                                        </p>
                                        <p>'.$value['proVariant'].'</p>
                                        <p>'.number_format($value['prosalePrice'], 0, ',', '.').'đ</p>
                                        <div class="table-cart-amount">
                                            <a href="pages/main/addtoCart.php?minus='.$value['proid'].'" onclick="handleMinus()"><i class="fas fa-minus"></i></a>
                                            <input type="text" id="quantity" value="'.$value['proAmount'].'" min="1" oninput="checkQuantity()">
                                            <a href="pages/main/addtoCart.php?plus='.$value['proid'].' "<i class="fas fa-plus"></i></a>
                                        </div>
                                        <p class="line-total">'.number_format($thanhtien, 0, ',', '.').'đ</p>
                                    </td>
                                </tr>';
                        }
                        $_SESSION['total'] = $total ;
                    }
                ?>  
                </tbody>
            </table>
        </div>
         <div class="col-sm-4">
            <div class="wrapper-total">
                      <div class="form-group form-group-profile">
                        <?php  if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0)
                          echo' <input type="text" class="form-control form-control-profile" placeholder="" value="" id="coupon" name="coupon" >
                               <label for="text"> Nhập mã giảm giá</label> ';
                             else
                             echo' <input type="text" class="form-control form-control-profile" placeholder="" value="Nhập mã giảm giá" id="coupon" name="coupon" readonly>';
                             ?>
                        </div>
                       
                <div class="total-main">
                    <p>Tổng tiền:</p>
                    <p><?php
                        if(isset($_SESSION['cart']))
                     echo number_format($total,0,',','.') .'đ';
                     ?></p>
                </div>
                <div class="total-pay">
                    <?php
                    if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                        echo '<div class ="wrapper-btn-pay">
                                 <a href="?pages=order-delivery" id="btn-pay" name="checkout">Thanh Toán</a>
                              </div>';
                    } else {
                        echo '<span>Thanh Toán</span>';
                    }
                    ?>
                </div>
                <div class="total-back">
                    <a href="index.php"><i class="fa fa-reply"></i>Tiếp tục mua hàng</a>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .wrapper-btn-pay{
        transition: all 80ms;
    }
    .wrapper-btn-pay:active{
       transform: scale(0.98);
    }
    .total-pay span {
        color: white;
        cursor: not-allowed;
        padding: 10px 120px;
        background-color:  #ee2d7a ;
        color: white;
        font-size: 18px;
        border-radius: 5px;
        transition: all 0.1s;
        text-align: center; 
    }
   
</style>