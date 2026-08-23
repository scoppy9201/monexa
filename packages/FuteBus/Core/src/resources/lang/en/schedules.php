<?php

return [
    'meta' => [
        'title'       => 'Bus schedules - FUTA Bus Lines',
        'description' => 'Find FUTA Bus Lines routes, vehicle types, distances, and journey times.',
    ],
    'from_placeholder' => 'Enter departure point',
    'to_placeholder'   => 'Enter destination',
    'swap'             => 'Swap departure and destination',
    'route'            => 'Route',
    'vehicle_type'     => 'Vehicle type',
    'distance'         => 'Distance',
    'duration'         => 'Journey time',
    'no_results'       => 'No matching schedules found.',
    'groups'           => (require __DIR__.'/../vi/schedules.php')['groups'],
];
