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
        $verify_delete->execute(['$order_id']);

        if($verify_delete->rowCount() > 0)
        {
            $delete_order= $conn->prepare("DELETE FROM orders WHERE id = ?");
            $delete_order->execute(['$order_id']);
            $success_msg[] = 'order deleted';
        }
        else{
            $warning_msg[] = 'order already deleted';
        }
        //update order

        if(isset($_POST['update_order'])){

            $order_id = $_POST['order_id'];
            $order_id = filter_var($order_id, FILTER_SANITIZE_STRING);

            $update_payment = $_POST['update_payment'];
            $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);
    

            $update_pay = $conn->prepare("UPDATE orders SET payment_status = ? WHERE id = ?");
            
            $update_pay ->execute(['$update_payment ,$order_id']);

            $success_msg[] = 'order updated';


        }
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
            <div class="title2">
                <a href="dashboard.php">dashboard</a><span> / order place</span>
            </div>
                <section class="order-container">
                    <h1 class="heading">order place</h1>
                    <div class="box-container">
                    <?php
                    
                    $last_order_id = null; // Biến lưu trữ ID đặt hàng cuối cùng
                    $select_orders = $conn->prepare("SELECT * FROM orders");
                    $select_products = $conn->prepare("SELECT * FROM product");
                    $select_products->execute();
                    $select_orders->execute();
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
                                    echo '<h3 class="order-id">Order date: ' . $fetch_order['date'] . ' -  Order id: <i>' .$fetch_order['id'] .'</i></h3>';
                                    $last_order_id = $order_id; // Cập nhật ID đặt hàng cuối cùng
                                }
                                if ($select_products->rowCount()>0) {
                                    while($fetch_product=$select_products->fetch(PDO :: FETCH_ASSOC)){ 
                                         
                                        $select_products = $conn->prepare("SELECT * FROM product");
                                        $select_products-> execute();
            
                                        if($select_products-> rowCount() > 0){
                                            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC))
                                            {
                    ?>
                        
                        <div class="box">
                            <div class="status" style="color: <?php if($fetch_order['status'] == 'in progress')
                            {echo "green";}else{echo "red";} ?>"><?=$fetch_order['status']; ?></div>
                                <div class="detail">
                                    <p>user name : <span><?= $fetch_order['name']; ?></span> </p>
                                    <p>user id : <span><?= $fetch_order['id']; ?></span> </p>
                                    <p>placed on : <span><?= $fetch_order['date']; ?></span> </p>
                                    <p>user number : <span><?= $fetch_order['number']; ?></span> </p>
                                    <p>user email : <span><?= $fetch_order['email']; ?></span> </p>
                                    <p>name product : <span><?= $fetch_products['name']; ?></span> </p>
                                    <p>user email : <span><?= $fetch_order['email']; ?></span> </p>
                                    <p>total price: <span><?= $fetch_order['price']; ?></span> </p>
                                    <p>method : <span><?= $fetch_order['method']; ?></span> </p>
                                    <p>address : <span><?= $fetch_order['address']; ?></span> </p>
                                </div>
                                <form action="" method="post">
                                    <input type="hidden" name="order_id" value="<?= $fetch_order['id']; ?>">
                                    <select name="update_payment">
                                        <option disabled selected><?= $fetch_order['payment_status']; ?></option>
                                        <option value="pending">delivered</option>
                                        <option value="complete">cancled</option>
                                        <option value="complete">in progress</option>
                                    </select>
                                    <div class="flex-btn">
                                        <button type="submit" name="update_order" class="btn">update payment</button>
                                        <button type="submit" name="delete_order" class="btn">delete order</button>

                                    </div>

                                </form>
                        </div>
                        <?php
                                }
                            }   
                        }
                                }}
                    }else{
                        echo '<p></p><p class="empty">No orders have place yet</p>';
                    }
                ?>
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