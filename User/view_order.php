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

    if (isset($_GET['get_id'])) {
        $get_id = $_GET['get_id'];
    }else{
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
<?php include 'style.css';
?>
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Green Coffee - order details page</title>
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
                    <div class="col">
                        <p class="title"><i class='bx bx-calendar'></i><?= $fetch_order['date']; ?></p>
                        <img src="image/<?= $fetch_product['image']; ?>" class="image">
                        <p class="price"> <?= $fetch_product['price']; ?> x <?= $fetch_order['qty']; ?></p>
                        <h3 class="name"> <?= $fetch_product['name']; ?></h3>
                        <p class="grand-total">Total amount payable : <span>$ <?= $grand_total; ?></span></p>
                        <?php if ($index == $select_orders->rowCount() - 1) { ?>
                     </div>
                </div>
                <div class="box">
                <div class="col">

                            <!-- Kiểm tra nếu là sản phẩm cuối cùng thì hiển thị thông tin -->
                            <p class="title">billing address</p>
                            <p class="user"><i class='bx bxs-user-check'></i><?= $fetch_order['name']; ?></p>
                            <p class="user"><i class='bx bxs-phone'></i> <?= $fetch_order['number']; ?></p>
                            <p class="user"><i class='bx bxs-envelope'></i> <?= $fetch_order['email']; ?></p>
                            <p class="user"><i class='bx bxs-map'></i> <?= $fetch_order['address']; ?></P>

                            <p class="title">status</p>
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
                                <!-- <a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="btn">order again</a> -->
                            <?php } else { ?>
                                <form method="post">
                                    <button type="submit" name="cancled" class="btn" , onclick="return confirm('do you want to cancel this order')">cancel order</button>
                                </form>
                            </div>
                            </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
<?php
            }
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