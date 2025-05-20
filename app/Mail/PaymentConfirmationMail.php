<?php

namespace App\Mail;

use App\Models\Bill;
use App\Models\Payment;
use App\Services\PdfService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bill;
    public $patient;
    public $payment;
    public $tenant;
    public $domain;

    /**
     * Create a new message instance.
     */
    public function __construct(Bill $bill, Payment $payment)
    {
        $this->bill = $bill;
        $this->patient = $bill->patient;
        $this->payment = $payment;
        $this->tenant = tenant() ? tenant() : null;
        $this->domain = tenant() ? tenant()->domains->first()->domain : config('app.url');
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // Load necessary relationships
        $this->bill->load(['patient', 'service', 'payments.cashier']);
        
        // Generate PDF using our PdfService
        $pdfContent = PdfService::generateBillPdf($this->bill);
        
        $tenantName = $this->tenant ? $this->tenant->name : 'HospiBill';
        
        return $this->subject('Payment Confirmation for Bill #' . $this->bill->bill_number . ' from ' . $tenantName)
            ->view('emails.payment-confirmation')
            ->with([
                'bill' => $this->bill,
                'patient' => $this->patient,
                'payment' => $this->payment,
                'tenant' => $this->tenant,
                'domain' => $this->domain
            ])
            ->attachData($pdfContent, 'Updated_Bill_' . $this->bill->bill_number . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
} 