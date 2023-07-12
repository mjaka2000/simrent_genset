-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jul 2023 pada 05.27
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
(1, 2, 'Pemasangan filter', '2023-06-15', 'baut lepas', 0),
(3, 2, 'bongkar mesin', '2023-06-16', '-', 1),
(5, 18, 'Bongkar Fuel pump', '2023-06-15', 'Filter kotor', 0),
(6, 18, 'bersihkan pump', '2023-06-15', '-', 1),
(7, 19, 'Penggantian oli mesin', '2023-06-16', '-', 0),
(8, 1, 'Testing', '2023-04-17', 'Tester', 1),
(9, 1, 'Selang solar mampet', '2023-04-14', 'Selang kotor dibersihkan', 1),
(10, 21, 'Kuras tangki solar', '2023-07-03', 'Tangki kotor sulit dibersihkan', 0),
(11, 21, 'Bongkar dan cuci tangki', '2023-07-04', '-', 1);

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
(2, '02', 'Hartech 45 P-02', '40', '1000000', 2, 'ht45p-02-2.jpg'),
(3, '07', 'Denyo 25 ES-07', '20', '750000', 0, 'denyo25es-07.jpg'),
(4, '10', 'Denyo 25 ES-10', '20', '750000', 0, 'denyo25es-10.jpg'),
(5, '16', 'Hartech 50 P-16', '50', '1250000', 0, 'ht50p-16.jpg'),
(6, '08', 'Kubota 13-08', '13', '500000', 0, 'kubota13-08.jpg'),
(7, '250', 'Hartech C-250', '250', '3500000', 0, 'ht250.jpg'),
(8, '18', 'Hartech 45 P-18', '40', '1000000', 0, 'ht45p-18.jpg');

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
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_jadwal_genset`
--

INSERT INTO `tb_jadwal_genset` (`id_jadwal_genset`, `id_operator`, `id_genset`, `id_mobil`, `tgl_keluar`, `tgl_masuk`, `jumlah_hari`, `lokasi`, `keterangan`) VALUES
(4, 1, 2, 1, '2023-07-12', '2023-07-14', '2', 'Tugu 0 Km', 'Wanda menyewa genset');

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
(1, 'Daihatsu Gran Max Biru', 'Pickup', '2015', 'DA 1231 CJ', 'Bensin', '2023-05-18', '2024-05-18', 'daihatsu-gran-max-blu.jpg'),
(2, 'Mobil Penyewa', 'Mobil Penyewa', '-', 'Mobil Penyewa', 'Bensin', '0001-01-01', '0001-01-01', 'nopic.png'),
(3, 'Mitsubishi Truk Engkel Kuning', 'Truk', '2005', 'DA 5674 CJ', 'Solar', '2023-06-01', '2024-06-01', 'truk_engkel.jpg'),
(4, 'L300', 'Pickup', '2010', 'DA 4351 SF', 'Solar', '2023-03-01', '2024-03-01', 'l300.jpg');

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
(1, 'Jaka Ja', 'Jl. sungai jingah', '0895619019104', '1623123432345436', 0),
(2, 'adi', 'jl sukamara', '0878907678956', '1624543765468998', 0),
(3, 'ijum', 'jl pulau laut', '0897819271234', '1643253487656745', 0),
(5, 'wanda', 'sungai miai', '0897618391837', '1675685465987534', 0),
(6, 'Wawan', 'Jl. Belitung Darat RT. 02', '0878124354432', '1623435433245886', 0),
(7, 'Agus', 'Jl. Manggis', '0821876723433', '1645765423457899', 0),
(8, 'Andre S.', 'Jl. Handil Bakti Komp. Persada', '0898213489123', '1756435675346765', 0),
(9, 'Sukma Lelana', 'Jl. Handil bakti', '0878678734658', '6756754567864567', 0),
(10, 'Ahmad Musa', 'Jl. Sungai Jingah', '0896316721892', '6546876546534567', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_plg` varchar(50) NOT NULL,
  `alamat_plg` varchar(50) NOT NULL,
  `nohp_plg` varchar(20) NOT NULL,
  `jk_plg` enum('L','P') NOT NULL,
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
(4, 'anonim', 'Jl. Sunga Andai', '0895619213134', 'L', 'PT Rahmat', '2023-04-11', 0, 1, 0),
(5, 'iwan f', 'jl kp melayu', '0878123121234', 'L', 'pt rahmat', '2023-04-16', 0, 1, 0),
(8, 'Wanda', 'Jl. Mantuil', '0897738493722', 'L', 'PT. Abadi', '2023-06-26', 0, 0, 37),
(9, 'Bayu Agung', 'Jl. A. Yani KM. 06', '0821564721344', 'L', '-', '2023-06-29', 0, 0, 38),
(10, 'Khairullah', 'Jl. Dharma Praja 07', '0878671234123', 'L', 'Pribadi', '2023-07-02', 0, 0, 39),
(11, 'Adrian Ali', 'Jl. Pahlawan, No. 10 Banjarmasin', '081345216712', 'L', 'PT. Maju Bersama', '2023-07-02', 0, 0, 40),
(12, 'Ahmad Yani', 'Jl. Pramuka, Komp. Satelit', '082132456712', 'L', 'Bintang Teknik', '2023-07-02', 0, 0, 41),
(13, 'Nur Hikari', 'Jl. Sultan Adam, No. 15', '087812903478', 'P', '-', '2023-07-03', 0, 0, 42);

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
(6, 8, '2023-06-26', 'hasil sewa jarr'),
(7, 9, '2023-06-28', 'sewa kh ujar'),
(8, 11, '2023-06-30', 'Sewa kah jarr'),
(9, 12, '2023-07-01', 'menyewa kah'),
(10, 15, '2023-07-02', 'ambil genset'),
(11, 6, '2023-07-02', 'testing'),
(12, 10, '2023-07-02', 'wooww');

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
(1, '2023-06-16', 'Bayar Pajak mobil grandmax', '540000'),
(2, '2023-06-15', 'Bayar Pajak mobil grandmax biru', '560000'),
(4, '2023-07-03', 'Bayar wifi kantor', '380000');

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
  `ket_perbaikan` tinyint(4) NOT NULL,
  `biaya_perbaikan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_serv_genset`
