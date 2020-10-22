<?php

namespace Chunpat\LumenApiStarterGenerator;

use Illuminate\Support\Composer;
use Illuminate\Support\ServiceProvider;

class LumenGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        'KeyGenerate' => 'command.key.generate',
        'Tinker' => 'command.tinker',
        'RouteList' => 'command.route.list',
        'ClearCompiled' => 'command.clear.compiled',
        'Optimize' => 'command.optimize',
        'FactoryMake' => 'command.factory.make',
    ];

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $devCommands = [
        'ConsoleMake' => 'command.console.make',
        'ControllerMake' => 'command.controller.make',
        'ServiceMake' => 'command.service.make',
        'CriteriaMake' => 'command.criteria.make',
        'EloquentMake' => 'command.eloquent.make',
        'PresenterMake' => 'command.presenter.make',
        'TransformerMake' => 'command.transformer.make',
        'RepositoryMake' => 'command.repositories.make',
        'ResourceMake' => 'command.resource.make',
        'ModelMake' => 'command.model.make',
        'ValidatorMake' => 'command.validator.make',
        'EventMake' => 'command.event.make',
        'ExceptionMake' => 'command.exception.make',
        'RequestMake' => 'command.request.make',
        'JobMake' => 'command.job.make',
        'PipeMake' => 'command.pipe.make',
        'PolicyMake' => 'command.policy.make',
        'ProviderMake' => 'command.provider.make',
        'Serve' => 'command.serve',
        'TestMake' => 'command.test.make',
        'NotificationMake' => 'command.notification.make',
        'NotificationTable' => 'command.notification.table',
        'ChannelMake' => 'command.channel.make',
    ];

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerCommands($this->commands);
        $this->registerCommands($this->devCommands);
    }

    /**
     * Register the given commands.
     *
     * @param array $commands
     */
    protected function registerCommands(array $commands)
    {
        foreach (array_keys($commands) as $command) {
            $method = "register{$command}Command";

            call_user_func_array([$this, $method], []);
        }

        $this->commands(array_values($commands));
    }

    /**
     * Register the command.
     */
    protected function registerRouteListCommand()
    {
        $this->app->singleton('command.route.list', function ($app) {
            return new Console\RouteListCommand();
        });
    }

    /**
     * Register the command.
     */
    protected function registerTinkerCommand()
    {
        $this->app->singleton('command.tinker', function ($app) {
            return new Console\TinkerCommand();
        });
    }

    /**
     * Register the command.
     */
    protected function registerClearCompiledCommand()
    {
        $this->app->singleton('command.clear.compiled', function ($app) {
            return new Console\ClearCompiledCommand();
        });
    }

    /**
     * Register the command.
     */
    protected function registerOptimizeCommand()
    {
        $this->app->singleton('command.optimize', function ($app) {
            $app->configure('compile');

            $app['config']->set('optimizer', require_once(__DIR__.'/config/optimizer.php'));

            return new Console\OptimizeCommand(new Composer($app['files']));
        });
    }

    /**
     * Register the command.
     */
    protected function registerConsoleMakeCommand()
    {
        $this->app->singleton('command.console.make', function ($app) {
            return new Console\ConsoleMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerControllerMakeCommand()
    {
        $this->app->singleton('command.controller.make', function ($app) {
            return new Console\ControllerMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerServiceMakeCommand()
    {
        $this->app->singleton('command.service.make', function ($app) {
            return new Console\ServiceMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerCriteriaMakeCommand()
    {
        $this->app->singleton('command.criteria.make', function ($app) {
            return new Console\CriteriaMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerEloquentMakeCommand()
    {
        $this->app->singleton('command.eloquent.make', function ($app) {
            return new Console\EloquentMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerPresenterMakeCommand()
    {
        $this->app->singleton('command.presenter.make', function ($app) {
            return new Console\PresenterMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerTransformerMakeCommand()
    {
        $this->app->singleton('command.transformer.make', function ($app) {
            return new Console\TransformerMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerRepositoryMakeCommand()
    {
        $this->app->singleton('command.repositories.make', function ($app) {
            return new Console\RepositoryMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerEventMakeCommand()
    {
        $this->app->singleton('command.event.make', function ($app) {
            return new Console\EventMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerExceptionMakeCommand()
    {
        $this->app->singleton('command.exception.make', function ($app) {
            return new Console\ExceptionMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerFactoryMakeCommand()
    {
        $this->app->singleton('command.factory.make', function ($app) {
            return new Console\FactoryMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerJobMakeCommand()
    {
        $this->app->singleton('command.job.make', function ($app) {
            return new Console\JobMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerKeyGenerateCommand()
    {
        $this->app->singleton('command.key.generate', function () {
            return new Console\KeyGenerateCommand();
        });
    }

    /**
     * Register the command.
     */
    protected function registerRequestMakeCommand()
    {
        $this->app->singleton('command.request.make', function ($app) {
            return new Console\RequestMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerPipeMakeCommand()
    {
        $this->app->singleton('command.pipe.make', function ($app) {
            return new Console\PipeMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerModelMakeCommand()
    {
        $this->app->singleton('command.model.make', function ($app) {
            return new Console\ModelMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerProviderMakeCommand()
    {
        $this->app->singleton('command.provider.make', function ($app) {
            return new Console\ProviderMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerSeederMakeCommand()
    {
        $this->app->singleton('command.seeder.make', function ($app) {
            return new Console\SeederMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerServeCommand()
    {
        $this->app->singleton('command.serve', function () {
            return new Console\ServeCommand();
        });
    }

    /**
     * Register the command.
     */
    protected function registerTestMakeCommand()
    {
        $this->app->singleton('command.test.make', function ($app) {
            return new Console\TestMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerResourceMakeCommand()
    {
        $this->app->singleton('command.resource.make', function ($app) {
            return new Console\ResourceMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerValidatorMakeCommand()
    {
        $this->app->singleton('command.validator.make', function ($app) {
            return new Console\ValidatorMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerPolicyMakeCommand()
    {
        $this->app->singleton('command.policy.make', function ($app) {
            return new Console\PolicyMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerNotificationTableCommand()
    {
        $this->app->singleton('command.notification.table', function ($app) {
            return new Console\NotificationTableCommand($app['files'], $app['composer']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerNotificationMakeCommand()
    {
        $this->app->singleton('command.notification.make', function ($app) {
            return new Console\NotificationMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     */
    protected function registerChannelMakeCommand()
    {
        $this->app->singleton('command.channel.make', function ($app) {
            return new Console\ChannelMakeCommand($app['files']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        if ($this->app->environment('production')) {
            return array_values($this->commands);
        } else {
            return array_merge(array_values($this->commands), array_values($this->devCommands));
        }
    }
}
