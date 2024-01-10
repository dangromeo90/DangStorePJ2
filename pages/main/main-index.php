<?php
include 'pages/banner.php'; 
$sql = "SELECT * from product " ;

 // $sql = "SELECT * FROM product , productcategory WHERE product.CATEGORYID = productcategory.CATEGORYID AND  product.categoryid = '$_GET[proid]'";
   $result = mysqli_query($conn, $sql);
?>
<div class="categoryname">
    <div class="trai"><img src="img/trai.jpg" alt=""></div>
        <a href="">SẢN PHẨM NỔI BẬT</a>
    <div class="phai"><img src="img/phai.jpg" alt=""></div>
</div>
<section class="wrapper-item">
    <div class="row-item">
        <?php while($row = mysqli_fetch_array($result)) { ?>
            <form action="pages/main/addtoCart.php?proid=<?php echo $row['productid']?>" method="post">
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
                        <button class="codepro-btn codepro-btn-2 hover-slide-right" name ="addtoCart">
                            <span>Mua ngay</span>   
                        </button>
                    </div>
                        <a href="index.php?pages=product&proid=<?php echo $row['productid']?>" class="xemchitiet">Xem chi tiết</a>
                </div>
           </form>
        <?php } ?>
   </div>
</section>