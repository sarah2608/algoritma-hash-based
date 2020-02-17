    <?php
    $sql2 = "SELECT * FROM kesimpulan"
                . " WHERE id = ".$id_process
                . " AND from_itemset=3 "
                . " AND support_xUy = ( SELECT max(support_xUy) FROM kesimpulan)";
    $query2 = $db_object->db_query($sql2);
    $jmlh=$db_object->db_num_rows($query2);

        $data_confidence = array();
        while($row1=$db_object->db_fetch_array($query2)){
            if($row1['status']==1){
            $data_confidence[] = $row1;
            }
        }
    ?>


    <?php
    $sql2 = "SELECT * FROM kesimpulan"
                . " WHERE id = ".$id_process
                . " AND from_itemset=2 "
                . " AND support_xUy = ( SELECT max(support_xUy) FROM kesimpulan)";
    $query2 = $db_object->db_query($sql2);
    $jmlh=$db_object->db_num_rows($query2);

        while($row1=$db_object->db_fetch_array($query2)){
            if($row1['status']==1){
            $data_confidence[] = $row1;
            }
        }
    ?>

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
                    }
                    $no++;
                }
                }
                ?>
            </table>

            <?php

    $sql2 = "SELECT conf.*, log.start_date, log.end_date
            FROM kesimpulan conf, riwayat log
            WHERE conf.id = '$id_process' "
                . " AND conf.id = log.id "
                . " AND conf.from_itemset=3 "
                . " AND conf.support_xUy = ( SELECT max(support_xUy) FROM kesimpulan)";
    $query2 = $db_object->db_query($sql2);
    $jmlh=$db_object->db_num_rows($query2);

        $data_confidence = array();
        while($row1=$db_object->db_fetch_array($query2)){
            if($row1['status']==1){
            $data_confidence[] = $row1;
            }
        }
    ?>


    <?php
    $sql2 = "SELECT conf.*, log.start_date, log.end_date 
            FROM kesimpulan conf, riwayat log
            WHERE conf.id = '$id_process' "
                . " AND conf.id = log.id "
                . " AND conf.from_itemset=2 "
                . " AND conf.support_xUy = ( SELECT max(support_xUy) FROM kesimpulan)";
    $query2 = $db_object->db_query($sql2);
    $jmlh=$db_object->db_num_rows($query2);

        while($row1=$db_object->db_fetch_array($query2)){
            if($row1['status']==1){
            $data_confidence[] = $row1;
            }
        }
    ?>

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
                    }
                    $no++;
                }
                }
                ?>
            </table>