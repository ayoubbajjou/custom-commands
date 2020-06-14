# Larave Custom Commands Package


[!Github issues](https://img.shields.io/github/issues/ayoubbajjou/custom-commands)
[![Software License](	https://img.shields.io/github/license/ayoubbajjou/custom-commands)]()

This Laravel package help to manage multiple commands in one command line, and this package is recomended if 
you are using Laravel Passport .

## Installation

Begin by installing the package through Composer. Run the following command in your terminal:

```bash
composer require bajjouayoub/custom-commands
```

Then publish the config file:

```
php artisan vendor:publish --provider="Bajjouayoub\CustomCommands\CustomCommandsServiceProvider"
```

## How it works

First of all, go to the `config` folder and the look for `custom-commands.php`

### Specify the name of the command

```
"command_name" => "command:name"  

Output :

php artisan command:name

```

### Add all the commands that you want to run at once

Note: those commands should be type of `string`

```
"commands" => [
    // 'config:clear'
    // 'migrate:refresh'
    // 'db:seed'
    // 'passport:install'
    ...
]
```

### Change something on the .env file (optional)

if you need to change some variable in the .env file change the variable to `true` by default it's `false`

```
"change_env" => true
```

### Table and row name

if you change the `change_env` to `true` then those fields is required.
the `table` variable is refers to the `oauth_clients` this table comes with `laravel passport` by default.
the `row` variable is refers to the `secret` row in the `oauth_clients` table.

```
"table" => "" //type of string


"row" => "" //type of string
```

