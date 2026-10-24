<?php
// Export students as a real CSV file.
// FIXES vs old export.php: it waited for a POST field while the page also linked
// it in ways that silently failed, it sent an HTML table labelled .xls with raw
// unescaped data, and it used a hardcoded personal filename. This version works
// with GET, follows the current search, and writes proper CSV.
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/includes/functions.php';

$q = trim($_GET['q'] ?? '');
$where = '';
if ($q !== '') {
    $where = ' WHERE u_f_name LIKE ? OR u_l_name LIKE ? OR u_card LIKE ? OR u_phone LIKE ? OR u_email LIKE ?';
}
$stmt = mysqli_prepare($con, 'SELECT * FROM card_activation' . $where . ' ORDER BY id DESC');
if ($q !== '') { $like = '%' . $q . '%'; mysqli_stmt_bind_param($stmt, 'sssss', $like, $like, $like, $like, $like); }
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$filename = 'students_' . date('Ymd_His') . '.csv';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');
$out = fopen('php://output', 'w');
fputcsv($out, ['S.L', 'Card No', 'First Name', 'Last Name', 'Father Name', 'Mother Name', 'Aadhar No', 'Gender', 'Date of Birth', 'Email', 'Mobile No', 'Family Members', 'Village', 'Police Station', 'District', 'State', 'Pincode', 'Staff ID', 'Photo', 'Issue Date']);
$i = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $i++;
    fputcsv($out, [$i, $row['u_card'], $row['u_f_name'], $row['u_l_name'], $row['u_father'], $row['u_mother'], $row['u_aadhar'], $row['u_gender'], $row['u_birthday'], $row['u_email'], $row['u_phone'], $row['u_family'], $row['u_village'], $row['u_police'], $row['u_dist'], $row['u_state'], $row['u_pincode'], $row['staff_id'], $row['image'], $row['uploaded']]);
}
fclose($out);
mysqli_stmt_close($stmt);
exit;
