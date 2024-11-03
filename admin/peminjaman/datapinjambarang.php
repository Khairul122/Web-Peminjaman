<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Pinjam</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Barang</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Pinjam Barang</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Tgl Mulai</th>
                                            <th>Tgl Selesai</th>
                                            <th>Jumlah Pinjam</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $query = mysqli_query($conn, "SELECT 
                                            pinjambarang.*, 
                                            barang.nama_barang 
                                            FROM pinjambarang 
                                            INNER JOIN barang ON barang.id=pinjambarang.id_barang 
                                            INNER JOIN user ON user.id=pinjambarang.id_user");
                                        while ($pinjambarang = mysqli_fetch_array($query)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $pinjambarang['nama_barang'] ?></td>
                                                <td><?php echo $pinjambarang['tgl_mulai'] ?></td>
                                                <td><?php echo $pinjambarang['tgl_selesai'] ?></td>
                                                <td><?php echo $pinjambarang['qty'] ?></td>
                                                <td>
                                                    <?php
                                                    $status = $pinjambarang['status'] ?: 'menunggu';
                                                    switch ($status) {
                                                        case 'menunggu':
                                                            echo '<div class="badge badge-warning">Menunggu</div>';
                                                            break;
                                                        case 'diterima':
                                                            echo '<div class="badge badge-success">Diterima</div>';
                                                            break;
                                                        case 'ditolak':
                                                            echo '<div class="badge badge-danger">Ditolak</div>';
                                                            break;
                                                        case 'dikembalikan':
                                                            echo '<div class="badge badge-success">Dikembalikan</div>';
                                                            break;
                                                        default:
                                                            echo '<div class="badge badge-info">Status Tidak Diketahui</div>';
                                                            break;
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="?view=detailpinjambarang&id=<?php echo $pinjambarang['id'] ?>"
                                                        title="Detail"
                                                        class="btn btn-xs btn-info">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <?php if ($pinjambarang['status'] == 'menunggu') { ?>
                                                        <a href="#modalApprovePinjamBarang<?php echo $pinjambarang['id'] ?>"
                                                            data-toggle="modal"
                                                            title="Update Status"
                                                            class="btn btn-xs btn-primary">
                                                            <i class="fa fa-edit"></i> Update Status
                                                        </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<!-- Modal Approval -->
<?php
$query_modal = mysqli_query($conn, "SELECT 
    pinjambarang.*, 
    barang.nama_barang,
    user.email 
    FROM pinjambarang 
    INNER JOIN barang ON barang.id=pinjambarang.id_barang 
    INNER JOIN user ON user.id=pinjambarang.id_user");
while ($row = mysqli_fetch_array($query_modal)) {
?>
    <div class="modal fade" id="modalApprovePinjamBarang<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">Update Status</span>
                        <span class="fw-light">Peminjaman</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="" onsubmit="return confirm('Apakah Anda yakin ingin mengubah status peminjaman ini?');">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                        <input type="hidden" name="id_barang" value="<?php echo $row['id_barang'] ?>">
                        <input type="hidden" name="qty" value="<?php echo $row['qty'] ?>">

                        <div class="form-group">
                            <label>Status Peminjaman</label>
                            <select name="status" class="form-control" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="diterima">Diterima</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="update_status" class="btn btn-primary">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <i class="fa fa-undo"></i> Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<?php
// Proses Update Status
if (isset($_POST['update_status'])) {
    $id = $_POST['id'];
    $id_barang = $_POST['id_barang'];
    $qty = $_POST['qty'];
    $status = $_POST['status'];
    $catatan = $_POST['catatan'];

    try {
        mysqli_begin_transaction($conn);

        // Update status peminjaman
        $update_status = mysqli_query($conn, "UPDATE pinjambarang SET 
            status = '$status',
            catatan = '$catatan'
            WHERE id = '$id'");

        if ($update_status) {
            // Jika status ditolak, kembalikan stok
            if ($status == 'ditolak') {
                $update_stok = mysqli_query($conn, "UPDATE barang SET 
                    stok = stok + $qty 
                    WHERE id = '$id_barang'");

                if (!$update_stok) {
                    throw new Exception("Gagal mengupdate stok barang");
                }
            }

            mysqli_commit($conn);
            echo "<script>
                alert('Status peminjaman berhasil diupdate!');
                window.location.href='?view=datapinjambarang';
            </script>";
        } else {
            throw new Exception("Gagal mengupdate status peminjaman");
        }
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "<script>
            alert('Error: " . $e->getMessage() . "');
            window.location.href='?view=datapinjambarang';
        </script>";
    }
}
?>