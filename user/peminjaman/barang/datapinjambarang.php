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
                                <a href="?view=createpinjambarang" class="btn btn-primary btn-round ml-auto">
                                    <i class="fa fa-plus"></i>
                                    Tambah Data
                                </a>
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
                                        $query = mysqli_query($conn, 'SELECT pinjambarang.id, pinjambarang.id_barang, pinjambarang.id_user, pinjambarang.tgl_mulai, pinjambarang.tgl_selesai, pinjambarang.qty, pinjambarang.lokasi_barang, pinjambarang.status, barang.nama_barang from pinjambarang inner join barang on barang.id=pinjambarang.id_barang inner join user on user.id=pinjambarang.id_user');
                                        while ($pinjambarang = mysqli_fetch_array($query)) {
                                        ?>
                                            <?php if ($_SESSION['id'] == $pinjambarang['id_user']) { ?>
                                                <tr>
                                                    <td><?php echo $no++ ?></td>
                                                    <td><?php echo $pinjambarang['nama_barang'] ?></td>
                                                    <td><?php echo $pinjambarang['tgl_mulai'] ?></td>
                                                    <td><?php echo $pinjambarang['tgl_selesai'] ?></td>
                                                    <td><?php echo $pinjambarang['qty'] ?></td>
                                                    <td>
                                                        <?php if ($pinjambarang['status'] == 'menunggu') { ?>
                                                            <div class="badge badge-danger"><?php echo $pinjambarang['status'] ?></div>
                                                        <?php } elseif ($pinjambarang['status'] == 'approve') { ?>
                                                            <div class="badge badge-success"><?php echo $pinjambarang['status'] ?></div>
                                                        <?php } elseif ($pinjambarang['status'] == 'dikembalikan') { ?>
                                                            <div class="badge badge-info"><?php echo $pinjambarang['status'] ?></div>
                                                        <?php } else { ?>
                                                            <div class="badge badge-secondary"><?php echo $pinjambarang['status'] ?></div>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($pinjambarang['status'] == 'menunggu') { ?>
                                                            <a href="?view=detailpinjambarang&id=<?php echo $pinjambarang['id'] ?>" title="Detail" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                                            <a href="#modalHapusPinjamBarang<?php echo $pinjambarang['id'] ?>" data-toggle="modal" title="Batal Pinjam" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Batal</a>
                                                        <?php } elseif ($pinjambarang['status'] == 'diterima') { ?>
                                                            <a href="?view=detailpinjambarang&id=<?php echo $pinjambarang['id'] ?>" title="Detail" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                                            <a href="#modalPengembalianBarang<?php echo $pinjambarang['id'] ?>" data-toggle="modal" title="Pengembalian" class="btn btn-xs btn-info"><i class="fa fa-check"></i> Pengembalian</a>
                                                        <?php } elseif ($pinjambarang['status'] == 'dikembalikan') { ?>
                                                            <a href="?view=detailpinjambarang&id=<?php echo $pinjambarang['id'] ?>" title="Detail" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                                            
                                                        <?php } else { ?>
                                                            <a href="?view=detailpinjambarang&id=<?php echo $pinjambarang['id'] ?>" title="Detail" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                                            <div class="badge badge-secondary"><?php echo $pinjamruangan['status'] ?></div>
                                                            
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
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

<!-- Modal Hapus -->
<?php
$c = mysqli_query($conn, 'SELECT pinjambarang.id, pinjambarang.id_barang, pinjambarang.id_user, pinjambarang.tgl_mulai, pinjambarang.tgl_selesai, pinjambarang.qty, pinjambarang.lokasi_barang, pinjambarang.status, barang.nama_barang from pinjambarang inner join barang on barang.id=pinjambarang.id_barang inner join user on user.id=pinjambarang.id_user');
while ($row = mysqli_fetch_array($c)) {
?>
    <div class="modal fade" id="modalHapusPinjamBarang<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                            Batalkan</span>
                        <span class="fw-light">
                            Pinjaman
                        </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data" action="">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                        <input type="hidden" name="id_barang" value="<?php echo $row['id_barang'] ?>">
                        <input type="hidden" name="qty" value="<?php echo $row['qty'] ?>">
                        <h4>Apakah Anda Ingin Membatalkan Pinjamanan Ini ?</h4>
                    </div>
                    <div class="modal-footer no-bd">
                        <button type="submit" name="hapus" class="btn btn-danger"><i class="fa fa-trash"></i> Batal Pinjam</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Modal Pengembalian -->
<?php
$c = mysqli_query($conn, 'SELECT pinjambarang.id, pinjambarang.id_barang, pinjambarang.id_user, pinjambarang.tgl_mulai, pinjambarang.tgl_selesai, pinjambarang.qty, pinjambarang.lokasi_barang, pinjambarang.status, barang.nama_barang from pinjambarang inner join barang on barang.id=pinjambarang.id_barang inner join user on user.id=pinjambarang.id_user');
while ($row = mysqli_fetch_array($c)) {
?>
    <div class="modal fade" id="modalPengembalianBarang<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                            Pengembalian</span>
                        <span class="fw-light">
                            Barang
                        </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data" action="">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                        <input type="hidden" name="id_barang" value="<?php echo $row['id_barang'] ?>">
                        <input type="hidden" name="qty" value="<?php echo $row['qty'] ?>">
                        <div class="form-group">
                            <label>Kondisi Barang</label>
                            <select class="form-control" name="kondisi" required>
                                <option value="" hidden>-- Pilih Kondisi --</option>
                                <option value="baik">Baik</option>
                                <option value="rusak">Rusak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Catatan Pengembalian</label>
                            <textarea class="form-control" name="catatan" rows="3" placeholder="Masukkan catatan pengembalian jika ada"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer no-bd">
                        <button type="submit" name="pengembalian" class="btn btn-info"><i class="fa fa-check"></i> Konfirmasi Pengembalian</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Proses PHP -->
<?php
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $id_barang = $_POST['id_barang'];
    $qty = $_POST['qty'];

    $selSto = mysqli_query($conn, "SELECT * FROM barang WHERE id='$id_barang'");
    $sto    = mysqli_fetch_array($selSto);
    $stok   = $sto['stok'];
    $sisa    = $stok + $qty;

    mysqli_query($conn, "UPDATE barang SET stok='$sisa' WHERE id='$id_barang'");
    mysqli_query($conn, "DELETE from pinjambarang where id='$id'");
    echo "<script>alert ('Data Berhasil Dihapus') </script>";
    echo "<meta http-equiv='refresh' content=0; URL=?view=datapinjambarang>";
} elseif (isset($_POST['pengembalian'])) {
    $id = $_POST['id'];
    $id_barang = $_POST['id_barang'];
    $qty = $_POST['qty'];
    $kondisi = $_POST['kondisi'];
    $catatan = $_POST['catatan'];
    $tgl_pengembalian = date('Y-m-d');

    // Update status pengembalian
    mysqli_query($conn, "UPDATE pinjambarang SET 
        status='dikembalikan', 
        kondisi_pengembalian='$kondisi',
        catatan_pengembalian='$catatan',
        tgl_pengembalian='$tgl_pengembalian'
        WHERE id='$id'");

    // Update stok barang
    $selSto = mysqli_query($conn, "SELECT * FROM barang WHERE id='$id_barang'");
    $sto    = mysqli_fetch_array($selSto);
    $stok   = $sto['stok'];
    $sisa   = $stok + $qty;

    mysqli_query($conn, "UPDATE barang SET stok='$sisa' WHERE id='$id_barang'");

    echo "<script>alert ('Barang berhasil dikembalikan') </script>";
    echo "<meta http-equiv='refresh' content=0; URL=?view=datapinjambarang>";
}
?>