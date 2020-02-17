
<?php 

$koneksi = new mysqli("localhost","root","","algoritma");

include "mining.php";
include "display_mining.php";
include "excel_reader2.php";
?>

<?php
//object database class
$db_object = new database();

$sql = "SELECT
        *
        FROM
         transaksi";
$query=$db_object->db_query($sql);
$jumlah=$db_object->db_num_rows($query);
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" style="background-color: #fff;">       
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><em class="fa fa-cubes"></em></a></li>
            <li class="active">Proses Mining</li>
        </ol>
    </div>
        <!-- Menampilkan Tabel -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3><strong>Tabel Data Transaksi</strong></h3>
            <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
        </div>
        <div class="col-md-12">
            <div class="panel-body">

            <?php
            if (!empty($pesan_error)) {
                display_error($pesan_error);
            }
            if (!empty($pesan_success)) {
                display_success($pesan_success);
            }

            echo "Jumlah data: ".$jumlah."<br>";
            if($jumlah==0){
                    echo "Data kosong...";
            }
            else{
            ?>
            <table class='table table-bordered table-striped  table-hover'>
                <tr>
                <th>No</th>
                <th style="width:10%;">Tanggal</th>
                <th>Produk</th>
                </tr>
                <?php
                    $no=1;
                    while($row=$db_object->db_fetch_array($query)){
                        echo "<tr>";
                            echo "<td>".$no."</td>";
                            echo "<td>".$row['tanggal_transaksi']."</td>";
                            echo "<td>".$row['produk']."</td>";
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

    <div class="panel panel-default">
        <div class="col-md-12">
            <div class="panel-body">
          
<?php
//object database class
$db_object = new database();

$pesan_error = $pesan_success = "";
if (isset($_GET['pesan_error'])) {
    $pesan_error = $_GET['pesan_error'];
}
if (isset($_GET['pesan_success'])) {
    $pesan_success = $_GET['pesan_success'];
}

if (isset($_POST['submit'])) {
?>

                <?php
                $can_process = true;
                if (empty($_POST['min_support']) || empty($_POST['min_confidence'])) {
                    $can_process = false;
                    ?>
                    <script> location.replace("?menu=proses_apriori&pesan_error=Min Support dan Min Confidence harus diisi");</script>
                    <?php
                }
                if(!is_numeric($_POST['min_support']) || !is_numeric($_POST['min_confidence'])){
                    $can_process = false;
                    ?>
                    <script> location.replace("?menu=proses_apriori&pesan_error=Min Support dan Min Confidence harus diisi angka");</script>
                    <?php
                }
                //  01/09/2016 - 30/09/2016
                
                if($can_process){
                    $tgl = explode(" - ", $_POST['range_tanggal']);
                    $start = format_date($tgl[0]);
                    $end = format_date($tgl[1]);
                    
                    if(isset($_POST['id'])){
                        $id_process = $_POST['id'];
                        //delete hitungan untuk id_process
                        reset_hitungan($db_object, $id_process);
                        
                        //update log process
                        $field = array(
                                        "start_date"=>$start,
                                        "end_date"=>$end,
                                        "min_support"=>$_POST['min_support'],
                                        "min_confidence"=>$_POST['min_confidence']
                                    );
                        $where = array(
                                        "id"=>$id_process
                                    );
                        $query = $db_object->update_record("riwayat", $field, $where);
                    }
                    else{
                        //insert log process
                        $field_value = array(
                                        "start_date"=>$start,
                                        "end_date"=>$end,
                                        "min_support"=>$_POST['min_support'],
                                        "min_confidence"=>$_POST['min_confidence']
                                    );
                        $query = $db_object->insert_record("riwayat", $field_value);
                        $id_process = $db_object->db_insert_id();
                    }
                    //show form for update
                    ?>

                </div>
            </div>
        </div>   

                    <div class="panel panel-default">
                        <div class="col-md-12">
                        <div class="panel-heading">
                            <h3><strong>Hasil Mining !</strong></h3>
                        </div>
                            <div class="panel-body">
                    <?php
                    
                    echo "<h5>Min Support = " . $_POST['min_support'] . " %</h5>";
                    $sql = "SELECT COUNT(*) FROM transaksi 
                    WHERE tanggal_transaksi BETWEEN '$start' AND '$end' ";
                    $res = $db_object->db_query($sql);
                    echo "<h5>Min Confidence = " . $_POST['min_confidence'] . " %</h5>";
                    echo "<h5>Start Date = " . $start . "</h5>";
                    echo "<h5>End Date = " . $end . "</h5>";
                    echo"<hr>";
                    
                    
                    //get  transaksi data to array variable
                    /*
                     * oret-oretan
                    $sql_trans = "SELECT * FROM transaksi 
                            WHERE transaction_date BETWEEN '$start' AND '$end' ";
                    $result_trans = $db_object->db_query($sql_trans);
                    $dataTransaksi = $item_list = array();
                    $jumlah_transaksi = $db_object->db_num_rows($result_trans);
                    $min_support_relative = ($min_support/$jumlah_transaksi)*100; 
                    $x=0;
                    while($myrow = $db_object->db_fetch_array($result_trans)){
                        $dataTransaksi[$x]['tanggal'] = $myrow['transaction_date'];
                        $dataTransaksi[$x]['produk'] = $myrow['produk'].",";
                        $dataTransaksi[$x]['id'] = $myrow['id'];
                        $produk = explode(",", $myrow['produk']);
                        $produk = str_replace(" ,", ",", $produk);
                        $produk = str_replace("  ,", ",", $produk);
                        $produk = str_replace("   ,", ",", $produk);
                        $produk = str_replace("    ,", ",", $produk);
                        $produk = str_replace(", ", ",", $produk);
                        $produk = str_replace(",  ", ",", $produk);
                        $produk = str_replace(",   ", ",", $produk);
                        $produk = str_replace(",    ", ",", $produk);
                        //all items
                        foreach ($produk as $key => $value_produk) {
                            //if(!in_array($value_produk, $item_list)){
                            if(!in_array(strtoupper($value_produk), array_map('strtoupper', $item_list))){
                                if(!empty($value_produk)){
                                    $item_list[] = $value_produk;
                                }
                            }
                        }
                        $x++;
                    }
                    
                    
                    $sql_trans = "SELECT * FROM itemset2 ";
                    $result_trans = $db_object->db_query($sql_trans);
                    while($myrow = $db_object->db_fetch_array($result_trans)){
                        if($myrow['atribut1']=='bendera cair coklat botol' 
                                && $myrow['atribut2']=='cair coklat kotak'){
                            $aaaaa="jjjjj";
                        }
                        $jumlahItemset2[] = jumlah_itemset2($dataTransaksi, $myrow['atribut1'], $myrow['atribut2']);
                        
                    }
                    echo "aaa";
                    */
                    

                    $result = mining_process($db_object, $_POST['min_support'], $_POST['min_confidence'],
                            $start, $end, $id_process);
                    if ($result) {
                        display_success("");
                    } else {
                        display_error("Gagal mendapatkan aturan asosiasi");
                    }
                    
                    display_process_hasil_mining($db_object, $id_process, $_POST['min_support'], $start, $end);                    
                }
                ?>

            </div>
        </div>
    </div>
    <?php
} 
else {
    $where = "ga gal";
    if(isset($_POST['range_tanggal'])){
        $tgl = explode(" - ", $_POST['range_tanggal']);
        $start = format_date($tgl[0]);
        $end = format_date($tgl[1]);
        
        $where = " WHERE tanggal_transaksi "
                . " BETWEEN '$start' AND '$end'";
    }
    $sql = "SELECT
        *
        FROM
         transaksi ".$where;
    
    $query = $db_object->db_query($sql);
    $jumlah = $db_object->db_num_rows($query);
    ?>
<?php 
}
?>

<h2>Analisis</h2>

<form method="post" enctype="multipart/form-data">
    <div class="form-group"><br>
        <label>Min. Support </label>
        <input type="Text" class="form-control" name="Text">
    </div>
    <div class="form-group"><br>
        <label>Min. Confidence </label>
        <input type="Text" class="form-control" name="Text">
    </div>
    <button class="btn btn-primary" name="save">Analisis</button><br>
    <button class="btn btn-warning" name="cetak">Cetak Hasil</button><br>
    <button class="btn btn-danger" name="hapus">Reset</button><br>

</form>

<script>
            function validasi(){
                var min_support = document.getElementById('min_support');
                var min_confidence = document.getElementById('min_confidence');
            
                if (harusDiisi(min_support, "Silahkan input nilai minimal support")) {
                    if (harusDiisi(min_confidence, "Silahkan input nilai minimal confidence")) {
                            return true;
                    };
                };
                return false;
            }
 
            function harusDiisi(att, msg){
                if (att.value.length == 0) {
                    alert(msg);
                    att.focus();
                    return false;
                }
 
                return true;
            }
</script>