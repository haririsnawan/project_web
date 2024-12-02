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
    <!-- Import Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Link to External CSS -->
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    

    <!-- Navbar -->
    <div class="navbar">
    
        <div class="date"><?php echo date('l, F d, Y'); ?></div>
        <div class="user">
            <div class="dropdown">
                <div class="user-profile">
                    <img src="icon/user_15194213.png" alt="Profile Picture">
                    <span>Admin</span>
                </div>
                <div class="dropdown-content">
                    <a href="profile.php"><i class="fas fa-user"></i> Profil</a>
                    <a href="login.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    
<div class="sidebar">
    <div class="logo">
        <img src="icon/logo.png" alt="Logo">
    </div>
    <ul>
        <li><a href=""><i class="fas fa-home"></i><span>Dashboard</span></a></li>
        <li><a href="penduduk.php"><i class="fas fa-users"></i><span>Data Penduduk</span></a></li>
        <li><a href="#"><i class="fas fa-baby"></i><span>Data Kelahiran</span></a></li>
        <li><a href="#"><i class="fas fa-skull-crossbones"></i><span>Data Kematian</span></a></li>
        <li><a href="#"><i class="fas fa-chart-bar"></i><span>Laporan</span></a></li>
    </ul>
    <i class="fas fa-bars toggle-btn"></i> <!-- Tombol Hamburger -->
</div>

        
         

    <!-- Content -->
    <div class="content">
        <div class="title">Selamat Datang, Admin!</div>
        <div class="card-container">
            <div class="card">
                <div class="icon"><i class="fas fa-users"></i></div>
                <h3><?php echo $total_penduduk; ?></h3>
                <p>Total Penduduk</p>
            </div>
            <div class="card">
                <div class="icon"><i class="fas fa-baby"></i></div>
                <h3><?php echo $total_kelahiran; ?></h3>
                <p>Total Kelahiran</p>
            </div>
            <div class="card">
                <div class="icon"><i class="fas fa-skull-crossbones"></i></div>
                <h3><?php echo $total_kematian; ?></h3>
                <p>Total Kematian</p>
            </div>
        </div>
    </div>

    <!-- JS Scripts -->
    <script src="js/dashboard.js"></script>
</body>
</html>