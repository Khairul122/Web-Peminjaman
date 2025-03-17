<?php
session_start();
include '../../../koneksi.php';

if (isset($_POST['simpan'])) {
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $email_user = $_POST['email_user'];
    $qty = $_POST['qty'];
    $tgl_mulai = date('Y-m-d H:i:s', strtotime($_POST['tgl_mulai']));
    $tgl_selesai = date('Y-m-d H:i:s', strtotime($_POST['tgl_selesai']));
    $lokasi_barang = $_POST['lokasi_barang'];
    $keterangan = $_POST['keterangan'];
    $id_user = $_POST['id_user'];
    $status = $_POST['status'];

    $query_stok = mysqli_query($conn, "SELECT stok FROM barang WHERE id = '$id_barang'");
    $data_stok = mysqli_fetch_assoc($query_stok);
    $stok_tersedia = $data_stok['stok'];

    if ($qty > $stok_tersedia) {
        echo "<script>
            alert('Jumlah peminjaman melebihi stok tersedia!');
            window.location.href='../../index.php?view=createpinjambarang';
        </script>";
        exit;
    }

    $query = mysqli_query($conn, "INSERT INTO pinjambarang (id_barang, id_user, qty, tgl_mulai, tgl_selesai, 
                                lokasi_barang, status, catatan) 
                                VALUES ('$id_barang', '$id_user', '$qty', '$tgl_mulai', '$tgl_selesai', 
                                '$lokasi_barang', '$status', '$keterangan')");

    if ($query) {
        $stok_baru = $stok_tersedia - $qty;
        $update_stok = mysqli_query($conn, "UPDATE barang SET stok = '$stok_baru' WHERE id = '$id_barang'");

        if ($update_stok) {
            echo "<script>
                alert('Peminjaman barang berhasil disimpan!');
                window.location.href='../../index.php?view=datapinjambarang';
            </script>";
        } else {
            echo "<script>
                alert('Peminjaman berhasil tapi gagal update stok! Error: " . mysqli_error($conn) . "');
                window.location.href='../../index.php?view=datapinjambarang';
            </script>";
        }
    } else {
        echo "<script>
            alert('Peminjaman barang gagal disimpan! Error: " . mysqli_error($conn) . "');
            window.location.href='../../index.php?view=createpinjambarang';
        </script>";
    }
} else {
    echo "<script>
        alert('Akses ditolak!');
        window.location.href='../../index.php?view=createpinjambarang';
    </script>";
}
?>
