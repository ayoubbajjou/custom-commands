<?php

namespace Bajjouayoub\CustomCommands\Commands;

use Illuminate\Console\Command;

class CustomCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    public $command_name;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Laravel package help to manage multiple commands in one command line.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->command_name = config("custom-commands.command_name");

        parent::__construct($this->signature = $this->command_name.':pull');

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Artisan::call('config:clear');
        // Artisan::call('migrate:refresh');
        // Artisan::call('db:seed');
        // Artisan::call('passport:install');

        $this->info("The Custom Commands runs properly !");

    }
}
