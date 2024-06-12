<?php
include 'include/navbar.php';
include 'include/dbconnect.php';

if (!isset($_SESSION['login_user'])) {
    header('Location:login.php');
    exit();
}

$usernameErr = $newpasswordErr = $rePasswordErr = $oldpasswordErr = $phoneErr = $dobErr = "";
$gender_edit = "";
$user = $_SESSION['login_user'];
$sql = "SELECT * FROM client WHERE client_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name_edit = $row["client_name"];
        $gender_edit = $row["gender"];
        $username = $row["client_name"];
        $password = $row["client_password"];
        $birthdate_edit = $row["birth_date"];
        $phone_edit = $row["client_phone"];
        $email_edit = $row["client_email"];
        $photo_edit = $row["client_photo"];
    }
}

$oldpassword = $newpassword = $re_entered_password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = "admin/uploads/";
        $uploaded_file = $upload_dir . basename($_FILES['photo']['name']);

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaded_file)) {
            $photo = basename($_FILES['photo']['name']);
            $update_photo_query = "UPDATE client SET client_photo=? WHERE client_name=?";
            $update_photo_stmt = $conn->prepare($update_photo_query);
            $update_photo_stmt->bind_param("ss", $photo, $user);
            if ($update_photo_stmt->execute()) {
                $_SESSION['photo'] = $photo;
            } else {
                echo "Error updating photo: " . $update_photo_stmt->error;
            }
        } else {
            echo "Error uploading file.";
        }
    }

    $up_phone = isset($_POST['phone']) ? $_POST['phone'] : $phone_edit;
    $birth_date = isset($_POST['birth_date']) ? $_POST['birth_date'] : $birthdate_edit;
    $sex = isset($_POST["gender"]) ? $_POST["gender"] : $gender_edit;

    if (!empty(trim($birth_date))) {
        $date = DateTime::createFromFormat('Y-m-d', $birth_date);

        if (!$date || $date->format('Y-m-d') !== $birth_date) {
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

    if (!preg_match("/^01[0-9][-]?([0-9]{8})$/", $up_phone)) {
        $phoneErr = "Invalid phone number format";
    }

    $update_details_query = "UPDATE client SET client_phone=?, birth_date=?, gender=? WHERE client_name=?";
    $update_details_stmt = $conn->prepare($update_details_query);
    $update_details_stmt->bind_param("ssss", $up_phone, $birth_date, $sex, $user);

    if ($dobErr == "" && $phoneErr == "") {
        $update_details_stmt->execute();
        $birthdate_edit=$birth_date;
        $phone_edit=$up_phone;
        $usernameErr = $dobErr = $phoneErr = "";
    }

    if (isset($_POST['newpassword']) && isset($_POST['oldpassword']) && isset($_POST['re-entry'])) {
        $newpassword = $_POST['newpassword'];
        $oldpassword = $_POST['oldpassword'];
        $re_entered_password = $_POST['re-entry'];
        if (empty($oldpassword)) {
            $oldpasswordErr = "Please enter your CURRENT password!!!";
        }
        if ($newpassword == null) {
            $newpasswordErr = 'Please enter New Password.';
        } else if (strlen($newpassword) < 8 || strlen($newpassword) > 15) {
            $newpasswordErr = 'New Password must be between 8 to 15 characters.';
        } else if (!preg_match('/^\w+$/', $newpassword)) {
            $newpasswordErr = 'New Password must contain only alphabets, digits, and underscores.';
        }

        if ($re_entered_password == null) {
            $rePasswordErr = 'Please enter Re-enter Password.';
        } else if ($re_entered_password != $newpassword) {
            $rePasswordErr = 'Re-enter Password must match the new password.';
        }

        if ($newpasswordErr == "" && $rePasswordErr == "") {
            if ($oldpassword === $password) {
                $update_password_query = "UPDATE client SET client_password=? WHERE client_name=?";
                $update_password_stmt = $conn->prepare($update_password_query);
                $update_password_stmt->bind_param("ss", $newpassword, $user);
                if ($update_password_stmt->execute()) {
                    echo "Password updated successfully.";
                } else {
                    echo "Error updating password: " . $update_password_stmt->error;
                }
            } else {
                $oldpasswordErr = "Old password is incorrect";
            }
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Settings</title>
    <link rel="stylesheet" href="css/setting.css">
    <link rel="stylesheet" href="css/phone_setting.css">
    <script src="https://kit.fontawesome.com/d25b499fc2.js" crossorigin="anonymous"></script>    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <h3>SETTING</h3>

    <form action="client_setting.php" method="POST" enctype="multipart/form-data">
        <div>
            <label for="username">USERNAME</label><br>
            <input type="text" name="username" id="username" value="<?php echo "$name_edit"; ?>" disabled >
        </div>
        <div>
            <span class="error"><?php echo $usernameErr; ?></span>
        </div>
        <div>
            <label for="gender">GENDER</label><br>
            <input type="radio" name="gender" id="gender" value="M" <?php if($gender_edit === 'M') echo 'checked'; ?>>Male
            <input type="radio" name="gender" id="gender" value="F" <?php if($gender_edit === 'F') echo 'checked'; ?>>Female
        </div>
        <div>
            <label for="birth_date">BIRTH DATE</label><br>
            <input type="date" name="birth_date" id="birth_date" value="<?php echo "$birthdate_edit"; ?>" >
        </div>
        <div>
            <span class="error"><?php echo $dobErr; ?></span>
        </div>
        <div>
            <label for="email">EMAIL</label><br>
            <input type="email" name="email" id="email" value="<?php echo "$email_edit"; ?>" disabled>
        </div>
        <div>
            <label for="phone">PHONE NUMBER</label><br>
            <input type="tel" name="phone" id="phone" maxlength="13" value="<?php echo "$phone_edit"; ?>">
        </div>
        <div>
            <span class="error"><?php echo $phoneErr; ?></span>
        </div>
        <button type="submit">UPDATE</button>
    </form>
    <form action="client_setting.php" method="POST" enctype="multipart/form-data" style="margin-top: 450px;margin-bottom:400px;">
        <div>
            <label for="password">CURRENT PASSWORD</label><br>
            <input type="password" name="oldpassword" id="oldpassword" >
        </div>
        <div>
            <span class="error"><?php echo $oldpasswordErr; ?></span>
        </div>
        <div>
            <label for="newpassword">NEW PASSWORD</label><br>
            <input type="password" name="newpassword" id="newpassword" >
        </div>
        <div>
            <span class="error"><?php echo $newpasswordErr; ?></span>
        </div>
        <div>
            <label for="re-entry">RE-ENTRY PASSWORD</label><br>
            <input type="password" name="re-entry" id="re-entry" >
        </div>
        <div>
            <span class="error"><?php echo $rePasswordErr; ?></span>
        </div>
        <button type="submit">UPDATE</button>
    </form> 
    <div class="uploadPhoto">
    <form action="client_setting.php" method="POST" enctype="multipart/form-data">
        <div style="display: inline-block;">
            <label for="photo">UPLOAD PROFILE PHOTO</label><br>
            <input type="file" name="photo" id="photo">
        </div>
        <button type="submit">UPDATE</button>
    </form> 
    </div>
    <div class="vertical-line"></div>
    <h4>PROFILE PHOTO</h4>
    <img src="admin/uploads/<?php echo $photo_edit; ?>" class="display" height="300" width="250">
    <div style="position:absolute;top:140%;bottom:0px;width:100%;">
        <?php include 'include/footer.php'; ?>
    </div>
</body>
</html>