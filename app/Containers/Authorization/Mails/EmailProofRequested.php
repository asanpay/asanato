<?php

namespace App\Containers\Authorization\Mails;

use App\Containers\Otp\Models\OtpToken;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailProofRequested extends Mailable
{
    use Queueable, SerializesModels;

    protected $otpToken;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(OtpToken $otpToken)
    {
        $this->otpToken = $otpToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('authorization::authz-emailproof-requested')
            ->to($this->otpToken->to)
            ->with(
                [
                'token' => $this->otpToken->token,
                ]
            );
    }
}
