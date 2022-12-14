<?php

namespace App\Containers\Documentation\Tasks;

use App\Containers\Documentation\Traits\DocsGeneratorTrait;
use App\Ship\Parents\Tasks\Task;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Class GenerateAPIDocsTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GenerateAPIDocsTask extends Task
{
    use DocsGeneratorTrait;

    /**
     * @param $type
     * @param $console
     *
     * @return mixed
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     * @throws \Symfony\Component\Process\Exception\LogicException
     * @throws \Symfony\Component\Process\Exception\ProcessFailedException
     */
    public function run($type, $console)
    {
        $path = $this->getDocumentationPath($type);

        $command = [
            $this->getExecutable(),
            // executable parameters
            "-c",
            $this->getJsonFilePath($type),
            ...$this->getEndpointFiles($type),
            "-i",
            "app",
            "-o",
            $path
        ];

        $process = new Process($command);

        // execute the command
        $process->run();

        if (!$process->isSuccessful()) {
            $console->error('Error Output: ' . $process->getOutput());
            throw new ProcessFailedException($process);
        }

        // echo the output
        $console->info('[' . $type . '] ' . implode(' ', $command));
        $console->info('Output: ' . $process->getOutput());

        // return the past to that generated documentation
        return $this->getFullApiUrl($type);
    }
}
