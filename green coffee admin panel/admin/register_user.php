<?php 
    include '../components/connection.php';
    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    } else {
        $user_id='';
    }

    if(isset($_POST['submit'])){
        $id = unique_id();
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $email= filter_var($email, FILTER_SANITIZE_STRING);
        $pass = $_POST['pass'];
        $pass= filter_var($pass, FILTER_SANITIZE_STRING);
        $cpass = $_POST['cpass'];
        $cpass= filter_var($cpass, FILTER_SANITIZE_STRING);
        $number = $_POST['number'];
        $number= filter_var($number, FILTER_SANITIZE_STRING);
        $address = $_POST['flat'].', '.$_POST['street'];
        $address= filter_var($address, FILTER_SANITIZE_STRING);
        $city = $_POST['city'];
        $city= filter_var($city, FILTER_SANITIZE_STRING);
        $country = $_POST['country'];
        $country= filter_var($country, FILTER_SANITIZE_STRING);
        $pincode = $_POST['pincode'];
        $pincode= filter_var($pincode, FILTER_SANITIZE_STRING);
        $address_type = $_POST['address_type'];
        $address_type= filter_var($address_type, FILTER_SANITIZE_STRING);
        $address = $_POST['flat'].', '.$_POST['street'].', '.$_POST['city'].', '.$_POST['country'].', '. $_POST['pincode'];

        $select_user = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $select_user->execute([$email]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        if($select_user->rowCount() > 0){
            $message = 'EMAIL ALREADY EXISTS.';
            echo "<script>alert('$message');</script>";
        }
        else{
            if($pass != $cpass){
                $message = 'CONFIRM YOUR PASSWORD';
                echo "<script>alert('$message');</script>";
            }
            else{
                $insert_user = $conn->prepare("INSERT INTO `users` (id, name, email, password, number, address, address_type ) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $insert_user->execute([$id,$name,$email,$pass,$number,$address,$address_type]);

                // Chuyển hướng đến trang user_account.php
                header('Location: user_account.php');
                exit; // Kết thúc kịch bản sau khi chuyển hướng
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.9">
    <title>green tea - register now</title>
    <style type="text/css">
        <?php include 'admin_style.css'; ?>
    </style>
</head>
<body>
    <div class="main-container">
        <section class="form-container">
            <div class="title">
                <img src="../img/download.png">
                <h1>register now</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto dolorum deserunt minus
                    veniam tenetur</p>
            </div>
            <form action="" method="post">
                <div class="input-field">
                    <p>your name <span>*</span></p>
                    <input type="text" name="name" required placeholder="enter your name" maxlength="50">
                </div>
                <div class="input-field">
                    <p>your email <span>*</span></p>
                    <input type="email" name="email" required placeholder="enter your name.." maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
                <div class="input-field">
                    <p>Your number <span>*</span></p>
                    <input type="number" name="number" required maxlength="50" placeholder="Enter Your Number.." class="input">
                </div>
                <div class="input-field">
                    <p>your password <span>*</span></p>
                    <input type="password" name="pass" nequired placeholder="enter your password.." maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
                <div class="input-field">
                    <p>confirm your password <span>*</span></p>
                    <input type="password" name="cpass" nequired placeholder="enter your password again.." maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
                <div class="input-field">
                    <p>Address line 01<span>*</span></p>
                    <input type="text" name="flat" required maxlength="50" placeholder="e.g flat & building number.." class="input">
                </div>
                <div class="input-field">
                    <p>Address line 02<span>*</span></p>
                    <input type="text" name="street" required maxlength="50" placeholder="e.g street.." class="input">
                </div>
                <div class="input-field">
                    <p>City name<span>*</span></p>
                    <input type="text" name="city" required maxlength="50" placeholder="enter your city name.." class="input">
                </div>
                <div class="input-field">
                    <p>Country name<span>*</span></p>
                    <input type="text" name="country" required maxlength="50" placeholder="enter your city name.." class="input">
                </div>
                <div class="input-field">
                    <p>Pincode<span>*</span></p>
                    <input type="text" name="pincode" required maxlength="6" placeholder="your pin code.." min="0" max="999999" class="input">
                </div>
                <div class="input-field">
                    <p>Address type<span>*</span></p>
                    <select name="address_type" class="button">
                        <option value="home">home</option>
                        <option value="office">office</option>
                    </select>
                </div>
                <button type="submit" name="submit" value="register now" class="btn">register</button>

            </form>
        </section>
    </div>
    <script>

    </script>
    <?php include '../components/alert.php'; ?>
</body>
</html>