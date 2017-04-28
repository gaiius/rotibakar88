-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 10 Jan 2017 pada 16.06
-- Versi Server: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `resto`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE IF NOT EXISTS `akun` (
  `id_akun` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(5) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` varchar(25) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_akun`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id_akun`, `username`, `password`, `level`, `status`) VALUES
(3, 'P0001', '202cb962ac59075b964b07152d234b70', 'USER', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi`
--

CREATE TABLE IF NOT EXISTS `informasi` (
  `id_informasi` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `subject` varchar(30) NOT NULL,
  `pesan` text NOT NULL,
  `aktif` int(11) NOT NULL,
  `id_pegawai` varchar(5) NOT NULL,
  PRIMARY KEY (`id_informasi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `informasi`
--

INSERT INTO `informasi` (`id_informasi`, `tanggal`, `subject`, `pesan`, `aktif`, `id_pegawai`) VALUES
(1, '2017-01-04 15:40:03', 'SISTEM ERROR', 'TELAH TERJADI SISTEM ERROR UNTUK SEMENTARA WAKTU INI !!!', 1, 'P0001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(30) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'KASIR'),
(2, 'MANAGER'),
(3, 'KOKI'),
(4, 'PELAYAN'),
(5, 'CLEANING');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(60) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(2, 'MAKANAN'),
(3, 'MINUMAN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `meja`
--

CREATE TABLE IF NOT EXISTS `meja` (
  `id_meja` int(11) NOT NULL AUTO_INCREMENT,
  `nama_meja` varchar(30) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_meja`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data untuk tabel `meja`
--

INSERT INTO `meja` (`id_meja`, `nama_meja`, `status`) VALUES
(1, 'MEJA 1', 0),
(2, 'MEJA 2', 0),
(3, 'MEJA 3', 0),
(4, 'MEJA 4', 0),
(5, 'MEJA 5', 0),
(6, 'MEJA 6', 0),
(7, 'MEJA 7', 0),
(8, 'MEJA 8', 0),
(9, 'MEJA 9', 0),
(10, 'MEJA 10', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id_pegawai` varchar(5) NOT NULL,
  `nama_pegawai` varchar(30) NOT NULL,
  `jk` varchar(9) NOT NULL,
  `alamat` text NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `aktif` int(11) NOT NULL,
  PRIMARY KEY (`id_pegawai`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `jk`, `alamat`, `id_jabatan`, `aktif`) VALUES
('P0001', 'RENDI', 'LAKI-LAKI', 'DS. KADU JAYA CURUG TANGERANG', 3, 1),
('P0002', 'MUHLISON', 'LAKI-LAKI', 'DS. TALAGA. CIKUPA TANGERANG', 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE IF NOT EXISTS `pemesanan` (
  `id_pemesanan` varchar(11) NOT NULL,
  `nama_pemesan` varchar(30) NOT NULL,
  `id_meja` int(11) NOT NULL,
  `bayar` decimal(10,0) NOT NULL,
  `id_pegawai` varchar(5) NOT NULL,
  `cash` decimal(10,0) NOT NULL,
  `cashback` decimal(10,0) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_pemesanan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `nama_pemesan`, `id_meja`, `bayar`, `id_pegawai`, `cash`, `cashback`, `status`) VALUES
('TR000000001', 'YHA', 2, '45000', 'P0001', '0', '0', 3),
('TR000000002', 'YU', 5, '538000', 'P0001', '0', '0', 3),
('TR000000003', 'ANWAR', 4, '15000', 'P0001', '0', '0', 3),
('TR000000004', 'NES', 1, '30000', 'P0001', '0', '0', 3),
('TR000000005', 'YHA', 2, '15000', 'P0001', '0', '0', 3),
('TR000000006', 'UYY', 1, '15000', 'P0001', '20000', '0', 3),
('TR000000007', 'YULIA', 2, '15000', 'P0001', '20000', '5000', 3),
('TR000000008', '435', 1, '20000', 'P0001', '20000', '10000', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan_detail`
--

CREATE TABLE IF NOT EXISTS `pemesanan_detail` (
  `nomor` int(11) NOT NULL AUTO_INCREMENT,
  `id_pemesanan` varchar(11) NOT NULL,
  `id_produk` varchar(5) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data untuk tabel `pemesanan_detail`
--

INSERT INTO `pemesanan_detail` (`nomor`, `id_pemesanan`, `id_produk`, `qty`) VALUES
(1, 'TR000000001', 'R0012', 1),
(2, 'TR000000001', 'R0001', 2),
(8, 'TR000000002', 'R0012', 8),
(9, 'TR000000002', 'R0013', 8),
(10, 'TR000000002', 'R0014', 8),
(11, 'TR000000002', 'R0015', 5),
(12, 'TR000000002', 'R0016', 2),
(13, 'TR000000003', 'R0012', 1),
(14, 'TR000000004', 'R0012', 2),
(15, 'TR000000005', 'R0012', 1),
(16, 'TR000000006', 'R0012', 1),
(17, 'TR000000007', 'R0012', 1),
(18, 'TR000000008', 'R0021', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` varchar(5) NOT NULL,
  `nama_produk` varchar(60) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `aktif` int(11) NOT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `id_kategori`, `aktif`) VALUES
('R0001', 'JUICE ALPUKAT', '15000', 3, 1),
('R0002', 'JUICE MANGGA', '15000', 3, 1),
('R0003', 'JUICE MELON', '15000', 3, 1),
('R0004', 'JUICE STROBERI', '15000', 3, 1),
('R0005', 'TEH MANIS DINGIN / HANGAT', '8000', 3, 1),
('R0006', 'TEH TAWAR DINGIN / HANGAT', '5000', 3, 1),
('R0007', 'AQUA BOTOL', '3500', 3, 1),
('R0008', 'JERUK DINGIN / HANGAT', '6000', 3, 1),
('R0009', 'TEH BOTOL SOSRO', '7000', 3, 1),
('R0010', 'FANTA', '7000', 3, 1),
('R0011', 'SPRITE', '7000', 3, 1),
('R0012', 'NASI GORENG BIASA', '15000', 2, 1),
('R0013', 'NASI GORENG SPESIAL', '18000', 2, 1),
('R0014', 'NASI GORENG SEAFOOD', '18000', 2, 1),
('R0015', 'AYAM RICA RICA', '20000', 2, 1),
('R0016', 'AYAM GORENG', '15000', 2, 1),
('R0017', 'AYAM BAKAR', '15000', 2, 1),
('R0018', 'BEBEK GORENG', '20000', 2, 1),
('R0019', 'KENTANG GORENG', '10000', 2, 1),
('R0020', 'ROTI BAKAR', '20000', 2, 1),
('R0021', 'MIE GORENG', '10000', 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `resto`
--

CREATE TABLE IF NOT EXISTS `resto` (
  `id_resto` int(11) NOT NULL AUTO_INCREMENT,
  `nama_resto` varchar(60) NOT NULL,
  `alamat` text NOT NULL,
  `tentang` text NOT NULL,
  `nama_pemilik` varchar(30) NOT NULL,
  PRIMARY KEY (`id_resto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `resto`
--

INSERT INTO `resto` (`id_resto`, `nama_resto`, `alamat`, `tentang`, `nama_pemilik`) VALUES
(1, 'ROTI BAKAR 88', 'CIKUPA - TANGERANG', 'CABANG CIKUPA', 'YULIA');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
