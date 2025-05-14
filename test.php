<?php
// Example password
$password = 'HelloWorld123!';

// Hash the password using bcrypt
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Output the hash (optional, to see it)
echo $hashed_password;
?>
