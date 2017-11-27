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
                    <h1 class="mt-4">Passing the Token</h1>
                    <p class="lead">
                        Pass the token from Stripe.js to your server.
                    </p>
                    <p class="text-secondary">
                        You just received a token representing payment
                        information from Stripe.js. When you click "continue"
                        below, these fields will be used to create a customer in
                        Stripe using Stripe's PHP library.
                    </p>
                    <p class="text-secondary">
                        In the real world, you'd probably move directly from
                        <code>index.php</code> and the Stripe.js form to
                        <code>third.php</code> and create a customer in Stripe.
                        This page is meant to slow highlight the required pass
                        of the Stripe.js token to your server.
                    </p>
                    <p class="text-secondary">
                        Note that only an email address and Stripe.js token is
                        required to create a customer in Stripe. However,
                        Cheddar will require a first and last name for the
                        customer, as well as a first and last name for the
                        credit card. In this example, we'll let Cheddar pull the
                        name for the credit card directly from Stripe via the
                        <code>name</code> attribute that was included when
                        creating the Stripe.js token. Later, we will explicitly
                        pass a name for the customer to Cheddar when creating it.
                    </p>
                    <p class="text-secondary">
                        To continue, you'll need to change line 10 in
                        <code>third.php</code> to contain your Stripe secret key.
                        It's recommended that you use a key from a test account.
                        The secret key you use should be from the account
                        corresponding to the public key you used in the previous
                        step.
                    </p>
                    <p class="text-secondary">
                        Note that submitting this form will create a customer
                        in whatever Stripe account is associated with the keys
                        you use.
                    </p>
                    <form autocomplete="on" method="POST" id="payment-form"
                        action="<?= htmlspecialchars('third.php') ?>">
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
                                    Stripe.js Token
                                </label>
                                <input id="stripe-token" type="text" class="form-control"
                                    name="stripe-token"
                                    value="<?= !empty($_POST['stripe-token']) ? $_POST['stripe-token'] : '' ?>"
                                    placeholder="tok_something" />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary mb-4">
                            Continue
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- We don't need the stripe.js library anymore -->
        <!-- Optional bootstrap things -->
        <!-- jQuery first, then popper.js, then bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </body>
</html>
