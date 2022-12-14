<?php

namespace App\Containers\Welcome\UI\CLI\Commands;

use App\Ship\Parents\Commands\ConsoleCommand;

/**
 * Class SayWelcomeCommand
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class SayWelcomeCommand extends ConsoleCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apiato:welcome';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Just saying welcome from a container.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        echo "Welcome to Apiato :)\n";
    }
}
