<h2>Data Produk</h2>
<button class="btn btn-warning" name="tambah">Tambah Produk</button>

<form method="post" enctype="multipart/form-data">
	<div class="form-group"><br>
		<Label>Data Produk</Label><br>
		<label>Cari Data</label>
		<input type="Text" class="form-control" name="Text">
	</div>
	<div class="form-group">
		<label>Pilih Data</label>
		<input type="Text" class="form-control"  placeholder="Nama Produk" name="Text">
	</div>
	<button class="btn btn-primary" name="save">Cari</button>
</form>
<h2> Tabel Data Produk</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>no</th>
			<th>nama Produk</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM produk"); ?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_produk']; ?></td>
			<td>
				<a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn-danger btn">hapus</a>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>