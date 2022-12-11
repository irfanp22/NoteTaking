<?php
include "koneksi.php";
session_start();
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'"));
    if($data){
        if($data['password']==$password){
            $_SESSION['username'] = $username;
            header("Location: index.php");
        }else{
            $_SESSION['pesan']='gagal';
        }
    }else{
        $_SESSION['pesan']='gagal';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <center>
        <h1>Halaman Login Note Taking</h1>
        <p style="color: red;" id="alert" hidden><i>Password/Username yang Anda Masukan Salah!</i></p>
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Username"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <button type="submit" name="login">Login</button>
        </form>
    </center>
    <script>
        <?php
        if(isset($_SESSION['pesan'])){
            echo "document.getElementById('alert').hidden = false;";
            session_unset();
        }
        ?>
    </script>
</body>
</html>