--

INSERT INTO `tb_serv_genset` (`id_perbaikan_gst`, `id_genset`, `id_sparepart`, `jenis_perbaikan`, `tgl_perbaikan`, `ket_perbaikan`, `biaya_perbaikan`) VALUES
(1, 2, 1, 'ganti filter solar', '2023-04-12', 1, '0'),
(2, 3, 2, 'Ganti Oli', '2023-04-14', 1, '250000'),
(18, 4, 4, 'GantiFuel pump', '2023-06-14', 1, '150000'),
(19, 4, 1, 'cek oli', '2023-06-16', 1, '0'),
(21, 5, 7, 'Solar Tersumbat', '2023-07-03', 0, '80000');

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
(1, 1, '2023-07-03', 'Filter Solar diganti', 1),
(3, 2, '2023-07-04', 'Oli diganti yang baru', 1),
(4, 19, '2023-07-04', 'Oli tidak bermasalah', 0);

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
(1, 'Filter Solar Donaldson J8620291', '2023-03-14', 'Multi Filter', '2', '80000'),
(2, 'oli sx', '2023-03-16', 'Bengkel Yuno', '3', '300000'),
(4, 'Fuel Pump Denyo', '2023-06-12', 'Anugerah Jaya', '3', '100000'),
(5, 'ring piston', '2023-06-19', 'Bintang Mulia', '4', '95000'),
(6, 'null', '0001-01-01', 'null', '1000', '0'),
(7, 'Filter Solar Donaldson P557111', '2023-06-08', 'Multi Guna Filter', '4', '85000'),
(8, 'Filter solar PERKINS 4816635', '2023-06-07', 'Multi Filter', '4', '65000'),
(9, 'Air Aki Yuasa Botol', '2023-06-30', 'Toko Aki Bersama', '6', '25000');

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
  `id_operator` int(11) DEFAULT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_genset` int(11) NOT NULL,
  `id_mobil` int(11) DEFAULT NULL,
  `tambahan` varchar(255) NOT NULL,
  `jumlah_hari` varchar(10) NOT NULL,
  `total` varchar(50) NOT NULL,
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_unit_penyewaan`
--

