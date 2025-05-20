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
    public $tenant;
    public $domain;

    /**
     * Create a new message instance.
     */
    public function __construct(Bill $bill)
    {
        $this->bill = $bill;
        $this->patient = $bill->patient;
        $this->tenant = tenant() ? tenant() : null;
        $this->domain = tenant() ? tenant()->domains->first()->domain : config('app.url');
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // Generate PDF using our PdfService
        $pdfContent = PdfService::generateBillPdf($this->bill);
        
        $tenantName = $this->tenant ? $this->tenant->name : 'HospiBill';
        
        return $this->subject('Your Bill #' . $this->bill->bill_number . ' from ' . $tenantName)
            ->view('emails.bill-created')
            ->with([
                'bill' => $this->bill,
                'patient' => $this->patient,
                'tenant' => $this->tenant,
                'domain' => $this->domain
            ])
            ->attachData($pdfContent, 'Bill_' . $this->bill->bill_number . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
} 