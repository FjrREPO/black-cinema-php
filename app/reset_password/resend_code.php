<?php
session_start();
include '../../config/conn.php';
require '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "resend_code") {
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $code = rand(100000, 999999);
        $_SESSION['code'] = $code;

        // Inisialisasi PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Konfigurasi server SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Ganti dengan host SMTP Anda
            $mail->SMTPAuth = true;
            $mail->Username = 'mw18804@gmail.com'; // Ganti dengan email Anda
            $mail->Password = 'wzenxtdsmogysqvm'; // Ganti dengan password aplikasi Anda
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587; // Ganti dengan port SMTP yang sesuai

            // Pengaturan email pengirim dan penerima
            $mail->setFrom('mw18804@gmail.com', 'Black Cinema'); // Ganti dengan nama dan email Anda
            $mail->addAddress($email);

            // Konten email dalam format HTML
            $mail->isHTML(true);
            $mail->Subject = 'Kode Verifikasi';
            ob_start(); // Memulai output buffering
            include 'email_content.php'; // Memasukkan konten email dari file terpisah
            $mail->Body = ob_get_clean(); // Mendapatkan dan membersihkan output buffering

            // Kirim email
            $mail->send();
            // Set session success message
            $_SESSION['success_message'] = "Kode verifikasi telah terkirim ke email Anda.";
        } catch (Exception $e) {
            $_SESSION['resend_error'] = "Gagal mengirim kode verifikasi. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $_SESSION['resend_error'] = "Email tidak ditemukan.";
    }
}

header("location: verify_code.php");
exit();
