<?php
include 'pages/banner.php'; 
if(isset($_POST['keyword'])){
    $keyword = $_POST['keyword'];
    $sql = "SELECT * FROM product  WHERE product.productname LIKE '%".$keyword."%' 
                     OR product.brand LIKE  '%".$keyword."%'";
    $result = mysqli_query($conn, $sql);
}
?>
<div class="categoryname">
    <div class="trai"><img src="img/trai.jpg" alt=""></div>
        <a href=""><?php echo $_POST['keyword']?></a>
    <div class="phai"><img src="img/phai.jpg" alt=""></div>
</div>
<section class="wrapper-item">
    <div class="row-item">
        <?php while($row = mysqli_fetch_array($result)) { ?>
            <form action="" method="post">
                <div class="box-item">
                    <div class="box-item-img">
                        <a href="?pages=product&proid=<?php echo $row['productid']?>">
                        <img src="img/products/<?php echo $row['image']?>" alt="abc">
                    </div>
                    <div class="box-item-info">
                        <a href="?pages=product&proid=<?php echo $row['productid']?>" class="item-name"><?php echo $row['productname'] ?></a>
                        <a href="?pages=product&proid=<?php echo $row['productid']?>"class="item-price">Giá cũ: <?php echo number_format($row['price'],0,',','.') .'đ'?></a>
                    </div>
                    <div class="boder-price hover-border-3 ">
                        <p class="item-price-sale"> <?php echo number_format($row['saleprice'],0,',','.')?></p>
                        <button class="codepro-btn codepro-btn-2 hover-slide-right" name ="btn-buy">
                            <span>Mua ngay</span>   
                        </button>
                    </div>
                        <a href="index.php?pages=product&proid=<?php echo $row['productid']?>" class="xemchitiet">Xem chi tiết</a>
                </div>
           </form>
        <?php } ?>
   </div>
</section>