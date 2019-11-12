<?php

/**
 *  Register Elastic Host
 */
return [
    'host' => [
        env("ELASTIC_HOST", "http://localhost:9200")
    ],
    'enable' => env('ELASTIC_OBSERVER_ENABLE', true)
];
