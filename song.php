<?php
include 'include/navbar.php';
include 'include/dbconnect.php';


$search_value = "";
if (isset($_POST['search'])) {
    $search_value = mysqli_real_escape_string($conn, $_POST['search']);
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 20;
$offset = ($page - 1) * $limit;

if ($search_value) {
    $sql = "SELECT * FROM song WHERE title LIKE '%$search_value%' OR artist LIKE '%$search_value%' ORDER BY id LIMIT $limit OFFSET $offset";
} else {
    $sql = "SELECT * FROM song ORDER BY id LIMIT $limit OFFSET $offset";
}
$result = $conn->query($sql);
$totalEvents = $conn->query("SELECT COUNT(*) AS total FROM song")->fetch_assoc()['total'];
$totalPages = ceil($totalEvents / $limit);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/song.css">
    <link rel="stylesheet" href="css/phone_song.css">
</head>

<body>
    <form action="" method="POST" style="position:absolute;top:15%;left:35%;">
        <input type="text" name="search" value="<?php echo $search_value; ?>" placeholder="SEARCHING ARTIST ....." style="width:450px;padding-left: 50px;padding-right:50px;padding-top:10px;padding-bottom:10px;border-radius:25px;">
        <button style="position:relative;right:40px;border:none;background-color:transparent;cursor:pointer;" type="submit"><i class="fa-solid fa-magnifying-glass" style="font-size: 20px;"></i></button>
    </form>

    <div id="song">
        <div id="grid">
        <?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $image = $row["image"];
        $title = $row["title"];
        $artist = $row["artist"];
        $file = $row["song_file"];
        echo "
            <div class='popstar-cards'>
                <div class='pop-img'>
                    <a href='$file' target='__blank'><img src='admin/$image'></a>
                </div>
                <h4>{$title}</h4>
                <p>{$artist}</p>
            </div>";
    }
} else {
    $allSongsQuery = "SELECT * FROM song ORDER BY id";
    $allSongsResult = $conn->query($allSongsQuery);

    if ($allSongsResult->num_rows > 0) {
        while ($row = $allSongsResult->fetch_assoc()) {
            $id = $row["id"];
            $image = $row["image"];
            $title = $row["title"];
            $artist = $row["artist"];
            $file = $row["song_file"];
            echo "
                <div class='popstar-cards'>
                    <div class='pop-img'>
                        <a href='$file' target='__blank'><img src='admin/$image'></a>
                    </div>
                    <h4>{$title}</h4>
                    <p>{$artist}</p>
                </div>";
        }
    } else {
        echo "No songs found.";
    }
}
?>
        </div>
    </div>

    <div style="position:relative;bottom:0px;width:100%;">
        <div class="pagination">
            <?php
            echo "<a href='?page=" . ($page > 1 ? $page - 1 : 1) . "' class='prev-next' title='Previous Page'><i class='fa fa-arrow-left' aria-hidden='true'></i></a>";
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<a href='?page=$i' class='" . ($i == $page ? 'current-page' : '') . "'>$i</a>";
            }
            echo "<a href='?page=" . ($page < $totalPages ? $page + 1 : $totalPages) . "' class='prev-next' title='Next Page'><i class='fa fa-arrow-right' aria-hidden='true'></i></a>";
            ?>
        <div style="position:absolute;top:100%;width:100%;margin-top:4.35%;">
            <?php include 'include/footer.php'; ?>
        </div>
        </div>
    </div>
</body>
</html>