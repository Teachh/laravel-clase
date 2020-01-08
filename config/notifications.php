<?php

return [
    /*
     * Set the length of time (in seconds) automatic notifications should fade out after.
     */
    'timeout' => 3,

    /*
     * Settings for the notification classes.
     */
    'classes' => [
        /*
         * Define the "provider" for the classes.
         * This is used to set the prefix for the level class.
         * Valid providers are: bootstrap
         */
        'provider' => 'bootstrap',

        /*
         * Define what classes to use for each notification level.
         */
        'levels'   => [
            'info'    => 'info',
            'success' => 'success',
            'warning' => 'warning',
            'error'   => 'danger',
        ],
    ],

    /*
     * Settings for the graphical icons.
     */
    'icons'   => [
        /*
         * Define the "provider" for the icons.
         * This is used to set the prefix for the icon class.
         * Valid providers are: bootstrap, font-awesome
         */
        'provider' => 'font-awesome',

        /*
         * Define what icon classes to use for each notification level.
         */
        'levels'   => [
            'info'    => 'info',
            'success' => 'check',
            'warning' => 'exclamation',
            'error'   => 'remove',
        ],

        /*
         * Define the icon class to use for the close icon.
         */
        'close'    => 'remove',
    ],
];
