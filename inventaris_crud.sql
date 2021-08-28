-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Agu 2021 pada 10.45
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris_crud`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `idBarangMasuk` int(11) NOT NULL,
  `kdBarang` varchar(50) NOT NULL,
  `nmBarang` varchar(50) NOT NULL,
  `merkBarang` varchar(50) NOT NULL,
  `idKategori` int(11) NOT NULL,
  `tglPembelian` date NOT NULL,
  `jmlhBarang` int(11) NOT NULL,
  `tglTambah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`idBarangMasuk`, `kdBarang`, `nmBarang`, `merkBarang`, `idKategori`, `tglPembelian`, `jmlhBarang`, `tglTambah`) VALUES
(1, 'STNDR', 'Pulpen', 'Pulpen Standar', 1, '2021-08-11', 20, '2021-08-24 12:19:32'),
(2, 'KBLLAN', 'Kabel Lan', 'No Merk', 2, '2021-08-18', 2, '2021-08-24 12:20:28');

--
-- Trigger `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `editmasuk` BEFORE UPDATE ON `barang_masuk` FOR EACH ROW BEGIN
UPDATE stok_brg SET jmlhBarang = jmlhBarang - OLD.jmlhBarang WHERE kdBarang = OLD.kdBarang ;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `editmasuk2` AFTER UPDATE ON `barang_masuk` FOR EACH ROW BEGIN
INSERT into stok_brg SET kdBarang = NEW.kdBarang, jmlhBarang = NEW.jmlhBarang ON DUPLICATE KEY UPDATE jmlhBarang = jmlhBarang + NEW.jmlhBarang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapusmasuk` AFTER DELETE ON `barang_masuk` FOR EACH ROW BEGIN
UPDATE stok_brg SET jmlhBarang = jmlhBarang - OLD.jmlhBarang WHERE kdBarang = OLD.kdBarang ;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `masuk` AFTER INSERT ON `barang_masuk` FOR EACH ROW BEGIN
INSERT into stok_brg SET kdBarang = NEW.kdBarang, jmlhBarang = NEW.jmlhBarang ON DUPLICATE KEY UPDATE jmlhBarang = jmlhBarang + NEW.jmlhBarang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `idKategori` int(11) NOT NULL,
  `nmKategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`idKategori`, `nmKategori`) VALUES
(1, 'Alat Tulis'),
(2, 'Peralatan Lab');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penempatan_brg`
--

CREATE TABLE `penempatan_brg` (
  `idPenempatanBrg` int(11) NOT NULL,
  `kdBarang` varchar(6) NOT NULL,
  `jmlhBarang` int(11) NOT NULL,
  `kdRuang` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruang`
--

CREATE TABLE `ruang` (
  `idRuang` int(11) NOT NULL,
  `kdRuang` varchar(6) NOT NULL,
  `nmRuang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ruang`
--

INSERT INTO `ruang` (`idRuang`, `kdRuang`, `nmRuang`) VALUES
(1, 'SRV01', 'Ruang Server 1'),
(2, 'RPL01', 'Lab RPL 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_brg`
--

CREATE TABLE `stok_brg` (
  `kdBarang` varchar(50) NOT NULL,
  `jmlhBarang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stok_brg`
--

INSERT INTO `stok_brg` (`kdBarang`, `jmlhBarang`) VALUES
('KBLLAN', 2),
('STNDR', 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `kdUser` varchar(12) NOT NULL,
  `nmUser` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`idUser`, `kdUser`, `nmUser`) VALUES
(1, '0001', 'Samy Sulaiman');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`idBarangMasuk`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idKategori`);

--
-- Indeks untuk tabel `penempatan_brg`
--
ALTER TABLE `penempatan_brg`
  ADD PRIMARY KEY (`idPenempatanBrg`);

--
-- Indeks untuk tabel `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`idRuang`);

--
-- Indeks untuk tabel `stok_brg`
--
ALTER TABLE `stok_brg`
  ADD PRIMARY KEY (`kdBarang`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `idBarangMasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idKategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `penempatan_brg`
--
ALTER TABLE `penempatan_brg`
  MODIFY `idPenempatanBrg` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ruang`
--
ALTER TABLE `ruang`
  MODIFY `idRuang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
