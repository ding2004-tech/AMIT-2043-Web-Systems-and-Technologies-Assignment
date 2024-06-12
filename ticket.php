<?php
include 'include/dbconnect.php';

$eventid = isset($_GET['event_id']) ? $_GET['event_id'] : 0;
$reservedSeats = [];

$sql = "SELECT seat_number FROM booking WHERE event_id = $eventid";
$result = $conn->query($sql);

$sql = "SELECT venue_seat AS total_seats FROM events WHERE event_id = $eventid";
$totalSeatsResult = $conn->query($sql);
$totalSeats = $totalSeatsResult->fetch_assoc()['total_seats'];

$seats = array_fill(1, $totalSeats, true);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $seatNumber = $row["seat_number"];
        $seats[$seatNumber] = false;
        $reservedSeats[] = $seatNumber;
    }
}

$eventsql = "SELECT * FROM events WHERE event_id = $eventid";
$result = $conn->query($eventsql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row["event_name"];
        $poster = $row["event_poster"];
        $detail = $row["event_detail"];
        $date = $row["event_date"];
        $time = $row["event_time"];
        $price = $row["event_price"];
        $place = $row["event_place"];
        $nation = $row["event_nation"];
        $venueseat = $row["venue_seat"];
        $totalSeats = $venueseat;
        $ticketPrice = $price;
        $url = isset($_SESSION['login_user']) ? "ticket.php?eventid=$eventid" : 'login.php';
    }
}

$conn->close();
?>

<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/d25b499fc2.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/phone_ticket.css">
    <link rel="stylesheet" href="css/ticket.css">

    <style>
        @media screen and (max-width: 450px) {
            .title {
                margin-top: 1500px !important;
            }
        }
    </style>

