<?php

return array(

    Model_Uploader::PROFILE_AVATAR => array(
        'path' => 'uploads/profiles/avatar/',
        /**
         * Image sizes config
         * key - filename prefix_
         * first argument  — need crop square or should resize with saving ratio
         * second argument — max width
         * third argument  — max height
         */
        'sizes' => array(
            'o'  => array(false, 1500, 1500),
            'm'  => array(true , 100),
        ),

    ),

    Model_Uploader::PROFILE_BRANDING => array(
        'path' => 'uploads/profiles/branding/',
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
        ),

    ),

    Model_Uploader::EVENT_BRANDING => array(
        'path' => 'uploads/events/branding/',
        /**
         * Image sizes config
         * key - filename prefix_
         * first argument  — need crop square or should resize with saving ratio
         * second argument — max width
         * third argument  — max height
         */
        'sizes' => array(
            'o'  => array(false, 1500, 1500),
            'b'  => array(true , 1200, 800)
        ),
    ),

    Model_Uploader::PARTICIPANTS_PHOTO => array(
        'path' => 'uploads/participants/',
        /**
         * Image sizes config
         * key - filename prefix_
         * first argument  — need crop square or should resize with saving ratio
         * second argument — max width
         * third argument  — max height
         */
        'sizes' => array(
            'b'  => array(true , 200),
            'm'  => array(true , 100),
            's'  => array(true , 50),
        ),
    )
);
