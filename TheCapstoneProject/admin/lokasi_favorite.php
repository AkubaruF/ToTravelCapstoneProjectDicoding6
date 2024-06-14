<?php include ("header.php"); ?>

<?php
$koneksi = new mysqli("localhost", "root", "", "capstonedb");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$sukses = '';
$error = '';
$katakunci = (isset($_GET['katakunci'])) ? $_GET['katakunci'] : '';

if (isset($_GET['op']) && $_GET['op'] == 'delete') {
    $id = $_GET['id'];
    $stmt = $koneksi->prepare("DELETE FROM favorite WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $sukses = "Data berhasil dihapus";
    } else {
        $error = "Gagal menghapus data: " . $stmt->error;
    }

    $stmt->close();
}

$sqltambahan = "";
if ($katakunci != '') {
    $array_katakunci = explode(" ", $katakunci);
    for ($x = 0; $x < count($array_katakunci); $x++) {
        $sqlcari[] = "(namawisata LIKE '%" . $koneksi->real_escape_string($array_katakunci[$x]) . "%' OR namakuliner LIKE '%" . $koneksi->real_escape_string($array_katakunci[$x]) . "%')";
    }
    $sqltambahan = " WHERE " . implode(" OR ", $sqlcari);
}

$sql2 = "SELECT * FROM favorite $sqltambahan ORDER BY id DESC";
$q2 = $koneksi->query($sql2);

function getFotoPaths($id)
{
    global $koneksi;
    $sql = "SELECT foto1, foto2, foto3, foto4, foto5, foto6 FROM favorite WHERE id = '$id'";
    $result = $koneksi->query($sql);
    if ($result) {
        return $result->fetch_assoc();
    }
    return null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Rekomendasi</title>
</head>

<body>
    <h1>Admin Destinasi Rekomendasi</h1>
    <p>
        <a href="input_favorite.php">
            <input type="button" class="btn btn-primary" value="Buat tempat Halaman Baru">
        </a>
    </p>
    <?php if ($error) { ?>
    <div class="alert alert-danger" role="alert">
        <?php echo htmlspecialchars($error); ?>
    </div>
    <?php } ?>
    <?php if ($sukses) { ?>
    <div class="alert alert-success" role="alert">
        <?php echo htmlspecialchars($sukses); ?>
    </div>
    <?php } ?>
    <form class="row g-3" method="get">
        <div class="col-auto">
            <input type="text" class="form-control" placeholder="Masukkan kata kunci" name="katakunci"
                value="<?php echo htmlspecialchars($katakunci); ?>">
        </div>
        <div class="col-auto">
            <input type="submit" name="cari" value="Cari Nama Tempat" class="btn btn-secondary">
        </div>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-1">#</th>
                <th class="col-2">Destinasi</th>
                <th class="col-2">Kuliner</th>
                <th class="col-2">Deskripsi Destinasi</th>
                <th class="col-2">Deskripsi Kuliner</th>
                <th class="col-2">Alamat Destinasi</th>
                <th class="col-2">Alamat Kuliner</th>
                <th>foto1</th>
                <th>foto2</th>
                <th>foto3</th>
                <th>foto4</th>
                <th>foto5</th>
                <th>foto6</th>
                <th class="col-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sqltambahan = "";
            $per_halaman = 10;
            if ($katakunci != '') {
                $array_katakunci = explode(" ", $katakunci);
                for ($x = 0; $x < count($array_katakunci); $x++) {
                    $sqlcari[] = "(namawisata LIKE '%" . mysqli_real_escape_string($koneksi, $array_katakunci[$x]) . "%' OR namakuliner LIKE '%" . mysqli_real_escape_string($koneksi, $array_katakunci[$x]) . "%')";
                }
                $sqltambahan = " WHERE " . implode(" OR ", $sqlcari);
            }
            $sql1 = "SELECT * FROM favorite $sqltambahan";
            $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            $mulai = ($page > 1) ? ($page * $per_halaman) - $per_halaman : 0;
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $total = mysqli_num_rows($q1);
                $pages = ceil($total / $per_halaman);
                $nomor = $mulai + 1;
                $sql1 = $sql1 . " ORDER BY id ASC LIMIT $mulai,$per_halaman";
                $q1 = mysqli_query($koneksi, $sql1);
                while ($r1 = mysqli_fetch_array($q1)) {
                    ?>
            <tr>
                <td>
                    <?php echo $nomor++; ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($r1['namawisata']); ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($r1['namakuliner']); ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($r1['deskripsiwisata']); ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($r1['deskripsikuliner']); ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($r1['alamatwisata']); ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($r1['alamatkuliner']); ?>
                </td>
                <?php
                        $fotoPaths = getFotoPaths($r1['id']);
                        for ($i = 1; $i <= 6; $i++) {
                            if ($fotoPaths['foto' . $i]) {
                                ?>
                <td>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($fotoPaths['foto' . $i]); ?>"
                        style="max-height: 100px; max-width: 100px;" />
                </td>
                <?php
                            } else {
                                ?>
                <td>No Image</td>
                <?php
                            }
                        }
                        ?>
                <td>
                    <a href="input_favorite.php?id=<?php echo $r1['id']; ?>"><span
                            class="badge text-bg-warning">Edit</span></a>
                    <a href="lokasi_favorite.php?op=delete&id=<?php echo $r1['id']; ?>"
                        onclick="return confirm('Ingin hapus data tersebut?')"><span
                            class="badge text-bg-danger">Delete</span></a>
                </td>
            </tr>
            <?php
                }
            } else {
                echo "Error: " . mysqli_error($koneksi);
                $pages = 0;
            }
            ?>
        </tbody>
    </table>

    <?php include ("footer.php"); ?>
</body>

</html>