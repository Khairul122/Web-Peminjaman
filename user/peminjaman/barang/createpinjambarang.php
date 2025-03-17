<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Create</h4>
				<ul class="breadcrumbs">
					<li class="nav-home">
						<a href="#"><i class="flaticon-home"></i></a>
					</li>
					<li class="separator"><i class="flaticon-right-arrow"></i></li>
					<li class="nav-item"><a href="#">Pinjam</a></li>
					<li class="separator"><i class="flaticon-right-arrow"></i></li>
					<li class="nav-item"><a href="#">Barang</a></li>
				</ul>
			</div>

			<form method="POST" action="peminjaman/barang/insert.php" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<div class="card-title">Create Pinjam Barang</div>
							</div>
							<div class="card-body">
								<div class="form-group">
									<label>Nama Barang</label>
									<select class="form-control" id="id_barang" onchange="changeValue(this.value)" name="id_barang" required>
										<option value="" hidden>-- Pilih Barang --</option>
										<?php
										$query = mysqli_query($conn, 'SELECT * FROM barang');
										$jsArray = [];

										while ($row = mysqli_fetch_array($query)) {
											echo '<option value="' . $row['id'] . '">' . $row['nama_barang'] . '</option>';
											$jsArray[$row['id']] = [
												'stok' => addslashes($row['stok']),
												'deskripsi' => addslashes($row['deskripsi']),
												'nama_barang' => addslashes($row['nama_barang'])
											];
										}
										?>
									</select>
								</div>

								<input type="hidden" id="nama_barang" name="nama_barang">

								<div class="form-group">
									<label>Stok Barang Tersedia</label>
									<input type="text" readonly id="stok" class="form-control">
								</div>

								<div class="form-group">
									<label>Deskripsi</label>
									<textarea readonly style="white-space: pre-line;" id="deskripsi" rows="5" class="form-control"></textarea>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<div class="card-title">Data Peminjam</div>
							</div>
							<div class="card-body">
								<div class="form-group">
									<label>Email Pengirim</label>
									<input type="email" name="email_user" placeholder="Email Pengirim ..." class="form-control" required>
								</div>

								<div class="form-group">
									<label>Jumlah Pinjam Barang</label>
									<input min="1" step="1" value="1" type="number" name="qty" class="form-control" placeholder="Jumlah Pinjam Barang ...">
								</div>

								<div class="form-group">
									<label>Tgl Mulai Pinjam</label>
									<input type="date" name="tgl_mulai" class="form-control">
								</div>

								<div class="form-group">
									<label>Tgl Selesai Pinjam</label>
									<input type="date" name="tgl_selesai" class="form-control">
								</div>

								<div class="form-group">
									<label>Lokasi Barang</label>
									<textarea class="form-control" name="lokasi_barang" rows="5"
										placeholder="Lokasi Barang ..." style="white-space: pre-line;"></textarea>
								</div>

								<div class="form-group">
									<label>Keterangan</label>
									<textarea class="form-control" name="keterangan" rows="5"
										placeholder="Keterangan ..." style="white-space: pre-line;"></textarea>
								</div>

								<input type="hidden" name="id_user" value="<?php echo $_SESSION['id']; ?>">
								<input type="hidden" name="email_admin" value="emailpenerima@gmail.com">
								<input type="hidden" name="status" value="menunggu">
							</div>

							<div class="card-action">
								<button type="submit" name="simpan" class="btn btn-success">
									<i class="fa fa-save"></i> Save Changes
								</button>
								<a href="?view=datapinjambarang" class="btn btn-danger">
									<i class="fa fa-undo"></i> Cancel
								</a>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	const jsData = <?php echo json_encode($jsArray); ?>;

	function changeValue(id) {
		if (jsData[id]) {
			document.getElementById('stok').value = jsData[id].stok;
			document.getElementById('deskripsi').value = jsData[id].deskripsi;
			document.getElementById('nama_barang').value = jsData[id].nama_barang;
		}
	}
</script>