<?php

namespace Bajjouayoub\CustomCommands\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class CustomCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $command_name;

    protected $commands;

    protected $table;

    protected $row;

    protected $changeEnv;


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

        parent::__construct($this->signature = $this->command_name);

        $this->commands = (array) config("custom-commands.commands");
        
        $this->table = config("custom-commands.table");

        $this->row = config("custom-commands.row");

        $this->changeEnv = (boolean) config("custom-commands.change_env");

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $commands = $this->commands;


        if(! empty($commands)) {
            
            foreach($commands as $command) {
            
                Artisan::call($command);
            
            }

            if($this->changeEnv) {
                
                $key = "CLIENT_SECRET" ;

                $value = $this->row($this->row);
    
                $path = app()->environmentFilePath();
    
                $escaped = preg_quote('='.env($key), '/');
    
                file_put_contents($path, preg_replace(
                    
                    "/^{$key}{$escaped}/m",
                    
                    "{$key}={$value}",
                    
                    file_get_contents($path)
                ));
            }
            
    
            $this->info("The custom commands runs properly !");
        
        }else {
        
            $this->warn("You have no commands to run !");
        
        }
        
        

    }


    protected function row($row)
    {        
        return DB::table($this->table)->where('personal_access_client', 0)->first()->$row;
    }
}
