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

</body>
<main>


    <h1>Products</h1>
    <hr><br><br>

    <?php
    $currentPage = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
    $pagina = (!empty($currentPage)) ? $currentPage : 1;
    $quantidadePagina = 8;
    $inicio = ($quantidadePagina * $pagina) - $quantidadePagina;
    ?>

    <div class="row">

        <?php

        $stmt = $conn->prepare("SELECT * FROM products order by idProd LIMIT $inicio, $quantidadePagina");
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

    <?php
    $result_pg = "SELECT COUNT(idProd) AS num_result FROM products";
    $resultado_pg = mysqli_query($conn, $result_pg);
    $row_pg = mysqli_fetch_assoc($resultado_pg);
    $quantidade_pg = ceil($row_pg['num_result'] / $quantidadePagina);
    ?>


    <div class="pagination">
        <?php

        $max_links = 4;

        for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
            if ($pag_ant >= 1) {
                echo "<a href='products.php?pagina=$pag_ant'>$pag_ant</a> ";
            }
        }

        echo "<a>$pagina</a> ";

        for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
            if ($pag_dep <= $quantidade_pg) {
                echo "<a href='products.php?pagina=$pag_dep'>$pag_dep</a> ";
            }
        }

        ?>

    </div>

</main>

</html>