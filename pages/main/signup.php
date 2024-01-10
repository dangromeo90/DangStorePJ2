<?php
if(isset($_POST['signup'])){
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $repassword = md5($_POST['repassword']);
    $avatar = 'customer.jpg';
    if($password != $repassword){
        echo '<script>
                Swal.fire({
                    title: "Mật khẩu không khớp",
                    icon: "error",
                    timer: 3000,
                }).then(function() {
                    window.location.href = "index.php"; 
                });
              </script>';
        exit();
    }
    // kiểm tra email và sđt tồn tại ?
    $sql_check = "SELECT * FROM `customer` WHERE `email`='$email' or `phone`='$phone'";
    $result_check = mysqli_query($conn,$sql_check);
    $row = mysqli_num_rows($result_check);
    if ($row > 0) {
        echo '<script>
                Swal.fire({
                    title: "Đăng ký thất bại",
                    icon: "error",
                    timer: 3000,
                    text: "Email hoặc số điện thoại đã tồn tại",
                }).then(function() {
                    window.location.href = "index.php"; 
                });
              </script>' . mysqli_close($conn);
        exit();
    }
    // Thêm dữ liệu
    $sql = "INSERT INTO `customer`(`customerid`, `email`, `password`, `lastname`, `firstname`, `address`, `phone`, `avatar`) 
            VALUES ('', '$email', '$password', '$lastname', '$firstname', '', '$phone', '$avatar')";
    $result = mysqli_query($conn, $sql);
    if($result) {
        echo '<script>
            Swal.fire({
                title: "Đăng ký thành công.",
                icon: "success",
                timer: 2000,
                showConfirmButton: false
            }).then(function() {
                window.location.href = "index.php";
            });
        </script>';
    }
}
?>
<div class="modal fade" id="modal-signup">
    <div class="modal-dialog">
        <div class="modal-content registerform">
            <button type="button" class="close" data-dismiss="modal"><img src="img/icon/close2.jpg" width="25px"></button>
            <div class="modal-header1">
                <h4 class="modal-title">Đăng Ký</h4>
              <button class="signup-social">
                <img src="img/icon/google.png" alt="" width="40px">
                <p>Đăng ký bằng google </p>
              </button>
              <div class="txt-or"><span>Hoặc sử dụng email để đăng ký</span></div>
              <form action="" method="post" class="form-signup">
              <div class="form-group">
                  <label>Họ</label>
                  <input type="text" class="form-control" placeholder="Nhập họ của bạn" id="lastname" name="lastname" required>
                </div>
                <div class="form-group">
                  <label>Tên</label>
                  <input type="text" class="form-control" placeholder="Nhập tên của bạn" id="firstname" name="firstname" required>
                </div>
                <div class="form-group">
                  <label>Số điện thoại</label>
                  <input type="text" class="form-control" placeholder="Nhập số điện thoại của bạn" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" value="@gmail.com" class="form-control" placeholder="Nhập email đăng nhập" id="email" name="email" onblur="addtxtEmail()" required>
                 </div>
                  <div class="form-group">
                    <label for="pwd">Mật khẩu</label>  <i class="fas fa-eye eye-icon" onclick="showpassword()"></i>
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="Nhập mật khẩu" id="password" name="password" required>
                      
                    </div>
                </div>

                <div class="form-group">
                    <label for="pwd">Nhập lại mật khẩu</label>
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" id="repassword" name="repassword" required>
                      
                    </div>
                </div>
                <div class="wrapper-btn-login">
                    <input type="submit" name="signup" id="btn-login" value="Đăng ký">
               </div>
              </form>
            </div>
        </div>
    </div>
</div>

