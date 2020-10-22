<?php

namespace Chunpat\LumenApiStarterGenerator\Console;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputOption;

class ControllerMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        parent::handle();
    }
    
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = $this->option('all')
            ? '/stubs/controller.whole.stub'
            : '/stubs/controller.stub';
        return __DIR__ . $stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Controllers';
    }

    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param  string $name
     *
     * @return string
     */
    protected function buildClass($name)
    {
        $controllerNamespace = $this->getNamespace($name);

        $replace = [];

        $replace["use {$controllerNamespace}\Controller;\n"] = '';

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['all', 'a', InputOption::VALUE_NONE, 'Create the class even if the controller already exists'],
        ];
    }
}
