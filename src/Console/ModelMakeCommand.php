<?php

namespace Chunpat\LumenApiStarterGenerator\Console;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class ModelMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->option('all')) {
            $this->input->setOption('controller', true);
            $this->input->setOption('service', true);
            $this->input->setOption('resource', true);
            $this->input->setOption('criteria', true);
            $this->input->setOption('presenter', true);
            $this->input->setOption('eloquent', true);
            $this->input->setOption('repositories', true);
            $this->input->setOption('transformer', true);
            $this->input->setOption('validator', true);
        }

        if ($this->option('controller')) {
            $this->createController();
            $this->createService();
            $this->createResource();
        }

        if ($this->option('service')) {
            $this->createCriteria();
            $this->createPresenter();
            $this->createEloquent();
        }

        if($this->option('eloquent')){
            $this->createRepository();
            $this->createValidator();
        }

        if($this->option('transformer')){
            $this->createTransformer();
        }

        $this->createMigration();

        parent::handle();
    }

    /**
     * Create a model factory for the model.
     *
     * @return void
     */
    protected function createFactory()
    {
        $factory = Str::studly(class_basename($this->argument('name')));
        $this->call('make:factory', [
            'name' => "{$factory}Factory",
            '--model' => $this->qualifyClass($this->getNameInput()),
        ]);
    }

    /**
     * Create a migration file for the model.
     *
     * @return void
     */
    protected function createMigration()
    {
        $table = Str::snake(Str::pluralStudly(class_basename($this->argument('name'))));

        $this->call('make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
        ]);
    }

    /**
     * Create a seeder file for the model.
     *
     * @return void
     */
    protected function createSeeder()
    {
        $seeder = Str::studly(class_basename($this->argument('name')));

        $this->call('make:seed', [
            'name' => "{$seeder}Seeder",
        ]);
    }

    /**
     * Create a controller for the model.
     *
     * @return void
     */
    protected function createController()
    {
        $controller = Str::studly(class_basename($this->argument('name')));

        $modelName = $this->qualifyClass($this->getNameInput());

        $this->call('make:controller', array_filter([
            'name' => "{$controller}",
            '-a' => $this->option('controller'),
        ]));
    }

    /**
     * Create a service for the controller.
     *
     * @return void
     */
    protected function createService()
    {
        $service = Str::studly(class_basename($this->argument('name')));

        $modelName = $this->qualifyClass($this->getNameInput());

        $this->call('make:service', array_filter([
            'name' => "{$service}",
            '-a' => $this->option('service'),
        ]));
    }

    /**
     * Create a controller for the controller.
     *
     * @return void
     */
    protected function createResource()
    {
        $resource = Str::studly(class_basename($this->argument('name')));

        $modelName = $this->qualifyClass($this->getNameInput());

        $this->call('make:resource', array_filter([
            'name' => "{$resource}",
            '-a' => $this->option('resource'),
        ]));
    }

    /**
     * Create a controller for the service.
     *
     * @return void
     */
    protected function createCriteria()
    {
        $criteria = Str::studly(class_basename($this->argument('name')));

        $modelName = $this->qualifyClass($this->getNameInput());

        $this->call('make:criteria', array_filter([
            'name' => "{$criteria}"
        ]));
    }

    /**
     * Create a controller for the service.
     *
     * @return void
     */
    protected function createPresenter()
    {
        $presenter = Str::studly(class_basename($this->argument('name')));

        $modelName = $this->qualifyClass($this->getNameInput());

        $this->call('make:presenter', array_filter([
            'name' => "{$presenter}"
        ]));
    }

    /**
     * Create a controller for the service.
     *
     * @return void
     */
    protected function createEloquent()
    {
        $eloquent = Str::studly(class_basename($this->argument('name')));

        $modelName = $this->qualifyClass($this->getNameInput());

        $this->call('make:eloquent', array_filter([
            'name' => "{$eloquent}"
        ]));
    }

    /**
     * Create a controller for the eloquent.
     *
     * @return void
     */
    protected function createRepository()
    {
        $eloquent = Str::studly(class_basename($this->argument('name')));

        $modelName = $this->qualifyClass($this->getNameInput());

        $this->call('make:repositories', array_filter([
            'name' => "{$eloquent}"
        ]));
    }

    /**
     * Create a controller for the presenter.
     *
     * @return void
     */
    protected function createTransformer()
    {
        $transformer = Str::studly(class_basename($this->argument('name')));

        $modelName = $this->qualifyClass($this->getNameInput());

        $this->call('make:transformer', array_filter([
            'name' => "{$transformer}"
        ]));
    }

    /**
     * Create a controller for the eloquent.
     *
     * @return void
     */
    protected function createValidator()
    {
        $validator = Str::studly(class_basename($this->argument('name')));

        $modelName = $this->qualifyClass($this->getNameInput());

        $this->call('make:validator', array_filter([
            'name' => "{$validator}"
        ]));
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = $this->option('all')
            ? '/stubs/model.whole.stub'
            : '/stubs/model.stub';

        return __DIR__ . $stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Repositories\Models';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['all', 'a', InputOption::VALUE_NONE, 'Generate a migration, seeder, factory, and resource controller for the model'],
            ['controller', 'co', InputOption::VALUE_NONE, 'Generate a controller, service, resource'],
            ['service', 's', InputOption::VALUE_NONE, 'Generate a service,resource,criteria,presenter,eloquent'],
            ['resource', 'res', InputOption::VALUE_NONE, 'Generate a resource'],
            ['criteria', 'cr', InputOption::VALUE_NONE, 'Generate a criteria'],
            ['presenter', 'p', InputOption::VALUE_NONE, 'Generate a presenter'],
            ['eloquent', 'e', InputOption::VALUE_NONE, 'Generate a eloquent'],
            ['repositories', 'rep', InputOption::VALUE_NONE, 'Generate a repository'],
            ['transformer', 't', InputOption::VALUE_NONE, 'Generate a transformer'],
            ['validator', 'va', InputOption::VALUE_NONE, 'Generate a validator'],
        ];
    }
}
