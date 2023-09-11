<?php

// Connect to MySQL database on localhost 3300
$connection = mysqli_connect("localhost:3300", "username", "password", "database_name");

// Check if connection was successful
if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}

// Process registration form
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Insert user information into MySQL database
  $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
  mysqli_query($connection, $sql);

  // Close database connection
  mysqli_close($connection);
}

?>

<!-- Registration form HTML -->
<form method="POST" action="">
  <input type="text" name="name" placeholder="Name"><br>
  <input type="email" name="email" placeholder="Email"><br>
  <input type="password" name="password" placeholder="Password"><br>
  <input type="submit" name="submit" value="Register">
</form>
