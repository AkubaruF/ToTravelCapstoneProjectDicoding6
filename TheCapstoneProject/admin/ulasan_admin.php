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
    $sql = "SELECT foto1, foto2, foto3, foto4, foto5, foto6 FROM sumatera WHERE id = '$id'";
    $result = mysqli_query($koneksi, $sql);
    if ($result) {
        return mysqli_fetch_assoc($result);
    }
    return null;
}

if ($op == 'delete' && isset($_GET['nama']) && isset($_GET['deskripsi'])) {
    $nama = $_GET['nama'];
    $deskripsi = $_GET['deskripsi'];

    $sql1 = "DELETE FROM ulasan WHERE nama = '$nama' AND deskripsi = '$deskripsi'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error = "Gagal menghapus data: " . mysqli_error($koneksi);
    }
}
?>

<h1>Halaman Admin Tempat</h1>
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
            <th class="col-2">ditinjau</th>
            <th class="col-2">nama</th>
            <th class="col-2">nilai</th>
            <th class="col-2">deskripsi</th>
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
        $sql1 = "SELECT * FROM ulasan $sqltambahan";
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $mulai = ($page > 1) ? ($page * $per_halaman) - $per_halaman : 0;
        $q1 = mysqli_query($koneksi, $sql1);
        if ($q1) {
            $total = mysqli_num_rows($q1);
            $pages = ceil($total / $per_halaman);
            $nomor = $mulai + 1;
            $q1 = mysqli_query($koneksi, $sql1);
            while ($r1 = mysqli_fetch_array($q1)) {
                ?>
        <tr>
            <td>
                <?php echo $nomor++; ?>
            </td>
            <td>
                <?php echo $r1['ditinjau']; ?>
            </td>
            <td>
                <?php echo $r1['nama']; ?>
            </td>
            <td>
                <?php echo $r1['nilai']; ?>
            </td>
            <td>
                <?php echo $r1['deskripsi']; ?>
            </td>
            <td>
                <a href="ulasan_admin.php?op=delete&nama=<?php echo $r1['nama']; ?>&deskripsi=<?php echo $r1['deskripsi']; ?>"
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