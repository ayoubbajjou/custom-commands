#download the package

composer require bajjouayoub/custom-commands

#register the package in services provider at config/app.php

Bajjouayoub\CustomCommands\CustomCommandsServiceProvider::class


#publish the configuration file

php artisan vendor:publish --tag="custom-commands"
