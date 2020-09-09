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

$email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);
$sql = "SELECT * FROM users WHERE emailUser='$email' ";
$result_user = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($result_user);
?>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="productManagement.php">Product Management</a>
            </li>
            <li class="nav-item active">
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

        <h1>Users Editing Area </h1>

        <div class="form-login">
            <form method="POST">

                <input type="hidden" name="emailUser" value="<?php echo $result['emailUser'] ?>">

                <div class="form-group">
                    <label>Name: </label>
                    <input type="text" class="form-control" name="nameUser" value="<?php echo $result['nameUser'] ?>">
                </div>

                <div class="form-group">
                    <label>Password: </label>
                    <input type="password" class="form-control" name="passwordUser" value="<?php echo $result['passwordUser'] ?>">
                </div>

                <div class="form-group">
                    <label>UserType: </label>
                    <input type="text" class="form-control" name="userType" value="<?php echo $result['userType'] ?>">
                </div>

                <button type="submit" name="edit" class="btn btn-success">Edit</button>
                <button type="submit" name="delete" class="btn btn-danger">Delete</button>

                <?php

                if (isset($_POST["edit"])) {

                    $emailUser = $_POST['emailUser'];
                    $nameUser = $_POST['nameUser'];
                    $passwordUser = $_POST['passwordUser'];
                    $userType = $_POST['userType'];

                    $sql = "UPDATE users SET nameUser='$nameUser', passwordUser='$passwordUser', userType='$userType' WHERE emailUser='$emailUser' ";
                    if ($conn->query($sql) === TRUE) {
                        echo '<script>location.href="http://localhost/DesafioDrible/admin/userManagement.php"</script>';
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                if (isset($_POST["delete"])) {

                    $emailUser = $_POST['emailUser'];

                    $sql = "DELETE FROM users WHERE emailUser='$emailUser' ";
                    if ($conn->query($sql) === TRUE) {
                        echo '<script>location.href="http://localhost/DesafioDrible/admin/userManagement.php"</script>';
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                ?>
            </form>
        </div>
    </main>

</body>

</html>