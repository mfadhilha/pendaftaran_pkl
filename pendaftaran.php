<?php
/*
A. Analisis Video

1. URL berubah karena data form ditambahkan di belakang alamat halaman setelah tanda tanya, contoh ?nama=Budi.

2. Data GET tampil di URL, sehingga password bisa terlihat orang lain dan tersimpan di riwayat browser.

3. isset() memeriksa apakah data sudah ada, agar tidak muncul error undefined index saat halaman pertama dibuka.
*/

session_start();
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Peserta PKL</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Pendaftaran Peserta PKL</h1>

        <?php if (!empty($errors)) { ?>
            <div class="error">
                <h2>Pendaftaran Gagal</h2>
                <ul>
                    <?php foreach ($errors as $error) { ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php } ?>
                </ul>
            </div>
            <br>
        <?php } ?>

        <form method="post" action="proses.php">
            <p>
                <label for="nama">Nama Lengkap</label><br>
                <input type="text" id="nama" name="nama">
            </p>

            <p>
                <label for="nis">NIS</label><br>
                <input type="number" id="nis" name="nis">
            </p>

            <p>
                <label for="email">Email Siswa</label><br>
                <input type="email" id="email" name="email">
            </p>

            <p class="pilihan">
                <label>Kompetensi Keahlian</label><br>
                <input type="radio" id="sija" name="jurusan" value="SIJA">
                <label for="sija">SIJA</label>
                <input type="radio" id="tjat" name="jurusan" value="TJAT">
                <label for="tjat">TJAT</label>
            </p>

            <p>
                <label for="perusahaan">Pilihan Perusahaan PKL</label><br>
                <select id="perusahaan" name="perusahaan">
                    <option value="">Pilih perusahaan</option>
                    <option value="PT Telkom Indonesia">PT Telkom Indonesia</option>
                    <option value="PT Len Industri">PT Len Industri</option>
                    <option value="PT Pertamina">PT Pertamina</option>
                    <option value="CV Teknologi Nusantara">CV Teknologi Nusantara</option>
                </select>
            </p>

            <p class="pilihan">
                <label>Kompetensi atau Tech Stack yang Dikuasai</label><br>
                <input type="checkbox" id="html" name="tech[]" value="HTML dan CSS">
                <label for="html">HTML dan CSS</label>
                <input type="checkbox" id="php" name="tech[]" value="PHP">
                <label for="php">PHP</label>
                <input type="checkbox" id="js" name="tech[]" value="JavaScript">
                <label for="js">JavaScript</label>
                <input type="checkbox" id="mysql" name="tech[]" value="MySQL">
                <label for="mysql">MySQL</label>
                <input type="checkbox" id="jaringan" name="tech[]" value="Jaringan">
                <label for="jaringan">Jaringan</label>
            </p>

            <p>
                <label for="alasan">Alasan Memilih Perusahaan</label><br>
                <textarea id="alasan" name="alasan" rows="4" cols="40"></textarea>
            </p>

            <button type="submit" name="submit">Daftar</button>
        </form>
    </div>
</body>

</html>