<!DOCTYPE html>
<html lang="en">

<?php
include 'util/head.php';
include 'util/conection.php';
include 'util/style.php';
?>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
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
            <li class="nav-item active">
                <a class="nav-link" href="register.php">Register</a>
            </li>
        </ul>
    </nav>

    <h1>Register</h1>

    <div class="form-login">
        <form method="POST">

            <div class="form-group">
                <label class="control-label col-sm-2" for="nameUser">Name:</label>
                <input type="text" class="form-control" name="nameUser" id="nameUser" placeholder="Enter name">
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="emailUser">Email:</label>
                <input type="text" class="form-control" name="emailUser" id="emailUser" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="passwordUser">Password:</label>
                <input type="password" class="form-control" id="passwordUser" name="passwordUser" placeholder="Enter password">
            </div>

            <button type="submit" id="Enter" name="register" value="register" class="btn btn-success">Enter</button>

            <?php

            if (isset($_POST["register"])) {

                $emailUser = $_POST['emailUser'];
                $nameUser = $_POST['nameUser'];
                $passwordUser = $_POST['passwordUser'];
                $userType = "utilizador";

                // $uppercase = preg_match('@[A-Z]@', $passwordUser);
                // $lowercase = preg_match('@[a-z]@', $passwordUser);
                // $number = preg_match('@[0-9]@', $passwordUser);
                // $specialChars = preg_match('@[^\w]@', $passwordUser);

                if (!preg_match("/^[a-zA-Z ]*$/", $nameUser)) {
                    echo '<script language="javascript" type="text/javascript"> alert("Por favor digite um nome correto. (Só letras)"); window.location.href="register.php" </script>';
                } else if (!filter_var($emailUser, FILTER_VALIDATE_EMAIL)) {
                    echo '<script language="javascript" type="text/javascript"> alert("Por favor digite um email correto."); window.location.href="register.php" </script>';
                } else {

                    //$passEncript = password_hash($passwordUser, PASSWORD_DEFAULT);

                    $stmt = $conn->prepare('INSERT INTO users VALUES(?,?,?,?)');
                    $stmt->bind_param('ssss', $emailUser, $nameUser, $passwordUser, $userType);
                    $stmt->execute();
                    $stmt->close();
                    echo '<script>location.href="http://localhost/DesafioDrible/index.php"</script>';
                    exit();
                }
            }

            ?>

        </form>

    </div>

</body>

</html>