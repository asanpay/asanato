<?php

namespace Apiato\Core\Commands;

use Apiato\Core\Foundation\Apiato;
use App\Ship\Parents\Commands\ConsoleCommand;

/**
 * Class GetApiatoVersionCommand
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class GetApiatoVersionCommand extends ConsoleCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "apiato";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Display the current Apiato version.";

    /**
     * GetApiatoVersionCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Handle the command
     */
    public function handle()
    {
        $this->info(Apiato::VERSION);
    }
}
