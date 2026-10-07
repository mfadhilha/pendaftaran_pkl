<?php
require 'koneksi.php';

$id   = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$data = false;

if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM pendaftaran_pkl WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $data = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pendaftaran PKL</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Hasil Pendaftaran PKL</h1>

        <?php if (!$data) { ?>
            <div class="error">
                <p>Data pendaftaran tidak ditemukan.</p>
            </div>
        <?php } else { ?>
            <div class="sukses">
                <h2>Data Pendaftaran Berhasil Disimpan</h2>
                <table>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td><?php echo htmlspecialchars($data['nama']); ?></td>
                    </tr>
                    <tr>
                        <td>NIS</td>
                        <td><?php echo htmlspecialchars($data['nis']); ?></td>
                    </tr>
                    <tr>
                        <td>Email Siswa</td>
                        <td><?php echo htmlspecialchars($data['email']); ?></td>
                    </tr>
                    <tr>
                        <td>Kompetensi Keahlian</td>
                        <td><?php echo htmlspecialchars($data['jurusan']); ?></td>
                    </tr>
                    <tr>
                        <td>Perusahaan PKL</td>
                        <td><?php echo htmlspecialchars($data['perusahaan']); ?></td>
                    </tr>
                    <tr>
                        <td>Tech Stack</td>
                        <td><?php echo htmlspecialchars($data['tech_stack']); ?></td>
                    </tr>
                    <tr>
                        <td>Alasan Memilih</td>
                        <td><?php echo nl2br(htmlspecialchars($data['alasan'])); ?></td>
                    </tr>
                    <tr>
                        <td>Waktu Pendaftaran</td>
                        <td><?php echo htmlspecialchars($data['created_at']); ?></td>
                    </tr>
                </table>
            </div>
        <?php } ?>

        <p><br><a href="pendaftaran.php">Kembali ke form</a></p>
    </div>
</body>

</html>