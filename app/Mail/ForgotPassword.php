<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\ForgotPassword as forgot_password;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $forgotPassword;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(forgot_password $forgotPassword)
    {
        $this->forgotPassword = $forgotPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Şifre Sıfırlama!")->view('mails.forgot-password');
    }
}
