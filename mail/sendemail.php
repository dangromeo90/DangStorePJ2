<?php 
 include_once "mail/PHPMailer/src/PHPMailer.php"; 
 include_once "mail/PHPMailer/src/SMTP.php"; 
 include_once "mail/PHPMailer/src/Exception.php"; 
 class mailer{
    function send_restorePass($email,$newPassword){
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
        try {
            $mail->SMTPDebug = 0; //0,1,2: chế độ debug
            $mail->isSMTP();  
            $mail->CharSet  = "utf-8";
            $mail->Host = 'smtp.gmail.com';  //SMTP servers
            $mail->SMTPAuth = true; // Enable authentication
            $mail->Username = 'dangstore163@gmail.com'; // SMTP username
            $mail->Password = 'clvihcdqzckczuhb';   // SMTP password
            $mail->SMTPSecure = 'tls';  // encryption TLS/SSL 
            $mail->Port = 587;  // port to connect to                
            $mail->setFrom('dangstore163@gmail.com'); 
            $mail->addAddress($email); 
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = 'Đăng Store - Khôi phục mật khẩu';
            $contentEmail = 
            "<html>
            <link href='https://fonts.googleapis.com/css?family=Open+Sans&display=swap'rel='stylesheet'/>
            <head>
                <style>
                    .wrapper-reset-email{
                        font-family: Open sans;
                        background-color: #f4f4f4;
                        color: #ee2d7a;
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                        background-color: #fff;
                        border-radius: 10px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        border:solid 2px #23a6d5;
                    }
            </style>
            </head>
            <body>
            <div class='wrapper-reset-email'>
                <h1 style='text-align:center; font-size: 30px;';font-weight:bold>Đăng Store</h1>
                <div class='email-reset-content'>
                    <h2 style='color: #2e56f3'>Khôi phục mật khẩu thành công !</h2>
                    <p style='font-size: 16px; line-height:1.6;'>Bạn đã khôi phục mật khẩu thành công. Dưới đây là mật khẩu mới của bạn:</p>
                    <b style='color: rgb(217, 129, 15);font-size:22px;'>$newPassword</b>
                </div>
            </div>
            </body>
            </html>
            "; 
            $mail->Body =  $contentEmail;
            $mail->smtpConnect( array(
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
                        title: "Khôi phục thất bại",
                        icon: "error",
                        timer: 3000,
                    });
            </script>', $mail->ErrorInfo;
        }
    }
    function send_OrderConfirmation($email,$content) {
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
            $contentEmail = $content; 
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
}
?>
