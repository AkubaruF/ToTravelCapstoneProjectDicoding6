<?php include ("header.php"); ?>
<?php
$koneksi = mysqli_connect("localhost", "root", "", "capstonedb");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$namawisata = "";
$namakuliner = "";
$alamatwisata = "";
$alamatkuliner = "";
$deskripsiwisata = "";
$deskripsikuliner = "";
$foto1 = $foto2 = $foto3 = $foto4 = $foto5 = $foto6 = "";
$error = "";
$sukses = "";

// Periksa apakah id disertakan dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = "";
}

// Jika ada id, ambil data dari database
if ($id != "") {
    $sql1 = "SELECT * FROM sumatera WHERE id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);

    if ($q1 && mysqli_num_rows($q1) > 0) {
        $r1 = mysqli_fetch_array($q1);
        $namawisata = $r1['namawisata'];
        $namakuliner = $r1['namakuliner'];
        $alamatwisata = $r1['alamatwisata'];
        $alamatkuliner = $r1['alamatkuliner'];
        $deskripsiwisata = $r1['deskripsiwisata'];
        $deskripsikuliner = $r1['deskripsikuliner'];
        $foto1 = $r1['foto1'];
        $foto2 = $r1['foto2'];
        $foto3 = $r1['foto3'];
        $foto4 = $r1['foto4'];
        $foto5 = $r1['foto5'];
        $foto6 = $r1['foto6'];
    } else {
        $error = "Data tidak ditemukan";
    }
}

// Fungsi untuk membuat tautan ke Google Maps
function createGoogleMapsLink($address)
{
    return "https://www.google.com/maps/search/?api=1&query=" . urlencode($address);
}

