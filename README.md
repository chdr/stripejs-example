# Stripe.js with Cheddar example
This is a simple form demonstrating how you could integrate Stripe.js with Cheddar.

## Overview

### Step One: Use Stripe.js to Get a Token Representing Payment Information

This example uses Stripe.js with Stripe Elements to collect credit card details and to send that information to Stripe from the client. If successful, Stripe responds with a token representing the payment information via Stripe.js.

### Step Two: Use This Token to Create a Customer in Stripe

The token received from Stripe.js can be passed to your servers and used to perform a charge or to save to a customer (in place of the actual payment information). In this example, an API call is made to Stripe to create a customer using their [PHP library](https://github.com/stripe/stripe-php).

### Step Three: Use the Customer Object Returned by Stripe to Create a Customer in Cheddar

If successful, Stripe will return the customer object of the newly created customer. You can pull the `id` field to pass as a subscription gateway token when creating a customer in Cheddar. This example uses the [PHP Cheddar Client wrapper](https://github.com/marcguyer/cheddargetter-client-php).

#### Difference in Name Requirements for Stripe versus Cheddar

Note that it's possible to create a customer and an associated credit card in Stripe without collecting a name for either the customer or the credit card. However, Cheddar will require a first and last name for the both the customer and the credit card.

You can pass the credit card first and last name directly to Cheddar, or by including the `name` attribute when you create a token in Stripe.js. If a name is included in the creation of a Stripe.js token, Cheddar will pull that information directly from Stripe. This example attaches a `name` when creating a token with Stripe.js.

## Useful Links
1. [Stripe.js and Elements Documentation](https://stripe.com/docs/stripe-js)
2. [Full Stripe API Reference](https://stripe.com/docs/api)
3. [Cheddar API Documentation](http://docs.getcheddar.com/)
4. [PHP Cheddar Client Repository](https://github.com/marcguyer/cheddargetter-client-php)

## See it in action
1. Clone this repository
2. Descend into the cloned directory
3. [Install Composer](https://getcomposer.org/doc/00-intro.md)
4. [Use Composer](https://getcomposer.org/doc/01-basic-usage.md) to install the dependencies for this example
5. Rename the `config.dist.php` file to `config.php`
  1. Run `mv config.dist.php config.php`
6. Set the configuration variables in `config.php`
  1. Replace any variables representing API keys from Stripe with those from your own test accounts in lines 5 and 6
  2. Replace any variables representing Cheddar credentials with those from a test product in Cheddar in lines 9 through 13
7. Run the PHP built-in server with `php -S localhost:8080`
8. Go to http://localhost:8080 in a browser
