<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "wisatareligieka"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM produk_wisata";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk Wisata</title>
    <link rel="stylesheet" href="styles.css"> <!-- Jika Anda punya file CSS -->
</head>
<body>
    <h1>Daftar Produk Wisata</h1>

    <table border="1">
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
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nama_wisata'] . "</td>";
                    echo "<td>" . $row['deskripsi'] . "</td>";
                    echo "<td><img src='uploads/" . $row['foto'] . "' width='100'></td>";
                    echo "<td>" . $row['tanggal_update'] . "</td>";
                    echo "<td>
                            <a href='update_produk.php?id=" . $row['id'] . "'>Update</a> | 
                            <a href='delete_produk.php?id=" . $row['id'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus produk ini?\")'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Tidak ada data produk wisata.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php

$conn->close();
?>
