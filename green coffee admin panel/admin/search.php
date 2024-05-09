<?php 
    include '../components/connection.php';

    session_start();
    
    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location: login.php');
    }
    //delete order
    if(isset($_POST['delete_order'])){

        $order_id = $_POST['order_id'];
        $order_id = filter_var($order_id, FILTER_SANITIZE_STRING);

        $verify_delete = $conn->prepare("SELECT * FROM orders WHERE id = ?");
        $verify_delete->execute([$order_id]);

        if($verify_delete->rowCount() > 0)
        {
            $delete_order= $conn->prepare("DELETE FROM orders WHERE id = ?");
            $delete_order->execute([$order_id]);
            $success_msg[] = 'order deleted';
        }
        else{
            $warning_msg[] = 'order already deleted';
        }
    }

    //update order
    if(isset($_POST['update_order'])){
        $order_id = $_POST['order_id'];
        $order_id = filter_var($order_id, FILTER_SANITIZE_STRING);

        $update_payment = $_POST['update_payment'];
        $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);

        $update_pay = $conn->prepare("UPDATE orders SET payment_status = ? WHERE id = ?");
        $update_pay->execute([$update_payment, $order_id]);

        $success_msg[] = 'order updated';
    }


    //search order
    $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
    $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';

    $where_clause = "";
    $params = [];

    if (!empty($from_date) && !empty($to_date)) {
        $where_clause = " WHERE date BETWEEN ? AND ?";
        $params = [$from_date, $to_date];
    }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="admin_style.css?v=<?php echo time(); ?>">
    <title>green coffee admin panel - order place page</title>
</head>
<body>
    <?php include'../components/admin_header.php';?>
    <div class="main">
        <div class="banner">
            <h1>order place</h1>
        </div>
        <div class="search-order-box">
            <a href="order.php">Order place</a><span> / Manager </span>
            <div class="search-form">
                <form action="search.php" method="GET">
                    <p>From Date: </p><input type="date" name="from_date" placeholder="From Date">
                    <p>To Date: </p><input type="date" name="to_date" placeholder="To Date">
                    <button type="submit"><i class="bx bx-search"></i></button>
                </form>
            </div>
        </div>
        <section class="order-container">
            <h1 class="heading">search results</h1>
            <div class="box-container">
            <?php
                $select_orders = $conn->prepare("SELECT * FROM orders" . $where_clause);
                $select_orders->execute($params);
                if ($select_orders->rowCount() > 0) {
                    $orders = $select_orders->fetchAll(PDO::FETCH_ASSOC);
                    foreach($orders as $fetch_order){
                        $order_id = $fetch_order['id']; // Current order ID
                        $select_products = $conn->prepare("SELECT * FROM product WHERE id = ?");
                        $select_products->execute([$fetch_order['product_id']]);
                        if ($select_products->rowCount() > 0) {
                            $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);
            ?>
                <div class="box">
                    <div class="status" style="color: <?php echo ($fetch_order['status'] == 'in progress') ? 'green' : 'red'; ?>"><?php echo $fetch_order['status']; ?></div>
                    <div class="detail">
                        <p>user name : <span><?php echo $fetch_order['name']; ?></span></p>
                        <p>user id : <span><?php echo $fetch_order['id']; ?></span></p>
                        <p>placed on : <span><?php echo $fetch_order['date']; ?></span></p>
                        <p>user number : <span><?php echo $fetch_order['number']; ?></span></p>
                        <p>user email : <span><?php echo $fetch_order['email']; ?></span></p>
                        <p>name product : <span><?php echo $fetch_product['name']; ?></span></p>
                        <p>total price: <span><?php echo $fetch_order['price']; ?></span></p>
                        <p>method : <span><?php echo $fetch_order['method']; ?></span></p>
                        <p>address : <span><?php echo $fetch_order['address']; ?></span></p>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="order_id" value="<?php echo $fetch_order['id']; ?>">
                        <select name="update_payment">
                            <option disabled selected><?php echo $fetch_order['payment_status']; ?></option>
                            <option value="pending">pending</option>
                            <option value="in progress">procesed</option>
                        </select>
                        <div class="flex-btn">
                            <button type="submit" name="update_order" class="btn">mark order</button>
                            <button type="submit" name="delete_order" class="btn">delete order</button>
                        </div>
                    </form>
                </div>
            <?php
                        }
                    }
                } else {
                    echo '<p></p><p class="empty">No orders have been placed yet</p';
                }
            ?>
            </div>
        </section>
    </div>

    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js link -->
    <script type="text/javascript" src="./script.js"></script>

    <!-- alert -->
    <?php include '../components/alert.php'; ?>
</body>
</html>
