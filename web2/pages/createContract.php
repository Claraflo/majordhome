<?php
require('../lib/fpdf.php');

if (count($_POST) == 7 
	&& !empty($_POST['lastname'])
	&& !empty($_POST['firstname'])
	&& !empty($_POST['profession'])
	&& !empty($_POST['address'])
	&& !empty($_POST['city'])
	&& !empty($_POST['code'])
	&& !empty($_POST['days']))

 {



$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$profession = $_POST['profession'];
$address = $_POST['address'];
$city = $_POST['city'];
$code = $_POST['code'];
$days = $_POST['days'];

$date = date('d/m/Y');


class PDF extends FPDF
    {

        function Header()
        {
            // Logo
            $this->Image('../img/majordhome.png', 10, 6, 30);
            // Police Arial gras 15
            $this->SetFont('Arial', 'B', 15);
            // Décalage à droite
            $this->Cell(80);
            // Titre
            $this->SetDrawColor(170, 149, 111);
            $this->Cell(50, 10, 'Contrat de travail', 1, 0, 'C');
            // Saut de ligne
            $this->Ln(20);
        }


        function Footer()
        {
            $this->SetFont('Arial', 'I', 8);
            // Positionnement à 3,0 cm du bas
            $this->SetY(-20);
            //Droit entreprise
            $this->Cell(190, 10, 'Entreprise de HomeService Majord\'home - Siege social PARIS', 0, 0, 'C');
            // Positionnement à 1,5 cm du bas
            $this->SetY(-15);
            // Police Arial italique 8
            $this->SetFont('Arial', 'I', 8);
            // Numéro de page
            $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
        }

      
}
    //Creation of pdf
    $pdf = new pdf();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 14);
    $pdf->ln(20);
    $pdf->SetDrawColor(170, 149, 111);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(100, 20, $lastname . ' ' . $firstname, 0, 0, 'L');
    $pdf->ln(5);
    $pdf->Cell(100, 20, $address, 0, 0, 'L');
    $pdf->ln(5);
    $pdf->Cell(100, 20, $code . " " .$city, 0, 0, 'L');
    $pdf->Cell(100, 20, 'Date  : ' . $date, 0, 0, 'C');
    $pdf->ln(30);
    $pdf->Cell(100, 20, 'Profession : ' . $profession , 0, 0, 'L');
    $pdf->ln(5);
    $pdf->Cell(100, 20, 'Duree du contrat : ' . $days . " ans" , 0, 0, 'L');
    $pdf->ln(50);


    $pdf->Cell(100, 20, "[  ] J'accepte le contrat" , 0, 0, 'L');
    $pdf->ln(10);
    $pdf->Cell(100, 20, "[  ] Je refuse le contrat" , 0, 0, 'L');
    $pdf->ln(30);
    $pdf->SetX(-100);


    $pdf->Cell(80, 20, 'Date et signature : ', 0, 0, 'C');

    // file name
 

    // Download of pdf (parameter D, diplay = I)
    $pdf->Output('Contrat.pdf', 'I');





}