</head>
<body>
    <?php include 'include/navbar.php';?>
    
    <div class="title">
        <hr>
        <h2 style="font-family: Montserrat;margin-top:10px;margin-bottom:10px">Event Booking </h2>
        <hr>
    </div>

    <div style="margin-top:50px;margin-left:12%;">
        <img src="admin/<?php echo $poster; ?>" height="320" width="260" style="border-style: double;border-width: 10px;">
        <div style="position:absolute;top:35%;left:35%;">
            <h1><?php echo $name; ?></h1><br>
            <div style="display: flex;align-items: center;margin-left:10px;font-weight:bold;font-family: Montserrat,sans-serif;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                </svg>
                <h2>&nbsp;&nbsp;<?php echo $place; ?></h2>
            </div><br>
            <div style="display: flex;align-items: center;margin-left:10px;font-family: Montserrat,sans-serif;font-weight:bold;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-globe" viewBox="0 0 16 16">
                    <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m7.5-6.923c-.67.204-1.335.82-1.887 1.855A8 8 0 0 0 5.145 4H7.5zM4.09 4a9.3 9.3 0 0 1 .64-1.539 7 7 0 0 1 .597-.933A7.03 7.03 0 0 0 2.255 4zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a7 7 0 0 0-.656 2.5zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5zM8.5 5v2.5h2.99a12.5 12.5 0 0 0-.337-2.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5zM5.145 12q.208.58.468 1.068c.552 1.035 1.218 1.65 1.887 1.855V12zm.182 2.472a7 7
                    0 0 1-.597-.933A9.3 9.3 0 0 1 4.09 12H2.255a7 7 0 0 0 3.072 2.472M3.82 11a13.7 13.7 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5zm6.853 3.472A7 7 0 0 0 13.745 12H11.91a9.3 9.3 0 0 1-.64 1.539 7 7 0 0 1-.597.933M10.855 4a8 8 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4z"/>
                </svg>
                <h2>&nbsp;&nbsp;<?php echo $nation; ?></h2>
            </div><br>
            <div style="display: flex;align-items: center;margin-left:8px;font-family: Montserrat,sans-serif;font-weight:bold;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                </svg>
                <h2>&nbsp;&nbsp;<?php echo $date; ?></h2>
            </div><br>
            <div style="display: flex;align-items: center;margin-left:8px;font-family: Montserrat,sans-serif;font-weight:bold;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-alarm" viewBox="0 0 16 16">
                    <path d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9z"/>
                    <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1zm1.038 3.018a6 6 0 0 1 .924 0 6 6 0 1 1-.924 0M0 3.5c0 .753.333 1.429.86 1.887A8.04 8.04 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5M13.5 1c-.753 0-1.429.333-1.887.86a8.04 8.04 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1"/>
                </svg>
                <h2>&nbsp;&nbsp;<?php echo $time; ?></h2>
            </div>
        </div>
    </div>
    
    <div style="margin-top: 100px;margin-left:12%;margin-right:12%;" class="seat-view">
        <hr>
        <form method="post" action="payment.php">
            <h2>SEAT MAP</h2>
            <h2 style='border: 2px solid black;text-align:center;margin:50px;'>STAGE</h2>    
            <div class="seat-map">
                <div class="seat-row">
                    <?php
                    for ($i = 1; $i <= $venueseat; $i++) {
                        if ($seats[$i]) {
                            echo "<label class='seat-label'><input type='checkbox' name='seats[]' value='$i' id='seat-$i' class='seat-checkbox'><i class='fa-solid fa-chair seat-number' title='$i'></i></label>";
                        } else {
                            echo "<div class='seat-label'><i class='fa-solid fa-chair seat-icon reserved'></i></div>";
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="ticket" style="margin-top:5%;">
                <hr style="width: 1150px;border-bottom:3px solid black;margin-bottom:3%;margin-right:12%;">
                <div>
                    <h2>TICKET INFORMATION</h2>
                    <hr style="width: 290px;border-bottom:3px solid black;"><br>
                    <h3>TOTAL SEAT: <?php echo $totalSeats; ?></h3>
                    <h4>AVAILABLE: <?php echo $totalSeats - count($reservedSeats); ?></h4><br><br>
                    <label for="ticket">TICKET(RM <?php echo"$price";?>)</label><br>
                    <h3 style="font-weight: bold;">SELECTING SEAT :<div id="selected-seats"></div></h3>
                    <input type="hidden" name="selected" id="insertdata" >
                    <label for="quantity">QUANTITY: <span id="qty">0</span></label>
                </div>
                <input type="submit" value="Reserve Seats" style="margin-top: 2%; margin-bottom:100px; color:white; background-color:black; cursor:pointer; font-weight:bold; padding:5px; border:none; width:150px;">
                <button id="resetButton" style="margin-top: 1%;margin-left:5%;margin-bottom:100px;color:white;background-color:black;cursor:pointer;font-weight:bold;padding:5px;border:none;">Clear</button>    
            </div>
        </form>
    </div>

    <div style="margin-left:12%;margin-right:12%;margin-bottom:50px;" class="faq">
        <hr>
        <h2 id="faq">Frequently Asked Questions</h2>   
        <hr>
    </div>
        
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
        
    <details>
        <summary>
            Terms & Conditions
            <svg class="control-icon control-icon-expand" width="30" height="30" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" /></svg>
            <svg class="control-icon control-icon-close" width="20" height="30" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" /></svg>
        </summary>
        <p>&#x2022;&nbsp;All sales are final. No refunds or exchanges unless the event is canceled. <br>
        &#x2022;&nbsp;Tickets are non-transferable. The ticket holder must be the person who enters the venue.<br>
        &#x2022;&nbsp;Resale of tickets from unauthorized sources violates the terms and may result in denied entry.<br>
        &#x2022;&nbsp;All tickets are subject to facility rules, which may include security screening and restricted item policies.<br>
        &#x2022;&nbsp;The venue reserves the right to refuse entry or remove any attendee for violation of policies/rules.<br>
        &#x2022;&nbsp;Attendees consent to being recorded (photo/video) at the event.<br>
        &#x2022;&nbsp;The event organizers are not liable for any loss/injuries at the event.<br>
        &#x2022;&nbsp;Event dates/times/lineups are subject to change without notice in case of emergencies.</p>
    </details>
    <details>
        <summary>
            Am I allowed to resell my tickets?
            <svg class="control-icon control-icon-expand" width="30" height="30" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" /></svg>
            <svg class="control-icon control-icon-close" width="20" height="30" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" /></svg>
        </summary>
        <p>No, ticket resale is prohibited. Tickets are non-transferable to prevent unauthorized resale. You may be denied entry if your ticket was resold.</p>
    </details>
    <details >
        <summary>
            What is the refund policy?
            <svg class="control-icon control-icon-expand" width="30" height="30" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" /></svg>
            <svg class="control-icon control-icon-close" width="20" height="30" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" /></svg>
        </summary>
        <p>In most cases, all ticket sales are final with no refunds or exchanges allowed. The only exception is if the entire event is canceled by the organizers.</p>
    </details>
    <details >
        <summary>
            How do I contact support for other questions?
            <svg class="control-icon control-icon-expand" width="30" height="30" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" /></svg>
            <svg class="control-icon control-icon-close" width="20" height="30" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" /></svg>
        </summary>
        <p>You can reach out to our support team via email at support@example.com or by phone at +1 (123) 456-7890 during office hours (9 am - 5 pm, Monday to Friday).</p>
    </details>
    <script>
      let qty = 0;
      const seatMapContainer = document.querySelector('.seat-map');
      const selectedSeats = [];

      seatMapContainer.addEventListener('change', function(event) {
          const checkbox = event.target;
          const seatNumber = checkbox.value;

          if (checkbox.checked) {
              if (selectedSeats.length < 6) {
                  selectedSeats.push(seatNumber);
                  qty++;
              } else {
                  checkbox.checked = false;
                  alert('You can only select a maximum of 5 seats.');
              }
          } else {
              const index = selectedSeats.indexOf(seatNumber);
              if (index !== -1) {
                  selectedSeats.splice(index, 1);
                  qty--;
              }
          }

          const selectedSeatsDiv = document.getElementById('selected-seats');
          selectedSeatsDiv.textContent = selectedSeats.join(', ');
          const insertdataDiv = document.getElementById('insertdata');
          insertdataDiv.textContent = selectedSeats.join(', ');

          document.getElementById('qty').textContent = qty;
      });

      const form = document.querySelector('form');
      form.addEventListener('submit', function(event) {
          event.preventDefault();

          if (selectedSeats.length > 0) {
              const qty = selectedSeats.length;
              const seatNumberPay = selectedSeats.join(', ');
              const ticketPrice = <?php echo json_encode($ticketPrice); ?>;
              const eventId = <?php echo json_encode($eventid); ?>;

              const paymentUrl = `payment.php?ticketQty=${qty}&ticketPrice=${ticketPrice}&seatNumber=${seatNumberPay}&event_id=${eventId}`;
              window.location.href = paymentUrl;
          } else {
              alert('Please select at least one seat to reserve.');
          }
      });

      const resetButton = document.getElementById('resetButton');
      resetButton.addEventListener('click', function(event) {
          const checkboxes = document.querySelectorAll('.seat-checkbox');
          checkboxes.forEach(function(checkbox) {
              checkbox.checked = false;
          });
          selectedSeats.length = 0;
          qty = 0;
          const selectedSeatsDiv = document.getElementById('selected-seats');
          selectedSeatsDiv.textContent = '';
          const insertdataDiv = document.getElementById('insertdata');
          insertdataDiv.textContent = '';

          document.getElementById('qty').textContent = qty;
      });
    </script>
    <?php include 'include/footer.php'; ?>
</body>
</html>
