<?php
include "koneksi.php";
session_start();
if(empty($_SESSION['username'])) header("Location: login.php");

if(isset($_POST['pos'])){
    $user = $_SESSION['username'];
    $dt = mysqli_fetch_array(mysqli_query($koneksi, "SELECT id_user FROM users WHERE username = '$user'"));
    $id = $dt['id_user'];
    $judul = $_POST['judul'];
    $note = $_POST['note'];
    $status = mysqli_query($koneksi, "INSERT INTO notes VALUES('', $id, '$judul', '$note')");
    if($status){
        header("location: index.php");
    }else{
        echo "<script>alert('Data gagal disimpan')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Note</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <center>
        <h3>Bikin Note Baru</h3>
        <form action="note_baru.php" method="post">
            <input type="text" name="judul" placeholder="judul note"><br>
            <textarea name="note" id="note" cols="80" rows="30" placeholder="isi note"></textarea><br>
            <button type="submit" name="pos">Submit</button>
            <a href="index.php"><button type="button">Batal</button></a>
        </form>
    </center>
</body>
</html>