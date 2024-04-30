<?php
 include 'components/connection.php'; 
    session_start();
    if (isset($_SESSION['user_id'])) 
        $user_id = $_SESSION['user_id'];
    else $user_id = '';
    if(isset($_POST['logout'])){
        session_destroy();
        header('Location: login.php');
    }

?>
<!-- Used to embed css file into this file -->
<style type="text/css">
<?php include 'style.css';
?>
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Green Coffee - orders page</title>
</head>

<body>
    <?php include 'components/header.php'; ?>
    <!--add header-->
    <div class="main">
        <div class="banner">
            <h1>My ORDERS</h1>
        </div>
        <div class="title2">
            <a href="home.php">Home</a><span> / Orders </span>
        </div>
        <section class="orders">
        <div class="title">
                <img src="img/download.png" class="logo">
                <h1>My Order</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus modi at sequi libero illum
                    ducimus, voluptatem officia necessitatibus sed cupiditate, cum fugit voluptates similique ea id
                    culpa accusamus amet provident.</p>
            </div>
            <div class="box-container">
                <?php
                    $last_order_id = null; // Biến lưu trữ ID đặt hàng cuối cùng
                    $select_orders = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY date DESC");
                    $select_orders->execute([$user_id]);
                    if ($select_orders->rowCount()>0) {
                        while($fetch_order =$select_orders->fetch(PDO :: FETCH_ASSOC)){
                                $order_id = $fetch_order['id']; // ID đặt hàng hiện tại
                                $select_products = $conn->prepare("SELECT * FROM product WHERE id =? ");
                                $select_products->execute([$fetch_order['product_id']]);
                                if ($order_id != $last_order_id) { // Kiểm tra nếu ngày đặt hàng khác với ngày đặt hàng trước đó
                                    if ($last_order_id !== null) {
                                        echo '</div>'; // Đóng nhóm trước (nếu có)
                                    }// Tạo một nhóm mới
                                    echo '<div class="order-group">';
                                    echo '<h3 class="order-id">Order date: ' . $fetch_order['date'] . '</h3>';
                                    $last_order_id = $order_id; // Cập nhật ID đặt hàng cuối cùng
                                }
                                if ($select_products->rowCount()>0) {
                                    while($fetch_product=$select_products->fetch(PDO :: FETCH_ASSOC)){            
                    ?>
                <div class="box" <?php if($fetch_order['status']=='cancle' ){echo 'style="border:2px solid red";' ;} ?>>
                    <a href="view_order.php?get_id=<?= $fetch_order['id']; ?>">
                        
                        <img src="image/<?= $fetch_product['image']; ?>" class="image">
                        <div class="row">
                            <h3 class="name"><?= $fetch_product['name']; ?></h3>
                            <p class="price">Price: $<?= $fetch_order['price'] * $fetch_order['qty']; ?></p>
                            <p class="status" style="color: <?php if($fetch_order['status'] == 'delivered') { echo 'green'; } elseif($fetch_order['status'] == 'canceled') { echo 'red'; } else { echo 'orange'; } ?>">
                                <?= ucfirst($fetch_order['status']); ?>
                            </p>
                        </div>
                    </a>

                </div>
                <?php
                                }
                            }   
                        }
                        
                    }else{
                        echo '<p></p><p class="empty">No orders have place yet</p>';
                    }
                ?>
            </div>
        </section>
        <?php include 'components/footer.php';?>
        <!--add footer-->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php';?>
    <!--add alert-->
</body>

</html>