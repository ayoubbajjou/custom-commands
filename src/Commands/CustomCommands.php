<?php

namespace Bajjouayoub\CustomCommands\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class CustomCommands extends Command
{
    
    /**
     * The Command name ex: php artisan "command:name"
     *
     * @var string
     */
    protected $command_name;
    
    /**
     * List of commands that runs by this command
     *
     * @var array
     */
    protected $commands;
    
    /**
     * The name of the table by default is "oauth_token"
     *
     * @var string
     */
    protected $table;
    
    /**
     * The name of the row in the table
     *
     * @var string
     */
    protected $row;
    
    /**
     * The variable will change in the .env file 
     *
     * @var bool
     */
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
                
                $this->change_variable($this->value(), $this->escaped());

            }
    
            $this->success();
        
        }else {
        
            $this->warning();
        
        }

    }
    
    /**
     * Preg the key variable in the .env file
     *
     * @return void
     */
    protected function escaped()
    {
        return preg_quote('='.env($this->key()), '/');
    }
    
    /**
     * The value returned from the row in the table
     *
     * @return void
     */
    protected function value()
    {
        return $this->row($this->row);
    }
    
    /**
     * The success message that returned after the commands run successfully
     *
     * @return string
     */
    protected function success()
    {
        return $this->info("The custom commands runs properly !");
    }
    
    /**
     * The warning message that returned if something wrong
     *
     * @return string
     */
    protected function warning()
    {
        return $this->warn("You have no commands to run !");
    }
    
    /**
     * The variable that who will change in the .env file
     *
     * @return string
     */
    protected function key()
    {
        return "CLIENT_SECRET";
    }
        
    
    /**
     * Change the variable in the .env file
     *
     * @param  mixed $value
     * @param  mixed $escaped
     * @return void
     */
    protected function change_variable($value, $escaped)
    {
        return file_put_contents($this->path(), preg_replace(
            
                    "/^{$this->key()}{$escaped}/m",
                    
                    "{$this->key()}={$value}",
                    
                    file_get_contents($this->path())
                )
            );
    }

    
    /**
     * The .env path in the project
     *
     * @return void
     */
    protected function path()
    {
       return app()->environmentFilePath();
    }

    /**
     * Get the value from the row in the table specified
     *
     * @param  string $row
     * @return void
     */
    protected function row($row)
    {        
        return DB::table($this->table)
                    ->where('personal_access_client', 0)
                    ->first()
                    ->$row;
    }
}
