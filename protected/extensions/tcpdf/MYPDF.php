<?php
//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
//require_once('ETcPdf.php');
require_once(dirname(__FILE__).'/tcpdf/tcpdf.php');

// Extend the TCPDF class to create custom Header and Footer
//class MYPDF extends ETcPdf {
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo
//		$image_file = 'logo_example.jpg';
//		$this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('helvetica', 'B', 20);
		// Title
//		$this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-2.5);
		// Set font
		$this->SetFont('helvetica', 'I', 9);
		// Page number
                 $str ='<table style="color:#66A3BC; width:100%;"><tbody><tr>'
                        . '<td><div>Cherrytours GmbH<br>Mittelstr. 30<br>10117 Berlin</div></td>'
                        . '<td><div>Geschäftsleitung:<br>Marina Kuranova,<br>Christian Zeitsch</div></td>'
                        . '<td><div>HRB Nr: 183404<br>USt-IDNr: DE304401873<br>SteuerNr: 1130/251/50018</div></td>'
                        . '<td><div>Commerzbank<br>IBAN DE59 8204 0000 0815 1367 00<br>BIC COBADEFFXXX</div></td>'
                        . '</tr></tbody></table>';
                $this->writeHTMLCell(0, 0, '', '', $str, 0, 1, 0, true, '', true);
             
 
	}
}