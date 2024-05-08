<?php
    include 'components/connection.php';
    session_start();

    // Kiểm tra nếu người dùng đã đăng nhập
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        // Chuyển hướng người dùng đến trang home nếu đã đăng nhập
        header('Location: home.php');
        exit();
    }

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $pass = $_POST['pass'];
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        // Kiểm tra thông tin đăng nhập trong cơ sở dữ liệu
        $select_user = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $select_user->execute([$email, $pass]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        if ($select_user->rowCount() > 0) {
            // Kiểm tra trạng thái tài khoản
            if($row['status'] == 'blocked'){
                // Hiển thị thông báo khi tài khoản bị khóa
                $message = 'Your account has been blocked. Please contact the administrator.';
                echo "<script>alert('$message');</script>";
            } else {
                // Đăng nhập thành công
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];
                // Chuyển hướng người dùng đến trang home
                header('Location: home.php');
                exit(); // Đảm bảo không có mã PHP nào được thực thi sau khi chuyển hướng
            }
        } else {
            // Hiển thị thông báo lỗi khi đăng nhập không thành công
            $message = 'USER IS NOT REGISTERED OR PASSWORD IS INCORRECT.';
            echo "<script>alert('$message');</script>";
        }
    }
?>

<style type="text/css">
<?php include 'style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Tea - Login</title>
</head>
<body>
    <div class="main-container">
        <section class="form-container">
            <div class="title">
                <img src="img/download.png">
                <h1>LOGIN now</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto dolorum deserunt minus veniam tenetur</p>
            </div>
            <form action="" method="post">
                <div class="input-field">
                    <p>Your email <span>*</span></p>
                    <input type="email" name="email" required placeholder="Enter your email" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
                <div class="input-field">
                    <p>Your password <span>*</span></p>
                    <input type="password" name="pass" required placeholder="Enter your password" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
                <button type="submit" name="submit" value="login now" class="btn">Login now</button>
                <p>Don't have an account? <a href="register.php">Register now</a></p>
            </form>
        </section>
    </div>
    <?php include 'components/alert.php'; ?>
</body>
</html>
