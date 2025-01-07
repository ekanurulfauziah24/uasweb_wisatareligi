<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "wisatareligieka"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $sql = "SELECT foto FROM produk_wisata WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $foto = $row['foto'];

    
    $sql_delete = "DELETE FROM produk_wisata WHERE id = $id";
    if ($conn->query($sql_delete) === TRUE) {
        
        if (file_exists("uploads/" . $foto)) {
            unlink("uploads/" . $foto);
        }
        echo "Produk wisata berhasil dihapus. <a href='data_wisata.php'>Kembali ke daftar</a>";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID produk tidak ditemukan.";
}


$conn->close();
?>
