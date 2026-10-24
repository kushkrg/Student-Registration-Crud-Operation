<?php require_once __DIR__ . '/includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($pageTitle ?? 'Dashboard') ?> | Student Registration CRUD</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="layout">
<aside class="sidebar" id="sidebar">
  <a class="brand" href="index.php">
    <span class="brand-icon">S</span>
    <span>Student<b>CRUD</b></span>
  </a>
  <nav class="side-nav" style="margin-top:8px">
    <a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : '' ?>">All Students</a>
    <a href="add.php" class="<?= basename($_SERVER['PHP_SELF']) === 'add.php' ? 'active' : '' ?>">+ Add Student</a>
    <a href="export.php">Export CSV</a>
  </nav>
  <div class="side-foot">Secure &bull; Core PHP + MySQL</div>
</aside>
<div class="topbar">
  <button class="menu-btn" onclick="document.getElementById('sidebar').classList.toggle('open')" aria-label="Menu">&#9776;</button>
  <strong><?= e($pageTitle ?? 'Dashboard') ?></strong>
</div>
<main class="main">
