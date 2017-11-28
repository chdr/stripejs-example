<?php
/*
Set your credentials in the $config variable. Use values from test accounts,
please. A customer will be created in both Stripe and Cheddar while running
this example.
*/
$config = [
    'stripe' => [
        'publishableKey' => '',
        'secretKey' => ''
    ],
    'cheddar' => [
        'url' => '',
        'username' => '',
        'password' => '',
        'productCode' => '',
        'planCode' => ''
    ]
];

$contentType = isset($_SERVER['CONTENT_TYPE']) ?
    trim($_SERVER['CONTENT_TYPE']) :
    '';

if ($contentType === 'application/json') {
    echo json_encode($config);
} else {
    return $config;
}
