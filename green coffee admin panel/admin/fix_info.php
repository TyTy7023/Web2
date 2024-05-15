<?php 
include '../components/connection.php';
session_start();

// Lấy ID của người dùng hiện tại từ session
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}
$user_id = $_SESSION['user_id'];

// Lấy thông tin người dùng từ CSDL để hiển thị trong form sửa thông tin
$select_user = $conn->prepare("SELECT * FROM users WHERE id = ?");
$select_user->execute([$user_id]);
$user_info = $select_user->fetch(PDO::FETCH_ASSOC);

// Xử lý khi người dùng ấn nút "Save" để cập nhật thông tin
if(isset($_POST['save'])){
    // Lấy thông tin mới từ form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password =$_POST['pass'];
    $number = $_POST['number'];
    $address = $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['country'] . ', ' . $_POST['pincode'];
    $address_type = $_POST['address_type'];

    // Cập nhật thông tin người dùng trong CSDL
    $update_user = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ?, number = ?, address = ?, address_type = ? WHERE id = ?");
    if($update_user->execute([$name, $email, $password, $number, $address, $address_type, $user_id])){
        // Chuyển hướng về trang user_account.php sau khi cập nhật thành công
        header('Location: user_account.php');
        exit();
    } else {
        echo "Failed to update user information.";
    }
}

// Tách địa chỉ thành các phần riêng biệt
$address_parts = explode(", ", $user_info['address']);
$flat = $address_parts[0] ?? '';
$street = $address_parts[1] ?? '';
$city = $address_parts[2] ?? '';
$country = $address_parts[3] ?? '';
$pincode = $address_parts[4] ?? '';

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
            width: 33%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        select {
            height: 40px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <section class="form-container">
            <div class="title">
                <h1 style="color:var(--green);">Edit User Information</h1>
            </div>
            <form action="fix_info.php" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user_info['name']); ?>" required maxlength="50"> 
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_info['email']); ?>" required maxlength="50">
                </div>

                <div class="form-group">
                    <label for="pass">Password:</label>
                    <input type="password" id="pass" name="pass" required maxlength="50">
                </div>

                <div class="form-group">
                    <label for="number">Phone:</label>
                    <input type="text" id="number" name="number" value="<?php echo htmlspecialchars($user_info['number']); ?>" required maxlength="50">
                </div>

                <div class="form-group">
                    <label for="flat">Address line 01:</label>
                    <input type="text" id="flat" name="flat" value="<?php echo htmlspecialchars($flat); ?>" required maxlength="50">
                </div>

                <div class="form-group">
                    <label for="street">Address line 02:</label>
                    <input type="text" id="street" name="street" value="<?php echo htmlspecialchars($street); ?>" required maxlength="50">
                </div>

                <div class="form-group">
                    <label for="city">City name:</label>
                    <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($city); ?>" required maxlength="50">
                </div>

                <div class="form-group">
                    <label for="country">Country name:</label>
                    <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($country); ?>" required maxlength="50">
                </div>

                <div class="form-group">
                    <label for="pincode">Pincode:</label>
                    <input type="text" id="pincode" name="pincode" value="<?php echo htmlspecialchars($pincode); ?>" required maxlength="6">
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
        </section>
    </div>
</body>
</html>
