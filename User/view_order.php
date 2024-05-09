<?php
include 'components/connection.php'; 
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if(isset($_POST['logout'])){
    session_destroy();
    header('Location: login.php');
}

if (isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else {
    $get_id='';
    header('location:order.php');
} 

if (isset($_POST['cancled'])) {
    $update_order = $conn->prepare("UPDATE orders SET status = ? WHERE id =? ");
    $update_order->execute(['canceled', $get_id]);
    header('location:order.php');
}
?>
<!-- Used to embed css file into this file -->
<style type="text/css">
    <?php include 'style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Green Coffee - order details page</title>
    <style>
        .box-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .box {
            width: calc(33.33% - 20px); /* 33.33% để hiển thị tối đa 3 cột trên mỗi hàng */
            margin-bottom: 20px; /* Khoảng cách giữa các sản phẩm */
        }
        .product {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .col {
            text-align: center;
        }
        .billing-info {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .billing-info p {
            margin: 10px 0;
        }
        .billing-info .title {
        font-weight: bold;
        font-size: 24px; /* Điều chỉnh kích thước phông chữ tại đây */
        margin-bottom: 10px;
    }
        .billing-info .user i {
            margin-right: 5px;
        }
        <style>
    .billing-info .user {
        font-size: 18px; /* Điều chỉnh kích thước phông chữ tại đây */
    }
</style>

        .billing-info .status {
        font-weight: bold;
        font-size: 20px; /* Điều chỉnh kích thước phông chữ tại đây */
        margin-top: 10px;
    }
        .billing-info .btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            text-transform: uppercase;
            cursor: pointer;
            margin-top: 10px;
        }
        .billing-info .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php include 'components/header.php'; ?>
    <!--add header-->
    <div class="main">
        <div class="banner">
            <h1>My ORDERS</h1>
        </div>
        <div class="title2">
            <a href="home.php">Home</a><span> / Order details </span>
        </div>
        <section class="order-detail">
            <div class="title">
                <img src="img/download.png" class="logo">
                <h1>Order details</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus modi at sequi libero illum
                    ducimus, voluptatem officia necessitatibus sed cupiditate, cum fugit voluptates similique ea id
                    culpa accusamus amet provident.</p>
            </div>
            <div class="box-container">
                <?php
                $grand_total = 0;
                $select_orders = $conn->prepare("SELECT * FROM orders WHERE id = ?");
                $select_orders->execute([$get_id]);
                if ($select_orders->rowCount() > 0) {
                    $index = 0;
                    while ($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                        $select_product = $conn->prepare("SELECT * FROM product WHERE id = ?");
                        $select_product->execute([$fetch_order['product_id']]);
                        if ($select_product->rowCount() > 0) {
                            while ($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)) {
                                $sub_total = ($fetch_order['price'] * $fetch_order['qty']);
                                $grand_total += $sub_total;
                                ?>
                                <div class="box">
                                    <div class="col product">
                                        <p class="title"><i class="bi bi-calender-fill"></i> <?= $fetch_order['date']; ?></p>
                                        <img src="image/<?= $fetch_product['image']; ?>" class="image">
                                        <p class="price"> <?= $fetch_product['price']; ?> x <?= $fetch_order['qty']; ?></p>
                                        <h3 class="name"> <?= $fetch_product['name']; ?></h3>
                                        <p class="grand-total">Total amount payable : <span>$ <?= $grand_total; ?></span></p>
                                    </div>
                                </div>
                            <?php }
                            $index++;
                        } else {
                            echo '<p></p><p class="empty">No orders have been placed yet</p>';
                        }
                    }
                } else {
                    echo '<p></p><p class="empty">No orders found</p>';
                }
                ?>
            </div>
            <!-- Billing Information -->
            <div class="billing-info">
                <p class="title">Billing Address</p>
                <?php
                $select_orders = $conn->prepare("SELECT * FROM orders WHERE id = ?");
                $select_orders->execute([$get_id]);
                if ($select_orders->rowCount() > 0) {
                    $fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC);
                ?>
                <!-- Hiển thị thông tin hóa đơn -->
                <!-- Bạn có thể lặp lại dữ liệu từ database ở đây nếu cần -->
                <p class="user"><i class='bx bxs-user-check'></i><?= $fetch_order['name']; ?></p>
                <p class="user"><i class='bx bxs-phone'></i> <?= $fetch_order['number']; ?></p>
                <p class="user"><i class='bx bxs-envelope'></i> <?= $fetch_order['email']; ?></p>
                <p class="user"><i class='bx bxs-map'></i> <?= $fetch_order['address']; ?></p>
                <p class="title">Status</p>
                <p class="status" style="color :<?php if ($fetch_order['status'] == 'delevered') {
                    echo 'green';
                } elseif ($fetch_order['status'] == 'canceled') {
                    echo 'red';
                } elseif ($fetch_order['status'] == 'In process') {
                    echo 'orange';
                } ?>">
                    <?= $fetch_order['status'] ?>
                </p>
                <?php if ($fetch_order['status'] == 'canceled') { ?>
                    <a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="btn">Order Again</a>
                <?php } else { ?>
                    <form method="post">
                        <button type="submit" name="cancled" class="btn" onclick="return confirm('Do you want to cancel this order')">Cancel Order</button>
                    </form>
                <?php } ?>
                <?php } ?>
            </div>
            <!-- End Billing Information -->
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
