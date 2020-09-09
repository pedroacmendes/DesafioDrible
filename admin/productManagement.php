<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
                <a class="nav-link" href="productManagement.php">Product Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="userManagement.php">User Management</a>
            </li>
        </ul>
        <ul class="navbar-nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href="../util/logout.php">Log Out, <?php echo $utl ?> </a>
            </li>
        </ul>
    </nav>

    <main>

        <h1>Products Area</h1>
        <hr>
        <br>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
            Add Product
        </button>

        <br><br>

        <div id="addProductModal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <form class="form" role="form" enctype="multipart/form-data" autocomplete="off" id="formAdd" novalidate="" method="POST">

                        <div class="modal-header">
                            <h4 class="modal-title">Insert Product</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>

                        <div class="modal-body">

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="nameProd" required>
                            </div>

                            <div class="form-group">
                                <label>Description</label> <br>
                                <input type="text" class="form-control" name="descriptionProd" required>
                            </div>

                            <div class="form-group">
                                <label>Price</label> <br>
                                <input type="text" class="form-control" name="priceProd" required>
                            </div>

                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn btn-default" aria-hidden="true">Cancel</button>
                                <button type="submit" name="upload" class="btn btn-success" value="UPLOAD" id="btnLogin">Add</button>
                            </div>

                            <?php

                            if (isset($_POST["upload"])) {

                                $nameProd = $_POST['nameProd'];
                                $descriptionProd = $_POST['descriptionProd'];
                                $priceProd = $_POST['priceProd'];

                                $sql = "INSERT INTO products VALUES ('', '$nameProd','$descriptionProd', '$priceProd')";
                                if ($conn->query($sql) === TRUE) {
                                    echo '<script>location.href="http://localhost/DesafioDrible/admin/productManagement.php"</script>';
                                } else {
                                    echo "Error: " . $sql2 . "<br>" . $conn->error;
                                }
                            }

                            ?>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description </th>
                    <th>Price </th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                <?php

                $stmt = $conn->prepare("SELECT * FROM products order by idProd");
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows === 0) exit('No rows');
                while ($row = $result->fetch_assoc()) {
                    $idProd = $row["idProd"];
                ?>
                    <tr>
                        <div class="col-sm-3">
                            <td> <?php echo $row['nameProd']; ?> </td>
                            <td> <?php echo $row['descriptionProd']; ?> </td>
                            <td> <?php echo $row['priceProd']; ?> </td>
                            <td><?php echo "<a href='editProduct.php?id=" . $row['idProd'] . "'>Edit</a>"; ?></td>
                        </div>
                    </tr>
                <?php }
                $stmt->close(); ?>

            </tbody>
        </table>



    </main>

</body>

</html>