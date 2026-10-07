<?php
session_start();
require 'koneksi.php';

if (!isset($_POST['submit'])) {
    header("Location: pendaftaran.php");
    exit;
}

$daftar_jurusan    = ["SIJA", "TJAT"];
$daftar_perusahaan = ["PT Telkom Indonesia", "PT Len Industri", "PT Pertamina", "CV Teknologi Nusantara"];
$daftar_tech       = ["HTML dan CSS", "PHP", "JavaScript", "MySQL", "Jaringan"];

$errors = [];

$nama       = trim($_POST['nama'] ?? '');
$nis        = trim($_POST['nis'] ?? '');
$email      = trim($_POST['email'] ?? '');
$jurusan    = $_POST['jurusan'] ?? '';
$perusahaan = $_POST['perusahaan'] ?? '';
$tech       = $_POST['tech'] ?? [];
$alasan     = trim($_POST['alasan'] ?? '');

if (empty($nama)) {
    $errors[] = "Nama Lengkap wajib diisi.";
}
if (empty($nis)) {
    $errors[] = "NIS wajib diisi.";
} elseif (!ctype_digit($nis)) {
    $errors[] = "NIS harus berupa angka.";
}
if (empty($email)) {
    $errors[] = "Email Siswa wajib diisi.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Format Email Siswa tidak valid.";
}
if (empty($jurusan) || !in_array($jurusan, $daftar_jurusan)) {
    $errors[] = "Kompetensi Keahlian wajib dipilih.";
}
if (empty($perusahaan) || !in_array($perusahaan, $daftar_perusahaan)) {
    $errors[] = "Pilihan Perusahaan PKL wajib dipilih.";
}
if (empty($tech) || !is_array($tech) || array_diff($tech, $daftar_tech)) {
    $errors[] = "Minimal satu Tech Stack wajib dipilih.";
}
if (empty($alasan)) {
    $errors[] = "Alasan Memilih Perusahaan wajib diisi.";
}

if (empty($errors)) {
    try {
        $sql = "INSERT INTO pendaftaran_pkl
                    (nama, nis, email, jurusan, perusahaan, tech_stack, alasan)
                VALUES
                    (:nama, :nis, :email, :jurusan, :perusahaan, :tech_stack, :alasan)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nama'       => $nama,
            ':nis'        => $nis,
            ':email'      => $email,
            ':jurusan'    => $jurusan,
            ':perusahaan' => $perusahaan,
            ':tech_stack' => implode(", ", $tech),
            ':alasan'     => $alasan,
        ]);

        header("Location: hasil.php?id=" . $pdo->lastInsertId());
        exit;
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            $errors[] = "NIS sudah terdaftar.";
        } else {
            $errors[] = "Data gagal disimpan. Silakan coba lagi.";
        }
    }
}

$_SESSION['errors'] = $errors;
header("Location: pendaftaran.php");
exit;
