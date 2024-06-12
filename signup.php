<?php
include 'include/navbar.php';
include 'include/dbconnect.php';

$usernameErr = $emailErr = $passwordErr = $rePasswordErr = $phoneErr = $dobErr = "";
$username = $email = $password = $re_password = $phone = $dob = "";
function generateAndSaveVoucher($voucherName, $discount, $validDate, $owner) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $voucherCode = '';
    $length = 8;
    $max = strlen($characters) - 1;

    for ($i = 0; $i < $length; $i++) {
        $voucherCode .= $characters[mt_rand(0, $max)];
    }

    global $conn;

    $insert_query = "INSERT INTO voucher (voucher_id,voucher_name, discount, valid_date, owner) VALUES (?,?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("ssiss",$voucherCode, $voucherName, $discount, $validDate, $owner);

    if ($stmt->execute()) {
        return $voucherCode;
    } else {
        echo "Error saving voucher: " . $conn->error;
        return null;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $re_password = $_POST['re-entry'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];

    $check_client_query = "SELECT * FROM client WHERE client_name=?";
    $stmt = $conn->prepare($check_client_query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result_client = $stmt->get_result();

    $check_admin_query = "SELECT * FROM administrator WHERE admin_name=?";
    $stmt = $conn->prepare($check_admin_query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result_admin = $stmt->get_result();

    if (empty(trim($username))) {
        $usernameErr = "Please enter username.";
    } else {
        if (!preg_match("/^[a-zA-Z0-9 ]*$/", $username)) {
            $usernameErr = "Special character is not allowed!";
        }
    }

    if (empty(trim($email))) {
        $emailErr = "Please enter email address.";
    } else {
        $email = trim($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format.";
        }
    }

    if (empty(trim($password))) {
        $passwordErr = "Please enter a password.";
    } else {
        $password = trim($password);
        if (strlen($password) < 8) {
            $passwordErr = "Passwords must be at least 8 characters long.";
        } else if (preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[^\w\s])\S*$/", $password)) {
            $passwordErr = "Passwords must contain at least 1 number, 1 uppercase letter, and 1 lowercase letter.";
        }
    }

    if (empty(trim($re_password))) {
        $rePasswordErr = "Please confirm password.";
    } else {
        $confirmPassword = trim($re_password);
        if ($password != $re_password) {
            $rePasswordErr = "Passwords do not match.";
        }
    }

    if (empty(trim($phone))) {
        $phoneErr = "Please enter phone number.";
    } else {
        $phone = trim($phone);
        if (strlen($phone) < 10) {
            $phoneErr = "Phone number must be at least 10 digits long (excluding -).";
        } else if (preg_match("/^01[0-9][-]?([0-9]{8})$/", $phone)) {
            $phoneErr = "Phone number should contain only numbers and the special character (-).";
        }
    }

    if (empty(trim($dob))) {
        $dobErr = "Please enter date of birth.";
    } else {
        $dob = trim($dob);
        $date = DateTime::createFromFormat('Y-m-d', $dob);
        
        if (!$date || $date->format('Y-m-d') !== $dob) {
            $dobErr = "Please enter a valid date of birth in the format YYYY-MM-DD.";
        } else {
            $dobYear = $date->format('Y');
            $currentYear = date('Y');
            $age = $currentYear - $dobYear;
            if ($age > 100) {
                $dobErr = "Your date of birth cannot be more than 100 years ago.";
            }
        }
    }

    if (empty($usernameErr) && empty($emailErr) && empty($passwordErr) && empty($rePasswordErr)&& empty($phoneErr)&& empty($dobErr)) {
        $check_client_query = "SELECT * FROM client WHERE client_name=?";
        $stmt = $conn->prepare($check_client_query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result_client = $stmt->get_result();
        $check_admin_query = "SELECT * FROM administrator WHERE admin_name=?";
        $stmt = $conn->prepare($check_admin_query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result_admin = $stmt->get_result();
    


        if ($result_client->num_rows > 0||$result_admin->num_rows > 0) {
            $usernameErr = "Username already exists. Please choose a different username.";
        } else {
            $insert_query = "INSERT INTO client (client_name, client_password, gender, client_email, client_phone, birth_date) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("ssssss", $username, $password, $gender, $email, $phone, $dob);
        
            if ($stmt->execute()) {
                $welcome_voucher_code = generateAndSaveVoucher("Welcome Voucher", 10, date('Y-m-d', strtotime('+1 month')), $username);
                header('Location: login.php');
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    }


}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login Page</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/signup.css">
        <link rel="stylesheet" href="css/phone_signup.css">
        <link rel="stylesheet" href="css/phone_login.css">
    </head>
    <body>
        <div class="ctn">
            <div class="box form-box">
                <h2>Sign up</h2>
                <form action="" method="POST">
                    <div>
                        <label for="username">USERNAME</label><br>
                        <input type="text" name="username" id="username" value="<?php echo $username ?>">
                    </div>
                    <div>
                        <span class="error"><?php echo $usernameErr; ?></span>
                    </div>       
                    <div>
                        <label for="gender">GENDER</label><br>
                        <input type="radio" name="gender" id="gender" value="M" checked>Male
                        <input type="radio" name="gender" id="gender" value="F">Female
                    </div>
                    <div>
                        <label for="password">PASSWORD</label><br>
                        <input type="password" name="password" id="password" value="<?php echo $password ?>">
                    </div>
                    <div>
                        <span class="error"><?php echo $passwordErr; ?></span>
                    </div>
                    <div>
                        <label for="re-entry">RE-ENTRY PASSWORD</label><br>
                        <input type="password" name="re-entry" id="re-entry" value="<?php echo $re_password ?>">
                    </div>
                    <div>
                        <span class="error"><?php echo $rePasswordErr; ?></span>
                    </div>
                    <div>
                        <label for="email">EMAIL</label><br>
                        <input type="email" name="email" id="email"value="<?php echo $email ?>">
                    </div>
                    <div>
                        <span class="error"><?php echo $emailErr; ?></span>
                    </div>
                    <div>
                        <label for="phone">PHONE NUMBER</label><br>
                        <input type="tel" name="phone" id="phone" maxlength="13" value="<?php echo $phone ?>">
                    </div>
                    <div>
                        <span class="error"><?php echo $phoneErr; ?></span>
                    </div>
                    <div>
                        <label for="dob">BIRTH DATE</label><br>
                        <input type="date" name="dob" id="dob" value="<?php echo $dob ?>">
                    </div>
                    <div>
                        <span class="error"><?php echo $dobErr; ?></span>
                    </div>
                    <button type="submit">SIGN UP</button>
                </form>
            </div>
        </div>
        <div style="position:absolute;top:100%;width:100%;margin-top:5%;">
            <?php include 'include/footer.php'; ?>
        </div>
    </body>

</html>
