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

        <h1>Users Area </h1>
        <hr>
        <br>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
            Add User
        </button>

        <br><br>

        <div id="addUserModal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <form class="form" role="form" enctype="multipart/form-data" autocomplete="off" id="formAdd" novalidate="" method="POST">

                        <div class="modal-header">
                            <h4 class="modal-title">Insert User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>

                        <div class="modal-body">

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="nameUser" required>
                            </div>

                            <div class="form-group">
                                <label>Email</label> <br>
                                <input type="text" class="form-control" name="emailUser" required>
                            </div>

                            <div class="form-group">
                                <label>Password</label> <br>
                                <input type="password" class="form-control" name="passwordUser" required>
                            </div>

                            <label>User Type</label> <br>
                            <select name="userType" id="userType">
                                <option value="admin">admin</option>
                                <option value="utilizador">utilizador</option>
                            </select> <br><br>

                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn btn-default" aria-hidden="true">Cancel</button>
                                <button type="submit" name="add" class="btn btn-success" value="add" id="btnAdd">Add</button>
                            </div>

                            <?php

                            if (isset($_POST["add"])) {

                                $nameUser = $_POST['nameUser'];
                                $emailUser = $_POST['emailUser'];
                                $passwordUser = $_POST['passwordUser'];
                                $userType = $_POST['userType'];

                                $stmt = $conn->prepare('INSERT INTO users VALUES(?,?,?,?)');
                                $stmt->bind_param('ssss', $emailUser, $nameUser, $passwordUser, $userType);
                                $stmt->execute();

                                if ($stmt->affected_rows === 1) {
                                    echo "<meta http-equiv='refresh' content='0'>";
                                } else {
                                    echo "Error: " . $sql2 . "<br>" . $conn->error;
                                }
                                $stmt->close();
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
                    <th>Email</th>
                    <th>Name</th>
                    <th>Password </th>
                    <th>User Type </th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                <?php

                $stmt = $conn->prepare("SELECT * FROM users order by nameUser");
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows === 0) exit('No rows');
                while ($row = $result->fetch_assoc()) {
                    $emailUser = $row["emailUser"];
                ?>
                    <tr>
                        <div class="col-sm-3">
                            <td> <?php echo $row['emailUser']; ?> </td>
                            <td> <?php echo $row['nameUser']; ?> </td>
                            <td> <?php echo $row['passwordUser']; ?> </td>
                            <td> <?php echo $row['userType']; ?> </td>
                            <td><?php echo "<a href='editUser.php?email=" . $emailUser . "'>Edit</a>"; ?></td>
                        </div>
                    </tr>
                <?php }
                $stmt->close(); ?>

            </tbody>
        </table>


    </main>

</body>

</html>