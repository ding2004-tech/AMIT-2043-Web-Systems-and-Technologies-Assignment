<?php session_start(); 

?>
<html>
    <head>
        <link rel="icon"  href="../MHS Logo.png">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/phone_navbar.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <script src="https://kit.fontawesome.com/d25b499fc2.js" crossorigin="anonymous"></script>   
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    </head>
    <body>
    <div class="container">
        <div class="navbar">
        <a href="index.php">
                <img src="MHS Logo.png" class="logo" alt="MHS Logo">
            </a>
            <nav>
                <ul style="font-weight: bold;">
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="eventpage.php">EVENT</a></li>
                    <li><a href="song.php">ARTIST</a></li>
                    <?php
                    if (isset($_SESSION['login_user'])) {
                        echo '<img class="user-img" width=30 height=30  src="admin/uploads/' . $_SESSION['photo'] . '"> ';
                        echo '<li class="logged-in"><a href="#">' . $_SESSION['login_user'] . '</a>';
                        echo '<div class="submenu">';
                        echo '<ul>';
                        echo '<li><a href="purchase_history.php">TICKET HISTORY</a></li>';
                        echo '<li><a href="voucher.php">MY VOUCHER</a></li>';
                        echo '<li><a href="client_setting.php">MY SETTINGS</a></li>';
                        echo '<li><a href="logout.php">LOG OUT</a></li>';
                        echo '</ul>';
                        echo '</div>';
                        echo '</li>';
                    } else {
                        echo '<li><a href="login.php">LOG IN</a></li>';
                    }
                    ?>
                </ul>
            </nav>
    </div>
    <script>
        const loggedInMenu = document.querySelector('.logged-in');
        loggedInMenu.addEventListener('click', function() {
            const submenu = this.querySelector('.submenu');
            submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
        });
    </script>
    </body>

</html>
