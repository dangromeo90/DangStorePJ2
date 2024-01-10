<?php 
if(isset($_POST['btn-save'])){
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $avatar = isset($_FILES['avatar']['name']) ? $_FILES['avatar']['name'] : 'customer.jpg'; 
    $avatar_tmp = isset($_FILES['avatar']['tmp_name']) ? $_FILES['avatar']['tmp_name'] : '';
    $avatar_path = '';
   if($avatar){
    upload_avatar();
    $avatar_path = basename($avatar);
   }
    $sql = "UPDATE `customer` SET `lastname`=' $lastname',`firstname`='$firstname',`avatar`='$avatar'
            WHERE email = '".$_SESSION['email']."' ";
    $result = mysqli_query($conn,$sql);
    if($result){
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['avatar'] = $avatar;
        echo '<script>
                    Swal.fire({
                        title: "Cập nhật thành công",
                        icon: "success",
                        timer: 2000,
                    }).then(function(){
                        window.location.href="index.php?pages=profile"
                    })
                </script>';
    }
    else{
        echo '<script>
                    Swal.fire({
                        title: "Cập nhật thất bại",
                        icon: "error",
                        timer: 3000,
                    }).then(function(){
                        window.location.href="index.php?pages=profile"
                    })
             </script>' . mysqli_close($conn);
    }
}
?>
<?php 
    function upload_avatar(){
       $folder = "img/avatar/";
       $file_name = $folder . basename($_FILES['avatar']['name']);
       $file_format = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
       $ok= 1 ;
       if(file_exists($file_name)){
        $ok = 0;
       }
       if($_FILES['avatar']['size'] > (5*1024*1024)){
        $ok = 0;
       }
       if($file_format != "jpg" &&$file_format != "png" && $file_format != "webp" && $file_format != "gif"){
        $ok = 0;
       }
       if($ok){
        move_uploaded_file($_FILES['avatar']['tmp_name'], $file_name);
       } 
        return $ok;
}
?>
<div class="row wrapper-sidebar-profile">
   <?php 
   include "myprofile/sidebar-profile.php";
   ?>
    <div class="col-sm-9 col-md-6 col-lg-8">
        <div class="wrapper-content-profile">
            <div class="content-profile-title">
                <h4> Hồ sơ của tôi</h4>
            </div>
            <form action="" method="post" enctype="multipart/form-data" class="main-profile-body">
                <div class="wrapper-content-profile-left">
                    <div class="form-group form-group-profile">
                        <input type="text" class="form-control form-control-profile" placeholder="" value="<?php echo $_SESSION['lastname'];?>" id="lastname" name="lastname"required>
                        <label for="text">Họ</label>
                    </div>
                    <div class="form-group form-group-profile">
                        <input type="text" class="form-control form-control-profile" placeholder="" value="<?php echo $_SESSION['firstname'];?>" id="firstname" name="firstname"required>
                        <label for="text">Tên</label>
                    </div>
                    <div class="form-group form-group-profile">
                        <input type="email" class="form-control form-control-profile" placeholder="" value="<?php echo $_SESSION['email'];?>" id="email" name="email" onblur="addtxtEmail()" readonly required>
                        <label for="email">Email</label>
                    </div>
                    <div class="form-group form-group-profile">
                        <input type="text" class="form-control form-control-profile" placeholder="" value="<?php echo $_SESSION['phone'];?>" id="phone" name="phone"readonly required>
                        <label for="text">Số điện thoại</label>
                    </div>
                    <div class="btn-save-profile">
                        <input type="submit" name="btn-save" id="btn-save-profile" value="Lưu">
                    </div>
                    </div> 
                <div class="wrapper-content-profile-right">
                    <div class="wrapper-avatar-change" id="preview">
                        <img src="img/avatar/<?php echo $_SESSION['avatar'] ?>" alt="" width="150px"id="avatarImage">
                    </div>
                    <div class="wrapper-img-change">
                        <input type="file" name="avatar" id="avatarInput" accept="image/*" onchange="previewImage()">
                        <label for="avatarInput">Chọn ảnh</label>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function previewImage() {
        var input = document.getElementById('avatarInput');
        var preview = document.getElementById('avatarImage');
        if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        preview.src = e.target.result;
        }
         reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<style>
    .main-profile-body{
        margin-top: -40px;
    }
    .form-group-profile{
       margin-top: 40px;
    }
</style>