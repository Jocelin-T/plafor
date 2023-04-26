# Plafor

Web application to manage course plans of students in computer science CFC.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

This project is developed on a LAMP server with PHP 7.4 and MariaDB 10.4.
It is based on the CodeIgniter 4.x framework.

### Installing

1. Download [our latest release](https://github.com/OrifInformatique/plafor/releases/tag/v4.0.1)
2. Unzip your download in your project's directory (in your local PHP server)
3. Create a new empty database ``plafor`` (using phpMyAdmin)
4. Rename env file to .env and adapt it for your server's parameters
5. Update .env file to set the environment to 'development' 
6. Update .env file to set the default and test database connections
7. To initialize the database (migrations and seeds), navigate to this URL ``http://localhost/plafor/public/migration`` (This step requires a password. Ask for it to an administrator.)

### Unit Testing
1. Download and install [Composer](https://getcomposer.org/download/)
2. From the project root (the directory that contains the application and system directories) type the following from the command line: ``composer update``
3. From the project root run unit tests typing the following from the command line : ``vendor\bin\phpunit``

## Code Coverage
1. From the project root type the following from the command line : ``composer require --dev phpunit/php-code-coverage``
2. Download Xdebug (version 3.1.6 which is compatible with PHP 7.4) from this URL ``https://xdebug.org/download/historical``
3. Move the downloaded file to ``C:\xampp\php7433\ext``, and rename it to ``php_xdebug.dll``
4. Update ``C:\xampp\php7433\php.ini`` and add the lines: ``zend_extension = xdebug`` and ``xdebug.mode = coverage``
5. Restart the Apache Webserver
6. Run the unit tests (see point 3 Unit Testing)

## Built With

* [CodeIgniter 4.x](https://www.codeigniter.com/) - PHP framework
* [Bootstrap](https://getbootstrap.com/) - Design library with personalized css
* [ReactJS v17.0.2](https://fr.reactjs.org/) - Design Library to add simple interactivity

## Authors

* **Orif, domaine informatique** - *Initiating and following the project* - [GitHub account](https://github.com/OrifInformatique)

See also the list of [contributors](https://github.com/OrifInformatique/plafor/contributors) who participated in this project.
