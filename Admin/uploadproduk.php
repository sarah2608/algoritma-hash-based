<?php
INCLUDE "excel_reader2.php";
?>

<h2>Upload Data</h2>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Pilih Data</label>
		<input type="file" id="fileproduk" name="fileproduk"/ >
		<p class="text-danger">File berupa Ms. Excel 2003-2007 .xls</p>
	</div>
	<button class="btn btn-primary" name="save">Upload</button>
	<button class="btn btn-danger" name="delete">Hapus</button>
</form>
<?php
if (isset($_POST['save'])) {
	$target = basename($_FILES['fileproduk']['name']);
	move_uploaded_file($_FILES['fileproduk']['tmp_name'],$target);
	//tambahkan baris berikut untuk mencegah error is not readable 
	chmod($_FILES['fileproduk']['name'], 0777);
	$data = new Spreadshett_Excel_Reader($_FILES['fileproduk']['name'],false);
	// menghitung jumlah baris file xls
	$baris = $data->rowcount($shett_index=0);
	//import data excel mulai dari baris ke-2 (karena baris pertama berisikan header)
	for ($i=2; $i<=$baris ; $i++) { 
		//membaca data (kolom ke-2 sd akhir)
		$id_produk = $data->val($i, 2);
		$nama_produk = $data->val($i, 3);
		$jumlah = $data->val($i, 4);

		//setelah data dibaca, masukkan ke tabel produk
		$koneksi->query ("INSERT INTO produk (id_produk, nama_produk) VALUES('$_POST[id_produk]','$_POST[nama_produk]')");

		echo "<div class='alret alert-info'>Data Tersimpan
	</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";

	}

	//hapus file xls yang sudah dibaca 
	unlink($_FILES['fileproduk']['name']);
}
if (isset($_POST['delete'])) {
$koneksi = new mysqli("localhost","root","","algoritma");
$ambil =$koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();


$koneksi->query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
//echo "<script>alert('data pelanggan terhapus');</script>";
//echo "<script>location='index.php?halaman=pelanggan;</script>";

header("location:index.php?halaman=uploadproduk");


}
?>
