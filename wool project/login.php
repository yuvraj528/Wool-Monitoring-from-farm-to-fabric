<?php
session_start();

require_once('db_config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['loginSubmit'])) {
    $loginUsername = $_POST['loginUsername'];
    $loginPassword = $_POST['loginPassword'];

    $sql = "SELECT * FROM users WHERE username = '$loginUsername' AND password = '$loginPassword'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $loginUsername;
        header("Location: welcome.php");
        exit();
    } else {
        $loginError = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <div class="form-container">
            <h2>Login</h2>
            <form action="" method="post">
                <label for="loginUsername">Username:</label>
                <input type="text" id="loginUsername" name="loginUsername" required>

                <label for="loginPassword">Password:</label>
                <input type="password" id="loginPassword" name="loginPassword" required>

                <button type="submit" name="loginSubmit">Login</button>
            </form>
            <?php if (isset($loginError)) { ?>
                <p style="color: red;"><?php echo $loginError; ?></p>
            <?php } ?>
        </div>
    </div>

</body>
</html>
