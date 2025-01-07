<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wisatareligieka"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sqlProfil = "SELECT * FROM profil WHERE id = 1"; 
$resultProfil = $conn->query($sqlProfil);
$profil = $resultProfil->fetch_assoc();


$sqlProdukWisata = "SELECT * FROM produk_wisata";
$resultProduk = $conn->query($sqlProdukWisata);


$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 30px;
        }
        .profil-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>


<?php include 'header.php'; ?>


<?php include 'sidebar.php'; ?>


<div class="main-content" style="margin-left: 250px; padding: 20px;">
    <div class="container">
        <?php if ($profil): ?>
            <div class="row">
                <div class="col-md-4">
                    
                    <img src="uploads/<?php echo htmlspecialchars($profil['foto']); ?>" alt="Profil" class="profil-img">
                </div>
                <div class="col-md-8">
                    
                    <h2><?php echo htmlspecialchars($profil['nama']); ?></h2>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($profil['email']); ?></p>
                    <p><strong>Deskripsi:</strong></p>
                    <p><?php echo nl2br(htmlspecialchars($profil['deskripsi'])); ?></p>

                    
                    <a href="update_profil.php?id=<?php echo $profil['id']; ?>" class="btn btn-primary">Update Profil</a>
                    
                    
                    <a href="delete_profil.php?id=<?php echo $profil['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus profil ini?')">Delete Profil</a>
                </div>
        </div>
        <?php endif; ?>

        
        <h2 class="mt-5">Daftar Produk Wisata</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Wisata</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Tanggal Update</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultProduk->num_rows > 0): ?>
                    <?php while ($row = $resultProduk->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_wisata']); ?></td>
                            <td><?php echo htmlspecialchars($row['deskripsi']); ?></td>
                            <td><img src="uploads/<?php echo htmlspecialchars($row['foto']); ?>" width="100"></td>
                            <td><?php echo htmlspecialchars($row['tanggal_update']); ?></td>
                            <td>
                                
                                <a href="update_produk.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Update</a>
                                <a href="delete_produk.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk wisata ini?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6">Tidak ada data produk wisata.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
