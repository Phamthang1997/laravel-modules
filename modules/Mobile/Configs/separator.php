<?php

// These are sorted by the native name, which is the order you might show them in a separator selector.
// Regional timezone are sorted by their base timezone, so "decimalSeparator" sorts as "dot"

return [
    'number' => [
        'dot'  => ['name' => 'The character of number separator', 'separator' => 'dot'],
        'comma '  => ['name' => 'The character of decimal separator', 'separator' => 'comma'],
    ],

    'timestamp' => [
        'mysql' => ['name' => 'The MySQL retrieves and displays', 'format' => 'Y-m-d H:i:s'],
        'iso' => ['name' => 'The ISO8601 retrieves and displays', 'format' => 'Y-m-d TH:i:sO'],
        'rfc' => ['name' => 'The RFC3339 retrieves and displays', 'format' => 'Y-m-d TH:i:sP'],
        'cookie' => ['name' => 'The COOKIE retrieves and displays', 'format' => 'l, d-M-Y H:i:s T'],
    ],
];
