<?php
    include 'components/connection.php';
    session_start();    

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    } else {
        $user_id = '';
    }

    if(isset($_POST['logout'])){
        session_destroy();
        header('Location: login.php');
        exit;
    }
        
    // Lấy dữ liệu từ biểu mẫu tìm kiếm
    $category_search = isset($_GET['category_search']) ? $_GET['category_search'] : '';
    $min_price = isset($_GET['min_price']) ? $_GET['min_price'] : '';
    $max_price = isset($_GET['max_price']) ? $_GET['max_price'] : '';
    $query = isset($_GET['query']) ? $_GET['query'] : '';

    // Xử lý thêm sản phẩm vào yeu thich
    if(isset($_POST['add_to_wishlist'])){
        $id = unique_id();
        $product_id = $_POST['product_id'];

        $varify_wishlist = $conn->prepare("SELECT * FROM wishlist WHERE product_id = ? AND user_id = ?");
        $varify_wishlist->execute([$product_id, $user_id]);

        $cart_num = $conn->prepare("SELECT * FROM cart WHERE product_id = ? AND user_id = ?");
        $cart_num->execute([$product_id, $user_id]);

        if($varify_wishlist -> rowCount() > 0){
            $warning_msg[] = "Product already exist to wishlist";
        }else if ($cart_num -> rowCount() > 0){
            $warning_msg[] = "Product already exist to cart";
        }else {
            $select_price = $conn->prepare("SELECT * FROM `product` WHERE id = ? LIMIT 1");
            $select_price->execute([$product_id]);
            $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

            $insert_wishlist = $conn->prepare("INSERT INTO `wishlist` (id, user_id, product_id, price) VALUES (?, ?, ?, ?)");
            $insert_wishlist->execute([$id, $user_id, $product_id, $fetch_price['price']]);
            $success_msg[] = "Product added to wishlist";
        }
    }

     // Xử lý thêm sản phẩm vào giỏ hàng
     if(isset($_POST['add_to_cart'])){
        $id = unique_id();
        $product_id = $_POST['product_id'];

        $qty = $_POST['qty'];
        $qty= filter_var($qty, FILTER_SANITIZE_STRING);

        $varify_cart = $conn->prepare("SELECT * FROM cart WHERE product_id = ? AND user_id = ?");
        $varify_cart->execute([$product_id, $user_id]);

        $max_cart_items = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
        $max_cart_items->execute([$user_id]);

        if($varify_cart -> rowCount() > 0){
            $warning_msg[] = "Product already exist to cart";
        }else if ($max_cart_items-> rowCount() > 20){
            $warning_msg[] = "cart is full";
        }else {
            $select_price = $conn->prepare("SELECT * FROM `product` WHERE id = ? LIMIT 1");
            $select_price->execute([$product_id]);
            $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

            $insert_cart = $conn->prepare("INSERT INTO `cart` (id, user_id, product_id, price, qty) VALUES (?, ?, ?, ?, ?)");
            $insert_cart->execute([$id, $user_id, $product_id, $fetch_price['price'],$qty]);
            $success_msg[] = "Product added to cart";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Green Coffee - Shop Page</title>

    <style>

    </style>
</head>

<body>
    <?php include 'components/header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>Green Tea Shop</h1>
        </div>
        <div class="title2">
            <a href="home.php">Home </a><span>/ Our Shop
            </span><?php if (!empty($category_search)) echo '<span>/ ' . ucfirst($category_search) . '</span>';?>
            <div class="search-form">
                <form action="search.php" method="GET">
                    <select name="category_search">
                        <option value="">All</option>
                        <option value="coffee" <?php if($category_search == 'coffee') echo 'selected'; ?>>Coffee
                        </option>
                        <option value="tea" <?php if($category_search == 'tea') echo 'selected'; ?>>Tea</option>
                    </select>
                    <input type="number" name="min_price" placeholder="Min Price" value="<?php echo $min_price; ?>">
                    <input type="number" name="max_price" placeholder="Max Price" value="<?php echo $max_price; ?>">
                    <input type="text" name="query" placeholder="Search products..." value="<?php echo $query; ?>">
                    <button type="submit"><i class="bx bx-search"></i></button>
                </form>
            </div>
        </div>
        <section class="products">
            <h1 class="title">Search Results</h1>
            <div class="box-container">
                <?php
                $products_per_page = 6; // Số sản phẩm trên mỗi trang
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Xác định trang hiện tại
                $offset = ($current_page - 1) * $products_per_page; // Tính offset
                // Tạo câu truy vấn SQL dựa trên dữ liệu tìm kiếm
                $sql = "SELECT * FROM `product` WHERE 1=1 ";

                if (!empty($category_search)) {
                    $sql .= " AND category = '$category_search'";
                }
                if (!empty($min_price)) {
                    $sql .= " AND price >= $min_price";
                }
                if (!empty($max_price)) {
                    $sql .= " AND price <= $max_price";
                }
                if (!empty($query)) {
                    $sql .= " AND (name LIKE '%$query%')";
                }

                // Thực thi câu truy vấn
                $result = $conn->query($sql);

                // Bộ lọc để loại bỏ kết quả trùng lặp
                $unique_results = [];

                // Sử dụng hàm fetchAll để lấy toàn bộ dữ liệu kết quả
                $rows = $result->fetchAll(PDO::FETCH_ASSOC);

                // Sử dụng count để đếm tổng số lượng sản phẩm
                $total_count = count($rows);

                // Hiển thị kết quả tìm kiếm
                if ($total_count > 0) {
                    // Lấy phần dữ liệu cho trang hiện tại
                    $current_rows = array_slice($rows, $offset, $products_per_page);
                    foreach ($current_rows as $row) {
                        // Hiển thị thông tin sản phẩm
                ?>

                <form action="" method="post" class="box">
                    <img src="image/<?php echo $row['image']; ?>" class="img">
                    <div class="button">
                        <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                        <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                        <a href="view_page.php?pid=<?php echo $row['id']; ?>" class="bx bxs-show"></a>
                    </div>
                    <h3 class="name"><?php echo $row['name']; ?></h3>
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <div class="flex">
                        <p class="price">Price $<?php echo $row['price']; ?>/-</p>
                        <input type="number" name="qty" required min="1" value="1" max="99" class="qty">
                    </div>
                    <a href="checkout.php?get_id=<?php echo $row['id']; ?>" class="btn">Buy Now</a>
                </form>
                <?php 
                    }
                } else {
                    echo "<h3>No products found.</h3>";
                }
                ?>
            </div>
        </section>
        <div class="pagination">
            <?php
                // Tính tổng số trang
                $total_pages = ceil($total_count / $products_per_page);

                // Hiển thị liên kết phân trang
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<a href='?page=$i&category_search=$category_search&min_price=$min_price&max_price=$max_price&query=$query'>$i</a> ";
                }
            ?>
        </div>
        <?php include 'components/footer.php'; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>

</html>