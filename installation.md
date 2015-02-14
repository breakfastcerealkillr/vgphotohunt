# Installation Instructions

## 1) Clone Le Repo

    git clone git@github.com:erichowey/vgphotohunt.git

## 2) Get Composer

    curl -s https://getcomposer.org/installer | php

#### Windows
You will need to install composer for Windows from [here](https://github.com/composer/windows-setup/releases/)

## 3) Run Composer to install all dependencies within the repo directory

    php ../composer.phar install

Or if Composer is installed globally:

    composer install

## 4) Set up database connection

In ```config/app.php``` is where you set up the connection to your database. You will need to set up a username and password for the application to log in to with write permissions to its own database. A SQL dump will be the best method of generating the database for your development environment to use for now.
