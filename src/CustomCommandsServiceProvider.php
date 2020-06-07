<?php

namespace Bajjouayoub\CustomCommands;

use Illuminate\Support\ServiceProvider;
use Bajjouayoub\CustomCommands\Commands\CustomCommands;

class CustomCommandsServiceProvider extends ServiceProvider 
{

    public function boot() 
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CustomCommands::class,
            ]);
        }

        $this->mergeConfigFrom(
            __DIR__.'/config/custom-commands.php', 'custom-commands'
        );

        $this->publishes([
            __DIR__.'/config/custom-commands.php' => config_path('custom-commands.php')
        ]);
    }


    public function register()
    {

    }

}



