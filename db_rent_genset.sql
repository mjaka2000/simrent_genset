-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Nov 2023 pada 01.52
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rent_genset`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_serv`
--

CREATE TABLE `tb_detail_serv` (
  `id_detail_serv` int(10) NOT NULL,
  `id_perbaikan_gst` int(11) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `kendala` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_detail_serv`
--

INSERT INTO `tb_detail_serv` (`id_detail_serv`, `id_perbaikan_gst`, `pekerjaan`, `tanggal`, `kendala`, `status`) VALUES
(2, 2, 'ted', '2023-09-08', 'fxz', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_genset`
--

CREATE TABLE `tb_genset` (
  `id_genset` int(11) NOT NULL,
  `kode_genset` varchar(50) NOT NULL,
  `nama_genset` varchar(50) NOT NULL,
  `daya` varchar(50) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `ket_genset` tinyint(4) DEFAULT 0,
  `gambar_genset` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_genset`
--

INSERT INTO `tb_genset` (`id_genset`, `kode_genset`, `nama_genset`, `daya`, `harga`, `ket_genset`, `gambar_genset`) VALUES
(1, '10', 'Denyo 25 ES-10', '20', '750000', 0, 'denyo25es-10.jpg'),
(2, '07', 'Denyo 25 ES-07', '20', '750000', 0, 'denyo25es-07.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jadwal_genset`
--

CREATE TABLE `tb_jadwal_genset` (
  `id_jadwal_genset` int(11) NOT NULL,
  `id_operator` int(11) NOT NULL,
  `id_genset` int(11) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `tgl_masuk` date NOT NULL,
  `jumlah_hari` varchar(10) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status_jdw` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mobil`
--

CREATE TABLE `tb_mobil` (
  `id_mobil` int(11) NOT NULL,
  `merek` varchar(100) NOT NULL,
  `tipe` varchar(100) NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `nopol` varchar(50) NOT NULL,
  `jenis_bbm` varchar(50) NOT NULL,
  `pajak` date NOT NULL,
  `stnk` date NOT NULL,
  `gambar_mobil` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_mobil`
--

INSERT INTO `tb_mobil` (`id_mobil`, `merek`, `tipe`, `tahun`, `nopol`, `jenis_bbm`, `pajak`, `stnk`, `gambar_mobil`) VALUES
(1, 'Daihatsu Gran Max Putih', 'pick up', '2016', 'DA 4534 AS', 'Bensin', '2023-08-20', '2023-08-20', 'gran_max_wh.jpg'),
(2, 'daihatsu gran max biru', 'pick up', '2016', 'DA 6754 QW', 'Bensin', '2024-08-01', '2024-08-01', 'daihatsu-gran-max-blu.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_operator`
--

CREATE TABLE `tb_operator` (
  `id_operator` int(11) NOT NULL,
  `nama_op` varchar(50) NOT NULL,
  `alamat_op` varchar(50) NOT NULL,
  `nohp_op` varchar(50) NOT NULL,
  `noktp_op` varchar(20) NOT NULL,
  `status_op` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_operator`
--

INSERT INTO `tb_operator` (`id_operator`, `nama_op`, `alamat_op`, `nohp_op`, `noktp_op`, `status_op`) VALUES
(1, 'Adi', 'jl pulau laut bjm', '0897819271234', '18377559303022', 1),
(2, 'Arul', 'Jl. AKT Dalam', '0897618391837', '1837755938776567', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_plg` varchar(50) NOT NULL,
  `alamat_plg` varchar(50) NOT NULL,
  `nohp_plg` varchar(20) NOT NULL,
  `jk_plg` enum('L','P') DEFAULT NULL,
  `namaperusahaan_plg` varchar(50) NOT NULL,
  `tglupdate_plg` date NOT NULL,
  `status_plg` tinyint(4) DEFAULT 0,
  `ket_plg` tinyint(4) DEFAULT 0,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama_plg`, `alamat_plg`, `nohp_plg`, `jk_plg`, `namaperusahaan_plg`, `tglupdate_plg`, `status_plg`, `ket_plg`, `id_user`) VALUES
(1, 'Bayu Agung', 'jl kp melayu', '0878123123123', 'L', 'pt amanah', '2023-08-21', 0, 0, 43),
(2, 'Ibnu Jal', 'jl. sei jingah', '0878123121234', 'L', 'pt rahmat', '2023-08-22', 0, 0, 44);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pendapatan`
--

CREATE TABLE `tb_pendapatan` (
  `id_pendapatan` int(10) NOT NULL,
  `id_u_sewa` int(10) NOT NULL,
  `tgl_update` date NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_pendapatan`
--

INSERT INTO `tb_pendapatan` (`id_pendapatan`, `id_u_sewa`, `tgl_update`, `keterangan`) VALUES
(1, 7, '2023-09-07', 'dah lh'),
(2, 6, '2023-10-16', 'tes rent');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengeluaran`
--

CREATE TABLE `tb_pengeluaran` (
  `id_pengeluaran` int(10) NOT NULL,
  `tgl_pengeluaran` date NOT NULL,
  `pengeluaran` varchar(255) NOT NULL,
  `biaya_pengeluaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_pengeluaran`
--

INSERT INTO `tb_pengeluaran` (`id_pengeluaran`, `tgl_pengeluaran`, `pengeluaran`, `biaya_pengeluaran`) VALUES
(1, '2023-09-07', 'wifi indi', '350000'),
(2, '2023-09-08', 'tester', '500');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_serv_genset`
--

CREATE TABLE `tb_serv_genset` (
  `id_perbaikan_gst` int(11) NOT NULL,
  `id_genset` int(11) NOT NULL,
  `id_sparepart` int(11) DEFAULT NULL,
  `jenis_perbaikan` varchar(255) NOT NULL,
  `tgl_perbaikan` date NOT NULL,
  `jam_pakai` varchar(10) NOT NULL,
  `ket_perbaikan` tinyint(4) NOT NULL,
  `biaya_perbaikan` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_serv_genset`
--

INSERT INTO `tb_serv_genset` (`id_perbaikan_gst`, `id_genset`, `id_sparepart`, `jenis_perbaikan`, `tgl_perbaikan`, `jam_pakai`, `ket_perbaikan`, `biaya_perbaikan`) VALUES
(2, 1, 1, 'ganti oli', '2023-09-04', '158', 1, '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_serv_genset_masuk`
--

CREATE TABLE `tb_serv_genset_masuk` (
  `id_det_pakai_genset` int(11) NOT NULL,
  `id_u_sewa` int(11) NOT NULL,
  `ket_det_pakai_genset` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_serv_genset_masuk`
--

INSERT INTO `tb_serv_genset_masuk` (`id_det_pakai_genset`, `id_u_sewa`, `ket_det_pakai_genset`) VALUES
(2, 6, 'tes'),
(3, 7, 'coba'),
(4, 9, 'yeas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_serv_gst_acc`
--

CREATE TABLE `tb_serv_gst_acc` (
  `id_serv_gst_acc` int(11) NOT NULL,
  `id_perbaikan_gst` int(11) NOT NULL,
  `tgl_setujui` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status_ajuan` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_serv_gst_acc`
--

INSERT INTO `tb_serv_gst_acc` (`id_serv_gst_acc`, `id_perbaikan_gst`, `tgl_setujui`, `keterangan`, `status_ajuan`) VALUES
(1, 2, '2023-09-07', 'oli diganti', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sparepart`
--

CREATE TABLE `tb_sparepart` (
  `id_sparepart` int(11) NOT NULL,
  `nama_sparepart` varchar(255) NOT NULL,
  `tanggal_beli` date NOT NULL,
  `tempat_beli` varchar(255) NOT NULL,
  `stok` varchar(20) NOT NULL,
  `harga_sparepart` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_sparepart`
--

INSERT INTO `tb_sparepart` (`id_sparepart`, `nama_sparepart`, `tanggal_beli`, `tempat_beli`, `stok`, `harga_sparepart`) VALUES
(1, 'Oli Meditran SX 1Lt', '2023-09-01', 'Bengkel Makmur', '4', '300000'),
(2, 'Filter Solar Sakura cf', '2023-09-02', 'Filter Jaya', '4', '70000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_unit_penyewaan`
--

CREATE TABLE `tb_unit_penyewaan` (
  `id_u_sewa` int(11) NOT NULL,
  `id_transaksi` varchar(20) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_genset` int(11) NOT NULL,
  `tambahan` varchar(255) NOT NULL,
  `jumlah_hari` varchar(10) NOT NULL,
  `total` varchar(50) NOT NULL,
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_unit_penyewaan`
--

INSERT INTO `tb_unit_penyewaan` (`id_u_sewa`, `id_transaksi`, `tanggal_keluar`, `tanggal_masuk`, `lokasi`, `id_pelanggan`, `id_genset`, `tambahan`, `jumlah_hari`, `total`, `status`) VALUES
(6, 'GE-Aug5291', '2023-08-21', '2023-08-23', 'Binuang', 1, 1, 'Kabel 20M', '2', '1500000', 0),
(7, 'GE-Aug0513', '2023-08-24', '2023-08-27', 'Banjarbaru', 1, 1, 'Box Panel', '3', '2250000', 0),
(8, 'GE-Sep4160', '2023-09-07', '2023-09-09', 'Gambut', 1, 1, 'Panel', '2', '1500000', 0),
(9, 'GE-Oct5632', '2023-10-30', '2023-11-03', 'Gambut', 2, 2, '-', '4', '3000000', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `nama_file` varchar(150) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `nama`, `password`, `role`, `nama_file`, `last_login`) VALUES
(1, 'admin', 'Jaka Admin', '$2y$10$Yc8ohXuawX0etu5zcU7mgu84DfZY8YZ/r45KZ6/VwZMOISukO10ZG', 0, 'Muhammad_Jaka_Permana_(Latar_Merah)-1-.jpg', '2023-11-29 08:26:43'),
(32, 'bos', 'Bos Jaka', '$2y$10$R4e0tMDfAU.8nz41SxIIhOQ1J5.itOq.sbA8YEAUzKJOSTVUJnV/m', 1, 'wifi-icon.png', '2023-10-24 11:26:48'),
(33, 'aril', 'Syahril', '$2y$10$bX/22YuDFyiEtVzcX17ofujConoU4Rgl/KmrFBzKqU2E7RaAqgLIO', 2, 'nopic.png', '2023-10-19 09:38:21'),
(34, 'aldir', 'Aldi', '$2y$10$/PLQHhHrXYDUB99txtigROvNfotOf/VIJbciIfeaQMPipOZgc86e6', 2, 'nopic.png', '0000-00-00 00:00:00'),
(43, 'abay021', 'Bayu Agung', '$2y$10$gYs55hE6HXox5mJfc5Q3t.7f/iauCe1ke2n6v3MoCddlqsXE8kniS', 3, 'nopic.png', '2023-10-30 10:24:50'),
(44, 'ibnu123', 'Ibnu', '$2y$10$xrUskK.7d7ZFMFrOLEoPZOuy6RXQsq.sx89z10kxbt4Ot8Oo9N0Uy', 3, 'nopic.png', '2023-10-30 10:25:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_valid_penyewaan`
--

CREATE TABLE `tb_valid_penyewaan` (
  `id_valid_penyewaan` int(11) NOT NULL,
  `id_u_sewa` int(11) NOT NULL,
  `id_transaksi` varchar(20) NOT NULL,
  `id_operator` int(11) NOT NULL,
  `id_mobil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_valid_penyewaan`
--

INSERT INTO `tb_valid_penyewaan` (`id_valid_penyewaan`, `id_u_sewa`, `id_transaksi`, `id_operator`, `id_mobil`) VALUES
(2, 6, 'GE-Aug5291', 1, 1),
(3, 7, 'GE-Aug0513', 1, 1),
(4, 8, 'GE-Sep4160', 1, 1),
(5, 9, 'GE-Oct5632', 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_detail_serv`
--
ALTER TABLE `tb_detail_serv`
  ADD PRIMARY KEY (`id_detail_serv`),
  ADD KEY `id_perbaikan_gst` (`id_perbaikan_gst`);

--
-- Indeks untuk tabel `tb_genset`
--
ALTER TABLE `tb_genset`
  ADD PRIMARY KEY (`id_genset`);

--
-- Indeks untuk tabel `tb_jadwal_genset`
--
ALTER TABLE `tb_jadwal_genset`
  ADD PRIMARY KEY (`id_jadwal_genset`),
  ADD KEY `id_operator` (`id_operator`,`id_genset`,`id_mobil`),
  ADD KEY `id_genset` (`id_genset`),
  ADD KEY `id_mobil` (`id_mobil`);

--
-- Indeks untuk tabel `tb_mobil`
--
ALTER TABLE `tb_mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indeks untuk tabel `tb_operator`
--
ALTER TABLE `tb_operator`
  ADD PRIMARY KEY (`id_operator`);

--
-- Indeks untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_pendapatan`
--
ALTER TABLE `tb_pendapatan`
  ADD PRIMARY KEY (`id_pendapatan`),
  ADD KEY `id_u_sewa` (`id_u_sewa`) USING BTREE;

--
-- Indeks untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indeks untuk tabel `tb_serv_genset`
--
ALTER TABLE `tb_serv_genset`
  ADD PRIMARY KEY (`id_perbaikan_gst`),
  ADD KEY `id_genset` (`id_genset`),
  ADD KEY `id_sparepart` (`id_sparepart`);

--
-- Indeks untuk tabel `tb_serv_genset_masuk`
--
ALTER TABLE `tb_serv_genset_masuk`
  ADD PRIMARY KEY (`id_det_pakai_genset`),
  ADD KEY `id_u_sewa` (`id_u_sewa`);

--
-- Indeks untuk tabel `tb_serv_gst_acc`
--
ALTER TABLE `tb_serv_gst_acc`
  ADD PRIMARY KEY (`id_serv_gst_acc`),
  ADD KEY `id_perbaikan_gst` (`id_perbaikan_gst`);

--
-- Indeks untuk tabel `tb_sparepart`
--
ALTER TABLE `tb_sparepart`
  ADD PRIMARY KEY (`id_sparepart`);

--
-- Indeks untuk tabel `tb_unit_penyewaan`
--
ALTER TABLE `tb_unit_penyewaan`
  ADD PRIMARY KEY (`id_u_sewa`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_genset` (`id_genset`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tb_valid_penyewaan`
--
ALTER TABLE `tb_valid_penyewaan`
  ADD PRIMARY KEY (`id_valid_penyewaan`),
  ADD KEY `id_u_sewa` (`id_u_sewa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_detail_serv`
--
ALTER TABLE `tb_detail_serv`
  MODIFY `id_detail_serv` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_genset`
--
ALTER TABLE `tb_genset`
  MODIFY `id_genset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_jadwal_genset`
--
ALTER TABLE `tb_jadwal_genset`
  MODIFY `id_jadwal_genset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_mobil`
--
ALTER TABLE `tb_mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_operator`
--
ALTER TABLE `tb_operator`
  MODIFY `id_operator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_pendapatan`
--
ALTER TABLE `tb_pendapatan`
  MODIFY `id_pendapatan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  MODIFY `id_pengeluaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_serv_genset`
--
ALTER TABLE `tb_serv_genset`
  MODIFY `id_perbaikan_gst` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_serv_genset_masuk`
--
ALTER TABLE `tb_serv_genset_masuk`
  MODIFY `id_det_pakai_genset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_serv_gst_acc`
--
ALTER TABLE `tb_serv_gst_acc`
  MODIFY `id_serv_gst_acc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_sparepart`
--
ALTER TABLE `tb_sparepart`
  MODIFY `id_sparepart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_unit_penyewaan`
--
ALTER TABLE `tb_unit_penyewaan`
  MODIFY `id_u_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `tb_valid_penyewaan`
--
ALTER TABLE `tb_valid_penyewaan`
  MODIFY `id_valid_penyewaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_detail_serv`
--
ALTER TABLE `tb_detail_serv`
  ADD CONSTRAINT `tb_detail_serv_ibfk_1` FOREIGN KEY (`id_perbaikan_gst`) REFERENCES `tb_serv_genset` (`id_perbaikan_gst`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_jadwal_genset`
--
ALTER TABLE `tb_jadwal_genset`
  ADD CONSTRAINT `tb_jadwal_genset_ibfk_1` FOREIGN KEY (`id_genset`) REFERENCES `tb_genset` (`id_genset`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_jadwal_genset_ibfk_2` FOREIGN KEY (`id_operator`) REFERENCES `tb_operator` (`id_operator`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_jadwal_genset_ibfk_3` FOREIGN KEY (`id_mobil`) REFERENCES `tb_mobil` (`id_mobil`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD CONSTRAINT `tb_pelanggan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pendapatan`
--
ALTER TABLE `tb_pendapatan`
  ADD CONSTRAINT `tb_pendapatan_ibfk_1` FOREIGN KEY (`id_u_sewa`) REFERENCES `tb_unit_penyewaan` (`id_u_sewa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_serv_genset`
--
ALTER TABLE `tb_serv_genset`
  ADD CONSTRAINT `tb_serv_genset_ibfk_1` FOREIGN KEY (`id_genset`) REFERENCES `tb_genset` (`id_genset`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_serv_gst_acc`
--
ALTER TABLE `tb_serv_gst_acc`
  ADD CONSTRAINT `tb_serv_gst_acc_ibfk_1` FOREIGN KEY (`id_perbaikan_gst`) REFERENCES `tb_serv_genset` (`id_perbaikan_gst`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_unit_penyewaan`
--
ALTER TABLE `tb_unit_penyewaan`
  ADD CONSTRAINT `tb_unit_penyewaan_ibfk_1` FOREIGN KEY (`id_genset`) REFERENCES `tb_genset` (`id_genset`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_unit_penyewaan_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_valid_penyewaan`
--
ALTER TABLE `tb_valid_penyewaan`
  ADD CONSTRAINT `tb_valid_penyewaan_ibfk_1` FOREIGN KEY (`id_u_sewa`) REFERENCES `tb_unit_penyewaan` (`id_u_sewa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
