<?php
function url_dasar()
{
    $url_dasar = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']);
    return $url_dasar;
}

function tempat_foto($id, $foto)
{
    global $koneksi;
    $sql = "SELECT $foto FROM isi WHERE id = '$id'";
    $result = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_assoc($result);
    return $data[$foto];
}
?>