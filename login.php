<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type="text/css" href="css/login.css" rel="stylesheet">
    <link rel="stylesheet" href="css/phone_login.css">
</head>

<body>
    <?php include 'include/navbar.php'; ?>
    <div class="ctn">
        <div class="box form-box">
            <h2>Login</h2>
            <form action="admin/verify_credential.php" method="post">
                <div class="field input">
                    <label for="username">Username <i class="fa fa-user-circle-o"></i>:</label>
                    <input type="text" name="login_user" id="username" placeholder="Username"   value="<?php echo isset($_SESSION['login_user_value']) ? $_SESSION['login_user_value'] : ''; ?>" required>
                </div>
                <div class="field input">
                    <label for="psw">Password <i class="fa fa-unlock-alt"></i>:</label>
                    <input type="password" name="login_pw" id="psw" placeholder="password" value="<?php echo isset($_SESSION['login_pw_value']) ? $_SESSION['login_pw_value'] : ''; ?>" required>
                </div>
                <div>
                    <span class="error" style="color:red;"><?php echo isset($_SESSION['error']) ? $_SESSION['error'] : ''; ?></span>
                </div> 
                <div class="btn">
                    <button type="submit" id="btn" name="login">Login</button><br>
                </div>
                <div class="user">
                    <label for="nameBox">New User? <a href="signup.php">Sign Up Now</a></label>
                </div>
            </form>
        </div>
    </div>
    <div style="position:fixed;bottom:0px;width:100%;">
        <?php include 'include/footer.php'; ?>
    </div>
</body>

</html>
