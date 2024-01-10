<?php
    if(isset($_POST['btn-save'])){
        $address = $_POST['address'];
        $sql = "UPDATE `customer` SET `address`= '$address' WHERE email = '".$_SESSION['email']."'";
        $result = mysqli_query($conn, $sql) ;
        if($result){
            $_SESSION['address'] = $address;
            echo '<script>
                      Swal.fire({
                            title: "Cập nhật thành công",
                            icon: "success",
                            timer: 1000,
                            showConfirmButton: false
                            }).then(function() {
                            window.location.href = "?pages=customer-address";
                            });
                    </script>';
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
                <h4>Địa chỉ giao hàng</h4>
            </div>
            <form action="" method="post" enctype="multipart/form-data" class="main-profile-body">
                <div class="wrapper-content-profile-left">
                     <div class="form-group form-group-profile">
                        <input type="text" class="form-control form-control-profile" placeholder="" value="<?php echo $_SESSION['address'];?>" id="address" name="address"required>
                        <label for="text">Nhập địa chỉ</label>
                    </div> 
                    <div class="btn-save-profile">
                        <input type="submit" name="btn-save" id="btn-save-profile" value="Lưu">
                    </div>
                </div> 
            </form>
        </div>
    </div>
</div>