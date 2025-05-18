<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TenantRejectionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tenant;
    public $reason;

    /**
     * Create a new message instance.
     */
    public function __construct($tenant, $reason = '')
    {
        $this->tenant = $tenant;
        $this->reason = $reason;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('Important: Update on Your HospiBill Application')
            ->view('emails.tenant-application-rejected')
            ->with([
                'tenant' => $this->tenant,
                'reason' => $this->reason,
            ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
} 