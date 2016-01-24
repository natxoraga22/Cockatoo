<?php

define("DB_HOST", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "cockatoo");

$connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$connection) {
    die("CONNECTION ERROR: " . mysqli_connect_errno() . " - " . mysqli_connect_error());
}

//echo "CONNECTION SUCCESFUL: " . mysqli_get_host_info($connection) . PHP_EOL;

?>