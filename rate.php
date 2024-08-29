<?php 
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rating dan Saran</title>
    <style>
        .rating {
            unicode-bidi: bidi-override;
            direction: rtl;
            text-align: solid;
        }

        .rating > input {
            display: none;
        }

        .rating > label {
            float: left;
            display: inline-block;
            padding: 2px;
            margin-right: 5px;
            color: #FFD700;
            font-size: 30px;
            font-weight: bold;
            cursor: pointer;
        }

        .rating > label::before {
            content: "\2605"; /* kode karakter bintang */
        }

        .rating > input:checked ~ label,
        .rating > input:checked ~ label ~ label {
            color: #FFD700;
        }

        .rating > label:hover,
        .rating > label:hover ~ label,
        .rating > input:checked ~ label:hover,
        .rating > input:checked ~ label:hover ~ label,
        .rating > input:checked ~ label ~ label:hover {
            color: #FFED85;
        }

        .saran {
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <h1>Beri Rating</h1>
    <div class="rating">
        
        <input type="radio" id="star5" name="rating" value="5" /><label for="star5">5</label>
        <input type="radio" id="star4" name="rating" value="4" /><label for="star4">4</label>
        <input type="radio" id="star3" name="rating" value="3" /><label for="star3">3</label>
        <input type="radio" id="star2" name="rating" value="2" /><label for="star2">2</label>
        <input type="radio" id="star1" name="rating" value="1" /><label for="star1">1</label>
    </div>
    <div class="saran">
        <h2>Berikan Saran</h2>
        <form method="post" action="">
            <textarea name="saran" rows="4" cols="100"></textarea><br>
            <input type="submit" value="Submit" name="submit">
        </form>
    </div>

    <?php
    // Konfigurasi koneksi ke database
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "dbpemesanan";

    // Membuat koneksi ke database
    $koneksi = mysqli_connect($host, $user, $pass, $db);

    // Memeriksa apakah koneksi berhasil
    if ($koneksi->koneksi_error) {
        die("Koneksi ke database gagal: " . $koneksi->koneksi_error);
    }

    if (isset($_POST['submit'])) {
        // Mengambil nilai rating dari form
        $rate = $_POST['rate'];

        // Mengambil nilai saran dari form
        $saran = $_POST['saran'];

        // Menyimpan nilai rating dan saran ke dalam database
        $sql = "INSERT INTO rating (rate, saran) VALUES ('$rate', '$saran')";

        if ($koneksi->query($sql) === TRUE) {
            echo "Rating dan saran berhasil disimpan.";
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }
    }

    // Menutup koneksi ke database
    $koneksi->close();
    ?>

</body>
</html>