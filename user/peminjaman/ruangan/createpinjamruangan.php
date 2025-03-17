<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Create</h4>
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
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div class="card-title">Create Pinjam Ruangan</div>
						</div>
						<form method="POST" action="peminjaman/ruangan/insert.php" enctype="multipart/form-data">
							<div class="card-body">
								<div class="form-group">
									<label>Nama Ruangan</label>
									<select class="form-control" id="id_ruangan" onchange="change(this.value)" name="id_ruangan" required="">
										<option value="" hidden="">-- Pilih Ruangan --</option>
										<?php
										$query       = mysqli_query($conn, 'SELECT * from ruangan');
										$deskripsi 	 = "var deskripsi 		= new Array();\n;";
										$nama_ruangan = "var nama_ruangan= new Array();\n;";
										while ($row = mysqli_fetch_array($query)) {
											if ($row['status'] == 'free') {
												echo '<option value="' . $row['id'] . '">' . $row['nama_ruangan'] . '</option>';
											}
											$deskripsi .= "deskripsi['" . $row['id'] . "'] = {deskripsi:'" . addslashes($row['deskripsi']) . "'};\n";
											$nama_ruangan .= "nama_ruangan['" . $row['id'] . "'] = {nama_ruangan:'" . addslashes($row['nama_ruangan']) . "'};\n";
										}
										?>
									</select>
								</div>

								<input type="hidden" id="nama_ruangan" name="nama_ruangan">

								<div class="form-group">
									<label>Deskripsi</label>
									<textarea readonly id="deskripsi" rows="5" class="form-control"></textarea>
								</div>

								<div class="form-group">
									<label>Email Pengirim</label>
									<input type="email" name="email_user" placeholder="Email Pengirim ..." class="form-control" required>
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
									<label>Keterangan</label>
									<textarea class="form-control" name="keterangan" rows="5" placeholder="Keterangan ..."></textarea>
								</div>

								<input type="hidden" name="id_user" value="<?php echo $_SESSION['id']; ?>">
								<input type="hidden" name="status" value="menunggu">

								<div class="card-action">
									<button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-save"></i> Save Changes</button>
									<a href="?view=datapinjamruangan" class="btn btn-danger"><i class="fa fa-undo"></i> Cancel</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<script type="text/javascript">
	<?php
	echo $nama_ruangan;
	echo $deskripsi;
	?>

	function change(id_ruangan) {
		document.getElementById('nama_ruangan').value = nama_ruangan[id_ruangan].nama_ruangan;
		document.getElementById('deskripsi').value = deskripsi[id_ruangan].deskripsi;
	};
</script>