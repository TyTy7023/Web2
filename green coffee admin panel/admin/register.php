<?php 
    include '../components/connection.php';

    if(isset($_POST['register'])){

        $id = unique_id();
        
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $pass = sha1($_POST['password']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $cpass = sha1($_POST['cpassword']);
        $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
        
        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../image' .$image;
       
        // $email = 'htphuc884@gmail.com';
        // $email = 'khoa884@gmail.com';
        $select_admin = $conn->prepare("SELECT * FROM admin WHERE email = ?");
        $select_admin->execute([$email]);

        if($select_admin->rowCount() > 0){
            $warning_msg[] = 'user email already exit';
        }else{
            if($pass != $cpass){
                $warning_msg[] = 'confirm password not matched';
            }else{
                $insert_admin = $conn->prepare("INSERT INTO admin(id, name, email, password, profile) VALUES(?,?,?,?,?)");
                $insert_admin->execute([$id, $name, $email, $cpass, $image]);
                move_uploaded_file($image_tmp_name, $image_folder);
                $success_msg[] = 'new admin register';
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
    <title>green coffee admin panel - register page</title>
</head>

<body>

<div class="main-container">
        <section class="form-container">
        <div class="title">
                <img src="../img/download.png">
                <h1>register now</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto dolorum deserunt minus
                    veniam
                    tenetur
                </p>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="input-field">
                    <p>your name <span>*</span></p>
                    <input type="text" name="name" required placeholder="enter your name" maxlength="50">
                </div>
                <div class="input-field">
                    <p>your email <span>*</span></p>
                    <input type="email" name="email" required placeholder="enter your name.." maxlength="50"
                        oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
                <div class="input-field">
                    <p>Your number <span>*</span></p>
                    <input type="number" name="number" required maxlength="50" placeholder="Enter Your Number.."
                        class="input">
                </div>
                <div class="input-field">
                    <p>your password <span>*</span></p>
                    <input type="password" name="pass" nequired placeholder="enter your password.." maxlength="50"
                        oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
                <div class="input-field">
                    <p>confirm your password <span>*</span></p>
                    <input type="password" name="cpass" nequired placeholder="enter your password again.." maxlength="50"
                        oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
                <div class="input-field">
                    <p>Address line 01<span>*</span></p>
                    <input type="text" name="flat" required maxlength="50" placeholder="e.g flat & building number.."
                        class="input">
                </div>
                <div class="input-field">
                    <p>Address line 02<span>*</span></p>
                    <input type="text" name="street" required maxlength="50" placeholder="e.g street.." class="input">
                </div>
                <div class="input-field">
                    <p>City name<span>*</span></p>
                    <input type="text" name="city" required maxlength="50" placeholder="enter your city name.."
                        class="input">
                </div>
                <div class="input-field">
                    <p>Country name<span>*</span></p>
                    <input type="text" name="country" required maxlength="50" placeholder="enter your city name.."
                        class="input">
                </div>
                <div class="input-field">
                    <p>Pincode<span>*</span></p>
                    <input type="text" name="pincode" required maxlength="6" placeholder="your pun code.." min="0" max="999999"
                        class="input">
                </div>
                <div class="input-field">
                    <p>Address type<span>*</span></p>
                    <select name="address_type" class="button">
                        <option value="home">home</option>
                        <option value="office">office</option>
                    </select>
                </div>
                <button type="submit" name="submit" value="register now" class="btn">register</button>
                <p>already have an account? <a href="login.php">login now</a></p>
            </form>
        </section>
    </div>
        </section>
    </div>

    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js link -->
    <script type="text/javascript" src="script.js"></script>

    <!-- alert -->
    <?php include '../components/alert.php'; ?>
</body>

</html>