INSERT INTO `tb_unit_penyewaan` (`id_u_sewa`, `id_transaksi`, `tanggal_keluar`, `tanggal_masuk`, `lokasi`, `id_operator`, `id_pelanggan`, `id_genset`, `id_mobil`, `tambahan`, `jumlah_hari`, `total`, `status`) VALUES
(6, 'GE-Jun4940', '2023-06-06', '2023-06-09', 'Binuang', 2, 4, 2, 1, 'kabel', '3', '3000000', 0),
(8, 'GE-Jun7741', '2023-06-13', '2023-06-17', 'Gambut', 2, 5, 4, 1, 'kabel', '4', '3000000', 0),
(9, 'GE-Jun2650', '2023-06-16', '2023-06-19', 'Martapura', 2, 5, 4, 2, 'Box Panel', '3', '2250000', 0),
(10, 'GE-Jun4676', '2023-06-16', '2023-06-19', 'Martapura', 1, 4, 3, 1, 'Box Panel', '3', '2250000', 0),
(11, 'GE-Jun2678', '2023-05-23', '2023-05-25', 'Gambut', 2, 5, 3, 2, '-', '2', '1500000', 0),
(12, 'GE-Jun6992', '2023-06-23', '2023-06-26', 'Martapura', 3, 5, 5, 4, 'kabel 20M', '3', '3750000', 0),
(15, 'GE-Jun2082', '2023-06-21', '2023-06-25', 'Tanjung', 2, 8, 4, 2, '-', '4', '3000000', 0),
(16, 'GE-Jun7627', '2023-06-28', '2023-06-30', 'Pemko BJM', 1, 9, 2, 2, 'Panel', '2', '2000000', 0),
(17, 'GE-Jun2828', '2023-06-29', '2023-07-02', 'Banjarbaru', 2, 8, 3, 2, '-', '3', '2250000', 0),
(18, 'GE-Jun4679', '2023-06-28', '2023-06-30', 'Pemko BJM', 3, 9, 4, 2, '-', '2', '1500000', 0);

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
  `last_login` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `nama`, `password`, `role`, `nama_file`, `last_login`) VALUES
