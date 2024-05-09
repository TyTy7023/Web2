<?php 
    include '../components/connection.php';
    session_start();

    // Lấy ID của người dùng hiện tại từ session
    $user_id = $_GET['user_id'];

    // Lấy thông tin người dùng từ CSDL để hiển thị trong form sửa thông tin
    $select_user = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $select_user->execute([$user_id]);
    $user_info = $select_user->fetch(PDO::FETCH_ASSOC);

    // Xử lý khi người dùng ấn nút "Save" để cập nhật thông tin
    if(isset($_POST['save'])){
        // Lấy thông tin mới từ form
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $number = $_POST['number'];
        $address = $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['country'] . ', ' . $_POST['pincode'];
        $address_type = $_POST['address_type'];

        // Cập nhật thông tin người dùng trong CSDL
        $update_user = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ?, number = ?, address = ?, address_type = ? WHERE id = ?");
        $update_user->execute([$name, $email, $password, $number, $address, $address_type, $user_id]);

        // Chuyển hướng về trang user_account.php sau khi cập nhật thành công
        header('Location: user_account.php');
        exit();
    }
    $address_user = $conn->prepare("SELECT * FROM users WHERE id = ?");
                    $address_user->execute([$user_id]);
                    $fetch_address = $address_user->fetch(PDO::FETCH_ASSOC);

                    $temp_address = $fetch_address['address'];
                    $info_address = explode(",", $temp_address);

                    $flat = $info_address[0];
                    $street = $info_address[1];
                    $city = $info_address[2];
                    $country = $info_address[3];
                    $pincode = $info_address[4];

                    $address_type = $fetch_address['address_type'];

                    $number = $fetch_address['number'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Information</title>
    <style type="text/css">
        <?php include 'admin_style.css'; ?>
    </style>
    <style>
        .container {
            width: 33%; /* Chiều rộng là 1/3 màn hình */
            margin: 0 auto; /* Canh giữa theo chiều ngang */
            padding: 20px; /* Khoảng cách lề bên trong form */
            border: 1px solid #ccc; /* Đường viền */
            border-radius: 5px; /* Bo góc */
        }

        .form-group {
            margin-bottom: 15px; /* Khoảng cách giữa các nhóm form */
        }

        label {
            display: block; /* Hiển thị label dưới dạng block để nằm trên mỗi input */
            margin-bottom: 5px; /* Khoảng cách giữa các label và input */
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        select {
            width: 100%; /* Chiều rộng của input là 100% */
            padding: 10px; /* Khoảng cách lề bên trong input */
            margin-top: 5px; /* Khoảng cách từ input lên trên */
            border-radius: 5px; /* Bo góc */
            border: 1px solid #ccc; /* Đường viền */
        }

        select {
            height: 40px; /* Chiều cao của select box */
        }

        button {
            padding: 10px 20px; /* Kích thước của nút */
            background-color: #4CAF50; /* Màu nền của nút */
            color: white; /* Màu chữ của nút */
            border: none; /* Bỏ viền */
            border-radius: 5px; /* Bo góc */
            cursor: pointer; /* Con trỏ chuột khi di chuyển vào nút */
        }

        button:hover {
            background-color: #45a049; /* Màu nền của nút khi hover */
        }
    </style>
</head>
<body>
    <div class="main-container">
        <section class="form-container">
            <div class="title">
                <h1 style="color:var(--green);">Edit User Information</h1>
            </div>
        <form action="fix_info.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $user_info['name']; ?>" required maxlength="50"> 
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $user_info['email']; ?>" required maxlength="50">
            </div>

            <div class="form-group">
                <label for="pass">Password:</label>
                <input type="password" id="pass" name="pass" required maxlength="50">
            </div>

            <div class="form-group">
                <label for="number">Phone:</label>
                <input type="text" id="number" name="number" value="<?php echo $user_info['number']; ?>" required maxlength="50">
            </div>

            <div class="form-group">
                <label for="flat">Address line 01:</label>
                <input type="text" id="flat" name="flat" value="<?php echo  $flat; ?>" required maxlength="50">
            </div>

            <div class="form-group">
                <label for="street">Address line 02:</label>
                <input type="text" id="street" name="street" value="<?php echo  $street; ?>" required maxlength="50">
            </div>

            <div class="form-group">
                <label for="city">City name:</label>
                <input type="text" id="city" name="city" value="<?php echo $city; ?>" required maxlength="50">
            </div>

            <div class="form-group">
                <label for="country">Country name:</label>
                <input type="text" id="country" name="country" value="<?php echo $country; ?>" required maxlength="50">
            </div>

            <div class="form-group">
                <label for="pincode">Pincode:</label>
                <input type="text" id="pincode" name="pincode" value="<?php echo $pincode; ?>" required maxlength="6" min="0" max="999999">
            </div>

            <div class="form-group">
                <label for="address_type">Address Type:</label>
                <select id="address_type" name="address_type" required>
                    <option value="home" <?php if($user_info['address_type'] == 'home') echo 'selected'; ?>>Home</option>
                    <option value="office" <?php if($user_info['address_type'] == 'office') echo 'selected'; ?>>Office</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" name="save" class="btn">Save</button>
            </div>
        </form>
    </div>
    </section>
</body>
</html>
