<?php
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
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <img src="foto_admin/logo.png" width="180" height="150">
               
                <h5>Silahkan Login</h5>
                 <br />
            </div>
        </div>
         <div class="row ">
               
                  <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong>   Enter Details To Login </strong>  
                            </div>
                            <div class="panel-body">
                                <form role="form" method="POST">
                                       <br />
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" class="form-control" name="user" />
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" class="form-control"  name="pass" />
                                        </div>
                                     
                                     <button class="btn btn-primary" name="login">Login</button>
                                     <ul class="nav navbar-nav navbar-right">
                                      <li><a href="daftar.php"><span class="glyphicon glyphicon-user"></span>Daftar</a></li>
                                    </ul>
                                    <hr />

                                    <?php
                                    if (isset($_POST['login']))
                                    {
                                      $ambil = $koneksi->query("SELECT * FROM users WHERE username='$_POST[user]' AND pass ='$_POST[pass]'");
                                      $yangcocok = $ambil->num_rows;
                                      if ($yangcocok==1)
                                      {
                                        $_SESSION['users']=$ambil->fetch_assoc();
                                        echo "<div class='alert alert-info'>Login sukses</div>";
                                        echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                                      }
                                      else
                                      {
                                        $_SESSION['users']=$ambil->fetch_assoc();
                                        echo "<div class='alert alert-danger'>Login gagal</div>";
                                        echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                                      }
                                    }
                                    ?>
                            </div>
                           
                        </div>
                    </div>
                
                
        </div>
    </div>
    <div>
        <footer>
        <div class="row">
            <div class="col-sm-12 col-md-4 footer-navigation">
    
            </div>
            <div class="col-sm-12 col-md-8 footer-contacts">
                <p class="company-name">Toko Multi Jaya Mandiri © 2018 </p>
            </div>
        
            <div class="col-md-4 footer-about">
              
            </div>
        </div>
    </footer>

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
