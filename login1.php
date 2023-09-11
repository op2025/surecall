<?php
session_start();
require_once 'config.php';

if(isset($_SESSION['username'])) {
    header("Location: dashboard.php");
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check credentials and set session variable
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch();

    if($result && password_verify($password, $result['password'])) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
    } else {
        $error = 'Invalid username or password';
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <?php if(isset($error)): ?>
            <div class="error"><?php echo $error ?></div>
        <?php endif ?>
        <form method="POST">
            <div class="user-box">
                <input type="text" name="username" required="">
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="">
                <label>Password</label>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>