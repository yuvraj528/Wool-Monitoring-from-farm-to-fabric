<?php
session_start();

require_once('db_config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signupSubmit'])) {
    $signupUsername = $_POST['signupUsername'];
    $signupPassword = $_POST['signupPassword'];

    // Check if the username already exists
    $checkUsername = "SELECT * FROM users WHERE username = '$signupUsername'";
    $result = $conn->query($checkUsername);

    if ($result->num_rows > 0) {
        $signupError = "Username already exists. Please choose another username.";
    } else {
        // Insert new user into the database
        $insertUser = "INSERT INTO users (username, password) VALUES ('$signupUsername', '$signupPassword')";
        if ($conn->query($insertUser) === TRUE) {
            $_SESSION['username'] = $signupUsername;
            header("Location: welcome.php");
            exit();
        } else {
            $signupError = "Error creating user: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <div class="form-container">
            <h2>Sign Up</h2>
            <form action="" method="post">
                <label for="signupUsername">Username:</label>
                <input type="text" id="signupUsername" name="signupUsername" required>

                <label for="signupPassword">Password:</label>
                <input type="password" id="signupPassword" name="signupPassword" required>

                <button type="submit" name="signupSubmit">Sign Up</button>
            </form>
            <?php if (isset($signupError)) { ?>
                <p style="color: red;"><?php echo $signupError; ?></p>
            <?php } ?>
        </div>
    </div>

</body>
</html>
