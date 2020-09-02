<?php

namespace App\Ship\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Tartan\Log\Facades\XLog;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     * @throws \Exception
     */
    public function __construct(string $number, string $message, int $lifetime = null)
    {
        $this->data = [
            'number'   => mobilify($number, '0'),
            'message'  => $message,
            'lifetime' => $lifetime,
        ];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!preg_match(config('regex.mobile_regex'), $this->data['number'])) {
            XLog::debug(sprintf('bypass sending mobile to %s number', $this->data['number']));
            return;
        }
        if (!empty($this->data['lifetime']) && time() > $this->data['lifetime']) {
            XLog::debug(sprintf('bypass sending mobile to %s number', $this->data['number']));
            return;
        }
        resolve('iraniansms')->make()->send($this->data['number'], $this->data['message']);
    }
}
