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
            <li class="nav-item">
                <a class="nav-link" href="products.php">Products</a>
            </li>
        </ul>
        <ul class="navbar-nav justify-content-end">
            <li class="nav-item active">
                <a class="nav-link" href="profile.php">My profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../util/logout.php">Log Out, <?php echo $utl ?></a>
            </li>
        </ul>
    </nav>

</body>

<?php

$stmt = $conn->prepare("SELECT * FROM users WHERE emailUser = '$utl'");
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 1) {
    $row = mysqli_fetch_array($result);
}

?>

<div class="profile">

    <div class="profile_foto">
        <img src="../../DesafioDrible/images/avatar.png" style="width:8%">
    </div>

    <div class="profile_name">
        <h3 style="font-family: 'Times New Roman', Times, serif;">Welcome </h3>
        <h2 style="text-transform: uppercase;"><?php echo $row['nameUser'] ?></h2>
    </div>

</div>

<main>
    <h1>Contact Informations:</h1>

</main>

<form class="form_profile" method="POST">

    <table class="tableProfile">
        <tr>
            <th>Name</th>
            <th>Password</th>
        </tr>
        <tr>
            <td>
                <input type="text" name="nameUser" value="<?php echo $row['nameUser'] ?>">
            </td>
            <td>
                <input type="password" name="passwordUser" value="<?php echo $row['passwordUser'] ?>">
            </td>
        </tr>
    </table>

    <br><br>
    <div style="margin-right: 45%; margin-left: 45%;">
        <button type="submit" name="edit" class="btn btn-success">Edit</button>
        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
    </div>

    <?php

    if (isset($_POST["edit"])) {

        $emailUser = $row['emailUser'];
        $nameUser = $_POST['nameUser'];
        $passwordUser = $_POST['passwordUser'];

        $stmt = $conn->prepare('UPDATE users SET nameUser = ?, passwordUser = ? WHERE emailUser = ?');
        $stmt->bind_param('sss', $nameUser, $passwordUser, $emailUser);
        $stmt->execute();

        if ($stmt->affected_rows === 1) {
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo '<script language="javascript" type="text/javascript"> alert("Alguma coisa não está correta. Por favor tente novamente."); window.location.href="profile.php" </script>';
        }
        $stmt->close();
    }

    if (isset($_POST["delete"])) {

        $emailUser = $row['emailUser'];

        $sql = "DELETE FROM users WHERE emailUser='$emailUser' ";
        if ($conn->query($sql) === TRUE) {
            echo '<script>location.href="http://localhost/DesafioDrible/"</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    ?>
</form>


</html>