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


// Mendapatkan data dari form
$nik = $_POST['nik'];
$no_kk = $_POST['no_kk'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$gol_darah = $_POST['gol_darah'];
$agama = $_POST['agama'];
$status_nikah = $_POST['status_nikah'];
$status_keluarga = $_POST['status_keluarga'];
$alamat_asal = $_POST['alamat_asal'];
$rt_asal = $_POST['rt_asal'];
$rw_asal = $_POST['rw_asal'];
$provinsi_asal = $_POST['provinsi_asal'];

// Menyiapkan query
$query = "INSERT INTO penduduk (
    nik, 
    no_kk, 
    nama, 
    jenis_kelamin, 
    tempat_lahir, 
    tanggal_lahir, 
    gol_darah, 
    agama, 
    status_nikah, 
    status_keluarga, 
    alamat_asal, 
    rt_asal, 
    rw_asal, 
    provinsi_asal
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Menyiapkan statement
$stmt = $mysqli->prepare($query);

// Bind parameter
$stmt->bind_param("ssssssssssssss", $nik, $no_kk, $nama, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $gol_darah, $agama, $status_nikah, $status_keluarga, $alamat_asal, $rt_asal, $rw_asal, $provinsi_asal);

// Eksekusi query
if ($stmt->execute()) {
    echo "Data berhasil ditambahkan!";
} else {
    echo "Error: " . $stmt->error;
}

// Menutup statement dan koneksi
$stmt->close();
$mysqli->close();
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
    <link rel="stylesheet" href="css/penduduk.css">
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
        <li><a href="dashboard.php"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
        <li><a href=""><i class="fas fa-users"></i><span>Data Penduduk</span></a></li>
        <li><a href="#"><i class="fas fa-baby"></i><span>Data Kelahiran</span></a></li>
        <li><a href="#"><i class="fas fa-skull-crossbones"></i><span>Data Kematian</span></a></li>
        <li><a href="#"><i class="fas fa-chart-bar"></i><span>Laporan</span></a></li>
    </ul>
    <i class="fas fa-bars toggle-btn"></i> <!-- Tombol Hamburger -->
</div>
 <!-- Content -->
 <div class="content">
        <div class="title">Data Penduduk Masuk</div>

        <div class="form-container">
    <form method="POST">
        <h3>Tambah Penduduk</h3>
        
        <div class="form-group">
            <label for="nik">NIK:</label>
            <input type="text" name="nik" id="nik" maxlength="16" required>
        </div>

        <div class="form-group">
            <label for="no_kk">No KK:</label>
            <input type="text" name="no_kk" id="no_kk" maxlength="20" required>
        </div>

        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" required>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select name="jenis_kelamin" id="jenis_kelamin" required>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir:</label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" required>
        </div>

        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" required>
        </div>

        <div class="form-group">
            <label for="gol_darah">Golongan Darah:</label>
            <select name="gol_darah" id="gol_darah" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="AB">AB</option>
                <option value="O">O</option>
            </select>
        </div>

        <div class="form-group">
            <label for="agama">Agama:</label>
            <select name="agama" id="agama" required>
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
                <option value="Konghucu">Konghucu</option>
            </select>
        </div>

        <div class="form-group">
            <label for="status_nikah">Status Nikah:</label>
            <select name="status_nikah" id="status_nikah" required>
                <option value="Belum Menikah">Belum Menikah</option>
                <option value="Menikah">Menikah</option>
                <option value="Cerai">Cerai</option>
            </select>
        </div>

        <div class="form-group">
            <label for="status_keluarga">Status Keluarga:</label>
            <select name="status_keluarga" id="status_keluarga" required>
                <option value="Kepala Keluarga">Kepala Keluarga</option>
                <option value="Anggota Keluarga">Anggota Keluarga</option>
            </select>
        </div>

        <div class="form-group">
            <label for="alamat_asal">Alamat Asal:</label>
            <textarea name="alamat_asal" id="alamat_asal" required></textarea>
        </div>

        <div class="form-group">
            <label for="rt_asal">RT Asal:</label>
            <input type="number" name="rt_asal" id="rt_asal" required>
        </div>

        <div class="form-group">
            <label for="rw_asal">RW Asal:</label>
            <input type="number" name="rw_asal" id="rw_asal" required>
        </div>

        <div class="form-group">
            <label for="provinsi_asal">Provinsi Asal:</label>
            <input type="text" name="provinsi_asal" id="provinsi_asal" required>
        </div>

        <button type="submit" name="add_penduduk">Tambah</button>
    </form>
</div>


        <!-- Tabel Penduduk -->
        <div class="table-container">
            <h3>Daftar Penduduk</h3>
            <table>
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Agama</th>
                        <th>RT</th>
                        <th>RW</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['nik']; ?></td>
                                <td><?php echo $row['nama']; ?></td>
                                <td><?php echo $row['jenis_kelamin']; ?></td>
                                <td><?php echo $row['tempat_lahir']; ?></td>
                                <td><?php echo $row['tanggal_lahir']; ?></td>
                                <td><?php echo $row['agama']; ?></td>
                                <td><?php echo $row['rt_asal']; ?></td>
                                <td><?php echo $row['rw_asal']; ?></td>
                                <td>
                                    <a href="edit_penduduk.php?id=<?php echo $row['nik']; ?>">Edit</a>
                                    <a href="delete_penduduk.php?id=<?php echo $row['nik']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9">Tidak ada data penduduk</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
        
         

   
    <!-- JS Scripts -->
    <script src="js/dashboard.js"></script>
</body>
</html>