<?php 
include '../components/connection.php';
include '../components/alert.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location: login.php');
}

// Khởi tạo câu truy vấn dựa trên loại sản phẩm được chọn
$status = isset($_GET['status']) ? $_GET['status'] : '';
if (!empty($status)) {
    $select_products = $conn->prepare("SELECT * FROM `product` WHERE status = ?");
    $select_products->execute([$status]);
} else {
    // Nếu không có loại sản phẩm được chọn, truy vấn tất cả sản phẩm
    $select_products = $conn->prepare("SELECT * FROM `product`");
    $select_products->execute();
}

//delete product
function is_product_in_orders($conn, $product_id) {
    $orders = $conn->prepare("SELECT * FROM orders WHERE product_id = ?");
    $orders->execute([$product_id]);
    return $orders->rowCount() > 0;
}

if (isset($_POST['delete'])) {
    $p_id = $_POST['product_id'];
    $p_id = filter_var($p_id, FILTER_SANITIZE_STRING);
    
    // Kiểm tra xem sản phẩm có trong đơn hàng không
    if (is_product_in_orders($conn, $p_id)) {
        // Product is in user orders, set warning message
        $warning_msg = "Không thể xóa sản phẩm vì nó đang tồn tại trong đơn hàng của người dùng.";
        // Redirect back to the page with the warning message
        header("Location: view_product.php?warning_msg=" . urlencode($warning_msg));
        exit();
    } else {
        // Product is not in user orders, proceed with deletion
        // Your deletion code here
        // Example: $delete_product_query = $conn->prepare("DELETE FROM products WHERE product_id = ?");
        // Then execute the query and handle success or failure
        $delete_product_query = $conn->prepare("DELETE FROM product WHERE id = ?");
        if ($delete_product_query->execute([$p_id])) {
            // Xóa sản phẩm thành công, thực hiện các hành động khác (nếu cần)
            // Ví dụ: Đặt thông báo thành công và chuyển hướng người dùng
            $_SESSION['success_msg'] = "Sản phẩm đã được xóa thành công.";
            header('location:view_product.php');
            exit();
        }
        else {
            // Xóa sản phẩm thất bại, đặt thông báo cảnh báo và chuyển hướng người dùng
            $warning_msg = "Không thể xóa sản phẩm.";
            header('location:view_product.php?warning_msg=' . urlencode($warning_msg));
            exit();
        }
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
    <title>green coffee admin panel - all products page</title>
</head>
<body>
<?php include '../components/admin_header.php';?>
<div class="main">
    <div class="banner">
        <h1>all products</h1>
    </div>
    <div class="title2">
        <a href="dashboard.php">dashboard</a></span><?php if (!empty($status)) echo '<span> / ' . ucfirst($status) . '</span>'; else echo "/ALL product"?>
    </div>
    <section class="show-post">
        <div class="box-container">
            <?php
            if ($status === 'all') {
                // Nếu người dùng chọn "all", truy vấn tất cả sản phẩm
                $select_products = $conn->prepare("SELECT * FROM `product`");
                $select_products->execute();
            } else if (!empty($status)) {
                // Nếu có một status được chọn, truy vấn sản phẩm trong status đó
                $select_products = $conn->prepare("SELECT * FROM `product` WHERE status = ?");
                $select_products->execute([$status]);
            } else {
                // Nếu không có status được chọn, truy vấn tất cả sản phẩm
                $select_products = $conn->prepare("SELECT * FROM `product`");
                $select_products->execute();
            }

            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                <?php if ($fetch_products['image'] != '') { ?>
                    <img src="../image/<?= $fetch_products['image']; ?>" class="image">
                <?php } ?>
                <div class="status" style="color: <?php if ($fetch_products['status'] == 'active') {echo "green";} else {echo "red";} ?>;"><?= $fetch_products['status']; ?></div>
                <div class="price">$<?= $fetch_products['price']; ?> </div>
                <div class="title"><?= $fetch_products['name']; ?> </div>
                <div class="flex-btn">
                    <a href="edit_product.php?id=<?= $fetch_products['id']; ?>" class="btn">edit</a>
                    <button type="submit" name="delete" class="btn" onclick="return confirm('delete this product');">delete</button>
                    <a href="read_product.php?post_id=<?= $fetch_products['id']; ?>" class="btn">view</a>
                </div>
            </form>
            <?php
                }
            } else {
                echo '</div>
                <div class="empty"><p>no product added yet!</p></div>
                <div class="container">
                <a href="add_products.php" class="btn">add product</a>
                </div>
                ';
            }
            ?>
        </div>
    </section>
</div>

<!-- SweetAlert CDN Link -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- JavaScript to show alert message -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (isset($_SESSION['success_msg'])): ?>
            Swal.fire({
                icon: 'success',
                title: 'Thành công',
                text: '<?php echo htmlspecialchars($_SESSION['success_msg']); ?>'
            }).then(function() {
                <?php unset($_SESSION['success_msg']); ?> // Xóa thông báo thành công từ Session
            });
        <?php endif; ?>
    });
    <?php if (isset($_GET['warning_msg'])): ?>
        Swal.fire({
            icon: 'warning',
            title: 'Thông báo',
            text: '<?php echo htmlspecialchars($_GET['warning_msg']); ?>'
        });
    <?php endif; ?>

</script>
