<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


ini_set('display_errors', 1);
error_reporting(E_ALL);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (empty($_POST['email']) || empty($_POST['judul']) || empty($_POST['pesan'])) {
        echo "Semua field harus diisi!";
        exit; 
    }

    
    $email = htmlspecialchars($_POST['email']);
    $judul = htmlspecialchars($_POST['judul']);
    $pesan = htmlspecialchars($_POST['pesan']);

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Alamat email tidak valid!";
        exit;
    }

    
    $mail = new PHPMailer(true);

    try {
        
        $mail->SMTPDebug = 0; 
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'ekanf242@gmail.com'; 
        $mail->Password = 'xgfdqwskfmdzuozz'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port = 587; 

        
        $mail->setFrom('ekanf242@gmail.com'); 
        $mail->addAddress($email); 

        
        $mail->isHTML(false); 
        $mail->Subject = $judul;
        $mail->Body = $pesan;

        
        if ($mail->send()) {
            
            header("Location: kontak.php?alert=berhasil");
            exit; 
        } else {
            
            header("Location: kontak.php?alert=gagal");
            exit; 
        }
    } catch (Exception $e) {
        
        header("Location: kontak.php?alert=gagal");
        exit; 
    }
}
?>
