<?php
include "koneksi.php";
$username=$_POST["username"];
$password=$_POST["password"];
$nama_lengkap=$_POST["nama_lengkap"];
$jenis_kelamin=$_POST["jenis_kelamin"];
$tanggal_lahir=$_POST["tanggal_lahir"];
$alamat=$_POST["alamat"];
$hp=$_POST["hp"];
$status=$_POST["status"];

  $hasil=mysqli_query($koneksi, "INSERT INTO user (username,password,nama_lengkap,jenis_kelamin,tanggal_lahir,alamat,hp,status) VALUES('$username','$password','$nama_lengkap','$jenis_kelamin','$tanggal_lahir','$alamat','$hp','$status')");

  if ($hasil) 
  {
	echo "<script>
				alert('Anda Berhasil Registrasi !');
				document.location='login.php';
		  </script>";
  }
  else 
  {
	echo "<script>
				alert('Registrasi Anda Gagal !');
				document.location='register.php';
		  </script>";
  }
?>