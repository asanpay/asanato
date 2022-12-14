<?php

namespace Apiato\Core\Generator\Commands;

use Apiato\Core\Generator\GeneratorCommand;
use Apiato\Core\Generator\Interfaces\ComponentsGenerator;
use Illuminate\Support\Pluralizer;
use Illuminate\Support\Str;

/**
 * Class ValueGenerator
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class ValueGenerator extends GeneratorCommand implements ComponentsGenerator
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'apiato:generate:value';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Value class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $fileType = 'Value';

    /**
     * The structure of the file path.
     *
     * @var string
     */
    protected $pathStructure = '{container-name}/Values/*';

    /**
     * The structure of the file name.
     *
     * @var string
     */
    protected $nameStructure = '{file-name}';

    /**
     * The name of the stub file.
     *
     * @var string
     */
    protected $stubName = 'value.stub';

    /**
     * User required/optional inputs expected to be passed while calling the command.
     * This is a replacement of the `getArguments` function "which reads whenever it's called".
     *
     * @var array
     */
    public $inputs = [
    ];

    /**
     * @return array
     */
    public function getUserInputs()
    {
        return [
            'path-parameters' => [
                'container-name' => $this->containerName,
            ],
            'stub-parameters' => [
                '_container-name' => Str::lower($this->containerName),
                'container-name'  => $this->containerName,
                'class-name'      => $this->fileName,
                'resource-key'    => strtolower(Pluralizer::plural($this->fileName)),
            ],
            'file-parameters' => [
                'file-name' => $this->fileName,
            ],
        ];
    }

    public function getDefaultFileName()
    {
        return 'DefaultValue';
    }
}
