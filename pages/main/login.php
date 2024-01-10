<?php 
if(isset($_POST['login'])){
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $sql = "SELECT * FROM `customer` WHERE `email` = '$email' and `password` = '$password' ";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_num_rows($result);
  if ($row) 
  {
    while($row= mysqli_fetch_array($result))
    {
      $_SESSION['customerid']= $row['customerid'];
      $_SESSION['email']= $row['email'];
      $_SESSION['password']= $row['password'];
      $_SESSION['lastname']= $row['lastname'];
      $_SESSION['firstname']= $row['firstname'];
      $_SESSION['phone']= $row['phone'];
      $_SESSION['address']= $row['address'];
      $_SESSION['avatar']= $row['avatar'];
     }
     echo '<script>
                  Swal.fire({
                      title: "Đăng nhập thành công",
                      icon: "success",
                      timer: 1000,
                      showConfirmButton: false
                  }).then(function() {
                      window.location.href = "index.php";
                  });
          </script>';
    }
    else
    {
      echo '<script>
                Swal.fire({
                    title: "Đăng nhập thất bại",
                    icon: "error",
                    timer: 3000,
                    text: "Email hoặc mật khẩu không chính xác.",
                }).then(function() {
                    window.location.href = "index.php";
                });
            </script>' . mysqli_error($conn);
    }
    exit();
}
?>
<div class="modal fade" id="modal-login">
    <div class="modal-dialog">
        <div class="modal-content loginform">
            <button type="" class="close" data-dismiss="modal"><img src="img/icon/close2.jpg" width="25px"></button>
            <div class="modal-header1">
                <h4 class="modal-title">Đăng Nhập</h4>
              <button class="signup-social" >
                <img src="img/icon/google.png" alt="" width="35px">
               <a href="google/login/login.php">Đăng nhập bằng google </a>
               
                <!-- <a href="">Đăng nhập bằng google </a> -->
              </button>
              <div class="txt-or"><span>Hoặc</span></div>
              <form action="" method="post" class="form-signup">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" value="@gmail.com" class="form-control" placeholder="Nhập email đăng nhập" id="email" name="email" onblur=" addtxtEmail()" required>
                 </div>
                <div class="form-group">
                    <label for="pwd">Mật khẩu</label>
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="Nhập mật khẩu" id="login-password" name="password" required>
                    </div>
                </div>
                <div class="wrapper-btn-login">
                    <input type="submit" name="login" id="btn-login" value="Đăng nhập">
               </div>
               <div class="wrapper-login-footer">
                  <p>Quên mật khẩu ?</p>
                  <a href="" data-dismiss="modal" data-toggle="modal" data-target="#emailModal">Khôi phục mật khẩu</a>
               </div>
               <div class="wrapper-login-footer wrapper-login-footer2 ">
                  <p>Khách hàng mới ?</p>
                  <a href="" data-dismiss="modal" data-toggle="modal" data-target="#modal-signup">Đăng ký tài khoản</a>
               </div>
              </form>
            </div>
         </div>
    </div>
</div>
<div class="modal" id="emailModal" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content loginform">
    <button type="button" class="close" data-dismiss="modal"> <img src="img/icon/close2.jpg" width="25px">  </button>
      <div class="modal-header1">
        <h5 class="modal-title">KHÔI PHỤC MẬT KHẨU</h5>
        <p style="font-family: quicksand;">Nhập email cùa bạn</p>
        <form action="" method="post" enctype="multipart/form-data" class="form-signup">
          <div class="form-group form-group-changepass">
            <input type="email" class="form-control form-control-changepass" placeholder="" id="email" name="email" onblur="addtxtEmail()" required>
            <label for="email">Email</label>
          </div>
          <div class="wrapper-btn-login">
              <input type="submit" name="resetpass" id="btn-login" value="Khôi phục">
           </div>
           <div class="wrapper-login-footer">
              <p>Bạn đã nhớ mật khẩu?</p>
              <a href="" data-dismiss="modal" data-toggle="modal" data-target="#modal-login">Trở về đăng nhập</a>
            </div>
        </form>
     </div>
    </div>
  </div>
</div>