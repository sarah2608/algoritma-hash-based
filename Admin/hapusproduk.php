<?php

$koneksi = new mysqli("localhost","root","","algoritma");
$ambil =$koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();


$koneksi->query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
//echo "<script>alert('data pelanggan terhapus');</script>";
//echo "<script>location='index.php?halaman=pelanggan;</script>";

header("location:index.php?halaman=produk");

?>
