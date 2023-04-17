#
# TABLE STRUCTURE FOR: tb_avatar
#

DROP TABLE IF EXISTS `tb_avatar`;

CREATE TABLE `tb_avatar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username_user` varchar(50) NOT NULL,
  `nama_file` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `tb_avatar` (`id`, `username_user`, `nama_file`) VALUES (1, 'admin', 'jaka.jpg');
INSERT INTO `tb_avatar` (`id`, `username_user`, `nama_file`) VALUES (12, 'jakaja', 'nopic.png');
INSERT INTO `tb_avatar` (`id`, `username_user`, `nama_file`) VALUES (13, 'bos', 'nopic.png');
INSERT INTO `tb_avatar` (`id`, `username_user`, `nama_file`) VALUES (14, 'aril', 'nopic.png');


#
# TABLE STRUCTURE FOR: tb_genset
#

DROP TABLE IF EXISTS `tb_genset`;

CREATE TABLE `tb_genset` (
  `id_genset` int(11) NOT NULL AUTO_INCREMENT,
  `kode_genset` varchar(50) NOT NULL,
  `nama_genset` varchar(50) NOT NULL,
  `daya` varchar(50) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `stok_gd` varchar(50) NOT NULL,
  `stok_pj` varchar(50) NOT NULL,
  `gambar_genset` varchar(50) NOT NULL,
  PRIMARY KEY (`id_genset`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `tb_genset` (`id_genset`, `kode_genset`, `nama_genset`, `daya`, `harga`, `stok_gd`, `stok_pj`, `gambar_genset`) VALUES (2, '02', 'Hartech 45 P-02', '40', '1000000', '1', '0', 'ht45p-02.jpg');
INSERT INTO `tb_genset` (`id_genset`, `kode_genset`, `nama_genset`, `daya`, `harga`, `stok_gd`, `stok_pj`, `gambar_genset`) VALUES (3, '07', 'Denyo 25 ES-07', '20', '750000', '1', '0', 'denyo25es-07.jpg');


#
# TABLE STRUCTURE FOR: tb_mobil
#

DROP TABLE IF EXISTS `tb_mobil`;

CREATE TABLE `tb_mobil` (
  `id_mobil` int(11) NOT NULL AUTO_INCREMENT,
  `merek` varchar(100) NOT NULL,
  `tipe` varchar(100) NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `nopol` varchar(50) NOT NULL,
  `jenis_bbm` varchar(50) NOT NULL,
  `pajak` date NOT NULL,
  `stnk` date NOT NULL,
  `gambar_mobil` varchar(50) NOT NULL,
  PRIMARY KEY (`id_mobil`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `tb_mobil` (`id_mobil`, `merek`, `tipe`, `tahun`, `nopol`, `jenis_bbm`, `pajak`, `stnk`, `gambar_mobil`) VALUES (1, 'Daihatsu Gran Max Biru', 'Pickup', '2015', 'DA 1231 CJ', 'Bensin', '2023-05-18', '2024-05-18', 'daihatsu-gran-max-blu.jpg');


#
# TABLE STRUCTURE FOR: tb_operator
#

DROP TABLE IF EXISTS `tb_operator`;

CREATE TABLE `tb_operator` (
  `id_operator` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `status_op` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_operator`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `tb_operator` (`id_operator`, `nama`, `alamat`, `no_hp`, `status_op`) VALUES (1, 'Jaka Ja', 'Jl. sungai jingah', '0895619019104', 1);


#
# TABLE STRUCTURE FOR: tb_pelanggan
#

DROP TABLE IF EXISTS `tb_pelanggan`;

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `nama_perusahaan` varchar(50) NOT NULL,
  `tanggal_update` date NOT NULL,
  `ket_plg` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama`, `alamat`, `no_hp`, `jenis_kelamin`, `nama_perusahaan`, `tanggal_update`, `ket_plg`) VALUES (4, 'anonim', 'Jl. SungaAndaii', '0895619213134', 'Laki-Laki', 'PT Rahmat', '2023-04-11', 1);


#
# TABLE STRUCTURE FOR: tb_pelanggan_blacklist
#

DROP TABLE IF EXISTS `tb_pelanggan_blacklist`;

CREATE TABLE `tb_pelanggan_blacklist` (
  `id_plg_blacklist` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `nama_perusahaan` varchar(50) NOT NULL,
  `tanggal_update` date NOT NULL,
  PRIMARY KEY (`id_plg_blacklist`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `tb_pelanggan_blacklist` (`id_plg_blacklist`, `nama`, `alamat`, `no_hp`, `jenis_kelamin`, `nama_perusahaan`, `tanggal_update`) VALUES (2, 'Engkoh', 'Sungai Jingah', '089561921342', 'Laki-Laki', 'PT RTR', '2023-04-11');


#
# TABLE STRUCTURE FOR: tb_serv_genset
#

DROP TABLE IF EXISTS `tb_serv_genset`;

CREATE TABLE `tb_serv_genset` (
  `id_perbaikan_gst` int(11) NOT NULL AUTO_INCREMENT,
  `id_genset` int(11) NOT NULL,
  `id_sparepart` int(11) NOT NULL,
  `jenis_perbaikan` varchar(255) NOT NULL,
  `tgl_perbaikan` date NOT NULL,
  `ket_perbaikan` varchar(255) NOT NULL,
  `biaya_perbaikan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_perbaikan_gst`),
  KEY `id_sparepart` (`id_sparepart`),
  KEY `id_genset` (`id_genset`),
  CONSTRAINT `tb_serv_genset_ibfk_1` FOREIGN KEY (`id_sparepart`) REFERENCES `tb_sparepart` (`id_sparepart`),
  CONSTRAINT `tb_serv_genset_ibfk_2` FOREIGN KEY (`id_genset`) REFERENCES `tb_genset` (`id_genset`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `tb_serv_genset` (`id_perbaikan_gst`, `id_genset`, `id_sparepart`, `jenis_perbaikan`, `tgl_perbaikan`, `ket_perbaikan`, `biaya_perbaikan`) VALUES (1, 2, 1, 'ganti filter solar', '2023-04-12', 'Selesai Diperbaiki', '0');
INSERT INTO `tb_serv_genset` (`id_perbaikan_gst`, `id_genset`, `id_sparepart`, `jenis_perbaikan`, `tgl_perbaikan`, `ket_perbaikan`, `biaya_perbaikan`) VALUES (2, 3, 1, 'Ganti Oli', '2023-04-11', 'Selesai Diperbaiki', '250000');
INSERT INTO `tb_serv_genset` (`id_perbaikan_gst`, `id_genset`, `id_sparepart`, `jenis_perbaikan`, `tgl_perbaikan`, `ket_perbaikan`, `biaya_perbaikan`) VALUES (3, 2, 2, 'oli', '2023-04-10', 'Selesai Diperbaiki', '100000');


#
# TABLE STRUCTURE FOR: tb_sparepart
#

DROP TABLE IF EXISTS `tb_sparepart`;

CREATE TABLE `tb_sparepart` (
  `id_sparepart` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sparepart` varchar(255) NOT NULL,
  `tanggal_beli` date NOT NULL,
  `tempat_beli` varchar(255) NOT NULL,
  `stok` varchar(20) NOT NULL,
  PRIMARY KEY (`id_sparepart`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `tb_sparepart` (`id_sparepart`, `nama_sparepart`, `tanggal_beli`, `tempat_beli`, `stok`) VALUES (1, 'Filter Oli Donaldson', '2023-03-14', 'Multi Filter', '3');
INSERT INTO `tb_sparepart` (`id_sparepart`, `nama_sparepart`, `tanggal_beli`, `tempat_beli`, `stok`) VALUES (2, 'oli sx', '2023-03-16', 'Bengkel Yuno', '1');


#
# TABLE STRUCTURE FOR: tb_unit_keluar
#

DROP TABLE IF EXISTS `tb_unit_keluar`;

CREATE TABLE `tb_unit_keluar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(20) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `id_operator` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_genset` int(11) NOT NULL,
  `id_mobil` int(11) DEFAULT NULL,
  `tambahan` varchar(255) NOT NULL,
  `jumlah_hari` varchar(10) NOT NULL,
  `total` varchar(50) NOT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_operator` (`id_operator`,`id_pelanggan`,`id_genset`,`id_mobil`),
  KEY `id_mobil` (`id_mobil`),
  KEY `id_pelanggan` (`id_pelanggan`),
  KEY `id_genset` (`id_genset`),
  CONSTRAINT `tb_unit_keluar_ibfk_1` FOREIGN KEY (`id_mobil`) REFERENCES `tb_mobil` (`id_mobil`),
  CONSTRAINT `tb_unit_keluar_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_pelanggan` (`id_pelanggan`),
  CONSTRAINT `tb_unit_keluar_ibfk_3` FOREIGN KEY (`id_operator`) REFERENCES `tb_operator` (`id_operator`),
  CONSTRAINT `tb_unit_keluar_ibfk_4` FOREIGN KEY (`id_genset`) REFERENCES `tb_genset` (`id_genset`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

#
# TABLE STRUCTURE FOR: tb_unit_masuk
#

DROP TABLE IF EXISTS `tb_unit_masuk`;

CREATE TABLE `tb_unit_masuk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(20) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `id_operator` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_genset` int(11) NOT NULL,
  `id_mobil` int(11) DEFAULT NULL,
  `tambahan` varchar(255) NOT NULL,
  `jumlah_hari` varchar(10) NOT NULL,
  `total` varchar(50) NOT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_operator` (`id_operator`,`id_pelanggan`,`id_genset`,`id_mobil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

#
# TABLE STRUCTURE FOR: tb_user
#

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `last_login` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `tb_user` (`id`, `username`, `nama`, `password`, `role`, `last_login`) VALUES (1, 'admin', 'admin1', '$2y$10$/TIhUCTyJV0mBGwMcbDmSOgG7KgFgnucybRnPq1L.xhA3wxfqxfgO', 0, '17-04-2023 19:30');
INSERT INTO `tb_user` (`id`, `username`, `nama`, `password`, `role`, `last_login`) VALUES (31, 'jakaja', 'Jaka', '$2y$10$BKPTzEWnptxgS63pLJh8UeCEG2POxhVqpL297bC3w6fEeOWF7QPw6', 0, '13-04-2023 9:56');
INSERT INTO `tb_user` (`id`, `username`, `nama`, `password`, `role`, `last_login`) VALUES (32, 'bos', 'Bos Jaka', '$2y$10$R4e0tMDfAU.8nz41SxIIhOQ1J5.itOq.sbA8YEAUzKJOSTVUJnV/m', 1, '13-04-2023 9:57');
INSERT INTO `tb_user` (`id`, `username`, `nama`, `password`, `role`, `last_login`) VALUES (33, 'aril', 'Teknik', '$2y$10$bX/22YuDFyiEtVzcX17ofujConoU4Rgl/KmrFBzKqU2E7RaAqgLIO', 2, '13-04-2023 9:58');


