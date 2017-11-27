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
                    <h1 class="mt-5">Collect Customer Card Details</h1>
                    <p class="lead">
                        Use Stripe.js to collect customer credit card details
                        and convert that payment information to a token.
                    </p>
                    <p class="text-secondary">
                        Your first step in integrating Stripe.js with Cheddar
                        will be to create a form with Stripe.js. Upon successful
                        submission, you will receive a token via Stripe.js.
                    </p>
                    <p class="text-secondary">
                        To be able to submit this form, you'll need to add your
                        Stripe publishable key to line 5 of
                        <code>index.js</code>. It's recommended that you use a
                        key from a test account.
                    </p>
                    <p class="text-secondary">
                        Per the Stripe.js documentation, "try it out using the
                        test card number 4242 4242 4242 4242, a random
                        three-digit CVC number, any expiration date in the
                        future, and a random five-digit U.S. ZIP code."
                    </p>
                    <p class="text-secondary">
                        This form is based on the Stripe.js and Stripe Elements
                        <a href="https://stripe.com/docs/stripe-js/elements/quickstart">
                            quickstart</a>.
                    </p>
                    <!-- Create your form  -->
                    <!-- The inputs for the card number, expiration, and CVC will
                        be inserted by Stripe Elements. -->
                    <form autocomplete="on" method="POST" id="payment-form"
                        action="<?= htmlspecialchars('second.php') ?>">
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
                            <div class="form-group col-md-12">
                                <label for="email">
                                    Email
                                </label>
                                <input id="email" type="text"
                                    class="form-control" name="email"
                                    value="<?= !empty($_POST['email']) ? $_POST['email'] : '' ?>"
                                    placeholder="johnathon@example.com" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="card-number-element">
                                    Credit or debit card
                                </label>
                                <div id="card-element" class="form-control">
                                    <!-- The stripe element will be inserted here -->
                                </div>
                            </div>
                            <!-- Used to display errors detected by elements -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Stripe.js things -->
        <!-- Include the stripe.js library, then your implementation -->
        <script src="https://js.stripe.com/v3/"></script>
        <script src="index.js"></script>
        <!-- Optional bootstrap things -->
        <!-- jQuery first, then popper.js, then bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </body>
</html>
