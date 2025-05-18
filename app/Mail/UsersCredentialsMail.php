<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UsersCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $password;
    public $user;
    public $tenant;
    public $domain;

    /**
     * Create a new message instance.
     */
    public function __construct($password, $user)
    {
        $this->password = $password;
        $this->user = $user;
        $this->tenant = tenant() ? tenant() : null;
        $this->domain = tenant() ? tenant()->domains->first()->domain : config('app.url');
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        $tenantName = $this->tenant ? $this->tenant->name : 'HospiBill';
        
        return $this->subject("Welcome to {$tenantName} - Your Account Credentials")
            ->view('emails.user-generated-password')
            ->with([
                'password' => $this->password,
                'user' => $this->user,
                'tenant' => $this->tenant,
                'domain' => $this->domain
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
