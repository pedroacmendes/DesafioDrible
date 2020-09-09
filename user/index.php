<!DOCTYPE html>
<html lang="en">

<?php
include '../util/head.php';
include '../util/conection.php';
include '../util/style.php';

$utl = $_SESSION['emailUser'];
if ($utl == null) {
    echo '<script>location.href="http://localhost/DesafioDrible/index.php"</script>';
}
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
                <a class="nav-link" href="profile.php">My profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../util/logout.php">Log Out, <?php echo $utl ?></a>
            </li>
        </ul>
    </nav>

</body>

<div class="imageDiv">
    <div class="text-block">
        <h2>HomePage</h2>
        <p>What a beautiful web hosting</p>
    </div>
</div>

<main>

    <h3 style="text-decoration: overline; text-align: center;">Highlights </h3>
    <br>

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
        <?php }


        $stmt->close(); ?>

    </div>

</main>

</html>