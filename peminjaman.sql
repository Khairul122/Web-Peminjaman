-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03 Nov 2024 pada 19.28
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjaman`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi` text,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `stok`, `deskripsi`, `foto`) VALUES
(1, 'Kursi Kantor', 10, 'Kursi kantor dengan roda dan sandaran yang nyaman', 'Screenshot 2024-11-03 224655.png'),
(2, 'Meja Meeting', 15, 'Meja meeting kapasitas 8 orang', 'Screenshot 2024-11-03 224655.png'),
(3, 'Proyektor', 3, 'Proyektor merk Epson brightness 3000 lumens', 'proyektor.jpg'),
(4, 'Laptop', 4, 'Laptop untuk keperluan kantor', 'laptop.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjambarang`
--

CREATE TABLE `pinjambarang` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `lokasi_barang` text,
  `status` varchar(30) NOT NULL DEFAULT 'menunggu',
  `catatan` text NOT NULL,
  `kondisi_pengembalian` varchar(50) DEFAULT NULL,
  `catatan_pengembalian` text,
  `tgl_pengembalian` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pinjambarang`
--

INSERT INTO `pinjambarang` (`id`, `id_barang`, `id_user`, `qty`, `tgl_mulai`, `tgl_selesai`, `lokasi_barang`, `status`, `catatan`, `kondisi_pengembalian`, `catatan_pengembalian`, `tgl_pengembalian`) VALUES
(2, 2, 2, 2, '2024-11-04 00:17:30', '2024-11-07 00:17:00', 'RUangan 1', 'dikembalikan', 'Terima kasih', 'baik', 'aaaa', '2024-11-03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjamruangan`
--

CREATE TABLE `pinjamruangan` (
  `id` int(11) NOT NULL,
  `id_ruangan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `keterangan` text,
  `status` enum('menunggu','dipinjam','dikembalikan','ditolak','diterima') DEFAULT 'menunggu',
  `catatan` text NOT NULL,
  `kondisi_pengembalian` varchar(50) DEFAULT NULL,
  `catatan_pengembalian` text,
  `tgl_pengembalian` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pinjamruangan`
--

INSERT INTO `pinjamruangan` (`id`, `id_ruangan`, `id_user`, `tgl_mulai`, `tgl_selesai`, `keterangan`, `status`, `catatan`, `kondisi_pengembalian`, `catatan_pengembalian`, `tgl_pengembalian`) VALUES
(1, 1, 2, '2024-11-04 00:21:57', '2024-11-04 00:22:00', 'Rapat', 'dikembalikan', 'acc', 'baik', 'aaaa', '2024-11-03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `id` int(11) NOT NULL,
  `nama_ruangan` varchar(100) NOT NULL,
  `deskripsi` text,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('free','used') DEFAULT 'free'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`id`, `nama_ruangan`, `deskripsi`, `foto`, `status`) VALUES
(1, 'Ruang Meeting A', 'Ruang meeting dengan kapasitas 10 orang, dilengkapi dengan proyektor dan whiteboard', 'meeting_a.jpg', 'free'),
(2, 'Ruang Seminar', 'Ruang seminar kapasitas 50 orang dengan sound system', 'seminar.jpg', 'free'),
(3, 'Ruang Konseling', 'Ruang untuk konseling pribadi atau kelompok kecil', 'konseling.jpg', 'free'),
(4, 'Ruang Ibadah', 'Ruang ibadah dengan AC dan perlengkapan ibadah', 'ibadah.jpg', 'free');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','user') NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`, `email`, `nama_lengkap`) VALUES
(1, 'admin1', 'admin123', 'admin', 'admin@gmail.com', 'Administrator'),
(2, 'user1', 'user123', 'user', 'user1@gmail.com', 'User Satu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinjambarang`
--
ALTER TABLE `pinjambarang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pinjamruangan`
--
ALTER TABLE `pinjamruangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ruangan` (`id_ruangan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pinjambarang`
--
ALTER TABLE `pinjambarang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pinjamruangan`
--
ALTER TABLE `pinjamruangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pinjambarang`
--
ALTER TABLE `pinjambarang`
  ADD CONSTRAINT `pinjambarang_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `pinjambarang_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Ketidakleluasaan untuk tabel `pinjamruangan`
--
ALTER TABLE `pinjamruangan`
  ADD CONSTRAINT `pinjamruangan_ibfk_1` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id`),
  ADD CONSTRAINT `pinjamruangan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
