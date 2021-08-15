<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Composer's auto-loading functionality
require "vendor/autoload.php";

use Dompdf\Dompdf;

class PdfGenerator {
	public function generate($html, $filename) {
		define('DOMPDF_ENABLE_AUTOLOAD', false);

		$dompdf = new DOMPDF();
		$dompdf->loadHtml($html);
		$dompdf->render();
		$dompdf->stream($filename.'.pdf',array("Attachment"=>0));
	}
}