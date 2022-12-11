<?php
include "koneksi.php";
session_start();
if(empty($_SESSION['username'])) header("Location: login.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $status = mysqli_query($koneksi, "DELETE FROM notes WHERE id_note = $id");
    if($status){
        header("location: index.php");
    }else{
        header("location: index.php");
    }
}
?>