<?php
require("mail/sendemail.php");
if(isset($_POST['resetpass']))
{
  $email = $_POST['email'];
  $sql= "SELECT * from customer where email = '$email'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_num_rows($result);
  if($row)
  {
    $newPassword = substr(md5(rand(0,999999)),0,8);
    $md5Password = md5($newPassword);
    $sql_update = "UPDATE customer SET `password` = '$md5Password' where email = '$email' ";
    $result_update = mysqli_query($conn,$sql_update);
    if($result_update){
      $mail = new mailer();
      $mail -> send_restorePass($email,$newPassword);
    }
    echo  '<script>
              Swal.fire({
                  title: "Khôi phục thành công",
                  icon: "success",
                  timer: 3000,
                  text: "Mật khẩu mới đã gửi vào email của bạn",
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
                  title: "Khôi phục thất bại",
                  icon: "error",
                  timer: 3000,
                  text: "Không tìm thấy email của bạn",
              });
            </script>' . mysqli_error($conn);
  }
}
?>
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
