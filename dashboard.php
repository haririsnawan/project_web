<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "project_web");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data statistik
$total_penduduk = $conn->query("SELECT COUNT(*) as total FROM penduduk_masuk")->fetch_assoc()['total'];
$total_kelahiran = $conn->query("SELECT COUNT(*) as total FROM kelahiran")->fetch_assoc()['total'];
$total_kematian = $conn->query("SELECT COUNT(*) as total FROM kematian")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Data Kependudukan</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
  
    </style>
</head>
<body>
    Navbar
    <div class="navbar">
        <div class="date"><?php echo date('l, F d, Y'); ?></div>
        <div class="user">
            <div class="dropdown">
                <div class="user-profile">
                    <img src="icon/user_15194213.png" alt="Profile Picture">
                    <span>Admin</span>
                </div>
                <div class="dropdown-content">
                    <a href="profile.php">Profile</a>
                    <a href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="path/to/logo.png" alt="Logo">
        </div>
        <ul>
            <li><a href="#"><i class="icon">🏠</i> Dashboard</a></li>
            <li><a href="#"><i class="icon">📑</i> Data Penduduk</a></li>
            <li><a href="#"><i class="icon">👶</i> Data Kelahiran</a></li>
            <li><a href="#"><i class="icon">⚰️</i> Data Kematian</a></li>
            <li><a href="#"><i class="icon">📊</i> Laporan</a></li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="title">Selamat Datang, Admin!</div>
        <div class="card-container">
            <div class="card">
                <div class="icon">📑</div>
                <h3><?php echo $total_penduduk; ?></h3>
                <p>Total Penduduk</p>
            </div>
            <div class="card">
                <div class="icon">👶</div>
                <h3><?php echo $total_kelahiran; ?></h3>
                <p>Total Kelahiran</p>
            </div>
            <div class="card">
                <div class="icon">⚰️</div>
                <h3><?php echo $total_kematian; ?></h3>
                <p>Total Kematian</p>
            </div>
        </div>
    </div>
</body>
</html>
