<?php 
$orderid = $_GET['orderid'];
$sql = "SELECT * FROM `orderdetail`,product WHERE orderdetail.productid = product.productid AND orderdetail.orderid = '$orderid' ";
$result = mysqli_query($conn, $sql);
?>
<div class="row wrapper-sidebar-profile">
<?php include "sidebar-profile.php";?>
    <div class="col-sm-9 col-md-6 col-lg-8 ">
        <div class="wrapper-content-profile">
            <div class="content-profile-title">
                <h4> Chi Tiết Đơn Hàng</h4>
            </div>
            <div class="wrapper-table">   
                <table class="table table-cart">
                    <tbody>
                        <?php 
                        $i=0;
                        $i++;
                        $total =0;
                        while($row = mysqli_fetch_array($result)){ 
                            $thanhtien =  $row['amount'] * $row['saleprice'];
                            $total +=  $thanhtien;
                            ?>
                            <tr>
                                <td class="table-cart-img">
                                    <img src="./img/products/<?php echo $row['image'] ?>" alt="abc" width="100px">
                                </td>
                                <td class="table-cart-item">
                                    <p> <?php echo $row['productname'] ?></p>
                                    <p> <?php echo number_format($row['saleprice'], 0, ',', '.').'đ'?></p>
                                    <div class="table-cart-amount">
                                        <input type="text" id="quantity" value="<?php echo $row['amount'] ?>" readonly>
                                    </div>
                                    <p class="line-total"><?php echo number_format($thanhtien, 0, ',', '.').'đ' ?></p>
                                </td>
                            </tr>
                        <?php }?>  
                    </tbody>
                    <tfoot>
                        <td colspan="2">Tổng tiền: <span><?php echo  number_format($total, 0, ',', '.').'đ' ?></span></td>
                    </tfoot>
                </table> 
               
            </div>
        </div>
    </div>
</div>

<style>
   
    tfoot td{
       text-align: right;
    }
    tfoot span{
       font-size: 22px;
       font-weight: bold;
       margin-left: 10px;
       color: red;


    }
    .row-ordered{
        text-transform: none;
    }
    .wrapper-content-profile{
        box-shadow: none;
    }
 
   
</style>