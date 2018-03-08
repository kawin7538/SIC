<?php session_start(); ?>
<?php
	date_default_timezone_set('UTC');
    $club = $_SESSION['club'] = $_GET['club'];
    //require 'sic_sql_config.php';

    // convert in PDF
    require_once('html2pdf_v4.03/html2pdf.class.php');

    ob_start();
    include 'preprint2_club.php';
    $content = ob_get_clean();

    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 3);
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output($club.'.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
