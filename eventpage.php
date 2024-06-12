<?php
include 'include/navbar.php';
include 'include/dbconnect.php';

if (!isset($_SESSION['login_type']) || $_SESSION['login_type'] == 'admin') {
    header('location:admin/admin.php');
    exit;
}
$search='';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 16;
$offset = ($page - 1) * $limit;

$search = isset($_POST['search']) ? $_POST['search'] : '';
$searchQuery = !empty($search) ? "WHERE event_name LIKE '%$search%' OR event_date LIKE '%$search%'OR event_place LIKE '%$search%' OR event_nation LIKE '%$search%'" : '';

$sql = "SELECT * FROM events $searchQuery LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/d25b499fc2.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/eventpage.css">
    <link rel="stylesheet" href="css/phone_event.css">
</head>

<body>
    <div class="blank">
        <div class="slideshow-container">
            <div class="mySlides fade">
                <img src="/past image/images.jpg" height="385" width="650">
            </div>

            <div class="mySlides fade">
                <img src="/past image/TS-1140-x-500-desktop-header.avif" height="385" width="650">
            </div>

            <div class="mySlides fade">
                <img src="/past image/download.jpg" height="385" width="650">
            </div>

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
    </div>

    <div class="title">
        <hr>
        <h2 style="font-family: Montserrat">Upcoming event </h2>
        <hr>
        <?php echo "<span class='current-page' style='position:absolute;right:20%;bottom:20%;font-weight:bold;'>PAGE: $page</span>"; ?>

    </div>
    <form action="" method="POST" style="position:absolute;top:71%;left:35%;z-index:100;">
            <input type="text" name="search" value="<?php echo $search; ?>" placeholder="SEARCHING EVENT......" style="width:450px;padding-left: 50px;padding-right:50px;padding-top:10px;padding-bottom:10px;border-radius:25px;">
            <button style="position:relative;right:40px;border:none;background-color:transparent;cursor:pointer;" type="submit"><i class="fa-solid fa-magnifying-glass" style="font-size: 20px;"></i></button>
        </form>
    <div class="event-cards-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row["event_id"];
                $name = $row["event_name"];
                $poster = $row["event_poster"];
                $detail = $row["event_detail"];
                $date = $row["event_date"];
                $time = $row["event_time"];
                $price = $row["event_price"];
                $place = $row["event_place"];
                $country = $row["event_nation"];
                $seat = $row["venue_seat"];
                $url = isset($_SESSION['login_user']) ? "ticket.php?event_id=$id" : 'login.php';

                echo "
                <div class='event-card' style='margin-bottom: 10%;'>
                    <div class='event-card-inner'>
                        <div class='event-card-front'>
                            <img src='admin/$poster' width=250 height=300>
                        </div>
                        <div class='event-card-back'>
                            <h3 style='display: flex;align-items: center;font-family: Montserrat,sans-serif;font-weight:bold;'>$name</h3>
                            <div style='display: flex;align-items: center;margin-left:10px;font-weight:bold;font-family: Montserrat,sans-serif;'>
                                <svg xmlns'http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-geo-alt' viewBox='0 0 16 16'>
                                    <path d='M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10'/>
                                    <path d='M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6'/>
                                </svg>
                                <p>$place</p>
                            </div>
                            <div style='display: flex;align-items: center;margin-left:10px;font-family: Montserrat,sans-serif;font-weight:bold;'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-globe' viewBox='0 0 16 16'>
                                    <path d='M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m7.5-6.923c-.67.204-1.335.82-1.887 1.855A8 8 0 0 0 5.145 4H7.5zM4.09 4a9.3 9.3 0 0 1 .64-1.539 7 7 0 0 1 .597-.933A7.03 7.03 0 0 0 2.255 4zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a7 7 0 0 0-.656 2.5zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5zM8.5 5v2.5h2.99a12.5 12.5 0 0 0-.337-2.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5zM5.145 12q.208.58.468 1.068c.552 1.035 1.218 1.65 1.887 1.855V12zm.182 2.472a7 7 0 0 1-.597-.933A9.3 9.3 0 0 1 4.09 12H2.255a7 7 0 0 0 3.072 2.472M3.82 11a13.7 13.7 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5zm6.853</svg>
                                    <p>&nbsp;&nbsp;$country</p>
                                </div>
                                <div style='display: flex;align-items: center;margin-left:8px;font-family: Montserrat,sans-serif;font-weight:bold;'>&nbsp;
                                    <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-calendar' viewBox='0 0 16 16'>
                                        <path d='M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z'/>
                                    </svg>
                                    <p>&nbsp;&nbsp;$date</p>
                                </div>
                                <div style='display: flex;align-items: center;margin-left:8px;font-family: Montserrat,sans-serif;font-weight:bold;'>&nbsp;
                                    <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-alarm' viewBox='0 0 16 16'>
                                        <path d='M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9z'/>
                                        <path d='M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1zm1.038 3.018a6 6 0 0 1 .924 0 6 6 0 1 1-.924 0M0 3.5c0 .753.333 1.429.86 1.887A8.04 8.04 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5M13.5 1c-.753 0-1.429.333-1.887.86a8.04 8.04 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1'/>
                                    </svg>
                                    <p>&nbsp;&nbsp;$time</p>
                                </div>
                                <div style='display: flex;align-items: center;margin-left:8px;font-family: Montserrat,sans-serif;font-weight:bold;'>&nbsp;
                                    <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-currency-dollar' viewBox='0 0 16 16'>
                                        <path d='M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73z'/>
                                    </svg>
                                    <p>&nbsp;&nbsp;$price</p>
                                </div>
                                <a href='$url'>Buy Ticket Now</a>
                            </div>
                        </div>
                    </div>";
                }
            }
            ?>
        </div>
     
        <div class="pagination">
            <?php
            $totalEvents = $conn->query("SELECT COUNT(*) AS total FROM events $searchQuery")->fetch_assoc()['total'];
            $totalPages = ceil($totalEvents / $limit);
     
            echo "<a href='?page=" . ($page > 1 ? $page - 1 : 1) . "&search=$search' class='prev-next' title='Previous Page'><i class='fa fa-arrow-left' aria-hidden='true'></i></a>";
            echo "<span class='current-page'>$page</span>";
            echo "<a href='?page=" . ($page < $totalPages ? $page + 1 : $totalPages) . "&search=$search' class='prev-next' title='Next Page'><i class='fa fa-arrow-right' aria-hidden='true'></i></a>";
            ?>
        </div>
        <script src="js/event.js"></script>
        <?php include 'include/footer.php'; ?>
</body>
</html>