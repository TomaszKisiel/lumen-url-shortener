<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Shortener Protection
    |--------------------------------------------------------------------------
    |
    | When this value is set to true, your site's dashboard will only be
    | available to users who provide the correct password. Without protection,
    | anyone can find your short links and their statistics.
    |
    */

    'protection' => true,

    /*
    |--------------------------------------------------------------------------
    | Shortener Passwords
    |--------------------------------------------------------------------------
    |
    | If protection is enabled, the dashboard will only be available if the
    | password provided by the user is included in this list. With protection
    | users can't create own short links on your domain, but still can use
    | links created by authenticated users.
    |
    */

    'passwords' => [
        'vertex25',
        'shortener'
    ]

];
