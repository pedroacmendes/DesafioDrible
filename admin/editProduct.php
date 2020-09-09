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

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT * FROM products WHERE idProd ='$id' ";
$result_user = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($result_user);
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
                <a class="nav-link" href="../util/logout.php">Log out, <?php echo $utl ?> </a>
            </li>
        </ul>
    </nav>

    <main>

        <h1>Products Editing Area </h1>
        <div class="form-login">
            <form method="POST">

                <input type="hidden" name="idProd" value="<?php echo $result['idProd'] ?>">

                <div class="form-group">
                    <label class="control-label col-sm-2" for="nameProd">Name:</label>
                    <input type="text" class="form-control" name="nameProd" value="<?php echo $result['nameProd'] ?>" id="nameProd">
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="descriptionProd">Description:</label>
                    <input type="text" class="form-control" name="descriptionProd" value="<?php echo $result['descriptionProd'] ?>" id="descriptionProd">
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="priceProd">Price:</label>
                    <input type="text" class="form-control" value="<?php echo $result['priceProd'] ?>" id="priceProd" name="priceProd">
                </div>

                <button type="submit" name="edit" class="btn btn-success">Edit</button>
                <button type="submit" name="delete" class="btn btn-danger">Delete</button>

                <?php

                if (isset($_POST["edit"])) {

                    $idProd = $_POST['idProd'];
                    $nameProd = $_POST['nameProd'];
                    $descriptionProd = $_POST['descriptionProd'];
                    $priceProd = $_POST['priceProd'];

                    $sql = "UPDATE products SET nameProd='$nameProd', descriptionProd='$descriptionProd', priceProd='$priceProd' WHERE idProd='$idProd' ";
                    if ($conn->query($sql) === TRUE) {
                        echo '<script>location.href="http://localhost/DesafioDrible/admin/productManagement.php"</script>';
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                if (isset($_POST["delete"])) {

                    $idProd = $_POST['idProd'];

                    $sql = "DELETE FROM products WHERE idProd='$idProd' ";
                    if ($conn->query($sql) === TRUE) {
                        echo '<script>location.href="http://localhost/DesafioDrible/admin/productManagement.php"</script>';
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                ?>
            </form>
    </main>

</body>

</html>