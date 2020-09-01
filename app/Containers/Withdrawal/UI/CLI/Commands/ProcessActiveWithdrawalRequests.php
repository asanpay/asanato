<?php


namespace App\Containers\Withdrawal\UI\CLI\Commands;

use Illuminate\Console\Command;

class ProcessActiveWithdrawalRequests extends Command
{
    /**
     * @var string
     */
    protected $signature = 'withdrawal:process';

    /**
     * @var string
     */
    protected $description = 'Process withdrawal requests and transfer money to users bank account';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->error('NOT implemented yet. Should get transfer API from bank');
    }
}
