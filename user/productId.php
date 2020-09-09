<!DOCTYPE html>
<html lang="en">

<link rel="icon" href="favicon.ico" type="image/x-icon" />
<script src="https://js.stripe.com/v3/"></script>

<?php
include '../util/head.php';
include '../util/conection.php';
include '../util/style.php';

$utl = $_SESSION['emailUser'];
if ($utl == null) {
    echo '<script>location.href="http://localhost/DesafioDrible/index.php"</script>';
}

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT * FROM products WHERE idProd ='$id' ";
$result_user = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($result_user);
?>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">HomePage</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="products.php">Products</a>
            </li>
        </ul>
        <ul class="navbar-nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href="profile.php">My profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../util/logout.php">Log Out, <?php echo $utl ?></a>
            </li>
        </ul>
    </nav>

    <div class="productId1">
        <img class="prodId" src="/DesafioDrible/images/image_test.jpg">
    </div>

    <div class="productId2">
        <form method="POST">
            <input type="hidden" name="idProd" value="<?php echo $result['idProd'] ?>">

            <h2><?php echo $result['nameProd'] ?></h2> <br>

            <label class="price"><?php echo $result['priceProd'] ?>€</label> <br>

            <p><?php echo $result['descriptionProd'] ?></p> <br>

            <input type="button" class="btn btn-success" id="basic-btn" value="Subscribe here" />

            <div id="error-message"></div>
        </form>
    </div>

    <div class="similarProds">
        <h3>Similar Products: </h3>
        <br><br>

        <div class="row">

            <?php

            $stmt = $conn->prepare("SELECT * FROM products order by idProd limit 0,4");
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) exit('No products.');

            while ($row = $result->fetch_assoc()) {

                $idProd = $row["idProd"];
            ?>
                <div class="column">
                    <div class="card">
                        <h3> <?php echo $row['nameProd']; ?></h3> <br>
                        <img src="/DesafioDrible/images/image_test.jpg" style="width:100%"> <br>
                        <p class="price"><?php echo $row['priceProd']; ?>€</p>
                        <?php echo "<a href='productId.php?id=" . $row['idProd'] . "'>Open</a>"; ?>
                    </div>
                    <br>
                </div>
            <?php
            }
            $stmt->close();
            ?>

        </div>

    </div>

    <script>
        var PUBLISHABLE_KEY = "pk_test_51HNb74FF0OVrMuNmuIyC85U8I2B9wkgugtRx8GYw9LaY2qu73jya1JBson4wZjWOHn5bjYrKT6w9a7xzICg0aZMr00ZpT8vmqs";

        var DOMAIN = 'http://localhost/DesafioDrible/util';

        var idStripeProd = 'price_1HP8GNFF0OVrMuNmTWapOZ6V';

        var SUBSCRIPTION_PRICE_ID = idStripeProd;

        var stripe = Stripe(PUBLISHABLE_KEY);

        // Handle any errors from Checkout
        var handleResult = function(result) {
            if (result.error) {
                var displayError = document.getElementById("error-message");
                displayError.textContent = result.error.message;
            }
        };

        var redirectToCheckout = function(priceId) {
            // Make the call to Stripe.js to redirect to the checkout page
            // with the current quantity
            stripe
                .redirectToCheckout({
                    lineItems: [{
                        price: priceId,
                        quantity: 1
                    }],
                    successUrl: DOMAIN + "/success.php?session_id={CHECKOUT_SESSION_ID}",
                    cancelUrl: DOMAIN + "/canceled.php",
                    mode: 'subscription',
                })
                .then(handleResult);
        };

        document
            .getElementById("basic-btn")
            .addEventListener("click", function(evt) {
                redirectToCheckout(SUBSCRIPTION_PRICE_ID);
            });
    </script>

</body>

</html>