<?php
session_start();
include '../../../koneksi.php';

if (isset($_POST['simpan'])) {
    $id_ruangan = $_POST['id_ruangan'];
    $nama_ruangan = $_POST['nama_ruangan'];
    $email_user = $_POST['email_user'];
    $tgl_mulai = date('Y-m-d', strtotime($_POST['tgl_mulai']));
    $tgl_selesai = $_POST['tgl_selesai'];
    $keterangan = $_POST['keterangan'];
    $id_user = $_POST['id_user'];
    $status = $_POST['status'];

    $query = mysqli_query($conn, "INSERT INTO pinjamruangan (id_ruangan, id_user, tgl_mulai, tgl_selesai, keterangan, status, catatan) 
    VALUES ('$id_ruangan', '$id_user', '$tgl_mulai', '$tgl_selesai', '$keterangan', '$status', '')");


    $update_ruangan = mysqli_query($conn, "UPDATE pinjamruangan SET status = 'menunggu' WHERE id = '$id_ruangan'");

    if ($query && $update_ruangan) {
        echo "<script>
            alert('Data peminjaman ruangan berhasil disimpan!');
            window.location.href='../../index.php?view=datapinjamruangan';
        </script>";
    } else {
        echo "<script>
            alert('Data peminjaman ruangan gagal disimpan! Error: " . mysqli_error($conn) . "');
            window.location.href='../../index.php?view=createpinjamruangan';
        </script>";
    }
} else {
    echo "<script>
        alert('Akses ditolak!');
        window.location.href='../../index.php?view=datapinjamruangan';
    </script>";
}
