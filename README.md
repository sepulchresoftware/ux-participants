#participants
A simple Laravel system for managing potential participants in a UX study.

**This system is a WIP; clone at your own risk**

##Installation Requirements
This system was written with LAMP, WAMP, and MAMP in mind.

- WAMP: http://www.wampserver.com/en/
- MAMP: http://www.mamp.info/en/
- LAMP: http://en.wikipedia.org/wiki/LAMP_(software_bundle)#External_links

**NOTE:** Please do not use MAMP for Windows with this system. As of this time (January 29, 2015) it has a weird problem with the LDAP module for some reason.

Below are the basic requirements for installation of this system:

- LAMP, MAMP, or WAMP installed
- Composer (https://getcomposer.org)
- Apache mod_rewrite enabled
- PHP LDAP module (http://php.net/manual/en/book.ldap.php)
- PHP Mcrypt module (http://php.net/manual/en/book.mcrypt.php)

##Installation Steps
1. Run `composer install` in the directory you installed the project.
2. Rename `env.example.php` to `env.php` and modify the config values to match your environment.
3. Run `php artisan migrate` to run the DB migrations
4. Run `php artisan db:seed` to seed the DB
5. ???
6. Profit