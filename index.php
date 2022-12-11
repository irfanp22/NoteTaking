<?php
include "koneksi.php";
session_start();
if (empty($_SESSION['username'])) header("Location: login.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <center>
        <h3>Selamat Datang <i><?php echo $_SESSION['username'] ?></i></h3>
        <h1>HALAMAN MENU NOTE</h1>
        <a href="note_baru.php"><button>New Note</button></a>
        <a href="logout.php"><button>Logout</button></a><br><br>
        <?php
        $user = $_SESSION['username'];
        $dt = mysqli_fetch_array(mysqli_query($koneksi, "SELECT id_user FROM users WHERE username = '$user'"));
        $id = $dt['id_user'];
        $sql = mysqli_query($koneksi, "SELECT * FROM notes WHERE id_user=$id");
        if ($data = mysqli_fetch_array($sql)) {
            $user = $_SESSION['username'];
            $dt = mysqli_fetch_array(mysqli_query($koneksi, "SELECT id_user FROM users WHERE username = '$user'"));
            $id = $dt['id_user'];
            $sql = mysqli_query($koneksi, "SELECT * FROM notes WHERE id_user=$id");
            $no = 1;
        ?>
                <table border='1px solid'>
                    <thead>
                        <th>NO.</th>
                        <th>Judul Note</th>
                        <th>Preview Note</th>
                        <th>Opsi</th>
                    </thead>
                    <tbody>
                <?php
            while ($data = mysqli_fetch_array($sql)) {
                if(strlen($data['note'])>50)
                    $note = substr($data['note'], 0, 50)."...";
                else $note = $data['note'];
                echo "<tr><td>" . $no++ . "</td>
                            <td>" . $data['judul'] . "</td>
                            <td>" . $note . "</td>
                            <td><a href='buka_note.php?id=" . $data['id_note'] . "'>Buka Note</a>
                            <a href='delete.php?id=" . $data['id_note'] . "'>Hapus Note</a></td></tr>";
            }
        } else {
            echo "Kamu belum ada note, silakan tekan new note untuk membuat note.";
        }
                ?>
                    </tbody>
                </table>
    </center>
</body>

</html>