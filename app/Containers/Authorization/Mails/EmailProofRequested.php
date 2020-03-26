<?php

namespace App\Containers\Authorization\Mails;

use App\Containers\Authorization\Models\OtpToken;
use App\Containers\User\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailProofRequested extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var  \App\Containers\Authorization\Models\OtpToken
     */
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
            ->with([
                'token' => $this->otpToken->token,
            ]);
    }
}
