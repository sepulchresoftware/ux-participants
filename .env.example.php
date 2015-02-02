<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */
    'DEBUG'                    => true,

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */
    'TIMEZONE'                 => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Database Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration parameters for the database driver. By default, mysql is
    | assumed as the desired host.
    |
    */
    'DB_HOST'                  => 'example',
    'DB_NAME'                  => 'example', // database name to use
    'DB_USERNAME'              => 'example',
    'DB_PASSWORD'              => 'example',
    'DB_PORT'                  => 'example', // not currently used

    /*
    |--------------------------------------------------------------------------
    | Authentication Fallback Configuration
    |--------------------------------------------------------------------------
    |
    | Defines whether to fall-back to database authentication should the primary
    | method of authentication fail.
    |
    */
    'AUTH_FALLBACK'            => false,

    /*
    |--------------------------------------------------------------------------
    | LDAP Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration parameters for the LDAP auth provider.
    |
    */
    'LDAP_HOST'                => 'ldap.example.com',
    'LDAP_BASE_DN'             => 'example',
    'LDAP_DN'                  => 'example',
    'LDAP_PASSWORD'            => 'example',
    'LDAP_ALLOW_NO_PASS'       => false, // whether to allow LDAP authentication
                                         // without a password using the LDAP_DN
                                         // instead

    /*
    |--------------------------------------------------------------------------
    | SMTP Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration parameters for the default mail driver. By default, smtp is
    | assumed as the desired method of mail transfer.
    |
    */
    'SMTP_HOST'                => 'smtp.example.com',
    'SMTP_USERNAME'            => 'example',
    'SMTP_PASSWORD'            => 'example',
    'SMTP_ENCRYPTION'          => 'example',
    'SMTP_PORT'                => 'example',
];
