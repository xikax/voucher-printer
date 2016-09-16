<?php
require('fpdf/fpdf.php');


class PDF extends FPDF
{
// Load data
function LoadData($file)
{
	
    $data = file($file);
    $data = preg_replace('/"/','', $data);
    return $data;
}

// Simple table
function BasicTable($data, $start, $count)
{
	for($i=$start; $i<count($data)-(count($data)-($start+$count)); $i++) 
		{
        	$this->Cell(80,15,$data[$i],1,0,'C');
        	$this->Ln();
    		}	
	}
}

if($_POST['weeks'] == 1)
	{
	$file = 'vouchers1.csv';
	$output = 'start_vr1.txt';	
	}
else
	{
	$file = 'vouchers2.csv';
	$output = 'start_vr2.txt';
	}

$count = $_POST['count'];

$start = file_get_contents($output);
if($start < 7)
	{
	$start = 7;
	}

$pdf = new PDF();
$data = $pdf->LoadData($file);
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->BasicTable($data,$start,$count);

if($start + $count > count($data))
	{
	echo 'A new Wifi Ticketroll needs to be generated.';
	}
else
	{
	$start = $start + $count;
	file_put_contents($output, $start);
	$pdf->Output();
	}
?>
