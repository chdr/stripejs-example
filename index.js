/* --- Get Your Publishable Key --- */

/*
You'll need a publishable key to use Stripe.js. In this example, we use the
Fetch API (see https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API) to
grab the publishable key from a server-side configuration variable.

Use a key from a test account, please.
*/
fetch('config.php', {
  method: 'GET',
  mode: 'same-origin',
  credentials: 'same-origin',
  headers: {
    'Content-Type': 'application/json'
  }
})
  .then(resp => resp.json())
  .then(json => json.stripe.publishableKey )
  .then(myKey => {
    useStripeJS(myKey);
  })
  .catch(err => {
    console.error(err);
  });

function useStripeJS(publishableKey) {
  /* --- Get an Instance of Stripe Elements --- */

  // Use your stripe publishable key to create an instance of elements
  const stripe = Stripe(publishableKey);
  const elements = stripe.elements();

  /* --- Insert a Card Element into Your Form --- */

  // Custom styles can be passed for each stripe element when created
  const style = {
    base: {
      fontFamily: '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol"',
      fontSize: '16px',
      lineHeight: '24px',
      color: '#495057'
    }
  };

  // Create an instance of the 'card' element
  /*
  Here, you can pass it an object with your
  custom style object, e.g. { style: style } or { style }
  */
  const card = elements.create('card', { style });

  // Use elements to insert a card element into your form
  card.mount('#card-element');

  /* --- Display any Card Validation Errors on Your Form --- */

  // Add a change event listener to the card element
  card.addEventListener('change', (event) => {
    const displayError = document.getElementById('card-errors');
    if (event.error) {
      displayError.textContent = event.error.message;
    } else {
      displayError.textContent = '';
    }
  });

  /* --- Attach Listener for Form Submission and Get Your Token --- */

  // Get non-elements-created form values you care about
  /*
  The stripe.createToken method will only pull in information from form elements
  created with the Elements library. Any other card information you want to
  associate with the token in Stripe (such as a name or address) can be passed in
  the second parameter of createToken. In this example, a name is passed to
  Stripe.js (as the later call to Cheddar to create a customer will need a name
  for the credit card, and Cheddar can pull the information from Stripe).
  */
  function getExtraCardData() {
    const first = document.getElementById('first-name').value;
    const last = document.getElementById('last-name').value;
    return {
      name: `${first} ${last}`
    }
  }

  // Attach the listener, get token
  const form = document.getElementById('payment-form');

  form.addEventListener('submit', (event) => {
    event.preventDefault();

    const cardData = getExtraCardData();

    // Pass the fields created with elements and your extra form values to createToken.
    stripe.createToken(card, cardData).then((result) => {
      // createToken returns a promise that will either have an error or your token
      if (result.error) {
        const errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;
      } else {
        stripeTokenHandler(result.token);
      }
    });
  });

  /* --- Pass the Token to Your Server --- */

  /*
    In the Stripe.js quickstart, they insert the token to a hidden input field
    appended to the form, and submit everything back to your server. This example
    follows suit.
  */
  function stripeTokenHandler(token) {
    const form = document.getElementById('payment-form');
    const hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripe-token');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);
    form.submit();
  }
}
