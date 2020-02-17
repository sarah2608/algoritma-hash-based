<?php

function display_process_hasil_mining($db_object, $id_process) {
//    ?>
<!--    <strong>Itemset 1:</strong>
    <table class = 'table table-bordered table-striped  table-hover'>
    <tr>
    <th>No</th>
    <th>Item</th>
    <th>Jumlah</th>
    <th>Support</th>
    <th></th>
    </tr>-->
    <?php
//    $sql1 = "SELECT * FROM itemset1 "
//            . " WHERE id_process = ".$id_process
//            . " ORDER BY lolos DESC";
//    $query1 = $db_object->db_query($sql1);
//    $no = 1;
//    while ($row1 = $db_object->db_fetch_array($query1)) {
//        echo "<tr>";
//        echo "<td>" . $no . "</td>";
//        echo "<td>" . $row1['atribut'] . "</td>";
//        echo "<td>" . $row1['jumlah'] . "</td>";
//        echo "<td>" . $row1['support'] . "</td>";
//        echo "<td>" . ($row1['lolos'] == 1 ? "Lolos" : "Tidak Lolos") . "</td>";
//        echo "</tr>";
//        $no++;
//    }
//    ?>
    <!--</table>-->


<!--    <strong>Itemset 2:</strong>
    <table class='table table-bordered table-striped  table-hover'>
        <tr>
            <th>No</th>
            <th>Item 1</th>
            <th>Item 2</th>
            <th>Jumlah</th>
            <th>Support</th>
            <th></th>
        </tr>-->
        <?php
//        $sql1 = "SELECT * FROM itemset2 "
//                . " WHERE id_process = ".$id_process
//                . " ORDER BY lolos DESC";
//        $query1 = $db_object->db_query($sql1);
//        $no = 1;
//        while ($row1 = $db_object->db_fetch_array($query1)) {
//            echo "<tr>";
//            echo "<td>" . $no . "</td>";
//            echo "<td>" . $row1['atribut1'] . "</td>";
//            echo "<td>" . $row1['atribut2'] . "</td>";
//            echo "<td>" . $row1['jumlah'] . "</td>";
//            echo "<td>" . $row1['support'] . "</td>";
//            echo "<td>" . ($row1['lolos'] == 1 ? "Lolos" : "Tidak Lolos") . "</td>";
//            echo "</tr>";
//            $no++;
//        }
//        ?>
<!--    </table>

    <strong>Itemset 3:</strong>
    <table class='table table-bordered table-striped  table-hover'>
        <tr>
            <th>No</th>
            <th>Item 1</th>
            <th>Item 2</th>
            <th>Item 3</th>
            <th>Jumlah</th>
            <th>Support</th>
            <th></th>
        </tr>-->
        <?php
//        $sql1 = "SELECT * FROM itemset3 "
//                . " WHERE id_process = ".$id_process
//                . " ORDER BY lolos DESC";
//        $query1 = $db_object->db_query($sql1);
//        $no = 1;
//        while ($row1 = $db_object->db_fetch_array($query1)) {
//            echo "<tr>";
//            echo "<td>" . $no . "</td>";
//            echo "<td>" . $row1['atribut1'] . "</td>";
//            echo "<td>" . $row1['atribut2'] . "</td>";
//            echo "<td>" . $row1['atribut3'] . "</td>";
//            echo "<td>" . $row1['jumlah'] . "</td>";
//            echo "<td>" . $row1['support'] . "</td>";
//            echo "<td>" . ($row1['lolos'] == 1 ? "Lolos" : "Tidak Lolos") . "</td>";
//            echo "</tr>";
//            $no++;
//        }
//        ?>
    <!--</table>-->

    <?php
    $sql1 = "SELECT * FROM kesimpulan "
                . " WHERE id = ".$id_process
                . " AND from_itemset=3 "
                ;//. " ORDER BY lolos DESC";
    $query1 = $db_object->db_query($sql1);
    $jmlh=$db_object->db_num_rows($query1);

            $data_confidence = array();
            while($row=$db_object->db_fetch_array($query1)){
                if($row['status']==1){
                $data_confidence[] = $row;
                }
            }
            ?>
    
    
    <?php
    $sql1 = "SELECT * FROM kesimpulan "
                . " WHERE id = ".$id_process
                . " AND from_itemset=2 "
                ;//. " ORDER BY lolos DESC";
    $query1 = $db_object->db_query($sql1);
    $jmlh=$db_object->db_num_rows($query1);
    ?>

    <h5><strong>Confidence dari Large 2-itemset :</strong></h5>
    <?php
    if($jmlh==0){
                    echo "Kosong..";
            }
            else{
    ?>

    <table class='table table-bordered table-striped  table-hover' style="text-align: center;">
        <tr>
        <th><center>No</th>
        <th><center>Aturan (X => Y)</th>
        <th><center>Support xUy</th>
        <th><center>Support x </th>
        <th><center>Confidence</th>
        </tr>
        <?php
            $no=1;
            //$data_confidence = array();
            while($row=$db_object->db_fetch_array($query1)){
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$row['kombinasi1']." => ".$row['kombinasi2']."</td>";
                    echo "<td>".price_format($row['support_xUy'])." %</td>";
                    echo "<td>".price_format($row['support_x'])." %</td>";
                    if ($row['confidence']<$row['min_confidence']) {
                            echo "<td style='color:#ff0000;'>" . price_format($row['confidence']) . " %</td>";
                        } 
                        else {
                            echo "<td style='color:#00ff00;'>" . price_format($row['confidence']) . " %</td>";
                        }
                echo "</tr>";
                $no++;
                if($row['status']==1){
                $data_confidence[] = $row;
                }
            }
        }
        ?>
    </table>


    <h5><strong>Aturan Asosiasi Yang Terbentuk :</strong></h5>
        <?php
        if($jmlh==0){
                    echo "Kosong..";
            }
            else{
        echo "<table class='table table-bordered table-striped  table-hover' style='text-align:center;'>
        <tr>
            <th><center>No</th>
            <th><center>Aturan (X => Y)</th>
            <th><center>Support</th>
            <th><center>Confidence</th>
            <!-- <th></th> -->
        </tr>";

        $no = 1;
        //while ($row1 = $db_object->db_fetch_array($query1)) {
        foreach($data_confidence as $key => $val){
//            $kom1 = explode(" , ", $row1['kombinasi1']);
//            $jika = implode(" Dan ", $kom1);
//            $kom2 = explode(" , ", $row1['kombinasi2']);
//            $maka = implode(" Dan ", $kom2);
            echo "<tr>";
            echo "<td>" . $no . "</td>";
            echo "<td>" . $val['kombinasi1']." => ".$val['kombinasi2'] . "</td>";
            echo "<td>" . price_format($val['support_xUy']) . " %</td>";
            echo "<td>" . price_format($val['confidence']) . " %</td>";
            //echo "<td>" . ($val['lolos'] == 1 ? "Lolos" : "Tidak Lolos") . "</td>";
            echo "</tr>";
            $no++;
        }
        }
        ?>
    </table>

    <h4><strong>Kesimpulan :</strong></h4>
                <?php
                if($jmlh==0){
                    echo "kosong..";
                }
                else{

                echo "<table class='table table-bordered table-striped  table-hover'>
                <tr>
                    <th><center>No.</th>
                    <th>Kombinasi</th>
                </tr>";
                $no=1;
                //while($row=$db_object->db_fetch_array($query)){
                foreach($data_confidence as $key => $val){
                    if($val['status']==1){
                        echo "<tr>";
                        echo "<td><center>".$no."</td>";
                        echo "<td> produk terlaris adalah ".$val['kombinasi1'].", dan ".$val['kombinasi2']."</td>";                       
                        echo "</tr>";
                    }
                    $no++;
                }
                }
                ?>
    </table>
    <a href="../config/export/warung_ecacau.php?id=<?php echo $id_process; ?>" class="btn btn-primary pull-right" target="blank"><em class="fa fa-file-text-o">&nbsp;</em> Export ke PDF</a>

    <?php
}
?>