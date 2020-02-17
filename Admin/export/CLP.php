<?php
include_once "../../database.php";
include_once "../../fungsi.php";
include_once "fpdf16/fpdf.php";
$id_process = $_REQUEST['id'];
//object database class
$db_object = new database();



$sql_que = "SELECT
            conf.*, log.start_date, log.end_date
            FROM
             kesimpulan conf, riwayat `log`
            WHERE conf.id = '$id_process' "
            . " AND conf.id = log.id "
            . " AND conf.status=1 "
            . " ORDER BY conf.from_itemset DESC";

$db_query = $db_object->db_query($sql_que) or die("Query gagal");
//Variabel untuk iterasi
$i = 0;
//Mengambil nilai dari query database
while ($data = $db_object->db_fetch_array($db_query)) {
    $cell[$i][0] = price_format($data['confidence']);
    $cell[$i][1] = "Produk terlaris adalah ".$data['kombinasi1'].", dan ".$data['kombinasi2'] ;
    $i++;
}

//memulai pengaturan output PDF
class PDF extends FPDF {

    //untuk pengaturan header halaman
    function Header() {
        //Pengaturan Font Header
        $this->SetFont('Times', 'B', 14); //jenis font : Times New Romans, Bold, ukuran 14
        //untuk warna background Header
        $this->SetFillColor(255, 255, 255);
        //untuk warna text
        $this->SetTextColor(0, 0, 0);
        //Menampilkan tulisan di halaman
        //$this->Cell(25, 1, 'Laporan Hasil Analisa', '', 0, 'C', 1); //TBLR (untuk garis)=> B = Bottom,
        // L = Left, R = Right
        //untuk garis, C = center
    }

}

//pengaturan ukuran kertas P = Portrait
$pdf = new PDF('L', 'cm', 'A4');
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 14);
//Ln() = untuk pindah baris
$pdf->Cell(28, 1, 'Laporan Hasil Prediksi', 'LRTB', 0, 'C'); //TBLR (untuk garis)=> B = Bottom,
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(1, 1, 'No', 'LRTB', 0, 'C');
$pdf->Cell(23, 1, 'Kombinasi', 'LRTB', 0, 'C');
$pdf->Cell(4, 1, 'Confidence (%)', 'LRTB', 0, 'C');
$pdf->Ln();
$pdf->SetFont('Times', "", 10);
for ($j = 0; $j < $i; $j++) {
    //menampilkan data dari hasil query database
    $pdf->Cell(1, 1, $j + 1, 'LBTR', 0, 'C');
    $pdf->Cell(23, 1, $cell[$j][1] , 'LBTR', 0, 'L');
    $pdf->Cell(4, 1, $cell[$j][0], 'LBTR', 0, 'C');
    $pdf->Ln();
}

//menampilkan output berupa halaman PDF
$pdf->Output();
?>