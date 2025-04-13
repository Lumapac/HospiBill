<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TenantCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $password;
    public $tenant;
    public $domain;

    /**
     * Create a new message instance.
     */
    public function __construct($password, $tenant, $domain)
    {
        $this->password = $password;
        $this->tenant = $tenant;
        $this->domain = $domain;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('Your Tenant Account Credentials')
            ->view('emails.tenant-generated-password')
            ->with([
                'password' => $this->password,
                'tenant' => $this->tenant,
                'domain' => $this->domain,
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
