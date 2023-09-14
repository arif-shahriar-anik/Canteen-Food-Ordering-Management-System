<?php
require('fpdf.php');
$add=rand(1,100);
$myFile = "text/memo".$add.".txt";
/*Food Name', 'Order No', 'Price(total)','User Balance'*/
$fh = fopen($myFile, 'wb') or die("can't open file");
$stringData = $_GET['fname'].";".$_GET['price'].";".$_GET['amount'].";".$_GET['orderno'];
fwrite($fh, $stringData);
fclose($fh);
class PDF extends FPDF
{
// Load data
    function LoadData($file)
    {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach($lines as $line)
            $data[] = explode(';',trim($line));
        return $data;
    }

// Simple table
    function BasicTable($header, $data)
    {
        // Header
        foreach($header as $col)
            $this->Cell(40,7,$col,1);
        $this->Ln();
        // Data
        foreach($data as $row)
        {
            foreach($row as $col)
                $this->Cell(40,6,$col,1);
            $this->Ln();
        }
    }

}

$pdf = new PDF();
// Column headings
$header = array('Food Name', 'Price(total)','User Balance','Order Number');
// Data loading
$data = $pdf->LoadData($myFile);
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->BasicTable($header,$data);
/*$pdf->AddPage();*/
$fileName = 'pdf ' . $_GET['uname'] .$_GET['orderno'] .'.pdf';
$pdf->Output($fileName, 'D');
/*$pdf->Output();*/
?>