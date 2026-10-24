<?php
/* Database connection
   Original setup: database `user`, table `card_activation`.
   Change the values below if your MySQL setup is different. */
mysqli_report(MYSQLI_REPORT_OFF); // handle errors manually (never leak server details)
$con = mysqli_connect('localhost', 'root', '', 'user');

if ($con === false) {
    // FIX: the old version only echoed "Not Connected" and kept running, which
    // crashed every page with confusing errors. Fail cleanly with a helpful message.
    die('Database connection failed. Please check db.php and import the SQL file (see README).');
}
mysqli_set_charset($con, 'utf8mb4');
