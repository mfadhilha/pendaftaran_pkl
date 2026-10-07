<?php

/*
A. Analisis Video

1. URL berubah karena data form ditambahkan di belakang alamat halaman setelah tanda tanya, seperti ini ?nama=Budi

2. Data GET tampil di URL, sehingga password bisa terlihat orang lain dan tersimpan di riwayat browser

3. isset() memeriksa apakah data sudah ada, agar tidak muncul error undefined index saat halaman pertama dibuka
*/

$errors = [];
$data = [];

if (isset($_POST['submit'])) {
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
    }
    if (empty($email)) {
        $errors[] = "Email Siswa wajib diisi.";
    }
    if (empty($jurusan)) {
        $errors[] = "Kompetensi Keahlian wajib dipilih.";
    }
    if (empty($perusahaan)) {
        $errors[] = "Pilihan Perusahaan PKL wajib dipilih.";
    }
    if (empty($tech)) {
        $errors[] = "Minimal satu Tech Stack wajib dipilih.";
    }
    if (empty($alasan)) {
        $errors[] = "Alasan Memilih Perusahaan wajib diisi.";
    }

    if (empty($errors)) {
        $data = [
            'nama' => $nama,
            'nis' => $nis,
            'email' => $email,
            'jurusan' => $jurusan,
            'perusahaan' => $perusahaan,
            'tech' => $tech,
            'alasan' => $alasan,
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Peserta PKL</title>
</head>

<body>
    <div class="container">
        <h1>Pendaftaran Peserta PKL</h1>

        <form method="post" action="">
            <p>
                <label for="nama">Nama Lengkap</label><br>
                <input type="text" id="nama" name="nama">
            </p>

            <p>
                <label for="nis">NIS</label><br>
                <input type="number" id="nis" name="nis">
            </p>

            <p>
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email">
            </p>

            <p class="pilihan">
                <label>Jurusan</label><br>
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

        <?php if (isset($_POST['submit'])) { ?>
            <hr>
            <?php if (!empty($errors)) { ?>
                <div class="error">
                    <h2>Pendaftaran Gagal</h2>
                    <ul>
                        <?php foreach ($errors as $error) { ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } else { ?>
                <div class="sukses">
                    <h2>Data Pendaftaran Berhasil Diterima</h2>
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
                            <td><?php echo htmlspecialchars(implode(", ", $data['tech'])); ?></td>
                        </tr>
                        <tr>
                            <td>Alasan Memilih</td>
                            <td><?php echo nl2br(htmlspecialchars($data['alasan'])); ?></td>
                        </tr>
                    </table>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</body>

</html>