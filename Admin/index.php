<?php
session_start();
//koneksi kedatabase
$koneksi = new mysqli("localhost","root","","algoritma");



if (!isset($_SESSION['users']))
{
    echo "<script>alert('anda harus login');</script>";
    echo "<script>location='login.php';</script>";
    header('location.php');
    exit();
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Toko Online Listrik</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <style type="text/css">
        #footer{
            text-align: center;
            padding: 20px 20px;
            background-color: #EEE8AA;
            font-size: 18px;
            font-family: techno, impact, sans-serif;
        }

    </style> 
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Admin MJM</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="foto_produk/sar.png" width="180" height="200">
					</li>
				
					
                    <li><a href="index.php"><i class="fa fa-home fa-3x"></i> Menu Utama</a></li>
                    <li><a href="index.php?halaman=uploadproduk"><i class="fa fa-upload fa-3x"></i> Upload Data Produk</a></li>
                    <li><a href="index.php?halaman=uploadtransaksi"><i class="fa fa-upload fa-3x"></i> Upload Data Transaksi</a></li>
                    <li><a href="index.php?halaman=transaksi"><i class="fa fa-bar-chart fa-3x"></i> Data Transaksi</a></li>
                    <li><a href="index.php?halaman=produk"><i class="fa fa-cube fa-3x"></i> Data Produk</a></li>
                    <li><a href="index.php?halaman=analisis"><i class="fa fa-line-chart fa-3x"></i> Analisis</a></li>
                    <li><a href="index.php?halaman=informasi"><i class="fa fa-info fa-3x"></i> Informasi</a></li>
                    <li><a href="index.php?halaman=bantuan"><i class="fa fa-question-circle fa-3x"></i> bantuan</a></li>
                    <li><a href="index.php?halaman=logout"><i class="fa fa-arrow-circle-right fa-3x"></i> Logout</a></li>
                    
                    
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <?php
                if (isset($_GET['halaman']))
                {
                    if ($_GET['halaman']=="produk")
                    {
                        include 'produk.php';
                    }
                    elseif ($_GET['halaman']=="uploadproduk")
                    {
                        include 'uploadproduk.php';
                    }
                    elseif ($_GET['halaman']=="uploadtransaksi")
                    {
                        include 'uploadtransaksi.php';
                    }
                    elseif ($_GET['halaman']=="transaksi")
                    {
                        include 'transaksi.php';
                    }
                    elseif ($_GET['halaman']=="produk") 
                    {
                        include 'produk.php';
                    }
                    elseif ($_GET['halaman']=="analisis") 
                    {
                        include 'analisis.php';
                    }
                    elseif ($_GET['halaman']=="hapusproduk")
                    {
                        include 'hapusproduk.php';
                    }
                    elseif ($_GET['halaman']=="informasi")
                    {
                        include 'informasi.php';
                    }
                    elseif ($_GET['halaman']=="bantuan") 
                    {
                        include 'bantuan.php';
                    }
                    elseif ($_GET['halaman']=="logout")
                    {
                        include 'logout.php';
                    }
                }
                else
                {
                    include 'home.php';
                }
                ?>
            </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
        <div id="footer">
            <?php include 'footer.php'; ?>
        </div>
        
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
