<?php
include 'sidebar.php';
include 'header.php'; 

$alert = '';
if (isset($_GET['alert'])) {
    if ($_GET['alert'] == 'berhasil') {
        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> Email berhasil dikirim.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
    } elseif ($_GET['alert'] == 'gagal') {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> Gagal mengirim email. Silakan coba lagi.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar dengan Notifikasi</title>
    
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


    <div class="main-content">
        <div class="container mt-3">
            <h2>Kirim Email Menggunakan PHP</h2>

            
            <?= $alert ?>

            <form action="kirim.php" method="post">
                <div class="mb-3 mt-3">
                    <label>Email Tujuan:</label>
                    <input type="email" class="form-control" placeholder="Email Tujuan" name="email" required>
                </div>
                <div class="mb-3 mt-3">
                    <label>Judul Pesan:</label>
                    <input type="text" class="form-control" placeholder="Judul Pesan" name="judul" required>
                </div>
                <div class="mb-3 mt-3">
                    <label>Isi Pesan:</label>
                    <textarea class="form-control" name="pesan" placeholder="Pesan" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>
<?php include 'footer.php'; ?>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
