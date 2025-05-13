<?php

namespace App\Mail;

use App\Models\Bill;
use App\Services\PdfService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BillCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bill;
    public $patient;

    /**
     * Create a new message instance.
     */
    public function __construct(Bill $bill)
    {
        $this->bill = $bill;
        $this->patient = $bill->patient;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // Generate PDF using our PdfService
        $pdfContent = PdfService::generateBillPdf($this->bill);
        
        return $this->subject('Your Bill #' . $this->bill->bill_number)
            ->view('emails.bill-created')
            ->with([
                'bill' => $this->bill,
                'patient' => $this->patient,
            ])
            ->attachData($pdfContent, 'Bill_' . $this->bill->bill_number . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
} 