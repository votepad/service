<?php

return array(

    Model_Uploader::PROFILE_AVATAR => array(
        'path' => 'uploads/profiles/',
        /**
         * Image sizes config
         * key - filename prefix_
         * first argument  — need crop square or should resize with saving ratio
         * second argument — max width
         * third argument  — max height
         */
        'sizes' => array(
            'o'  => array(false, 1500, 1500),
            'b'  => array(true , 200),
            'm'  => array(true , 100),
            's'  => array(true , 50),
        ),

    ),

    Model_Uploader::PROFILE_BRANDING => array(
        'path' => 'uploads/profile_brandings/',
        /**
         * Image sizes config
         * key - filename prefix_
         * first argument  — need crop square or should resize with saving ratio
         * second argument — max width
         * third argument  — max height
         */
        'sizes' => array(
            'o'  => array(false, 1500, 1500),
            'b'  => array(true , 1200, 800),
            'm'  => array(true , 800),
            's'  => array(true , 200, 200),
        ),

    ),

    Model_Uploader::ORGANIZATION_BRANDING => array(
        'path' => 'uploads/organization/brandings/',
        /**
         * Image sizes config
         * key - filename prefix_
         * first argument  — need crop square or should resize with saving ratio
         * second argument — max width
         * third argument  — max height
         */
        'sizes' => array(
            'o'  => array(false, 1500, 1500),
            'b'  => array(true , 1200, 800),
            'm'  => array(true , 800),
            's'  => array(true , 200, 200),
        ),
    ),

    Model_Uploader::ORGANIZATION_LOGO => array(
        'path' => 'uploads/organization/logo/',
        /**
         * Image sizes config
         * key - filename prefix_
         * first argument  — need crop square or should resize with saving ratio
         * second argument — max width
         * third argument  — max height
         */
        'sizes' => array(
            'o'  => array(false, 1500, 1500),
            'b'  => array(true , 200),
            'm'  => array(true , 100),
            's'  => array(true , 50),
        ),
    )
);