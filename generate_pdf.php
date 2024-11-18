<?php // add a new page for TOC
session_start();

// require('./fpdf/fpdf.php'); 

// $pdf = new FPDF('P', 'mm', 'A4');
// $pdf ->AddPage();
// $pdf->SetFont('arial', 'b',16);
// $pdf->Cell(300 , 5 ,'Liste des employees',1,1);
// // $pdf->Cell(59,5,'',0,1);
// $pdf->Output();

require('./fpdf/fpdf.php'); 

require("config.php");

class PDF extends FPDF {
    public $date;
	function Header(){
        $this->date = date("j/m/y");
		$this->SetFont('Arial','B',15);
		
		//dummy cell to put logo
		//$this->Cell(12,0,'',0,0);
		//is equivalent to:
		$this->Cell(12);
		
		//put logo
		$this->Image('logo.png',8,10,14);
		
		$this->Cell(130,13,'List des Employees',0,0);
		$this->Cell(100,13,'Fait le :' . ' '.$this->date,0,1);
		
		
		$this->Ln(5);
		$this->SetFont('Arial','B',11);
		$this->SetFillColor(180,180,255);
		$this->SetDrawColor(180,180,255);
		$this->Cell(40,5,'Matricule',1,0,'',true);
		$this->Cell(40,5,'Name',1,0,'',true);
		$this->Cell(40,5,'Prenom',1,0,'',true);
		$this->Cell(25,5,'Grade',1,0,'',true);
		$this->Cell(40,5,'Numero Telephone',1,1,'',true);
		
	}
	function Footer(){
		//add table's bottom line
		$this->Cell(185,0,'','T',1,'',true);
		
		//Go to 1.5 cm from bottom
		$this->SetY(-15);
				
		$this->SetFont('Arial','',8);
		
		//width = 0 means the cell is extended up to the right margin
		$this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
	}
}


class PDF_requests extends FPDF {
    public $date;
	function Header(){
        $this->date = date("j/m/y");
		$this->SetFont('Arial','B',15);
		
		//dummy cell to put logo
		//$this->Cell(12,0,'',0,0);
		//is equivalent to:
		$this->Cell(12);
		
		//put logo
		$this->Image('logo.png',8,10,14);
		
		$this->Cell(130,13,'List des Requetes	',0,0);
		$this->Cell(100,13,'Fait le :' . ' '.$this->date,0,1);
		
		
		$this->Ln(5);
		$this->SetFont('Arial','B',11);
		$this->SetFillColor(180,180,255);
		$this->SetDrawColor(180,180,255);
		$this->Cell(25,5,'ID Request',1,0,'',true);
		$this->Cell(20,5,'Matricule',1,0,'',true);
		$this->Cell(40,5,'Date de depart',1,0,'',true);
		$this->Cell(25,5,'Date de fin',1,0,'',true);
		$this->Cell(40,5,'Numero de jour',1,0,'',true);
		$this->Cell(40,5,'Status',1,1,'',true);
		
	}
	function Footer(){
		//add table's bottom line
		$this->Cell(190,0,'','T',1,'',true);
		
		//Go to 1.5 cm from bottom
		$this->SetY(-15);
				
		$this->SetFont('Arial','',8);
		
		//width = 0 means the cell is extended up to the right margin
		$this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
	}
}

if (isset($_SESSION['email']) && $_SESSION['email'] == "root" && $_GET["id_pdf"] == 1 && isset($_GET["id_pdf"]) ) {

$pdf = new PDF('P','mm','A4');

$pdf->AliasNbPages('{pages}');

$pdf->SetAutoPageBreak(true,15);
$pdf->AddPage();

$pdf->SetFont('Arial','',9);
$pdf->SetDrawColor(180,180,255);

$stm = $db->prepare("select matricule, name, prenom, grade, tel, adresse from employees");
$stm->execute();
$rslt = $stm->fetchAll(PDO::FETCH_ASSOC);

foreach ($rslt as $data) {
    $pdf->Cell(40, 5, $data["matricule"], 'LR', 0);
    $pdf->Cell(40, 5, $data["name"], 'LR', 0);
    $pdf->Cell(40, 5, $data["prenom"], 'LR', 0);
    $pdf->Cell(25, 5, $data["grade"], 'LR', 0);
    $pdf->Cell(40, 5, $data["tel"], 'LR', 1);
}

$pdf->Output(); }


else if (isset($_SESSION['email']) && $_SESSION['email'] == "root" && $_GET["id_pdf"] == 2 && isset($_GET["id_pdf"]) ) {

	$pdf = new PDF_requests('P','mm','A4');

	$pdf->AliasNbPages('{pages}');
	
	$pdf->SetAutoPageBreak(true,15);
	$pdf->AddPage();
	
	$pdf->SetFont('Arial','',9);
	$pdf->SetDrawColor(180,180,255);
	
	$stm = $db->prepare("select * from leave_requests");
	$stm->execute();
	$rslt = $stm->fetchAll(PDO::FETCH_ASSOC);
	
// print_r($_SESSION);

	foreach ($rslt as $data) { 
		$x =  diffDates($data["start_date"], $data["end_date"]);

		$pdf->Cell(25, 5, $data["id_request"], 'LR', 0);
		$pdf->Cell(20, 5, $data["employee_matricule"], 'LR', 0);
		$pdf->Cell(40, 5, $data["start_date"], 'LR', 0);
		$pdf->Cell(25, 5, $data["end_date"], 'LR', 0);
		$pdf->Cell(40, 5, $x, 'LR', 0);
		if ( $data["status"] == 1) {$x = "Confirme";
			$pdf->Cell(40, 5, $x, 'LR', 1);} else {$pdf->Cell(40, 5,'Non Confirme', 'LR', 1);  }
		
	}
	
	$pdf->Output();



}
?>