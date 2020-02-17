<?php
INCLUDE "excel_reader2.php";
?>

<h2>Upload Data</h2>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Pilih Data</label>
		<input type="file" id="filetransaksi" name="filetransaksi"/ >
		<p class="text-danger">File berupa Ms. Excel 2003-2007 .xls</p>
	</div>
	<button class="btn btn-primary" name="simpan">Upload</button>
	<button class="btn btn-danger" name="delete">Hapus</button>
</form>
<?php
if (isset($_POST['simpan'])) {
	$target = basename($_FILES['filetransaksi']['name']);
	move_uploaded_file($_FILES['filetransaksi']['tmp_name'],$target);
	//tambahkan baris berikut untuk mencegah error is not readable 
	chmod($_FILES['filetransaksi']['name'], 0777);
	$data = new Spreadshett_Excel_Reader($_FILES['filetransaksi']['name'],false);
	// menghitung jumlah baris file xls
	$baris = $data->rowcount($shett_index=0);
	//import data excel mulai dari baris ke-2 (karena baris pertama berisikan header)
	for ($i=2; $i<=$baris ; $i++) { 
		//membaca data (kolom ke-2 sd akhir)
		$id_transaksi = $data->val($i, 2);
		$nama_produk = $data->val($i, 3);

		//setelah data dibaca, masukkan ke tabel produk
		$koneksi -> query ("INSERT INTO transaksi (id_transaksi, nama_produk) VALUES('$_POST[id_transaksi]','$_POST[nama_produk]')");

		echo "<div class='alret alert-info'>Data Tersimpan
	</div>";
	echo "<meta http-equiv='refresh' content='1;url=transaksi.php?halaman=transaksi'>";

	}

	//hapus file xls yang sudah dibaca 
	unlink($_FILES['filetransaksi']['name']);
}
?>
