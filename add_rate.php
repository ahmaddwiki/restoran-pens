<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <title>Restoran PENS</title>
</head>

<body>
    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container">
            <h1 class="display-4"><span class="font-weight-bold">Anda Memasuki Laman Penilaian</span></h1>
            <hr>
            <p class="lead font-weight-bold">Silahkan Isi Penilaian Terhadap Restoran Kami<br>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <form action="add_rate.php" method="post">
                <div>
                    <h3>Beri Rating Untuk Restoran Kami</h3>
                </div>
                <div>
                    <label>Nama Pelanggan</label>
                    <input type="text" name="name">
                </div>
                <div class="rateyo" id="rating" data-rateyo-rating="4" data-rateyo-num-stars="5" data-rateyo-score="3">
                </div>

                <span class='result'>0</span>
                <input type="hidden" name="rating" >


                <div class="saran">
                    <h2>Berikan Saran</h2>
                    <textarea name="saran" rows="4" cols="100"></textarea><br>
                </div>

                <?php
                // Include the file to establish database connection
                session_start();
                $id = $_SESSION['id_user'];
                include 'koneksi.php';

                // Retrieve the id_user from the "profil" table
                $sql = "SELECT * FROM user WHERE id_user=$id";
                $result = mysqli_query($koneksi, $sql);

                // Check if any user exists in the "profil" table
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $id_user = $row['id_user'];

                    // Add the hidden input field to pass the id_user along with the form submission
                    echo "<input type='hidden' name='id_user' value='$id_user'>";
                }
                ?>

                <div><input type="submit" name="add"> </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

    <script>
        $(function() {
            $(".rateyo").rateYo().on("rateyo.change", function(e, data) {
                var rating = data.rating;
                $(this).parent().find('.result').text('rating :' + rating);
                $(this).parent().find('input[name=rating]').val(rating);
            });
        });
    </script>
</body>

</html>
<?php
include 'koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST['id_user'];
    $name = $_POST["name"];
    $rating = $_POST["rating"];
    $saran = $_POST["saran"];
    $sql = "INSERT INTO rate (id_user, name, rating, saran) VALUES ('$id_user','$name','$rating','$saran')";
    if (mysqli_query($koneksi, $sql)) {
        echo "Terima Kasih Atas Saran yang Anda Berikan";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
    mysqli_close($koneksi);
}
?>