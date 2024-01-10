<?php 
$customerid = $_SESSION['customerid'];
$sql = "SELECT * FROM `order` WHERE customerid = '$customerid' ORDER BY orderid DESC ";
$result = mysqli_query($conn, $sql);

?>
<div class="row wrapper-sidebar-profile">
<?php include "sidebar-profile.php";?>
    <div class="col-sm-9 col-md-6 col-lg-8 ">
        <div class="wrapper-content-profile">
            <div class="content-profile-title">
                <h4> Đơn hàng của bạn </h4>
            </div>
            <div class="wrapper-table">          
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ngày đặt</th>
                            <th>Mã đơn hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Xem đơn hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i=0 ;
                        while($row = mysqli_fetch_array($result)){
                            $i++;
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>   
                            <td><?php echo date('d/m/Y',strtotime($row['orderdate'])); ?></td>
                            <td><a href="?pages=order-detail&orderid=<?php echo $row['orderid']?>"><?php echo $row['ordercode'] ?></a></td>
                            <td><?php echo number_format($row['total'],0,',','.').'đ' ?></td>
                            <td><?php
                                if($row['orderstatus']== 1)echo 'Đã xử lý';
                                elseif($row['orderstatus']== 2) echo 'Đã huỷ';
                                else echo 'Đang xử lý';
                             ?>
                            
                            </td>
                            <td><a href="?pages=order-detail&orderid=<?php echo $row['orderid']?>"><i class="fas fa-eye eye" ></i></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .row-ordered{
        text-transform: none;
    }
    .wrapper-content-profile{
        box-shadow: none;
    }
    .wrapper-table{
        width: 100%;
    }
    .table{
        width: 100%;
        text-align: center;
        box-shadow: 0 0 4px rgba(2, 41, 199);
    }
    .eye{
        color:  #f20362 ;
        font-size: 18px;
    }
</style>