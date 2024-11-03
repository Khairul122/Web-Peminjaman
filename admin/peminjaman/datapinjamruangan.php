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
						<a href="#">Ruangan</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<h4 class="card-title">Data Pinjam Ruangan</h4>

							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="add-row" class="display table table-striped table-hover">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Ruangan</th>
											<th>Tgl Mulai</th>
											<th>Tgl Selesai</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>

									<tbody>
										<?php
										$no = 1;
										$query = mysqli_query($conn, 'SELECT pinjamruangan.id, pinjamruangan.id_ruangan, pinjamruangan.id_user, pinjamruangan.tgl_mulai, pinjamruangan.tgl_selesai, pinjamruangan.status, ruangan.nama_ruangan from pinjamruangan inner join ruangan on ruangan.id=pinjamruangan.id_ruangan inner join user on user.id=pinjamruangan.id_user');
										while ($pinjamruangan = mysqli_fetch_array($query)) {
										?>
											<tr>
												<td><?php echo $no++ ?></td>
												<td><?php echo $pinjamruangan['nama_ruangan'] ?></td>
												<td><?php echo $pinjamruangan['tgl_mulai'] ?></td>
												<td><?php echo $pinjamruangan['tgl_selesai'] ?></td>

												<td>
													<?php
													switch ($pinjamruangan['status']) {
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
													<?php if ($pinjamruangan['status'] == 'menunggu') { ?>
														<a href="?view=detailpinjamruangan&id=<?php echo $pinjamruangan['id'] ?>"
															title="Detail" class="btn btn-xs btn-info">
															<i class="fa fa-eye"></i>
														</a>
														<a href="#modalApprovePinjamRuangan<?php echo $pinjamruangan['id'] ?>"
															data-toggle="modal"
															title="Update Status"
															class="btn btn-xs btn-primary">
															<i class="fa fa-edit"></i> Update Status
														</a>
													<?php } else { ?>
														<a href="?view=detailpinjamruangan&id=<?php echo $pinjamruangan['id'] ?>"
															title="Detail" class="btn btn-xs btn-info">
															<i class="fa fa-eye"></i>
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


<?php
$c = mysqli_query($conn, 'SELECT pinjamruangan.id, pinjamruangan.id_ruangan, pinjamruangan.id_user, pinjamruangan.tgl_mulai, pinjamruangan.tgl_selesai, pinjamruangan.status, ruangan.nama_ruangan, user.email from pinjamruangan inner join ruangan on ruangan.id=pinjamruangan.id_ruangan inner join user on user.id=pinjamruangan.id_user');
while ($row = mysqli_fetch_array($c)) {
?>

	<div class="modal fade" id="modalApprovePinjamRuangan<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
				<form method="POST" enctype="multipart/form-data" action="">
					<div class="modal-body">
						<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
						<input type="hidden" name="id_ruangan" value="<?php echo $row['id_ruangan'] ?>">
						<input type="hidden" name="tgl_mulai" value="<?php echo $row['tgl_mulai'] ?>">
						<input type="hidden" name="tgl_selesai" value="<?php echo $row['tgl_selesai'] ?>">

						<div class="form-group">
							<label>Status Peminjaman</label>
							<select name="status" class="form-control" required>
								<option value="">-- Pilih Status --</option>
								<option value="diterima">Diterima</option>
								<option value="ditolak">Ditolak</option>
							</select>
						</div>

						<div class="form-group">
							<label>Catatan (Opsional)</label>
							<textarea name="catatan" class="form-control" rows="3"
								placeholder="Tambahkan catatan jika diperlukan..."></textarea>
						</div>
					</div>
					<div class="modal-footer no-bd">
						<button type="submit" name="ubah" class="btn btn-primary">
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
// Proses update
if (isset($_POST['ubah'])) {
	$id = $_POST['id'];
	$id_ruangan = $_POST['id_ruangan'];
	$status = $_POST['status'];
	$catatan = isset($_POST['catatan']) ? $_POST['catatan'] : '';

	try {
		mysqli_begin_transaction($conn);

		if ($status == 'diterima') {
			// Update status ruangan menjadi dipinjam
			$update_ruangan = mysqli_query($conn, "UPDATE ruangan 
                SET status='dipinjam' 
                WHERE id='$id_ruangan'");
		} else if ($status == 'ditolak') {
			// Update status ruangan menjadi free
			$update_ruangan = mysqli_query($conn, "UPDATE ruangan 
                SET status='free' 
                WHERE id='$id_ruangan'");
		}

		// Update status peminjaman
		$update_pinjam = mysqli_query($conn, "UPDATE pinjamruangan 
            SET status='$status', 
                catatan='$catatan' 
            WHERE id='$id'");

		if ($update_ruangan && $update_pinjam) {
			mysqli_commit($conn);
			echo "<script>
                alert('Status peminjaman berhasil diupdate!');
                window.location.href='?view=datapinjamruangan';
            </script>";
		} else {
			throw new Exception(mysqli_error($conn));
		}
	} catch (Exception $e) {
		mysqli_rollback($conn);
		echo "<script>
            alert('Gagal mengupdate status: " . $e->getMessage() . "');
            window.location.href='?view=datapinjamruangan';
        </script>";
	}
}
?>