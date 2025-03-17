<?php
session_start();
include '../../koneksi.php';

if (isset($_POST['ubah'])) {
    $id = $_POST['id'];
    $id_ruangan = $_POST['id_ruangan'];
    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_selesai = $_POST['tgl_selesai'];
    $status = $_POST['status'];
    $catatan = $_POST['catatan'];

    $query = mysqli_query($conn, "UPDATE pinjamruangan SET 
                                status = '$status',
                                catatan = '$catatan'
                                WHERE id = '$id'");
    if ($status == 'ditolak') {
        $update_ruangan = mysqli_query($conn, "UPDATE ruangan SET status = 'free' WHERE id = '$id_ruangan'");
    } else if ($status == 'diterima') {
        $update_ruangan = mysqli_query($conn, "UPDATE ruangan SET status = 'used' WHERE id = '$id_ruangan'");
    }

    if ($query) {
        echo "<script>
            alert('Status peminjaman ruangan berhasil diperbarui!');
           window.location.href='?view=datapinjamruangan';
        </script>";
    } else {
        echo "<script>
            alert('Status peminjaman ruangan gagal diperbarui! Error: " . mysqli_error($conn) . "');
            window.location.href='?view=datapinjamruangan';
        </script>";
    }
} else {
    echo "<script>
        alert('Akses ditolak!');
        window.location.href='?view=datapinjamruangan';
    </script>";
}
