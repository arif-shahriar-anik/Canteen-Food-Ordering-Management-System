<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 11/27/2018
 * Time: 10:55 AM
 */
require('fpdf.php');
 $myFile=$_GET['id'];
 echo $myFile;
/* $search = 'text/';
 $myFile = str_replace($search, '', $name);*/
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
$header = array('Email(except @)','Food Name', 'Price(total)','Order Number');
// Data loading
$data = $pdf->LoadData($myFile);
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->BasicTable($header,$data);
/*$pdf->AddPage();*/
$name=str_replace('.txt','',$myFile);
$fileName = 'pdf ' .$name.'.pdf';
$pdf->Output($fileName, 'D');
/*$pdf->Output();*/
?>