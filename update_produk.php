<?php
include 'header.php';
include 'sidebar.php';

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
} else {
    die("ID produk tidak ditemukan.");
}

$sql = "SELECT * FROM produk_wisata WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
   
    echo "<div class='main-content'>";
    echo "<h2>Update Produk Wisata</h2>";
    echo "<form action='update_produk.php?id=" . $row['id'] . "' method='POST' enctype='multipart/form-data'>";
    echo "<label for='nama_wisata'>Nama Wisata:</label>";
    echo "<input type='text' name='nama_wisata' value='" . $row['nama_wisata'] . "' required><br>";
    echo "<label for='deskripsi'>Deskripsi:</label>";
    echo "<textarea name='deskripsi' required>" . $row['deskripsi'] . "</textarea><br>";
    echo "<label for='foto'>Foto:</label>";
    echo "<input type='file' name='foto'><br>";
    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
    echo "<input type='submit' name='update' value='Update'>";
    echo "</form>";
    echo "</div>";
} else {
    echo "Produk tidak ditemukan.";
}

if (isset($_POST['update'])) {
    $nama_wisata = $_POST['nama_wisata'];
    $deskripsi = $_POST['deskripsi'];
    $foto = $_FILES['foto']['name'];

    
    if ($foto != "") {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["foto"]["name"]);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
    } else {
        $foto = $row['foto']; 
    }

    $sql_update = "UPDATE produk_wisata SET nama_wisata='$nama_wisata', deskripsi='$deskripsi', foto='$foto' WHERE id=$id";

    if ($conn->query($sql_update) === TRUE) {
        
        session_start();
        $_SESSION['notif'] = "Data wisata berhasil diperbarui.";
        
       
        header("Location: data_wisata.php"); 
        exit();
    } else {
        echo "Error: " . $sql_update . "<br>" . $conn->error;
    }
}

$conn->close();
?>
