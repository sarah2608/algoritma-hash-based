<?php 
session_start();
$koneksi = new mysqli("localhost","root","","algoritma");


?> 

<!DOCTYPE html>
<html>
<head>
	<title>Daftar</title>
	<link rel="stylesheet" type="text/css" href="Admin/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>

<?php include'menu.php'; ?>

<<?phpd
session_start();
// skrip koneksi
$koneksi = new mysqli("localhost","root","","algoritma");
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Admin</title>
  <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-tittle">REGISTRASI</h3>
					
				</div>
				<div class="panel-body">
					<form method="post" class="form-horizontal">
						<br>
						<div class="form-group">
							<label class="control-label col-md-3">Nama</label>
							<div class="col-md-7">
								<input type="text" class="form-control" placeholder="Nama Lengkap" name="Nama" required>
							</div>
							
						</div>
						<div class="form-group ">
							<label class="control-label col-md-3">Email</label>
							<div class="col-md-7">
								<input type="email" class="form-control" placeholder="Email" name="email" required>
							</div>
							
						</div>

						<div class="form-group ">
							<label class="control-label col-md-3">Username</label>
							<div class="col-md-7">
								<input type="text" class="form-control" placeholder="Username" name="username" required>
							</div>
							
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Password</label>
							<div class="col-md-7">
								<input type="password" class="form-control" placeholder="Password" name="pass" required>
							</div>
							
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Telp/Hp</label>
							<div class="col-md-7">
								<input type="text" class="form-control" placeholder="No. Hp/Telp" name="telp" required>
							</div>
							
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3">Alamat Lengkap</label>
							<div class="col-md-7">
								<input class="form-control" placeholder="Nama gedung, jalan, dll.." name="alamat" required>
							</div>
							
						</div>
						<div class="form-group">
							<div class="col-md-7 col-md-offset-3">
								<button class="btn btn-primary" name="daftar"> Daftar </button>
								
							</div>
							
						</div>
					</form>
					<?php
					//jika ada tombol daftar (tekan tombol daftar)
					if (isset($_POST["daftar"]))
					{
						//mengambil isian nama, email, password, alamat, telepon 
						$Nama = $_POST["Nama"];
						$email = $_POST["email"];
						$username = $_POST["username"];
						$pass = $_POST["pass"];
						$alamat = $_POST["alamat"];
						$telp = $_POST["telp"];

						//cek apakah email sudah digunakan

						$ambil = $koneksi->query("SELECT * FROM users WHERE email='$email'");
						$yangcocok = $ambil->num_rows;
						if ($yangcocok==1)
						{
							echo "<script>alert('pendaftaran gagal, email sudah digunakan');</script>";
							echo "<script>location='daftar.php';</script>";
						}
						else
						{
							//query insert ke tabel pelanggan 
							$koneksi->query("INSERT INTO users (email,pass,Nama,username,telp,alamat)
								VALUES('$email','$pass','$Nama','$username','$telp','$alamat')");

							echo "<script>alert('pendaftaran sukses, silahkan login');</script>";
							echo "<script>location='login.php';</script>";

						}
					}

					?>
				</div>
				
			</div>
			
		</div>
		
	</div>
</div>
<div>
            <?php include 'footer.php'; ?>
        </div>
        

     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
   
</body>
</html>


</body>
</html>