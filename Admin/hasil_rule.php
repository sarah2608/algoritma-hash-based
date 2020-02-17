<?php 
//session_start();
if (!isset($_SESSION['apriori_toko_id'])) {
    header("location:index.php?menu=forbidden");
}

include_once "../database.php";
include_once "../fungsi.php";
include_once "mining.php";
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" style="background-color: #fff;">       
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><em class="fa fa-history"></em></a></li>
            <li class="active">Riwayat Mining</li>
        </ol>
    </div>

<?php
//object database class
$db_object = new database();

$pesan_error = $pesan_success = "";
if(isset($_GET['pesan_error'])){
    $pesan_error = $_GET['pesan_error'];
}
if(isset($_GET['pesan_success'])){
    $pesan_success = $_GET['pesan_success'];
}

$sql = "SELECT
        *
        FROM
         riwayat";
$query=$db_object->db_query($sql);
$jumlah=$db_object->db_num_rows($query);
?>

    <div class="panel panel-default">
        <div class="col-md-12">
        <div class="panel-heading">
            <h3><strong>Tabel Riwayat Mining</strong></h3>
        </div>
            <div class="panel-body">

            <?php
            if (!empty($pesan_error)) {
                display_error($pesan_error);
            }
            if (!empty($pesan_success)) {
                display_success($pesan_success);
            }


            //echo "Jumlah data: ".$jumlah."<br>";
            if($jumlah==0){
                    echo "Data kosong...";
            }
            else{
            ?>
            <table class='table table-bordered table-striped  table-hover' style='text-align: center;'>
                <tr>
                <th><center>No</center></th>
                <th><center>Start Date</center></th>
                <th><center>End Date</center></th>
                <th><center>Min Support</center></th>
                <th><center>Min Confidence</center></th>
                <th></th>
                </tr>
                <?php
                    $no=1;
                    while($row=$db_object->db_fetch_array($query)){
//                          if($no==1){
//                            echo "Min support: ".$row['min_support'];
//                            echo "<br>";
//                            echo "Min confidence: ".$row['min_confidence'];
//                        }
//                        $kom1 = explode(" , ",$row['kombinasi1']);
//                        $jika = implode(" Dan ", $kom1);
//                        $kom2 = explode(" , ",$row['kombinasi2']);
//                        $maka = implode(" Dan ", $kom2);
                            echo "<tr>";
                            echo "<td>".$no."</td>";
                            echo "<td>".$row['start_date']."</td>";
                            echo "<td>".$row['end_date']."</td>";
                            echo "<td>".$row['min_support']."</td>";
                            echo "<td>".$row['min_confidence']."</td>";
                            $view = "<a href='index.php?menu=view_rule&id=".$row['id']."' class='btn btn-primary'>Lihat Hasil</a>";
                            echo "<td>".$view."</td>";
//                            echo "<td>Jika ".$jika.", Maka ".$maka."</td>";
//                            echo "<td>".price_format($row['confidence'])."</td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
            </table>
            <?php
            }
            ?>
            </div>
        </div>
    </div>
</div>
