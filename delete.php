<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/includes/functions.php';

// FIX: the old delete.php deleted via a GET link with the raw id pasted into SQL
// (delete.php?id=...) - SQL injection + CSRF + accidental deletes in one line.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('index.php');
}
verify_csrf();

$id = (int)($_POST['id'] ?? 0);

$stmt = mysqli_prepare($con, 'SELECT image FROM card_activation WHERE id = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $image);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

$stmt = mysqli_prepare($con, 'DELETE FROM card_activation WHERE id = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

if (!empty($image)) {
    $file = __DIR__ . '/upload_images/' . $image;
    if (is_file($file)) unlink($file);
}
set_flash('success', 'Student deleted successfully.');
redirect('index.php');
