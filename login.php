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
            <li class="nav-item active">
                <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.php">Register</a>
            </li>
        </ul>
    </nav>

    <h1>Login</h1>

    <div class="form-login">
        <form method="POST">

            <div class="form-group">
                <label class="control-label col-sm-2" for="emailUser">Email:</label>
                <input type="text" class="form-control" name="emailUser" id="emailUser" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="passwordUser">Password:</label>
                <input type="password" class="form-control" id="passwordUser" name="passwordUser" placeholder="Enter password">
            </div>

            <button type="submit" id="Enter" name="login" class="btn btn-success">Enter</button>

            <?php

            if (isset($_POST["login"])) {

                $emailUser = ($_POST['emailUser']);
                $passwordUser = ($_POST['passwordUser']);
                $session = $emailUser;

                $stmt = $conn->prepare("SELECT * FROM users WHERE emailUser = '$emailUser'");
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows == 1) {
                    while ($row = mysqli_fetch_array($result)) {
                        if ($passwordUser == $row['passwordUser']) {
                            $_SESSION['emailUser'] = $emailUser;
                            $_SESSION['userType'] = $row['userType'];
                            if ($_SESSION['userType'] == "utilizador") {
                                echo '<script>location.href="http://localhost/DesafioDrible/user/index.php"</script>';
                            } else if ($_SESSION['userType'] == "admin") {
                                echo '<script>location.href="http://localhost/DesafioDrible/admin/productManagement.php"</script>';
                            } else {
                                echo '<script language="javascript" type="text/javascript"> alert("Surgiu algum problema com o seu tipo de utilizador"); window.location.href="index.php" </script>';
                            }
                        } else {
                            echo '<script language="javascript" type="text/javascript"> alert("Os seus dados de acesso 1 estão errados."); window.location.href="index.php" </script>';
                        }
                    }
                } else {
                    session_unset();
                    echo '<script language="javascript" type="text/javascript"> alert("Os seus dados de acesso estão errados."); window.location.href="index.php" </script>';
                    $stmt->close();
                }
            }

            ?>

        </form>
    </div>

</body>

</html>