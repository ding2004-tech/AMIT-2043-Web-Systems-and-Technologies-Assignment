<?php

include 'include/navbar.php';
include 'include/dbconnect.php';

if (isset($_SESSION['login_user'])) {
    $user = $_SESSION['login_user'];

    $sql = "SELECT * FROM voucher WHERE owner=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/d25b499fc2.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/voucher.css">
    <link rel="stylesheet" href="css/phone_voucher.css">
</head>
<body>
    <h2>My Voucher</h2>

    <div class="voucher-container">

    <?php   
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $voucher_name = $row["voucher_name"];
                $discount = $row["discount"];
                $valid_date = $row["valid_date"];
                echo "<div class='voucher-card' style='display:block;'>
                <div class='front'>
                    <i class='fa-solid fa-ticket voucher-icon'></i>
                    <div class='voucher-content'>
                    <div class='voucher-title'><h4>$voucher_name</h4></div>
                        <div class='voucher-details'>
                            <p>$discount% off</p>
                        </div>
                        <h5>Valid Until: $valid_date</h5>
                    </div>
                </div>
            </div>";
            }
        }else{

            echo"<div style='height:63vh;'>No voucher found</div>";
        }
        ?>

    
    </div>
    <?php include 'include/footer.php'; ?>
</body>
</html>
