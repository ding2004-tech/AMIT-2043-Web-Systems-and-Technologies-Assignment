<?php
include 'include/navbar.php';
include 'include/dbconnect.php';

$buyer = "";
$eventName = isset($_POST['eventName']) ? $_POST['eventName'] : (isset($_GET['eventName']) ? $_GET['eventName'] : 0);
$event_id = isset($_POST['eventid']) ? $_POST['eventid'] : (isset($_GET['event_id']) ? $_GET['event_id'] : 0);
$ticketQty = isset($_POST['ticketQty']) ? $_POST['ticketQty'] : (isset($_GET['ticketQty']) ? $_GET['ticketQty'] : 0);
$ticketPrice = isset($_POST['ticketPrice']) ? $_POST['ticketPrice'] : (isset($_GET['ticketPrice']) ? $_GET['ticketPrice'] : 0);
$eventName =$cardHolderErr=$cardNumberErr=$cvvErr=$expiryDateErr= '';

$eventsql = "SELECT * FROM events WHERE event_id = $event_id";
$result = $conn->query($eventsql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $eventName = $row["event_name"];
        $date = $row["event_date"];
        $time = $row["event_time"];
        $price = $row["event_price"];
        $place = $row["event_place"];
        $nation = $row["event_nation"];
        $ticketPrice = $price;
        $buyer = $_SESSION['login_user'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" || !empty($_GET)) {
    $seatNumber = $_GET["seatNumber"];
    $seatNumbersArray = explode(",", $seatNumber);
    foreach ($seatNumbersArray as $seat) {
        $seat = mysqli_real_escape_string($conn, trim($seat));
        $check_sql = "SELECT * FROM booking WHERE event_id = ? AND seat_number = ?";
        $stmt_check = $conn->prepare($check_sql);
        $stmt_check->bind_param("ii", $event_id, $seat);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows == 0) {
            $sql = "INSERT INTO booking (ticket_id, event_id, seat_number, buyer) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iiis", $ticketID, $event_id, $seat, $_SESSION['login_user']);
            $stmt->execute();
            $stmt->close();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rawBody = file_get_contents('php://input');
    parse_str($rawBody, $parsedBody);

    if (isset($parsedBody['data-voucher-id'])) {
        $v_id = $parsedBody['data-voucher-id'];
        $sql_delete_voucher = "DELETE FROM voucher WHERE voucher_id = ?";
        $stmt_delete_voucher = $conn->prepare($sql_delete_voucher);
        $stmt_delete_voucher->bind_param("s", $v_id);
        $stmt_delete_voucher->execute();
        $stmt_delete_voucher->close();
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cardNumber = $_POST["cardNumber"];
    $cardHolder = $_POST["cardHolder"];
    $expiryDate = $_POST["expiryDate"];
    $cvv = $_POST["cvv"];

    $cardNumberErr = $cardHolderErr = $expiryDateErr = $cvvErr = "";

    if (empty($cardNumber) || !preg_match("/^\d{16}$/", $cardNumber)) {
        $cardNumberErr = "Please enter a valid 16-digit card number.";
    }

    if (empty($cardHolder) || !preg_match("/^[A-Za-z\s]+$/", $cardHolder)) {
        $cardHolderErr = "Please enter a valid card holder name.";
    }

    if (empty($expiryDate) || !preg_match("/^(0[1-9]|1[0-2])\/\d{2}$/", $expiryDate)) {
        $expiryDateErr = "Please enter a valid expiry date in MM/YY format.";
    }

    if (empty($cvv) || !preg_match("/^\d{3}$/", $cvv)) {
        $cvvErr = "Please enter a valid 3-digit CVV.";
    }

    if (empty($cardNumberErr) && empty($cardHolderErr) && empty($expiryDateErr) && empty($cvvErr)) {

        if (isset($_POST['payment_form_submitted'])) {
            $seatNumber = $_GET["seatNumber"];
            $seatNumbersArray = explode(",", $seatNumber);
            foreach ($seatNumbersArray as $seat) {
                $seat = mysqli_real_escape_string($conn, trim($seat));
                $check_sql = "SELECT * FROM booking WHERE event_id = ? AND seat_number = ?";
                $stmt_check = $conn->prepare($check_sql);
                $stmt_check->bind_param("ii", $event_id, $seat);
                $stmt_check->execute();
                $result_check = $stmt_check->get_result();

                if ($result_check->num_rows == 0) {
                    $sql = "INSERT INTO booking (ticket_id, event_id, seat_number, buyer) VALUES (?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("iiis", $ticketID, $event_id, $seat, $_SESSION['login_user']);
                    $stmt->execute();
                    $stmt->close();
                }
            }
            ?><script> window.location.href = "ticket.php?event_id=<?php echo $event_id; ?>" </script><?php
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/d25b499fc2.js" crossorigin="anonymous"></script>   
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="css/payment.css">
    <link rel="stylesheet" href="css/phone_payment.css">
</head>
<body>

<div class="paymentdetail" style="position:absolute;left:13%;top:100px;">
    <h1>PAYMENT DETAILS</h1>
    <hr style="border-top:5px solid black;width:330px;">
    <div class="card" style="background-color:black;width:356.70px;height:224.93px;border-radius:15px;margin-top:30px;">
        <img src="card/logo-mydebit.png"  style="z-index:1;position:absolute;top:100px;left:240px;" wieght=40 height=40> 
        <img src="card/ocbc-bank-logo.png" style="z-index:1;position:relative;top:-30px;left:20px;" wieght=230 height=130>
        <img src="card/chip-card.png" style="z-index:1;position:relative;top:-5px;left:-110px;" wieght=60 height=35>   
        <h2 id="cardNum" style="z-index:1;position:relative;top:0px;left:50px;color:white;font-family:Cardo,sans serif;font-size:22px;">1234 5678 4561 5481</h2>
        <h3 id="exyDate" style="z-index:1;position:relative;top:5px;left:180px;color:white;font-family:Cardo,sans serif;font-size:14px;">05/29</h3>
        <img src="card/mastercard.png" style="z-index:1;position:relative;top:-5px;left:275px;" wieght=80 height=50>                
    </div>
    <form class="card" method="POST">
        <div>
        <input type="hidden" name="payment_form_submitted" value="1">
        <input type="hidden" name="voucherSelect" id="voucherSelect" value="0">
        <label for="cardNumber">Card Number:</label>
        <input type="number" id="cardNumber" name="cardNumber" maxlength="16" placeholder="Enter card number" >
        </div>
        <div>
        <span class="error"><?php echo $cardNumberErr; ?></span>
        </div>
        <div>
        <label for="cardHolder">Card Holder:</label>
        <input type="text" id="cardHolder" name="cardHolder" placeholder="Enter card holder name" >
        </div>
        <div>
        <span class="error"><?php echo $cardHolderErr; ?></span>
        </div>
        <div>
        <label for="expiryDate">Expiry Date:</label>
        <input type="text" id="expiryDate" name="expiryDate" maxlength="5" placeholder="MM/YY" >
        </div>
        <div>
            <span class="error"><?php echo $expiryDateErr; ?></span>
        </div>
        <div>
        <label for="cvv">CVV:</label>
        <input type="password" id="cvv" name="cvv" maxlength="3" placeholder="Enter CVV" >
        </div>
        <div>
            <span class="error"><?php echo $cvvErr; ?></span>
        </div>
        <br>
        <button type="submit" style="padding:5px;background-color:black;color:white;cursor:pointer;font-weight:bold;">Payment</button>
    </form>
</div>
<div class="topay" style="position:absolute;right:5%;top:100px;border:2px solid black;padding:20px;">
    <h1>TO PAY</h1>
    <hr style="border-top:5px solid black;width:150px;">
    <h2>Ticket</h2><h2 style="text-align:right;margin-top:-30px">RM</h2>
    <h3><?php echo $eventName; ?></h3>
    <h3 id="qty" style="position:relative;left:250px;top:-22px"><?php echo $ticketQty;?></h3>
    <h3 id="ticketTotal" style="text-align:right;">0.00</h3>
    <hr style="width: 520px;border-top:5px solid black;">
    <h4>SUBTOTAL</h4>
    <h3 id="subtotal" style="text-align: right">0.00</h3>
    <h4>SERVICE TAX 6%</h4>
    <h3 id="serviceTax" style="text-align: right;">0.00</h3>
    <h4>VOUCHER</h4><br>
    <select name="voucherSelect" id="voucherSelect" style="padding:3px;border-radius:5px;position:relative;top:-10px;" onchange="calculateTotal()">
    <option value="0">Select a voucher</option>
    <?php
        $voucherQuery = "SELECT * FROM voucher WHERE owner = ?";
        $stmt = $conn->prepare($voucherQuery);
        $stmt->bind_param("s", $_SESSION['login_user']);
        $stmt->execute();
        $voucherResult = $stmt->get_result();
        if ($voucherResult->num_rows > 0) {
            while ($row = $voucherResult->fetch_assoc()) {
                $voucher_name = $row["voucher_name"];
                $discount = $row["discount"];
                $v_id = $row["voucher_id"];
                echo "<option value='$discount' data-voucher-id='$v_id'>$voucher_name</option>";
            }
        } else {
            echo "<option value='0'>No vouchers available</option>";
        }
    ?>
</select>
<h3 id="discount_value" style="text-align: right;">0.00</h3>

    <br>
    <hr style="width: 520px;border-bottom:3px solid black;"><br>
    <h4>TOTAL</h4>
    <h3 id="total" style="text-align: right;color:red;">0.00</h3>
</div>

<script>
document.getElementById("voucherSelect").addEventListener("change", function() {
    var selectedOption = this.options[this.selectedIndex];
    var dataValue = selectedOption.dataset.voucherId;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "payment.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                console.log(xhr.responseText);
            } else {
                console.error("Error occurred: " + xhr.status);
            }
        }
    };
    xhr.send("data-voucher-id=" + dataValue);
});

   function calculateTicketTotal() {
       var ticketQty = parseInt(document.getElementById('qty').textContent);
       var ticketPrice = <?php echo $ticketPrice; ?>;
       var ticketTotal = ticketQty * ticketPrice;
       document.getElementById('ticketTotal').textContent = ticketTotal.toFixed(2);
       calculateTotal();
   }

   function calculateTotal() {
       var ticketTotal = parseFloat(document.getElementById('ticketTotal').textContent);
       var subtotal = ticketTotal; 
       var serviceTax = subtotal * 0.06;
       var voucherDiscount = parseFloat(document.getElementById('voucherSelect').value);
       var voucherAmount = subtotal * (voucherDiscount / 100); 
       var total = subtotal + serviceTax - voucherAmount;
       document.getElementById('discount_value').textContent = voucherAmount.toFixed(2);
       document.getElementById('subtotal').textContent = subtotal.toFixed(2);
       document.getElementById('serviceTax').textContent = serviceTax.toFixed(2);
       document.getElementById('total').textContent = total.toFixed(2);
       toggleProceedPaymentButton(); 
   }

   calculateTicketTotal();
</script>
    <div style="position:absolute;top:100%;width:100%;margin-top:10%;">
        <?php include 'include/footer.php'; ?>
    </div>
</body>
</html>