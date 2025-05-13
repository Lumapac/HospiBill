<?php

namespace App\Services;

use App\Models\Bill;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService
{
    /**
     * Generate a PDF for a bill
     */
    public static function generateBillPdf(Bill $bill)
    {
        // Configure Dompdf options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'sans-serif');
        $options->set('isPhpEnabled', true);
        $options->set('isFontSubsettingEnabled', true);
        $options->set('defaultMediaType', 'print');
        $options->set('chroot', public_path());
        
        // Create new Dompdf instance
        $dompdf = new Dompdf($options);
        
        // Load HTML content from view
        $html = view('pdfs.bill', ['bill' => $bill])->render();
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html, 'UTF-8');
        
        // Set paper size to A4
        $dompdf->setPaper('A4', 'portrait');
        
        // Render the PDF
        $dompdf->render();
        
        // Return the generated PDF content
        return $dompdf->output();
    }
} 