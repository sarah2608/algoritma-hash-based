<h2>Detail Pembelian</h2>
<?php
$koneksi = new mysqli("localhost","root","","toko-online");
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>

<strong><?php echo $detail['nama_pelanggan']; ?></strong><br>
<p>
	<?php echo $detail['telepon_pelanggan']; ?> <br>
	<?php echo $detail['email_pelanggan']; ?>
</p>

<p>
	tanggal: <?php echo $detail['tanggal_pembelian']; ?> <br>
	Total: Rp. <?php echo number_format($detail['total_pembelian']); ?><br>
	Alamat Pengiriman : <?php echo $detail['alamat_pengiriman']; ?> <br>
	provinsi : <?php echo $detail['provinsi_beli'] ?><br>
	Kota : <?php echo $detail['kota_beli'] ?><br>
	Kecamatan : <?php echo $detail['kecamatan_beli'] ?><br>
	Desa : <?php echo $detail['desa_beli'] ?><br>
	Kode Pos : <?php echo $detail['kode_pos_beli'] ?><br>
</p>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama produk</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM beli_produk JOIN produk ON beli_produk.id_produk=produk.id_produk WHERE beli_produk.id_pembelian='$_GET[id]'"); ?>

		<?php if($ambil) { ?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_produk']; ?></td>
			<td><?php echo $pecah['harga_produk']; ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td>
				<?php echo $pecah['harga_produk']*$pecah['jumlah']; ?>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
		<?php }?>
	</tbody>
</table>