-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jun 2023 pada 03.32
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
-- Struktur dari tabel `tb_avatar`
--

CREATE TABLE `tb_avatar` (
  `id` int(11) NOT NULL,
  `username_user` varchar(50) NOT NULL,
  `nama_file` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_avatar`
--

INSERT INTO `tb_avatar` (`id`, `username_user`, `nama_file`) VALUES
(1, 'admin', 'jaka1.jpg'),
(12, 'jakaja', 'nopic.png'),
(13, 'bos', 'nopic.png'),
(14, 'aril', 'nopic.png');

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
  `ket_genset` int(10) DEFAULT NULL,
  `gambar_genset` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_genset`
--

INSERT INTO `tb_genset` (`id_genset`, `kode_genset`, `nama_genset`, `daya`, `harga`, `ket_genset`, `gambar_genset`) VALUES
(2, '02', 'Hartech 45 P-02', '40', '1000000', 0, 'ht45p-02.jpg'),
(3, '07', 'Denyo 25 ES-07', '20', '750000', 1, 'denyo25es-07.jpg'),
(4, '10', 'Denyo 25 ES-10', '20', '750000', 0, 'denyo25es-10.jpg');

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
(1, 'Daihatsu Gran Max Biru', 'Pickup', '2015', 'DA 1231 CJ', 'Bensin', '2023-05-18', '2024-05-18', 'daihatsu-gran-max-blu.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_operator`
--

CREATE TABLE `tb_operator` (
  `id_operator` int(11) NOT NULL,
  `nama_op` varchar(50) NOT NULL,
  `alamat_op` varchar(50) NOT NULL,
  `nohp_op` varchar(50) NOT NULL,
  `status_op` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_operator`
--

INSERT INTO `tb_operator` (`id_operator`, `nama_op`, `alamat_op`, `nohp_op`, `status_op`) VALUES
(1, 'Jaka Ja', 'Jl. sungai jingah', '0895619019104', 1),
(2, 'adi', 'jl sukamara', '0878907678956', 1),
(3, 'ijum', 'jl pulau laut', '0897819271234', 1),
(5, 'wanda', 'sungai miai', '0897618391837', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_plg` varchar(50) NOT NULL,
  `alamat_plg` varchar(50) NOT NULL,
  `nohp_plg` varchar(20) NOT NULL,
  `jk_plg` varchar(20) NOT NULL,
  `namaperusahaan_plg` varchar(50) NOT NULL,
  `tglupdate_plg` date NOT NULL,
  `ket_plg` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama_plg`, `alamat_plg`, `nohp_plg`, `jk_plg`, `namaperusahaan_plg`, `tglupdate_plg`, `ket_plg`) VALUES
(4, 'anonim', 'Jl. SungaAndaii', '0895619213134', 'Laki-Laki', 'PT Rahmat', '2023-04-11', 1),
(5, 'iwan f', 'jl kp melayu', '0878123121234', 'Laki-Laki', 'pt rahmat', '2023-04-16', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan_blacklist`
--

CREATE TABLE `tb_pelanggan_blacklist` (
  `id_plg_blacklist` int(11) NOT NULL,
  `nama_plg_blk` varchar(50) NOT NULL,
  `alamat_plg_blk` varchar(50) NOT NULL,
  `nohp_plg_blk` varchar(20) NOT NULL,
  `jk_plg_blk` varchar(20) NOT NULL,
  `namaperusahaan_plg_blk` varchar(50) NOT NULL,
  `tglupdate_plg_blk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_pelanggan_blacklist`
--

INSERT INTO `tb_pelanggan_blacklist` (`id_plg_blacklist`, `nama_plg_blk`, `alamat_plg_blk`, `nohp_plg_blk`, `jk_plg_blk`, `namaperusahaan_plg_blk`, `tglupdate_plg_blk`) VALUES
(2, 'Engkoh', 'Sungai Jingah', '089561921342', 'Laki-Laki', 'PT RTR', '2023-04-11'),
(3, 'ami', 'jl. sjingah', '0821312341087', 'Perempuan', 'pt amanah', '2023-04-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_serv_genset`
--

CREATE TABLE `tb_serv_genset` (
  `id_perbaikan_gst` int(11) NOT NULL,
  `id_genset` int(11) NOT NULL,
  `id_sparepart` int(11) NOT NULL,
  `jenis_perbaikan` varchar(255) NOT NULL,
  `tgl_perbaikan` date NOT NULL,
  `ket_perbaikan` varchar(255) NOT NULL,
  `biaya_perbaikan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_serv_genset`
--

INSERT INTO `tb_serv_genset` (`id_perbaikan_gst`, `id_genset`, `id_sparepart`, `jenis_perbaikan`, `tgl_perbaikan`, `ket_perbaikan`, `biaya_perbaikan`) VALUES
(1, 2, 1, 'ganti filter solar', '2023-04-12', 'Selesai Diperbaiki', '0'),
(2, 3, 2, 'Ganti Oli', '2023-04-14', 'Selesai Diperbaiki', '250000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sparepart`
--

CREATE TABLE `tb_sparepart` (
  `id_sparepart` int(11) NOT NULL,
  `nama_sparepart` varchar(255) NOT NULL,
  `tanggal_beli` date NOT NULL,
  `tempat_beli` varchar(255) NOT NULL,
  `stok` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_sparepart`
--

INSERT INTO `tb_sparepart` (`id_sparepart`, `nama_sparepart`, `tanggal_beli`, `tempat_beli`, `stok`) VALUES
(1, 'Filter Oli Donaldson', '2023-03-14', 'Multi Filter', '3'),
(2, 'oli sx', '2023-03-16', 'Bengkel Yuno', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_unit_keluar`
--

CREATE TABLE `tb_unit_keluar` (
  `id_u_keluar` int(11) NOT NULL,
  `id_transaksi` varchar(20) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `id_operator` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_genset` int(11) NOT NULL,
  `id_mobil` int(11) DEFAULT NULL,
  `tambahan` varchar(255) NOT NULL,
  `jumlah_hari` varchar(10) NOT NULL,
  `total` varchar(50) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_unit_keluar`
--

INSERT INTO `tb_unit_keluar` (`id_u_keluar`, `id_transaksi`, `tanggal_keluar`, `tanggal_masuk`, `lokasi`, `id_operator`, `id_pelanggan`, `id_genset`, `id_mobil`, `tambahan`, `jumlah_hari`, `total`, `status`) VALUES
(6, 'GE-Jun0519', '2023-06-06', '2023-06-09', 'Binuang', 2, 4, 2, 1, 'kabel', '3', '3000000', 0),
(7, 'GE-Jun9018', '2023-06-13', '2023-06-15', 'Banjarbaru', 2, 5, 3, 1, 'Box Panel', '2', '1500000', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_unit_masuk`
--

CREATE TABLE `tb_unit_masuk` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(20) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `id_operator` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_genset` int(11) NOT NULL,
  `id_mobil` int(11) DEFAULT NULL,
  `tambahan` varchar(255) NOT NULL,
  `jumlah_hari` varchar(10) NOT NULL,
  `total` varchar(50) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_unit_masuk`
--

INSERT INTO `tb_unit_masuk` (`id`, `id_transaksi`, `tanggal_keluar`, `tanggal_masuk`, `lokasi`, `id_operator`, `id_pelanggan`, `id_genset`, `id_mobil`, `tambahan`, `jumlah_hari`, `total`, `status`) VALUES
(1, 'GE-Jun0519', '2023-06-06', '2023-06-09', 'Binuang', 2, 4, 2, 1, 'kabel', '3', '3000000', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `last_login` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `nama`, `password`, `role`, `last_login`) VALUES
(1, 'admin', 'admin1', '$2y$10$eZ1p2/8Ne1va1k5JQDqz2eJQ68mEDCV/LPYrIIDa0GtORa9KGkez2', 0, '14-06-2023 8:31'),
(32, 'bos', 'Bos Jaka', '$2y$10$R4e0tMDfAU.8nz41SxIIhOQ1J5.itOq.sbA8YEAUzKJOSTVUJnV/m', 1, '26-04-2023 11:25'),
(33, 'aril', 'Teknik', '$2y$10$bX/22YuDFyiEtVzcX17ofujConoU4Rgl/KmrFBzKqU2E7RaAqgLIO', 2, '26-04-2023 11:23');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_avatar`
--
ALTER TABLE `tb_avatar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_genset`
--
ALTER TABLE `tb_genset`
  ADD PRIMARY KEY (`id_genset`);

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
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `tb_pelanggan_blacklist`
--
ALTER TABLE `tb_pelanggan_blacklist`
  ADD PRIMARY KEY (`id_plg_blacklist`);

--
-- Indeks untuk tabel `tb_serv_genset`
--
ALTER TABLE `tb_serv_genset`
  ADD PRIMARY KEY (`id_perbaikan_gst`),
  ADD KEY `id_sparepart` (`id_sparepart`),
  ADD KEY `id_genset` (`id_genset`);

--
-- Indeks untuk tabel `tb_sparepart`
--
ALTER TABLE `tb_sparepart`
  ADD PRIMARY KEY (`id_sparepart`);

--
-- Indeks untuk tabel `tb_unit_keluar`
--
ALTER TABLE `tb_unit_keluar`
  ADD PRIMARY KEY (`id_u_keluar`),
  ADD KEY `id_operator` (`id_operator`,`id_pelanggan`,`id_genset`,`id_mobil`),
  ADD KEY `id_mobil` (`id_mobil`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_genset` (`id_genset`);

--
-- Indeks untuk tabel `tb_unit_masuk`
--
ALTER TABLE `tb_unit_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_operator` (`id_operator`,`id_pelanggan`,`id_genset`,`id_mobil`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_avatar`
--
ALTER TABLE `tb_avatar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_genset`
--
ALTER TABLE `tb_genset`
  MODIFY `id_genset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_mobil`
--
ALTER TABLE `tb_mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_operator`
--
ALTER TABLE `tb_operator`
  MODIFY `id_operator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_pelanggan_blacklist`
--
ALTER TABLE `tb_pelanggan_blacklist`
  MODIFY `id_plg_blacklist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_serv_genset`
--
ALTER TABLE `tb_serv_genset`
  MODIFY `id_perbaikan_gst` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_sparepart`
--
ALTER TABLE `tb_sparepart`
  MODIFY `id_sparepart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_unit_keluar`
--
ALTER TABLE `tb_unit_keluar`
  MODIFY `id_u_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_unit_masuk`
--
ALTER TABLE `tb_unit_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_serv_genset`
--
ALTER TABLE `tb_serv_genset`
  ADD CONSTRAINT `tb_serv_genset_ibfk_1` FOREIGN KEY (`id_sparepart`) REFERENCES `tb_sparepart` (`id_sparepart`),
  ADD CONSTRAINT `tb_serv_genset_ibfk_2` FOREIGN KEY (`id_genset`) REFERENCES `tb_genset` (`id_genset`);

--
-- Ketidakleluasaan untuk tabel `tb_unit_keluar`
--
ALTER TABLE `tb_unit_keluar`
  ADD CONSTRAINT `tb_unit_keluar_ibfk_1` FOREIGN KEY (`id_mobil`) REFERENCES `tb_mobil` (`id_mobil`),
  ADD CONSTRAINT `tb_unit_keluar_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `tb_unit_keluar_ibfk_3` FOREIGN KEY (`id_operator`) REFERENCES `tb_operator` (`id_operator`),
  ADD CONSTRAINT `tb_unit_keluar_ibfk_4` FOREIGN KEY (`id_genset`) REFERENCES `tb_genset` (`id_genset`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
