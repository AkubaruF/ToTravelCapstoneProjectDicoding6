<?php include ("header.php"); ?>
<?php
$koneksi = mysqli_connect("localhost", "root", "", "capstonedb");

$sukses = "";
$katakunci = (isset($_GET['katakunci'])) ? $_GET['katakunci'] : "";
if (isset($_GET["op"])) {
    $op = $_GET["op"];
} else {
    $op = "";
}

function getFotoPaths($id)
{
    global $koneksi;
    $sql = "SELECT foto1, foto2, foto3, foto4, foto5, foto6 FROM papua WHERE id = '$id'";
    $result = mysqli_query($koneksi, $sql);
    if ($result) {
        return mysqli_fetch_assoc($result);
    }
    return null;
}

if ($op == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql1 = "DELETE FROM papua WHERE id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error = "Gagal menghapus data: " . mysqli_error($koneksi);
    }
}
?>

<h1>Halaman Admin Tempat</h1>
<p>
    <a href="input_papua.php">
        <input type="button" class="btn btn-primary" value="Buat tempat Halaman Baru">
    </a>
</p>
<?php if ($sukses) { ?>
    <div class="alert alert-primary" role="alert">
        <?php echo $sukses; ?>
    </div>
<?php } ?>
<?php if (isset($error)) { ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
    </div>
<?php } ?>
<form class="row g-3" method="get">
    <div class="col-auto">
        <input type="text" class="form-control" placeholder="Masukkan kata kunci" name="katakunci"
            value="<?php echo $katakunci; ?>">
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
        $sql1 = "SELECT * FROM papua $sqltambahan";
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
                        <?php echo $r1['namawisata']; ?>
                    </td>
                    <td>
                        <?php echo $r1['namakuliner']; ?>
                    </td>
                    <td>
                        <?php echo $r1['deskripsiwisata']; ?>
                    </td>
                    <td>
                        <?php echo $r1['deskripsikuliner']; ?>
                    </td>
                    <td>
                        <?php echo $r1['alamatwisata']; ?>
                    </td>
                    <td>
                        <?php echo $r1['alamatkuliner']; ?>
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
                        <a href="input_papua.php?id=<?php echo $r1['id']; ?>"><span
                                class="badge text-bg-warning">Edit</span></a>
                        <a href="lokasi_papua.php?op=delete&id=<?php echo $r1['id']; ?>"
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