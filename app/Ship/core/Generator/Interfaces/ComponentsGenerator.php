<?php

namespace Apiato\Core\Generator\Interfaces;

/**
 * Class ComponentsGenerator
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
interface ComponentsGenerator
{

    /**
     * Reads all data for the component to be generated (as well as the mappings for path, file and stubs)
     *
     * @return mixed
     */
    public function getUserInputs();
}
