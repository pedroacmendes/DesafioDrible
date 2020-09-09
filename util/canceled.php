<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Stripe Checkout Sample</title>
  <meta name="description" content="A demo of Stripe Payment Intents" />

  <link rel="icon" href="favicon.ico" type="image/x-icon" />
  <script src="https://js.stripe.com/v3/"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<?php
include 'conection.php';
include 'style.php';
?>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">HomePage</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="products.php">Products</a>
      </li>
    </ul>
    <ul class="navbar-nav justify-content-end">
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>
    </ul>
  </nav>

  <main>


    <h1>Your payment was canceled! :(</h1>
    <p style="text-align: center;">Checkout Session ID: <span id="session"></span></p>

    <input type="button" style="left: 43%; right: 43%; position: fixed; margin:3%;" class="btn btn-success" onclick="location.href='http://localhost/DesafioDrible/index.php';" value="Go to HomePage" />

  </main>

  <script>
    var PUBLISHABLE_KEY = "pk_test_51HNb74FF0OVrMuNmuIyC85U8I2B9wkgugtRx8GYw9LaY2qu73jya1JBson4wZjWOHn5bjYrKT6w9a7xzICg0aZMr00ZpT8vmqs";

    var stripe = Stripe(PUBLISHABLE_KEY);
    var urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has("session_id")) {
      document.getElementById("session").textContent = urlParams.get(
        "session_id"
      );
    }
  </script>
</body>

</html>