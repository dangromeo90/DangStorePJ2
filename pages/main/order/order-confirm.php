<?php
// Xử lý khi nút "Tiếp tục" được nhấn
if (isset($_POST['btn-cont'])) {
    // Xoá session cũ trước khi tạo session mới
    unset($_SESSION['recipientname']);
    unset($_SESSION['deliveryaddress']);
    unset($_SESSION['email-guest']);
    unset($_SESSION['phone-guest']);
    unset($_SESSION['note']);
    unset($_SESSION['payment']);

    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $note = $_POST['note'];
    $payment = $_POST['payment'];

    // tạo session guest mới
    $_SESSION['recipientname'] = $name;
    $_SESSION['deliveryaddress'] = $address;
    $_SESSION['email-guest'] = $email;
    $_SESSION['phone-guest'] = $phone;
    $_SESSION['note'] = $note;
    $_SESSION['payment'] = $payment;
}
?>
<div class="container">
    <div class="arrow-steps clearfix">
        <div class="step done"> <span>Thông tin giao hàng</span> </div>
        <div class="step current"> <span>Xác nhận thanh toán</span> </div>
        <div class="step"> <span>Lịch sử đơn hàng</span> </div>
    </div>
</div>
<div class="wrapper-cart-page">
    <div class="cart-title">
        <strong>Xác nhận đơn hàng</strong>
    </div>
    <div class="row row-cart">
        <div class="col-sm-8">
            <table class="table table-cart">
                <tbody>
                    <?php
                    if (!isset($_SESSION['cart'])) {
                        echo '
                            <tr>
                                <td style="text-align: center; font-size: 18px; font-weight: bold">
                                    Giỏ hàng của bạn đang trống
                                </td>
                            </tr>';
                    } else {
                        $total = 0;
                        foreach ($_SESSION['cart'] as $value) {
                            $thanhtien = $value['proAmount'] * $value['prosalePrice'];
                            $total += $thanhtien;
                            echo '
                                <tr>
                                    <td class="table-cart-img">
                                        <img src="./img/products/' . $value['proImage'] . '" alt="abc" width="100px">
                                    </td>
                                    <td class="table-cart-item">
                                        <p>' . $value['proName'] . '</p>
                                        <p>' . $value['proVariant'] . '</p>
                                        <p>' . number_format($value['prosalePrice'], 0, ',', '.') . 'đ</p>
                                        <div class="table-cart-amount">
                                            <input id="quantity" value="' . $value['proAmount'] . '" min="1" readonly>
                                        </div>
                                        <p class="line-total">' . number_format($thanhtien, 0, ',', '.') . 'đ</p>
                                    </td>
                                </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="col-sm-4">
            <div class="wrapper-right-confirm">
                <div class="wrapper-info">
                    <div class="wrapper-content-profile-left">
                        <p>Họ Tên : <span class="txt-confirm"><?= isset($_SESSION['recipientname']) ? $_SESSION['recipientname'] : ''; ?></span></p>
                        <p>Địa chỉ : <span class="txt-confirm"><?= isset($_SESSION['deliveryaddress']) ? $_SESSION['deliveryaddress'] : ''; ?></span> </p>
                        <p>Điện thoại : <span><?= isset($_SESSION['phone-guest']) ? $_SESSION['phone-guest'] : ''; ?></span> </p>
                        <p>Email : <span><?= isset($_SESSION['email-guest']) ? $_SESSION['email-guest'] : ''; ?></span> </p>
                        <p>Ghi chú : <span style="color: red;"><?= isset($_SESSION['note']) ? $_SESSION['note'] : ''; ?></span> </p>
                        <p>Phương thức thanh toán : <span><?= isset($_SESSION['payment']) ? $_SESSION['payment'] : ''; ?></span> </p>
                    </div>
                </div>

                <div class="wrapper-total">
                    <div class="total-main">
                        <p>Tổng tiền:</p>
                        <p><?= isset($_SESSION['cart']) ? number_format($total, 0, ',', '.') . 'đ' : '0đ'; ?></p>
                    </div>

                    <form action="pages/main/order/order.php" method="post" class="">
                        <div class="total-pay">
                            <input type="submit" id="btn-pay" name="btn-order" value="Đặt hàng">
                        </div>
                    </form>

                    <button id="btn-cancel" name="btn-cancel" class="btn btn-danger" data-toggle="modal" data-target="#modal-cancel">Huỷ</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-cancel">
    <div class="modal-dialog">
        <div class="modal-content loginform">
            <button type="" class="close" data-dismiss="modal"><img src="img/icon/close2.jpg" width="25px"></button>
            <div class="modal-header1">
                <p>Bạn muốn huỷ ?</p>
                <div class="wrapper-button">
                    <button type="button" class="btn btn-primary" onclick="confirmCancel()">OK</button>
                    <button type="button" class="btn btn-danger btn-close" onclick="closeModal()">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function confirmCancel() {
        window.location.href = 'pages/main/cancel-order-confirm.php';
    }

    function closeModal() {
        $('#modal-logout').modal('hide');
    }
</script>
<script>
        $(document).ready(function () {
            window.onbeforeunload = function () {
                // Gửi yêu cầu AJAX để huỷ bỏ session khi rời khỏi trang
                $.ajax({
                    url: 'pages/main/cancel-order-confirm.php', 
                    method: 'POST',
                    async: false
                });
            };
        });
    </script>

<style>
  
    .cart-title{
        margin-top: 20px;
        color: green;
    }
.wrapper-info{
    box-shadow: 0 0 7px rgb(233, 121, 87);
    padding: 5px;
    margin: 0;
    
}
.wrapper-total{
    margin-top: 10px;

}
.total-main{
    margin-top: 5px;
}
.wrapper-content-profile-left{
  margin-top: 10px;
  margin-left: 10px;
  font-family: quicksand;
}
.wrapper-content-profile-left p{
font-weight: bold;
}
.wrapper-content-profile-left span{
font-weight: bold;
color: #e83770;
}
.wrapper-right-confirm{
    position: sticky;
    top: 10px;
}
#btn-pay{
    width: 90%;
    padding: 10px ;
    margin-right: 5px;
    border: 0;
    margin: auto;
    transition: all 80ms;
    margin-top: -10px;
}
#btn-pay:active{
    transform: scale(0.98);
}

#btn-cancel{
   padding: 8px 20px;
   border: 0;
   border-radius: 5px;
   color: white;
   width: 30%;
   margin-left: 35%;
   background-color: rgb(240, 3, 3);

}
.total-pay{
    display: flex;
    justify-content: space-between;
}
.wrapper-button{
        display: flex;
    }
    .wrapper-button button{
        margin-left: 5px;
        padding: 5px 10px;
    }
.btn-close{
    background-color: rgb(240, 3, 3);

}
.txt-confirm{
    text-transform: capitalize;
}
</style>

