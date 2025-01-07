<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "wisatareligieka"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    
    $nama_wisata = $_POST['nama_wisata'];
    $deskripsi = $_POST['deskripsi'];

    
    $foto = $_FILES['foto']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($foto);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check === false) {
        echo "File yang diupload bukan gambar.";
        exit();
    }

    
    if (file_exists($target_file)) {
        echo "Maaf, file sudah ada.";
        exit();
    }

    if ($_FILES["foto"]["size"] > 5000000) { 
        echo "Maaf, file terlalu besar.";
        exit();
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Maaf, hanya file gambar JPG, JPEG, PNG & GIF yang diizinkan.";
        exit();
    }

    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
    
        $sql = "INSERT INTO produk_wisata (nama_wisata, deskripsi, foto) VALUES ('$nama_wisata', '$deskripsi', '$foto')";

        if ($conn->query($sql) === TRUE) {
            echo "Produk wisata berhasil di-upload.";
            echo "<a href='data_wisata.php'>Lihat Data Wisata</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Maaf, ada masalah saat meng-upload file.";
    }
}

$conn->close();
?>
