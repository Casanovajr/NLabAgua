<?php
require __DIR__ . '/includes/config.php';
$new = password_hash('admin123', PASSWORD_BCRYPT);
mysqli_query($connection, "UPDATE admin SET password='{$new}' WHERE email='admin@labagua.com'");
echo mysqli_affected_rows($connection) ? 'OK' : 'NOK';?>