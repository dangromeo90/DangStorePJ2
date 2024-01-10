<?php 
// ini_set('log_errors', 1);
// ini_set('error_log', '/path/to/error_log.log'); // Điều chỉnh đường dẫn tới file log của bạn

// // Tắt hiển thị lỗi trực tiếp lên trang web
// ini_set('display_errors', 0);

// // Bật báo cáo tất cả các loại lỗi
// error_reporting(E_ALL);

session_start();
include '../../../database/database.php';

$ngay = date('d'.'m'.'y');
$ordercode =  $ngay . rand(0, 9999);

$sql_order = "INSERT INTO `order`(`customerid`, `accountid`, `couponid`, `ordercode`, `orderdate`, `deliverydate`, `recipientname`, `deliveryaddress`, `phone`, `email`, `total`, `shippingmethod`, `orderstatus`) 
        VALUES (";

if (isset($_SESSION['customerid'])) {
    $sql_order .= "'" . $_SESSION['customerid'] . "',";
} else {
    $sql_order .= "null,";
}

$sql_order .= "null, null, '$ordercode', CURRENT_DATE, null, '".$_SESSION['recipientname']."', '".$_SESSION['deliveryaddress']."', '".$_SESSION['phone-guest']."', '".$_SESSION['email-guest']."', '".$_SESSION['total']."', '".$_SESSION['payment']."', null)";

$result_order = mysqli_query($conn, $sql_order);

if (!$result_order) {
    echo "Server đang bị lỗi, vui lòng thử lại sau ít phút!";
    exit();
}

$sql_orderid = "SELECT max(orderid) as orderid FROM `order`";
$result_orderid = mysqli_query($conn, $sql_orderid);

if (!$result_orderid) {
    die("Server đang bị lỗi, vui lòng thử lại sau ít phút!");
}

$orderid = "";

while ($row = mysqli_fetch_array($result_orderid)) {
    $orderid = $row['orderid'];
}

$sql_order_detail = "INSERT INTO `orderdetail`(`productid`, `orderid`, `amount`, `saleprice`, `vat`, `note`)
   VALUES ";

foreach ($_SESSION['cart'] as $value) {
    $proid = $value['proid'];
    $amount = $value['proAmount'];
    $saleprice = $value['prosalePrice'];
    $variant = $value['proVariant'];
    $note = isset($_SESSION['note']) ? $_SESSION['note'] : '';
    $sql_order_detail .= "('$proid', '$orderid', '$amount', '$saleprice', null, '$note'),";
}
$sql_order_detail = rtrim($sql_order_detail, ',');
$result = mysqli_query($conn, $sql_order_detail);

if ($result) {
    $email = isset($_SESSION['email-guest']) ? $_SESSION['email-guest'] : $_SESSION['email'];
    $productInfo = getProductInfo($_SESSION['cart']);
    send_OrderConfirmation($email, $ordercode, $productInfo);
    unset($_SESSION['recipientname']);
    unset($_SESSION['deliveryaddress']);
    unset($_SESSION['email-guest']);
    unset($_SESSION['phone-guest']);
    unset($_SESSION['note']);
    unset($_SESSION['payment']);
    unset($_SESSION['cart']);
    unset($_SESSION['cart-count']);	
    unset($_SESSION['total']);	
    mysqli_close($conn);
}
echo '<script>alert("Đặt hàng thành công! Vui lòng chờ shop xử lý bạn nhé!");
		document.location= "../../../index.php"</script>'; 

function getProductInfo($cart) {
    $productInfo = '';
    foreach ($cart as $value) {
        $productName = $value['proName'];
        $quantity = $value['proAmount'];
        $unitPrice = $value['prosalePrice'];
        $totalPrice = $quantity * $unitPrice;
        $productInfo .= "
        <tr>
            <td style='text-align: left'>$productName</td>
            <td style='text-align: center'>$quantity</td>
            <td style='text-align: right'>". number_format($unitPrice, 0, ',', '.') . "</td>
            <td style='text-align: right'>". number_format($totalPrice, 0, ',', '.') . "</td>
        </tr>";
    }
    return $productInfo;
}
function send_OrderConfirmation($email,$ordercode,$productInfo) {
    include_once "../../../mail/PHPMailer/src/PHPMailer.php"; 
    include_once "../../../mail/PHPMailer/src/SMTP.php"; 
    include_once "../../../mail/PHPMailer/src/Exception.php"; 
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->CharSet = "utf-8";
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'dangstore163@gmail.com';
        $mail->Password = 'clvihcdqzckczuhb';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('dangstore163@gmail.com');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Đăng Store - Xác nhận đơn hàng';
        $contentEmail = "
<html>
    <head>
        <style>
            .wrapper-reset-email {
                padding: 0;
                font-family: 'Open Sans', sans-serif;
                background-color: #f4f4f4;
                max-width: 600px;
                margin: auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 10px;
                border: solid 2px #23a6d5;
            }
h1 {text-align: center;font-size: 25px;margin-top: -20px;color: #ee2d7a;}
</style>
</head>
    <body>
        <div class='wrapper-reset-email'>
            <h1>Đăng Store</h1>
            <div class='email-reset-content'>
                <p>Cảm ơn bạn đã mua hàng. Đơn hàng của bạn đã được xử lý</p>
                <p>Mã đơn hàng: <b style='color: #2e56f3;'>$ordercode</b></p>
            </div>
            <table class='table'>
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    $productInfo
                </tbody>
                <tfoot>
                    <td colspan='4' style='text-align: right;'>Tổng tiền: ".number_format($_SESSION['total'],0,',','.')."</td>
                </tfoot>
            </table>
        </div>
    </body>
</html>";
 
        $mail->Body = $contentEmail;
        $mail->smtpConnect(array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        ));
        $mail->send();
    } catch (Exception $e) {
        echo '<script>
                Swal.fire({
                    title: "Gửi email xác nhận thất bại",
                    icon: "error",
                    timer: 3000,
                });
            </script>', $mail->ErrorInfo;
    }
}
// Thêm vào đoạn mã khi bạn muốn kiểm tra
exit();
?>