// Jika form disubmit
if (isset($_POST['simpan'])) {
    $namawisata = $_POST['namawisata'];
    $namakuliner = $_POST['namakuliner'];
    $alamatwisata = $_POST['alamatwisata'];
    $alamatkuliner = $_POST['alamatkuliner'];
    $deskripsiwisata = strip_tags($_POST['deskripsiwisata'], '<br><a>');
    $deskripsikuliner = strip_tags($_POST['deskripsikuliner'], '<br><a>');

    // Validasi data yang dikirim dari formulir
    if ($namawisata == '' || $alamatwisata == '' || $deskripsiwisata == '' || $namakuliner == '' || $alamatkuliner == '' || $deskripsikuliner == '') {
        $error = "Silahkan masukkan semua data yang diperlukan";
    } else {
        // Mengambil file gambar jika ada yang diupload
        for ($i = 0; $i < 6; $i++) {
            if (isset($_FILES['foto']['tmp_name'][$i]) && $_FILES['foto']['tmp_name'][$i] != '') {
                ${"foto" . ($i + 1)} = file_get_contents($_FILES['foto']['tmp_name'][$i]);
            }
        }

        // Siapkan statement untuk memasukkan atau memperbarui data
        if ($id == "") {
            $sql = "INSERT INTO sumatera (namawisata, namakuliner, alamatwisata, alamatkuliner, deskripsiwisata, deskripsikuliner, foto1, foto2, foto3, foto4, foto5, foto6) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($koneksi, $sql);
            if ($stmt === false) {
                $error = "Error: " . mysqli_error($koneksi);
            } else {
                mysqli_stmt_bind_param($stmt, "ssssssssssss", $namawisata, $namakuliner, $alamatwisata, $alamatkuliner, $deskripsiwisata, $deskripsikuliner, $foto1, $foto2, $foto3, $foto4, $foto5, $foto6);
                if (mysqli_stmt_execute($stmt)) {
                    $sukses = "Sukses memasukkan data";
                } else {
                    $error = "Gagal memasukkan data: " . mysqli_error($koneksi);
                }
            }
        } else {
            $sql = "UPDATE sumatera SET namawisata=?, namakuliner=?, alamatwisata=?, alamatkuliner=?, deskripsiwisata=?, deskripsikuliner=?, foto1=?, foto2=?, foto3=?, foto4=?, foto5=?, foto6=? WHERE id=?";
            $stmt = mysqli_prepare($koneksi, $sql);
            if ($stmt === false) {
                $error = "Error: " . mysqli_error($koneksi);
            } else {
                mysqli_stmt_bind_param($stmt, "ssssssssssssi", $namawisata, $namakuliner, $alamatwisata, $alamatkuliner, $deskripsiwisata, $deskripsikuliner, $foto1, $foto2, $foto3, $foto4, $foto5, $foto6, $id);
                if (mysqli_stmt_execute($stmt)) {
                    $sukses = "Sukses memperbarui data";
                } else {
                    $error = "Gagal memperbarui data: " . mysqli_error($koneksi);
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Pulau Sumatera</title>
</head>

<body>
    <h1>Input Data Pulau Sumatera</h1>
    <div class="mb-3 row">
        <a href="lokasi_sumatera.php">Kembali ke halaman admin tempat</a>
    </div>

    <!-- Tampilkan pesan error jika ada -->
    <?php if ($error) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <!-- Tampilkan pesan sukses jika ada -->
    <?php if ($sukses) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo $sukses; ?>
        </div>
    <?php } ?>

    <!-- Form untuk memasukkan atau mengupdate data -->
    <form method="post" enctype="multipart/form-data">
        <!-- Input untuk Nama Wisata -->
        <div class="mb-3 row">
            <label for="namawisata" class="col-sm-2 col-form-label">Nama Wisata</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="namawisata"
                    value="<?php echo htmlspecialchars($namawisata); ?>" name="namawisata">
            </div>
        </div>
        <!-- Input untuk Deskripsi Wisata -->
        <div class="mb-3 row">
            <label for="deskripsiwisata" class="col-sm-2 col-form-label">Deskripsi Wisata</label>
            <div class="col-sm-10">
                <textarea name="deskripsiwisata" class="form-control"
                    id="deskripsiwisata"><?php echo htmlspecialchars($deskripsiwisata); ?></textarea>
            </div>
        </div>
        <!-- Input untuk Alamat Wisata -->
        <div class="mb-3 row">
            <label for="alamatwisata" class="col-sm-2 col-form-label">Alamat Wisata</label>
            <div class="col-sm-10">
                <textarea name="alamatwisata" class="form-control"
                    id="alamatwisata"><?php echo htmlspecialchars($alamatwisata); ?></textarea>
                <!-- Tautan ke Google Maps -->
                <?php if ($alamatwisata) { ?>
                    <div>
                        <a href="<?php echo createGoogleMapsLink($alamatwisata); ?>" target="_blank">Lihat di Google
                            Maps</a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- Input untuk Nama Kuliner -->
        <div class="mb-3 row">
            <label for="namakuliner" class="col-sm-2 col-form-label">Nama Kuliner</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="namakuliner"
                    value="<?php echo htmlspecialchars($namakuliner); ?>" name="namakuliner">
            </div>
        </div>
        <!-- Input untuk Deskripsi Kuliner -->
        <div class="mb-3 row">
            <label for="deskripsikuliner" class="col-sm-2 col-form-label">Deskripsi Kuliner</label>
            <div class="col-sm-10">
                <textarea name="deskripsikuliner" class="form-control"
                    id="deskripsikuliner"><?php echo htmlspecialchars($deskripsikuliner); ?></textarea>
            </div>
        </div>
        <!-- Input untuk Alamat Kuliner -->
        <div class="mb-3 row">
            <label for="alamatkuliner" class="col-sm-2 col-form-label">Alamat Kuliner</label>
            <div class="col-sm-10">
                <textarea name="alamatkuliner" class="form-control"
                    id="alamatkuliner"><?php echo htmlspecialchars($alamatkuliner); ?></textarea>
                <!-- Tautan ke Google Maps -->
                <?php if ($alamatkuliner) { ?>
                    <div>
                        <a href="<?php echo createGoogleMapsLink($alamatkuliner); ?>" target="_blank">Lihat di Google
                            Maps</a>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- Input untuk Foto (6 Foto) -->
        <div class="mb-3 row">
            <label for="foto" class="col-sm-2 col-form-label">Foto</label>
            <div class="col-sm-10">
                <?php for ($i = 0; $i < 6; $i++) {
                    $fotoVar = "foto" . ($i + 1);
                    $fotoVal = ${$fotoVar}; ?>
                    <?php if (!empty($fotoVal)) { ?>
                        <div>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($fotoVal); ?>"
                                alt="Foto <?php echo $i + 1; ?>" style="width: 100px; height: 100px; object-fit: cover;">
                            <input type="file" class="form-control" id="foto<?php echo $i + 1; ?>" name="foto[]"
                                accept="image/*">
                        </div>
                    <?php } else { ?>
                        <input type="file" class="form-control" id="foto<?php echo $i + 1; ?>" name="foto[]" accept="image/*">
                    <?php } ?>
                <?php } ?>
            </div>
        </div>

        <!-- Tombol Simpan -->
        <div class="mb-3 row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
            </div>
        </div>
    </form>
    <?php include ("footer.php"); ?>
</body>

</html>