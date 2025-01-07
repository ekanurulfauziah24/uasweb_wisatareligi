<?php
include 'sidebar.php';
include 'header.php';

$host = "localhost";
$user = "root";
$password = "";
$database = "wisatareligieka";

$connection = mysqli_connect($host, $user, $password, $database);

if (!$connection) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

$notifMessage = '';  

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul_profil = mysqli_real_escape_string($connection, $_POST['judul_profil']);
    $isi_profil = mysqli_real_escape_string($connection, $_POST['isi_profil']);
    $tgl_update = date('Y-m-d');
    $gambar = $_FILES['gambar']['name'];
    
    if ($gambar != '') {
        $target = "uploads/" . basename($gambar);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target);
        $sql_update = "UPDATE profil SET judul_profil='$judul_profil', isi_profil='$isi_profil', gambar='$gambar', tgl_update='$tgl_update' WHERE id='$id'";
    } else {
        $sql_update = "UPDATE profil SET judul_profil='$judul_profil', isi_profil='$isi_profil', tgl_update='$tgl_update' WHERE id='$id'";
    }

    if (mysqli_query($connection, $sql_update)) {
        $notifMessage = 'Profil berhasil diupdate.';
    } else {
        $notifMessage = 'Error: ' . mysqli_error($connection);
    }
}

if (isset($_POST['submit'])) {
    $judul_profil = mysqli_real_escape_string($connection, $_POST['judul_profil']);
    $isi_profil = mysqli_real_escape_string($connection, $_POST['isi_profil']);
    $tgl_update = date('Y-m-d');
    $gambar = $_FILES['gambar']['name'];
    $target = "uploads/" . basename($gambar);

    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
        $sql_insert = "INSERT INTO profil (judul_profil, isi_profil, gambar, tgl_update) VALUES ('$judul_profil', '$isi_profil', '$gambar', '$tgl_update')";
        
        if (mysqli_query($connection, $sql_insert)) {
            $notifMessage = 'Data berhasil ditambahkan.';
        } else {
            $notifMessage = 'Error: ' . mysqli_error($connection);
        }
    } else {
        $notifMessage = 'Gagal mengunggah gambar.';
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql_delete = "DELETE FROM profil WHERE id='$id'";
    if (mysqli_query($connection, $sql_delete)) {
        $notifMessage = 'Profil berhasil dihapus.';
    } else {
        $notifMessage = 'Error: ' . mysqli_error($connection);
    }
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM profil WHERE id = $id";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah/Edit Profil</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            color: #fff;
            padding: 15px;
        }
        .sidebar a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #495057;
        }
        .sidebar i {
            margin-right: 10px; 
        }
        .main-content {
            margin-left: 260px; 
            padding: 20px;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .alert {
            padding: 10px;
            margin: 20px 0;
            border-radius: 5px;
            font-size: 1rem;
        }
        .alert.success {
            background-color: #4CAF50;
            color: white;
        }
        .alert.error {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
    
    <div class="sidebar">
        <h4 class="text-center">Menu</h4>
        <a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="profil.php" class="<?= basename($_SERVER['PHP_SELF']) == 'profil.php' ? 'active' : '' ?>"><i class="fas fa-user"></i> Profil</a>
        <a href="data_wisata.php" class="<?= basename($_SERVER['PHP_SELF']) == 'data_wisata.php' ? 'active' : '' ?>"><i class="fas fa-map-marked-alt"></i> Data Wisata</a>
        <a href="upload_wisata.php" class="<?= basename($_SERVER['PHP_SELF']) == 'upload_wisata.php' ? 'active' : '' ?>"><i class="fas fa-upload"></i> Upload Wisata</a>
        <a href="kontak.php"><i class="fas fa-envelope"></i> Kontak</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    
    <div class="main-content">
        <h1><?php echo isset($_GET['edit']) ? 'Edit Profil' : 'Tambah Profil'; ?></h1>
        
        
        <?php if ($notifMessage != ''): ?>
            <div class="alert <?php echo (strpos($notifMessage, 'berhasil') !== false) ? 'success' : 'error'; ?>">
                <?php echo $notifMessage; ?>
            </div>
        <?php endif; ?>

        <form action="profil.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo isset($row) ? $row['id'] : ''; ?>">

            <div class="form-group">
                <label for="judul_profil">Judul Profil:</label>
                <input type="text" name="judul_profil" id="judul_profil" class="form-control" value="<?php echo isset($row) ? $row['judul_profil'] : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="isi_profil">Isi Profil:</label>
                <textarea name="isi_profil" id="isi_profil" class="form-control" rows="4" required><?php echo isset($row) ? $row['isi_profil'] : ''; ?></textarea>
            </div>

            <div class="form-group">
                <label for="gambar">Gambar:</label>
                <input type="file" name="gambar" id="gambar" class="form-control">
            </div>

            <?php if (isset($row) && $row['gambar']): ?>
                <p>Gambar saat ini: <img src="uploads/<?php echo $row['gambar']; ?>" alt="Gambar Profil" width="100"></p>
            <?php endif; ?>

            <div class="form-group">
                <input type="submit" name="submit" value="Tambah Profil" class="btn btn-primary">
                <?php if (isset($_GET['edit'])): ?>
                    <input type="submit" name="update" value="Update Profil" class="btn btn-warning">
                <?php endif; ?>
            </div>
        </form>

        <h1>Daftar Profil</h1>
        <?php
        $sql = "SELECT id, judul_profil, isi_profil, gambar, tgl_update FROM profil";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='profil'>";
                echo "<h2>" . htmlspecialchars($row['judul_profil']) . "</h2>";
                echo "<p>" . nl2br(htmlspecialchars($row['isi_profil'])) . "</p>";
                echo "<img src='uploads/" . htmlspecialchars($row['gambar']) . "' alt='" . htmlspecialchars($row['judul_profil']) . "'>";
                echo "<p>Last updated: " . htmlspecialchars($row['tgl_update']) . "</p>";
                echo "<div class='actions'>";
                echo "<a href='profil.php?delete=" . $row['id'] . "' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a> | ";
                echo "<a href='profil.php?edit=" . $row['id'] . "'>Edit</a>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='alert error'>Belum ada profil yang tersedia.</div>";
        }

        mysqli_close($connection);
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
