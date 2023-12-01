-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Des 2023 pada 09.47
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
(2, 2, 'ted', '2023-09-08', 'fxz', 1),
(3, 3, 'testing', '2023-04-12', 'tester', 1),
(4, 3, 'selang solar mampet', '2023-04-12', 'selang kotor dibersihkan', 1);

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
(2, '07', 'Denyo 25 ES-07', '20', '750000', 0, 'denyo25es-07.jpg'),
(3, '13', 'Denyo 25 ES-13', '20', '750000', 0, 'denyo25es-13.jpg'),
(4, '08', 'Kubota 13-08', '13', '500000', 0, 'kubota13-08.jpg'),
(5, '02', 'Hartech 45 P-02', '40', '1000000', 0, 'ht45p-02.jpg'),
(6, '18', 'Hartech 45 P-18', '40', '1000000', 0, 'ht45p-18.jpg'),
(7, '16', 'Hartech 50 P-16', '50', '1250000', 0, 'ht50p-16.jpg'),
(8, '200', 'Denyo 150', '150', '2500000', 0, 'denyo_dca-150_spk-200.jpg'),
(9, '250', 'Hartech C-250', '250', '3500000', 0, 'ht250.jpg');

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
(2, 'daihatsu gran max biru', 'pick up', '2016', 'DA 6754 QW', 'Bensin', '2024-08-01', '2024-08-01', 'daihatsu-gran-max-blu.jpg'),
(3, 'Mitsubishi Truk Engkel Kuning', 'Truk', '2000', 'DA 8510 LF', 'Solar', '2024-09-08', '2028-09-08', 'truk_engkel.jpg'),
(4, 'Mobil Penyewa', 'Mobil Penyewa', '-', 'Mobil Penyewa', 'Bensin', '0001-01-01', '0001-01-01', 'nopic.png');

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
(1, 'Adi', 'jl pulau laut bjm', '0897819271234', '1837755930302264', 1),
(2, 'Arul', 'Jl. AKT Dalam', '0897618391837', '1837755938776567', 1),
(4, 'Ijum', 'jl pulau laut', '0897819271234', '1256237467583752', 1),
(5, 'Wawan', 'jl sukamara', '0897819289283', '1620938473817289', 1),
(6, 'Agus', 'jl manggis', '0897618390485', '1620938473467583', 0),
(7, 'Andre S', 'jl handil bakti', '0897618654602', '1256237457684938', 0),
(8, 'Sukma Lelana', 'jl. sungai andai, komp. persada', '0897819256049', '1256237457172638', 0),
(9, 'Ahmad Musa', 'jl. sungai jingah', '0897618059683', '1620932637482945', 0);

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
(2, 'Ibnu Jal', 'jl. sei jingah', '0878123121234', 'L', 'pt rahmat', '2023-08-22', 0, 0, 44),
(3, 'Wanda', 'Jl. Sungai Miai', '0878123121234', 'L', 'pt rtr', '2023-11-29', 0, 0, 45),
(4, 'Khairullah', 'Jl. Kampung Melayu 07', '0821312341087', 'L', 'pt amanah', '2023-11-29', 0, 0, 46),
(5, 'Adrian Ali', 'Jl. Pahlaman, No. 10 Banjarmasin', '0878123123123', 'L', '-', '2023-11-29', 0, 0, 47),
(6, 'Ahmad Yani', 'Jl. Pramuka, No. 15 Banjarmasin', '0878123128976', 'L', 'Maju Bersama', '2023-11-29', 0, 0, 48),
(7, 'Nur Hikari', 'Jl. Sultan Adam, No. 10', '0878123129861', 'P', 'PT Amanah', '2023-11-29', 0, 0, 49);

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
(2, 1, 1, 'ganti oli', '2023-09-04', '158', 1, '100000'),
(3, 5, 8, 'ganti filter solar', '2023-04-12', '150', 1, '80000'),
(4, 7, 6, 'ganti filter solar', '2023-06-14', '50', 1, '80000'),
(5, 4, 1, 'Penggantian oli mesin', '2023-06-16', '80', 1, '100000'),
(6, 6, 8, 'Solar Buntu', '2023-07-03', '110', 0, '120000'),
(7, 3, 9, 'kuras tangki solar', '2023-10-11', '20', 0, '0');

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
(4, 9, 'yeas'),
(5, 10, 'genset kepanasan pada mesin'),
(6, 11, 'tegangan kurang stabil'),
(7, 13, 'perawatan rutin');

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
(1, 2, '2023-09-07', 'oli diganti', 1),
(2, 3, '2023-04-12', 'filter solar diganti', 1),
(3, 4, '2023-06-14', 'filter solar aman', 1),
(4, 5, '2023-06-17', 'oli diganti baru', 0);

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
(1, 'Oli Meditran SX 1Lt', '2023-09-01', 'Bengkel Makmur', '3', '300000'),
(2, 'Filter Solar Sakura cf', '2023-09-02', 'Filter Jaya', '4', '70000'),
(3, 'Filter Oli Donaldson', '2023-09-14', 'Multi Filter', '4', '80000'),
(4, 'Fuel Pump Denyo', '2023-10-03', 'Anugerah Jaya', '3', '350000'),
(5, 'Ring Piston Denyo', '2023-10-09', 'Anugerah Jaya', '5', '95000'),
(6, 'Filter Solar Perkins', '2023-10-11', 'Multi Filter', '3', '70000'),
(7, 'Air Aki Yuasa Botol', '2023-09-26', 'Toko Aki Bersama', '6', '25000'),
(8, 'Filter Solar Donaldson', '2023-10-16', 'Multi Filter', '2', '80000'),
(9, 'null', '0001-01-01', 'null', '999', '0'),
(10, 'selang vakum denyo', '2023-10-17', 'Anugerah Jaya', '3', '20000');

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
(9, 'GE-Oct5632', '2023-10-30', '2023-11-03', 'Gambut', 2, 2, '-', '4', '3000000', 0),
(10, 'GE-Dec6017', '2023-06-09', '2023-06-12', 'Binuang', 1, 5, '-', '3', '3000000', 0),
(11, 'GE-Dec5892', '2023-06-17', '2023-06-21', 'Gambut', 2, 1, 'Kabel 20M', '4', '3000000', 0),
(12, 'GE-Dec6304', '2023-06-19', '2023-06-22', 'Martapura', 3, 2, 'kabel', '3', '2250000', 0),
(13, 'GE-Dec7501', '2023-06-19', '2023-06-22', 'Martapura', 3, 3, '-', '3', '2250000', 0),
(14, 'GE-Dec9270', '2023-11-13', '2023-11-16', 'Pemko BJM', 4, 4, '-', '3', '1500000', 0),
(15, 'GE-Dec9367', '2023-11-14', '2023-11-17', 'Polda Banjarbaru', 4, 6, 'Kabel 20M', '3', '3000000', 0);

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
(1, 'admin', 'Jaka Admin', '$2y$10$Yc8ohXuawX0etu5zcU7mgu84DfZY8YZ/r45KZ6/VwZMOISukO10ZG', 0, 'Muhammad_Jaka_Permana_(Latar_Merah)-1-.jpg', '2023-12-01 15:59:12'),
(32, 'bos', 'Bos Jaka', '$2y$10$R4e0tMDfAU.8nz41SxIIhOQ1J5.itOq.sbA8YEAUzKJOSTVUJnV/m', 1, 'wifi-icon.png', '2023-10-24 11:26:48'),
(33, 'aril', 'Syahril', '$2y$10$bX/22YuDFyiEtVzcX17ofujConoU4Rgl/KmrFBzKqU2E7RaAqgLIO', 2, 'nopic.png', '2023-10-19 09:38:21'),
(43, 'abay021', 'Bayu Agung', '$2y$10$gYs55hE6HXox5mJfc5Q3t.7f/iauCe1ke2n6v3MoCddlqsXE8kniS', 3, 'nopic.png', '2023-10-30 10:24:50'),
(44, 'ibnu123', 'Ibnu', '$2y$10$xrUskK.7d7ZFMFrOLEoPZOuy6RXQsq.sx89z10kxbt4Ot8Oo9N0Uy', 3, 'nopic.png', '2023-10-30 10:25:18'),
(45, 'wanda012', 'Wanda', '$2y$10$h3QlLXnF/tisWJGpmPeqB.0qKYc4o9/htnYoMLVK13aiSuz4cygoe', 3, 'nopic.png', '2023-11-29 14:19:40'),
(46, 'irul021', 'Khairullah', '$2y$10$6k4V03w51B4MY2ZHRDkEEOjGubsrg4xgeHbUUEGzXdLnGY1itrjay', 3, 'nopic.png', '2023-11-29 14:21:31'),
(47, 'adrianali01', 'Adrian Ali', '$2y$10$E8oUX6gAMg8uUj.UE2AVVOQjw4y2AO3nlsvUKp2eHVfDLGZB3TlUu', 3, 'nopic.png', '2023-11-29 14:23:05'),
(48, 'ayani12', 'Ahmad Yani', '$2y$10$kjOrYMOWCXBYcwvJITtZYe8dbnSlskfydV1MG2abYblEyt7Mc2uTK', 3, 'nopic.png', '2023-11-29 14:24:23'),
(49, 'hkari098', 'Nur Hikari', '$2y$10$Eml8N9Ceum0UXp7g.xr/SuNal0D0DUA7u/MM//hIdvfuSFeyOl1wS', 3, 'nopic.png', '2023-11-29 14:26:48');

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
(5, 9, 'GE-Oct5632', 2, 2),
(6, 10, 'GE-Dec6017', 1, 1),
(7, 11, 'GE-Dec5892', 2, 2),
(8, 12, 'GE-Dec6304', 4, 4),
(9, 13, 'GE-Dec7501', 4, 4),
(10, 14, 'GE-Dec9270', 5, 1),
(11, 15, 'GE-Dec9367', 2, 4);

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
  MODIFY `id_detail_serv` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_genset`
--
ALTER TABLE `tb_genset`
  MODIFY `id_genset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_jadwal_genset`
--
ALTER TABLE `tb_jadwal_genset`
  MODIFY `id_jadwal_genset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_mobil`
--
ALTER TABLE `tb_mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_operator`
--
ALTER TABLE `tb_operator`
  MODIFY `id_operator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id_perbaikan_gst` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_serv_genset_masuk`
--
ALTER TABLE `tb_serv_genset_masuk`
  MODIFY `id_det_pakai_genset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_serv_gst_acc`
--
ALTER TABLE `tb_serv_gst_acc`
  MODIFY `id_serv_gst_acc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_sparepart`
--
ALTER TABLE `tb_sparepart`
  MODIFY `id_sparepart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_unit_penyewaan`
--
ALTER TABLE `tb_unit_penyewaan`
  MODIFY `id_u_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `tb_valid_penyewaan`
--
ALTER TABLE `tb_valid_penyewaan`
  MODIFY `id_valid_penyewaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
