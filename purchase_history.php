<?php
include 'include/navbar.php';
include 'include/dbconnect.php';

if (isset($_SESSION['login_user'])) {
    $user = $_SESSION['login_user'];

    $sql = "SELECT b.ticket_id, b.event_id, e.event_name, e.event_date, e.event_nation, e.event_time, e.event_place,
                   GROUP_CONCAT(b.seat_number) AS seat_numbers,
                   b.purchase_time, b.buyer
            FROM booking b
            JOIN events e ON b.event_id = e.event_id
            WHERE b.buyer = ?
            GROUP BY b.event_id, e.event_name, e.event_date, e.event_nation, e.event_time, e.event_place, b.purchase_time, b.buyer;";

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
    <link rel="stylesheet" href="css/purchase.css">
    <link rel="stylesheet" href="css/phone_history.css">
</head>
<body>
    <h2>TICKET HISTORY</h2>
    <div class="history">
        <div style="visibility: hidden; position: absolute; width: 0px; height: 0px;">
            <svg xmlns="http://www.w3.org/2000/svg">
                <symbol viewBox="0 0 24 24" id="expand-more">
                    <path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"/><path d="M0 0h24v24H0z" fill="none"/>
                </symbol>
                <symbol viewBox="0 0 24 24" id="close">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/>
                </symbol>
            </svg>
        </div>

        <?php   
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ticket_id = $row["ticket_id"];
                $event_id = $row["event_id"];
                $event_name = $row["event_name"];
                $event_date = $row["event_date"];
                $event_time = $row["event_time"];
                $event_place = $row["event_place"];
                $event_nation = $row["event_nation"];
                $purchase_time = $row["purchase_time"];
                $seatNumber = $row["seat_numbers"]; 

                echo "<details>
                <summary>
                    $event_name
                    <svg class='control-icon control-icon-expand' width='24' height='24' role='presentation'><use xmlns:xlink='http://www.w3.org/1999/xlink' xlink:href='#expand-more' /></svg>
                    <svg class='control-icon control-icon-close' width='24' height='24' role='presentation'><use xmlns:xlink='http://www.w3.org/1999/xlink' xlink:href='#close' /></svg>
                </summary>
                <div class='seatNumber' style='position: absolute;top:100px;'>
                    <h5 style='font-weight:normal;font-size:12px;'>Seat Number</h5>
                    <h6>$seatNumber</h6>
                </div>
                <div class='date' style='position: absolute;right:100px;top:100px;'>
                    <h5 style='font-weight:normal;font-size:12px;'>Date & Time</h5>
                    <h6>$event_date $event_time </h6>
                </div>
                <div class='venue' style='position: absolute;top:150px;'>
                    <h5 style='font-weight:normal;font-size:12px;'>Venue</h5>
                    <h6>$event_place,$event_nation</h6>
                </div>
                <div class='purchase_time' style='position: absolute;right:100px;top:150px;'>
                    <h5 style='font-weight:normal;font-size:12px;'>Purchase Time</h5>
                    <h6>$purchase_time</h6>
                </div>
                <br> <br><br>
                </details>";
            }
        } 
        else{
            echo "<div style='margin-left:12%;'>NO TICKET HISTORY FOUND !</div>";
        }
        ?>
    </div>
    <div style="display:block;">
        <?php include 'include/footer.php'; ?>
    </div>

</body>
</html>
