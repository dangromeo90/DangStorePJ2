<?php 
    if(isset($_POST['btn-save'])){
        $password = $_POST['password'];
        $newpassword =$_POST['newpassword'];
        $renewpassword =$_POST['renewpassword'];
        if($newpassword != $renewpassword){
            echo '<script>
                        Swal.fire({
                            title: "Mật khẩu không khớp",
                            icon: "error",
                            timer: 3000,
                        }).then(function() {
                            window.location.href = "index.php?pages=change-password";
                        });
                 </script>';
        }
        else if(md5($password) != $_SESSION['password']){
            echo '<script>
                        Swal.fire({
                            title: "Sai mật khẩu cũ !",
                            icon: "error",
                            timer: 3000,
                        }).then(function() {
                            window.location.href = "index.php?pages=change-password";
                        });
                 </script>' . mysqli_error($conn);
        }
        else{
            $updatepassword = md5($newpassword);
            $sql = "UPDATE `customer` SET `password`='$updatepassword' WHERE `email`='".$_SESSION['email']."'";
            $result = mysqli_query($conn,$sql);
            if($result){
                $_SESSION['password'] = $updatepassword;
                echo '<script>
                        Swal.fire({
                            title: "Đổi mật khẩu thành công !",
                            icon: "success",
                            timer: 3000,
                        }).then(function() {
                            window.location.href = "index.php?pages=change-password";
                        });
                 </script>';
            }
            else{
                echo '<script>
                            Swal.fire({
                                title: "Sai mật khẩu cũ !",
                                icon: "error",
                                timer: 3000,
                            }).then(function() {
                                window.location.href = "index.php?pages=change-password";
                            }); 
                    </script>' . mysqli_error($conn);
            }
        }
    }
?>
<div class="row wrapper-sidebar-profile">
   <?php 
    include "sidebar-profile.php";
   ?>
    <div class="col-sm-9 col-md-6 col-lg-8 ">
        <div class="wrapper-content-profile">
            <div class="content-profile-title">
                <h4> Đổi mật khẩu</h4>
            </div>
            <form action="" method="post" enctype="multipart/form-data" class="main-profile-body">
                <div class="wrapper-content-profile-left">
                    <div class="form-group form-group-profile">
                        <input type="password" class="form-control form-control-profile" placeholder="" id="password" name="password"required>
                        <label for="text">Mật khẩu cũ</label>
                    </div>
                    <div class="form-group form-group-profile">
                        <input type="password" class="form-control form-control-profile" placeholder="" id="newpassword" name="newpassword"required>
                        <label for="text">Mật khẩu mới</label>
                    </div>
                    <div class="form-group form-group-profile">
                        <input type="password" class="form-control form-control-profile" placeholder="" id="renewpassword" name="renewpassword" required>
                        <label for="email">Nhập lại mật khẩu mới</label>
                    </div>
                    <div class="btn-save-profile">
                        <input type="submit" name="btn-save" id="btn-save-profile" value="Lưu">
                    </div>
                </div> 
            </form>
        </div>
    </div>
</div>


