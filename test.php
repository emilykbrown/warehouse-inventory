<?php

$password = 'HelloWorld123!';
$hash = password_hash($password, PASSWORD_DEFAULT);
echo $hash;

// Then store $hash in the database



?>