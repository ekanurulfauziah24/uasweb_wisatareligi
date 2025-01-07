<?php

include 'koneksi.php';
include 'sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Upload Produk Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 30px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container label {
            font-weight: bold;
        }
        .form-container input[type="text"],
        .form-container textarea,
        .form-container input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="container mt-4">
            <div class="row mt-4">
                <div class="col-md-8 offset-md-2">
                    <div class="form-container">
                        <h2>Form Upload Produk Wisata</h2>
                        <form action="upload_produk.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nama_wisata">Nama Wisata:</label>
                                <input type="text" name="nama_wisata" id="nama_wisata" required>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi:</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="foto">Foto (Upload):</label>
                                <input type="file" name="foto" accept="image/*" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="submit">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include "footer.php"; ?>
</body>
</html>
