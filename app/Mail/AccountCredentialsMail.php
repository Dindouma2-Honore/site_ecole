<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $recipientName,
        public string $email,
        public string $password,
        public string $role,
        public ?string $matricule = null,
    ) {}

    public function build()
    {
        return $this->subject('Vos identifiants de connexion - Ambassadors International School')
            ->view('emails.credentials');
    }
}
