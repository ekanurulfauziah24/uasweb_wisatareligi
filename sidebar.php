<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    
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
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center">Menu</h4>
        <a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="profil.php" class="<?= basename($_SERVER['PHP_SELF']) == 'profil.php' ? 'active' : '' ?>"><i class="fas fa-user"></i> Profil</a>
        <a href="data_wisata.php" class="<?= basename($_SERVER['PHP_SELF']) == 'data_wisata.php' ? 'active' : '' ?>"><i class="fas fa-map-marked-alt"></i> Data Wisata</a>
        <a href="upload_wisata.php" class="<?= basename($_SERVER['PHP_SELF']) == 'upload_wisata.php' ? 'active' : '' ?>"><i class="fas fa-upload"></i> Upload Wisata</a> <!-- Menambahkan link Upload Wisata -->
        <a href="kontak.php"><i class="fas fa-envelope"></i> Kontak</a> 
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a> 
    </div>
</body>
</html>
