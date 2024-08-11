<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $konfirmasi = $_POST["konfirmasi"];

    // Cek apakah password dan konfirmasi password cocok
    if ($password !== $konfirmasi) {
        echo "Password dan Konfirmasi Password tidak cocok.";
        exit();
    }

    // Hashing password untuk keamanan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk memasukkan data ke database
    $query_sql = "INSERT INTO tbl_login (username, email, password) 
                  VALUES ('$username', '$email', '$hashed_password')";

    if (mysqli_query($conn, $query_sql)) {
        // Redirect ke halaman index.html setelah pendaftaran berhasil
        header("Location: index.html");
        exit();
    } else {
        echo "Pendaftaran Gagal: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