(1, 'admin', 'Jaka Admin', '$2y$10$Yc8ohXuawX0etu5zcU7mgu84DfZY8YZ/r45KZ6/VwZMOISukO10ZG', 0, 'Muhammad_Jaka_Permana_(Latar_Merah)-1-.jpg', '12-07-2023 11:25'),
(32, 'bos', 'Bos Jaka', '$2y$10$R4e0tMDfAU.8nz41SxIIhOQ1J5.itOq.sbA8YEAUzKJOSTVUJnV/m', 1, 'wifi-icon.png', '12-07-2023 11:26'),
(33, 'aril', 'Teknik', '$2y$10$bX/22YuDFyiEtVzcX17ofujConoU4Rgl/KmrFBzKqU2E7RaAqgLIO', 2, 'nopic.png', '12-07-2023 11:17'),
(34, 'aldir', 'Aldi', '$2y$10$/PLQHhHrXYDUB99txtigROvNfotOf/VIJbciIfeaQMPipOZgc86e6', 2, 'nopic.png', '23-06-2023 18:26'),
(37, 'wanda123', 'Wanda', '$2y$10$wWJ.E/bIgYzelEjF4aGIMuuGxD7gdA46Pr3jLA7xwFuDgufsze/YC', 3, 'nopic.png', '11-07-2023 11:55'),
(38, 'abay021', 'Bayu Agung', '$2y$10$QEeN8oD4rPRK2xQnGrdNA.omD00N3KHv.ND5Xy4wUGj65ZWWl7ZVe', 3, 'nopic.png', '12-07-2023 11:20'),
(39, 'khai021', 'Khairullah', '$2y$10$m1dBvC60tGx0JgaX7LEDQ.Y.Inx4FAjeUZS1bEw6RmLdS4muAfnCu', 3, 'nopic.png', '05-07-2023 8:03'),
(40, 'adrian123', 'Adrian Ali', '$2y$10$m/Cqzifn67ZQ3Pz762CatO3DKHUJ5/pH.G32YtqyC3vzEZ6HQ7CYK', 3, 'nopic.png', '02-07-2023 19:21'),
(41, 'yaniAhm021', 'Ahmad Yani', '$2y$10$COCwQrSXoewNGdajAHUy4ORtyvvd8DIxNjTrsLO0mr4ekwy3rUMnW', 3, 'nopic.png', '02-07-2023 19:24'),
(42, 'cahaya12', 'Nur Hikari', '$2y$10$OGy6N0Is0tgC/pWyTzQMxe6hza7xl63HrbrYCWuElDItwQ2JiOP1a', 3, 'nopic.png', '02-07-2023 19:26');

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
  ADD KEY `id_operator` (`id_operator`,`id_genset`,`id_mobil`);

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
  ADD KEY `id_operator` (`id_operator`,`id_pelanggan`,`id_genset`,`id_mobil`),
  ADD KEY `id_mobil` (`id_mobil`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_genset` (`id_genset`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_detail_serv`
--
ALTER TABLE `tb_detail_serv`
  MODIFY `id_detail_serv` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_genset`
--
ALTER TABLE `tb_genset`
  MODIFY `id_genset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_jadwal_genset`
--
ALTER TABLE `tb_jadwal_genset`
  MODIFY `id_jadwal_genset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_mobil`
--
ALTER TABLE `tb_mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_operator`
--
ALTER TABLE `tb_operator`
  MODIFY `id_operator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_pendapatan`
--
ALTER TABLE `tb_pendapatan`
  MODIFY `id_pendapatan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  MODIFY `id_pengeluaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_serv_genset`
--
ALTER TABLE `tb_serv_genset`
  MODIFY `id_perbaikan_gst` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  MODIFY `id_u_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_detail_serv`
--
ALTER TABLE `tb_detail_serv`
  ADD CONSTRAINT `tb_detail_serv_ibfk_1` FOREIGN KEY (`id_perbaikan_gst`) REFERENCES `tb_serv_genset` (`id_perbaikan_gst`);

--
-- Ketidakleluasaan untuk tabel `tb_serv_genset`
--
ALTER TABLE `tb_serv_genset`
  ADD CONSTRAINT `tb_serv_genset_ibfk_2` FOREIGN KEY (`id_genset`) REFERENCES `tb_genset` (`id_genset`),
  ADD CONSTRAINT `tb_serv_genset_ibfk_3` FOREIGN KEY (`id_sparepart`) REFERENCES `tb_sparepart` (`id_sparepart`);

--
-- Ketidakleluasaan untuk tabel `tb_unit_penyewaan`
--
ALTER TABLE `tb_unit_penyewaan`
  ADD CONSTRAINT `tb_unit_penyewaan_ibfk_1` FOREIGN KEY (`id_mobil`) REFERENCES `tb_mobil` (`id_mobil`),
  ADD CONSTRAINT `tb_unit_penyewaan_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `tb_unit_penyewaan_ibfk_3` FOREIGN KEY (`id_operator`) REFERENCES `tb_operator` (`id_operator`),
  ADD CONSTRAINT `tb_unit_penyewaan_ibfk_4` FOREIGN KEY (`id_genset`) REFERENCES `tb_genset` (`id_genset`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
