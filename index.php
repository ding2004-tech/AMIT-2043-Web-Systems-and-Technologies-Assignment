<?php
include 'include/navbar.php';
include 'include/dbconnect.php';


$sql = "SELECT * FROM events";
$result = $conn->query($sql);
$sql2 = "SELECT * FROM history_image";
$result2 = $conn->query($sql2);
?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Harmony Society</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/d25b499fc2.js" crossorigin="anonymous"></script>    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/phone_view.css">
</head>

<body>
    <div class = "banner">
        <div class = "banner1" style="position: absolute; top: 20%; left: 12%;">
            <img src="admin\song_image\bts.jpg" alt="" width="670" height="417.88" >
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1; color: white; text-align: center;">
                <span style="font-size: 40px; font-weight: bold; font-family: Montserrat;">BTS</span><br>
                <div style="margin-top: 10%;font-size: 30px">
                    <span >Map of the Soul Tour</span>
                </div>
            </div>
        </div>
        <div class = "banner2" style="background-color: white; width: 30.59%; height: 60%;position: absolute; top: 20%; right: 12%;">
            <div >
                <span style="font-size: 20px;font-family: Montserrat;position:absolute;left:37%;top:10%;">JUNE 5 , 2024</span><br>
                <span class = "place" style="font-size: 20px;font-family: Montserrat;position:absolute;left:23%;top:18%;">Axiata Arena Bukit Jalil , My</span>
            </div>
            <span style="font-size: 28px;font-family: Montserrat;position:absolute;left:37%;top:33%;">See you in</span>
            <div>
                <div id="countdown"></div>
                <div class = "day" style="font-size: 16px;color:#71797E;position:absolute;left:18%;top:58%;">
                    <span>Days&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <span>Hours&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <span>Minutes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <span>Seconds</span>
                </div>
            </div>
            <button style="background-color:#DCF0FA; color:black;padding:8px;border-radius:2px;font-weight:bold;position:relative;left:198px;top:10.07%;"><a href="ticket.php?event_id=25" style="text-decoration:none;color:black;">Buy Ticket</a></button>
        </div>
    </div>
    <div class = "sliders" style="padding-bottom: 150px;">
        <div class="slider-container">
            <div class="title">
                <hr class="horizontal-line">
                <h2>MORE EVENT & CONCERT</h2>
                <hr class="horizontal-line">
            </div>
            <div class="slider">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row["event_id"];
                        $name = $row["event_name"];
                        $poster = $row["event_poster"];
                        $url = isset($_SESSION['login_user']) ? "ticket.php?event_id=$id" : 'login.php';
                        echo "<div class='card'>
                                <a href='$url'><img src='admin/$poster' width='270px' height='350'></a>
                                <div class='card-body'>
                                    <h5 class='card-title'>$name</h5>
                                </div>
                            </div>";
                    }
                }
                ?>
            </div>
            <button class="prev-btn"><i class="far fa-arrow-alt-circle-left"></i></button>
            <button class="next-btn"><i class="far fa-arrow-alt-circle-right"></i></button>
        </div>
    </div>

    <div class = "historical" style="margin-left: 12%;margin-right:12%;">
        <div class="title">
            <hr class="horizontal-line">
            <h2 style="margin-top: 20px;margin-bottom: 20px;">Historical Image of Concert</h2>
            <hr class="horizontal-line">
        </div>
        
        <div class="gallery">

            <?php
    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $name = $row["name"];
            $concert_name = $row["concert_name"];
            $image = $row["photo"];
            echo "<div class='photo-container'>
                    <div class='photo'>
                        <img src='admin/${image}' width='363px' height='221px' alt='IU'>
                        <div class='photo-overlay'>
                            <h2>$name</h2><br>
                            <p>$concert_name</p>
                        </div>        
                    </div>
                </div>";
        }
    } else {
        echo "No results found.";
    }
?>

        </div>
    </div>
    <?php include 'include/footer.php'; ?>
</body>
<script src="js/index.js"></script>
</html>
