<?php
/*
Set your credentials below.



Stripe

The Stripe publishable and secret keys can be found by visiting your Stripe
dashboard (https://dashboard.stripe.com/) and navigating to your API page via
the left-hand menu (https://dashboard.stripe.com/account/apikeys). Ensure the
"View test data" button is toggled on. It should say "Viewing test data."



Cheddar

There are many ways to view or get Cheddar product and plan codes. Here are two:

Product Code
A Cheddar product code can be found by navigating to "Configuration" on the main
menu and "Product Settings" in the submenu after logging into your desired
product. You're looking for the "CODE" field.

Plan Code
A Cheddar plan code can be found
by navigating to "Configuration" on the main menu and "Pricing Plans" in the
submenu. The plan codes will follow the plan name heading.



Use values from test accounts, please. A customer will be created in both Stripe
and Cheddar while running this example.
*/
return [
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
