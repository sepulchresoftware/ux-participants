#participants
A simple Laravel system for managing potential participants in a UX study.

**This system is a WIP; clone at your own risk**

##Releases

- [UX Participants 1.0.0 (February 8, 2015)](https://github.com/SepulchreSoftware-Matt/participants/releases/tag/v1.0.0)

##Installation Requirements
This system was written with LAMP, WAMP, and MAMP in mind.

- WAMP: http://www.wampserver.com/en/
- MAMP: http://www.mamp.info/en/
- LAMP: http://en.wikipedia.org/wiki/LAMP_(software_bundle)#External_links

**NOTE:** Please do not use MAMP for Windows with this system. As of this time (January 29, 2015) it has a weird problem with the LDAP module for some reason.

Below are the basic requirements for installation of this system:

- LAMP, MAMP, or WAMP installed
- PHP version 5.4+ should work fine but the system was developed on 5.5.18
- Composer (https://getcomposer.org)
- Apache mod_rewrite enabled
- PHP LDAP module (http://php.net/manual/en/book.ldap.php)
- PHP Mcrypt module (http://php.net/manual/en/book.mcrypt.php)

##Installation Steps
1. Run `composer install` in the directory you installed the project.
2. Rename `env.example.php` to `env.php` and modify the config values to match your environment.
3. Run `php artisan migrate --seed` to run the migrations and seed the DB
4. ???
5. Profit

##Change Log

###1.0.0

- Implemented authentication and authorization
- LDAP auth as primary method with local DB auth as backup
- Participant full list of studies
- Participant submission of available time slots per study
- Participant view of all associated studies
- Participant profile view
- Admin creation of studies to allow participation
- Admin editing, deletion, locking, and unlocking of existing studies
- Admin view all available and confirmed time slots per study on a basic calendar
- Admin confirm participant time slots per study