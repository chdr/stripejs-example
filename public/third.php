<?php

$post = array_filter($_POST);

if (!empty($post)) {
    /* --- Set your Stripe secret key --- */

    \Stripe\Stripe::setApiKey($config['stripe']['secretKey']);

   /* --- Create a customer in stripe --- */

   // This example includes error handling per stripe's website: https://stripe.com/docs/api?lang=php#error_handling
    try {
        // The email and stripe token can be used to create a customer in stripe
        $customer = \Stripe\Customer::create(array(
            'email' => $post['email'],
            'source' => $post['stripe-token']
        ));
    } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly
        die($e);
    } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
        die($e);
    } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        die($e);
    } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
        die($e);
    } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send yourself an email
        die($e);
    } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
        die($e);
    }

    /*
    If successful, Stripe will return an object for the newly created
    customer. You can use the customer id to pass the customer's payment
    information directly from Stripe to Cheddar.
    */
    $customer_id = $customer->id;
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
                    <h1 class="mt-4">Create a Customer in Stripe</h1>
                    <p class="lead">
                        Use a Stripe API library to create a customer in Stripe.
                    </p>
                    <p class="text-secondary">
                        On this page of the example, we created a customer in
                        Stripe. We passed the email address from the previous
                        form as the email address for the Stripe customer, and
                        the Stripe.js token as the
                        <a href="https://stripe.com/docs/api#customers">customer's payment source</a>.
                        This is based off of Stripe's
                        <a href="https://stripe.com/docs/saving-cards">Saving Cards</a>
                        guide.
                    </p>
                    <p class="text-secondary">
                        Note that submitting this form will create a customer in
                        Cheddar for whatever product information you provide.
                    </p>
                    <form autocomplete="on" method="POST" id="payment-form"
                        action="<?= htmlspecialchars('fourth.php') ?>">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first-name">
                                    First name
                                </label>
                                <input id="first-name" type="text"
                                    class="form-control" name="first-name"
                                    value="<?= !empty($_POST['first-name']) ? $_POST['first-name'] : '' ?>"
                                    placeholder="Johnathon" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last-name">
                                    Last name
                                </label>
                                <input id="last-name" type="text"
                                    class="form-control" name="last-name"
                                    value="<?= !empty($_POST['last-name']) ? $_POST['last-name'] : '' ?>"
                                    placeholder="Doe" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">
                                    Email
                                </label>
                                <input id="email" type="text"
                                    class="form-control" name="email"
                                    value="<?= !empty($_POST['email']) ? $_POST['email'] : '' ?>"
                                    placeholder="johnathon@example.com" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="customer-id">
                                    Stripe Customer ID
                                </label>
                                <input id="customer-id" type="text" class="form-control"
                                    name="customer-id"
                                    value="<?= $customer_id ? $customer_id : '' ?>"
                                    placeholder="cus_something" />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">
                            Continue
                        </button>
                    </form>
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
