<?php
include "koneksi.php";
session_start();
if(empty($_SESSION['username'])) header("Location: login.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $_SESSION['id']=$id;
    $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM notes WHERE id_note = $id"));
}

if(isset($_POST['pos'])){
    $id_note = $_SESSION['id'];
    $judul = $_POST['judul'];
    $note = $_POST['note'];
    $status = mysqli_query($koneksi, "UPDATE notes SET judul = '$judul', note = '$note' WHERE id_note=$id_note");
    if($status){
        header("location: index.php");
    }else{
        echo "<script>alert('Data gagal diedit')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Note</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <center>
        <h3>Edit Note</h3>
        <form action="buka_note.php" method="post">
            <input type="text" name="judul" placeholder="judul note" value="<?php echo $data['judul'] ?>"><br>
            <textarea name="note" id="note" cols="80" rows="30" placeholder="isi note"><?php echo $data['note'] ?></textarea><br>
            <button type="submit" name="pos">Submit</button>
            <a href="index.php"><button type="button">Batal</button></a>
        </form>
    </center>
</body>
</html>