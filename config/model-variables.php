<?php

/**
 * Model-variables file contain all constant variables declaration of models which will be globally accessible.
 * Key of the table should be based on the table name (singular/plural)
 * Key of the Model class should be based on the class name (Always singular)
 */


use App\Models\User;
use App\Models\Product;

return [
    'models' => [
        /*
        * User table and model
        */
        'user' => [
            'table' => 'users',
            'class' => User::class,
        ],

         /*
        * Product table and model
        */
        'product' => [
            'table' => 'products',
            'class' => Product::class,
        ],
        /*
        * Passwordreset table
        */
        'passwordreset' => [
            'table' => 'password_resets'
        ],

        /*
        * Failedjob table
        */
        'failedjob' => [
            'table' => 'failed_jobs'
        ],

        /*
        * Personalaccesstoken table
        */
        'personalaccesstoken' => [
            'table' => 'personal_access_tokens'
        ],

    ],
];