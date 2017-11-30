<?php

require '../vendor/autoload.php';
$config = require '../config/config.php';

/* --- Instantiate the Client Object --- */

// Don't use information from a live product, please
$client = new CheddarGetter_Client(
    $config['cheddar']['url'],
    $config['cheddar']['username'],
    $config['cheddar']['password'],
    $config['cheddar']['productCode']
);

$post = array_filter($_POST);

if (!empty($post)) {
    /* --- Create a customer in cheddar --- */

    // Set payload to create customer in cheddar
    /* Note that the customer id from stripe is being passed to cheddar as the
    subscription->gatewayToken
    */
    $customerCode = strtolower($post['first-name']) . '_' . strtolower($post['last-name']);
    $payload = array(
        'code' => $customerCode,
        'firstName' => $post['first-name'],
        'lastName' => $post['last-name'],
        'email' => $post['email'],
        'subscription' => array(
            'planCode' => $config['cheddar']['planCode'],
            'gatewayToken' => $post['customer-id']
        )
    );

    // Create a customer in Cheddar
    // This example includes very basic error handling
    try {
        $customer = $client->newCustomer($payload);
        // under some circumstances, the customer is created but
        // contains an embedded error that needs to be handled
        $customer->handleEmbeddedErrors();
    } catch (CheddarGetter_Response_Exception $re) {
        die($re->getCode() . '-' . $re->getAuxCode() . ': ' . $re->getMessage());
    }
}

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Stripe.js with Cheddar Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h1 class="mt-4">Create a Customer in Cheddar</h1>
                    <p class="lead">
                        Use the Cheddar API to create a customer in Cheddar.
                    </p>
                    <p class="text-secondary">
                        Using the customer ID you pulled from Stripe as the
                        subscription gateway token in Cheddar, you can
                        create a customer in Cheddar to pass the customer's
                        payment information directly from Stripe to Cheddar.
                    </p>
                    <p class="text-secondary">
                        Note that this example uses the
                        <a href="https://github.com/marcguyer/cheddargetter-client-php">
                            PHP Cheddar Client
                        </a> as a wrapper for the Cheddar API.
                    </p>
                    <p>
                        You're done!
                    </p>
                </div>
            </div>
        </div>
        <!-- We don't need the stripe.js library anymore -->
        <!-- Optional JavaScript (Bootstrap things) -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </body>
</html>
