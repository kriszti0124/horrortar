-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Jan 14. 15:51
-- Kiszolgáló verziója: 10.4.6-MariaDB
-- PHP verzió: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `horror`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ertekeles`
--

CREATE TABLE `ertekeles` (
  `eid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `eertekeles` int(1) NOT NULL,
  `ekomment` text COLLATE utf8_hungarian_ci NOT NULL,
  `eertekelesdatum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `filmek`
--

CREATE TABLE `filmek` (
  `fid` int(11) NOT NULL,
  `fcim` varchar(250) COLLATE utf8_hungarian_ci NOT NULL,
  `fmegjelenes` date NOT NULL,
  `fmufaj` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `fleiras` text COLLATE utf8_hungarian_ci NOT NULL,
  `ffeltoltdatum` datetime NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `karakterek`
--

CREATE TABLE `karakterek` (
  `kid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `knev` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `krang` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `karakter_rangsorolas`
--

CREATE TABLE `karakter_rangsorolas` (
  `rid` int(11) NOT NULL,
  `kid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `krank` int(2) NOT NULL,
  `kranksordatum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `login`
--

CREATE TABLE `login` (
  `lid` int(11) NOT NULL,
  `ldatum` datetime NOT NULL,
  `lip` varchar(48) COLLATE utf8_hungarian_ci NOT NULL,
  `lsession` varchar(8) COLLATE utf8_hungarian_ci NOT NULL,
  `luid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `naplo`
--

CREATE TABLE `naplo` (
  `nid` int(11) NOT NULL,
  `ndatum` datetime NOT NULL,
  `nip` varchar(48) COLLATE utf8_hungarian_ci NOT NULL,
  `nsession` varchar(8) COLLATE utf8_hungarian_ci NOT NULL,
  `nuid` int(11) NOT NULL,
  `nurl` varchar(250) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `naplo`
--

INSERT INTO `naplo` (`nid`, `ndatum`, `nip`, `nsession`, `nuid`, `nurl`) VALUES
(1, '0000-00-00 00:00:00', '', '', 0, ''),
(2, '2024-10-21 12:12:08', '', 'ajqva6o5', 0, '/petra/login/?p=login'),
(3, '2024-10-21 12:14:10', '::1', 'ajqva6o5', 0, '/petra/login/?p=login'),
(4, '0000-00-00 00:00:00', '', '', 0, ''),
(5, '2024-10-21 12:29:50', '::1', 'ajqva6o5', 0, '/petra/login/'),
(6, '2024-10-21 12:29:51', '::1', 'ajqva6o5', 0, '/petra/login/?p=login'),
(7, '2024-10-21 12:30:00', '::1', 'ajqva6o5', 0, '/petra/login/login_ir.php'),
(8, '2024-10-21 12:30:02', '::1', 'ajqva6o5', 0, '/petra/login/'),
(9, '2024-10-21 12:30:04', '::1', 'ajqva6o5', 0, '/petra/login/?p=login'),
(10, '2024-10-21 12:30:08', '::1', 'ajqva6o5', 0, '/petra/login/?p=regisztracio'),
(11, '2024-10-21 12:30:30', '::1', 'ajqva6o5', 0, '/petra/login/?p=login'),
(12, '2024-10-21 12:30:37', '::1', 'ajqva6o5', 0, '/petra/login/login_ir.php'),
(13, '2024-10-21 12:30:37', '::1', 'ajqva6o5', 15, '/petra/login/'),
(14, '2024-10-24 09:56:05', '::1', 'i19fbv36', 0, '/petra/login/'),
(15, '2024-10-24 09:56:14', '::1', 'i19fbv36', 0, '/petra/login/?p=login'),
(16, '2024-10-24 10:22:23', '::1', 'i19fbv36', 0, ''),
(17, '2024-10-24 10:22:23', '::1', 'i19fbv36', 15, '/petra/login/'),
(18, '2024-10-24 10:22:25', '::1', 'i19fbv36', 15, '/petra/login/?p=adatlapom'),
(19, '2024-10-24 10:26:23', '::1', 'i19fbv36', 15, '/petra/login/?p=adatlapom'),
(20, '2024-10-24 10:27:15', '::1', 'i19fbv36', 15, '/petra/login/?p=adatlapom'),
(21, '2024-10-24 10:27:16', '::1', 'i19fbv36', 15, '/petra/login/?p=adatlapom'),
(22, '2024-10-24 10:29:14', '::1', 'i19fbv36', 15, '/petra/login/?p=adatlapom'),
(23, '2024-10-24 10:31:18', '::1', 'i19fbv36', 15, '/petra/login/?p=adatlapom'),
(24, '2024-10-24 11:23:10', '::1', 'i19fbv36', 15, '/petra/login/?p=adatlapom'),
(25, '2024-10-24 11:23:11', '::1', 'i19fbv36', 15, '/petra/login/?p=adatlapom'),
(26, '2024-10-24 11:23:11', '::1', 'i19fbv36', 15, '/petra/login/?p=adatlapom'),
(27, '2024-10-24 11:23:12', '::1', 'i19fbv36', 0, '/petra/login/'),
(28, '2024-10-24 11:23:14', '::1', 'i19fbv36', 0, '/petra/login/?p=login'),
(29, '2024-10-24 11:24:01', '::1', 'i19fbv36', 0, '/petra/login/?p=login'),
(30, '2024-11-07 10:01:47', '::1', 'f2bn7db1', 0, '/petra/login/'),
(31, '2024-11-07 10:03:10', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(32, '2024-11-07 10:15:43', '::1', 'f2bn7db1', 0, '/petra/login/'),
(33, '2024-11-07 10:15:47', '::1', 'f2bn7db1', 0, '/petra/login/'),
(34, '2024-11-07 10:29:09', '::1', 'f2bn7db1', 0, '/petra/login/'),
(35, '2024-11-07 10:32:40', '::1', 'f2bn7db1', 0, '/petra/login/'),
(36, '2024-11-07 10:54:04', '::1', 'f2bn7db1', 0, '/petra/login/'),
(37, '2024-11-07 10:57:00', '::1', 'f2bn7db1', 0, '/petra/login/'),
(38, '2024-11-07 10:57:02', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(39, '2024-11-07 10:57:44', '::1', 'f2bn7db1', 0, '/petra/login/'),
(40, '2024-11-07 10:57:49', '::1', 'f2bn7db1', 0, '/petra/login/'),
(41, '2024-11-07 10:57:51', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(42, '2024-11-07 10:58:08', '::1', 'f2bn7db1', 0, '/petra/login/?p=regisztracio'),
(43, '2024-11-07 10:58:11', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(44, '2024-11-07 10:58:16', '::1', 'f2bn7db1', 0, '/petra/login/?p=regisztracio'),
(45, '2024-11-07 10:58:18', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(46, '2024-11-07 10:59:36', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(47, '2024-11-07 10:59:40', '::1', 'f2bn7db1', 0, '/petra/login/?p=regisztracio'),
(48, '2024-11-07 10:59:43', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(49, '2024-11-07 11:00:10', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(50, '2024-11-07 11:00:10', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(51, '2024-11-07 11:00:45', '::1', 'f2bn7db1', 0, '/petra/login/?p=regisztracio'),
(52, '2024-11-07 11:00:48', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(53, '2024-11-07 11:00:50', '::1', 'f2bn7db1', 0, '/petra/login/?p=regisztracio'),
(54, '2024-11-07 11:00:52', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(55, '2024-11-07 11:00:56', '::1', 'f2bn7db1', 0, '/petra/login/?p=regisztracio'),
(56, '2024-11-07 11:01:17', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(57, '2024-11-07 11:03:11', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(58, '2024-11-07 11:04:21', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(59, '2024-11-07 11:04:22', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(60, '2024-11-07 11:06:29', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(61, '2024-11-07 11:06:42', '::1', 'f2bn7db1', 0, ''),
(62, '2024-11-07 11:06:43', '::1', 'f2bn7db1', 0, '/petra/login/'),
(63, '2024-11-07 11:06:46', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(64, '2024-11-07 11:07:06', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(65, '2024-11-07 11:08:11', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(66, '2024-11-07 11:08:11', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(67, '2024-11-07 11:08:12', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(68, '2024-11-07 11:08:12', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(69, '2024-11-07 11:08:27', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(70, '2024-11-07 11:08:28', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(71, '2024-11-07 11:08:36', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(72, '2024-11-07 11:08:37', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(73, '2024-11-07 11:08:50', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(74, '2024-11-07 11:08:50', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(75, '2024-11-07 11:09:04', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(76, '2024-11-07 11:09:08', '::1', 'f2bn7db1', 0, '/petra/login/?p=regisztracio'),
(77, '2024-11-07 11:09:11', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(78, '2024-11-07 11:09:51', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(79, '2024-11-07 11:09:54', '::1', 'f2bn7db1', 0, '/petra/login/?p=regisztracio'),
(80, '2024-11-07 11:09:56', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(81, '2024-11-07 11:10:08', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(82, '2024-11-07 11:10:09', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(83, '2024-11-07 11:10:09', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(84, '2024-11-07 11:10:09', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(85, '2024-11-07 11:10:10', '::1', 'f2bn7db1', 0, ''),
(86, '2024-11-07 11:10:11', '::1', 'f2bn7db1', 0, '/petra/login/'),
(87, '2024-11-07 11:10:12', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(88, '2024-11-07 11:10:13', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(89, '2024-11-07 11:10:15', '::1', 'f2bn7db1', 0, '/petra/login/'),
(90, '2024-11-07 11:10:18', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(91, '2024-11-07 11:10:22', '::1', 'f2bn7db1', 0, '/petra/login/?p=regisztracio'),
(92, '2024-11-07 11:11:17', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(93, '2024-11-07 11:11:33', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(94, '2024-11-07 11:11:41', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(95, '2024-11-07 11:12:43', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(96, '2024-11-07 11:12:44', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(97, '2024-11-07 11:13:20', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(98, '2024-11-07 11:13:29', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(99, '2024-11-07 11:13:33', '::1', 'f2bn7db1', 0, ''),
(100, '2024-11-07 11:13:34', '::1', 'f2bn7db1', 0, '/petra/login/'),
(101, '2024-11-07 11:13:34', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(102, '2024-11-07 11:13:38', '::1', 'f2bn7db1', 0, '/petra/login/?p=regisztracio'),
(103, '2024-11-07 11:13:43', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(104, '2024-11-07 11:13:46', '::1', 'f2bn7db1', 0, '/petra/login/?p=regisztracio'),
(105, '2024-11-07 11:13:50', '::1', 'f2bn7db1', 0, '/petra/login/?p=login'),
(106, '2024-11-11 11:49:36', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(107, '2024-11-11 11:49:47', '::1', 'hi1q3nbi', 0, '/petra/login/?p=login'),
(108, '2024-11-11 11:49:54', '::1', 'hi1q3nbi', 0, '/petra/login/?p=regisztracio'),
(109, '2024-11-11 11:49:57', '::1', 'hi1q3nbi', 0, '/petra/login/?p=login'),
(110, '2024-11-11 11:50:15', '::1', 'hi1q3nbi', 0, '/petra/login/?p=login'),
(111, '2024-11-11 11:50:16', '::1', 'hi1q3nbi', 0, '/petra/login/?p=login'),
(112, '2024-11-11 11:50:28', '::1', 'hi1q3nbi', 0, ''),
(113, '2024-11-11 11:50:29', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(114, '2024-11-11 11:50:31', '::1', 'hi1q3nbi', 0, '/petra/login/?p=login'),
(115, '2024-11-11 11:50:32', '::1', 'hi1q3nbi', 0, '/petra/login/?p=regisztracio'),
(116, '2024-11-11 11:50:33', '::1', 'hi1q3nbi', 0, '/petra/login/?p=login'),
(117, '2024-11-11 12:50:08', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(118, '2024-11-11 12:50:34', '::1', 'hi1q3nbi', 0, '/petra/login/?p=login'),
(119, '2024-11-11 12:51:59', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(120, '2024-11-11 12:52:51', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(121, '2024-11-11 12:59:59', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(122, '2024-11-11 13:00:00', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(123, '2024-11-11 13:01:28', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(124, '2024-11-11 13:01:29', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(125, '2024-11-11 13:01:49', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(126, '2024-11-11 13:01:49', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(127, '2024-11-11 13:02:17', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(128, '2024-11-11 13:03:01', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(129, '2024-11-11 13:03:02', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(130, '2024-11-11 13:03:02', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(131, '2024-11-11 13:03:02', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(132, '2024-11-11 13:03:19', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(133, '2024-11-11 13:03:19', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(134, '2024-11-11 13:03:19', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(135, '2024-11-11 13:03:19', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(136, '2024-11-11 13:03:20', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(137, '2024-11-11 13:03:20', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(138, '2024-11-11 13:03:20', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(139, '2024-11-11 13:03:20', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(140, '2024-11-11 13:03:20', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(141, '2024-11-11 13:03:21', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(142, '2024-11-11 13:03:21', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(143, '2024-11-11 13:04:22', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(144, '2024-11-11 13:04:33', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(145, '2024-11-11 13:04:41', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(146, '2024-11-11 13:04:45', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(147, '2024-11-11 13:07:43', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(148, '2024-11-11 13:08:25', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(149, '2024-11-11 13:08:49', '::1', 'hi1q3nbi', 0, '/petra/login/'),
(150, '2024-11-20 12:56:15', '::1', 'u3ei6k16', 0, '/petra/login/'),
(151, '2024-11-21 10:08:05', '::1', 'nate24i2', 0, '/petra/login/'),
(152, '2024-11-21 10:08:24', '::1', 'nate24i2', 0, '/petra/login/index.php'),
(153, '2024-11-21 10:54:09', '::1', 'nate24i2', 0, '/petra/login/'),
(154, '2024-11-21 10:54:26', '::1', 'nate24i2', 0, '/petra/login/?p=login'),
(155, '2024-11-21 10:54:40', '::1', 'nate24i2', 0, ''),
(156, '2024-11-21 10:54:40', '::1', 'nate24i2', 15, '/petra/login/');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `umail` varchar(250) COLLATE utf8_hungarian_ci NOT NULL,
  `unick` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `upw` varchar(64) COLLATE utf8_hungarian_ci NOT NULL,
  `uszuldatum` date NOT NULL,
  `udatum` datetime NOT NULL,
  `uprofkep_nev` varchar(40) COLLATE utf8_hungarian_ci NOT NULL,
  `uprofkep_eredetinev` varchar(250) COLLATE utf8_hungarian_ci NOT NULL,
  `uip` varchar(48) COLLATE utf8_hungarian_ci NOT NULL,
  `usession` varchar(8) COLLATE utf8_hungarian_ci NOT NULL,
  `ustatusz` varchar(2) COLLATE utf8_hungarian_ci NOT NULL,
  `ukomment` text COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`uid`, `umail`, `unick`, `upw`, `uszuldatum`, `udatum`, `uprofkep_nev`, `uprofkep_eredetinev`, `uip`, `usession`, `ustatusz`, `ukomment`) VALUES
(1, '', '', '', '0000-00-00', '0000-00-00 00:00:00', '', '', '', '', '', ''),
(2, '$_POST[email]', '$_POST[becenev]', '$upw', '0000-00-00', '2024-09-30 13:09:57', '', '', '', '', '', ''),
(4, 'a@gmail.com', 'htjr', 'd41d8cd98f00b204e9800998ecf8427e', '2024-09-20', '2024-09-30 13:14:14', '', '', '', '', '', ''),
(5, 'a@gmail.com', 'htjr', 'd41d8cd98f00b204e9800998ecf8427e', '2024-09-20', '2024-09-30 13:17:45', '', '', '', '', '', ''),
(6, 'a@gmail.com', 'htjr', 'd41d8cd98f00b204e9800998ecf8427e', '2024-09-20', '2024-09-30 13:20:06', '', '', '', '', '', ''),
(7, 'a@gmail.com', 'htjr', 'd41d8cd98f00b204e9800998ecf8427e', '2024-09-20', '2024-09-30 13:33:03', '', '', '', '', '', ''),
(8, 'a@gmail.com', 'htjr', 'd41d8cd98f00b204e9800998ecf8427e', '2024-09-20', '2024-09-30 13:33:03', '', '', '', '', '', ''),
(9, 'a@gmail.com', 'htjr', 'd41d8cd98f00b204e9800998ecf8427e', '2024-09-20', '2024-09-30 13:33:03', '', '', '', '', '', ''),
(10, 'a@gmail.com', 'htjr', 'd41d8cd98f00b204e9800998ecf8427e', '2024-09-13', '2024-09-30 14:06:33', '', '', '', '', '', ''),
(11, 'a@gmail.com', 'htjr', 'd41d8cd98f00b204e9800998ecf8427e', '2024-10-24', '2024-10-02 13:17:51', '', '', '', '', '', ''),
(12, 'alma@gmail.com', 'alma', 'd41d8cd98f00b204e9800998ecf8427e', '2024-10-16', '2024-10-02 14:37:30', '', '', '', '', '', ''),
(13, 'almapaprika@gmail.com', 'almapaprika', 'd41d8cd98f00b204e9800998ecf8427e', '2024-10-17', '2024-10-02 14:40:26', '', '', '', '', '', ''),
(14, 'alma@gmail.com', 'alma', 'd41d8cd98f00b204e9800998ecf8427e', '2024-10-18', '2024-10-07 12:10:07', '', '', '', '', '', ''),
(15, 'valami@gmail.com', 'valami', '249d6c99eff6d0ef6c470e4254629323', '2024-10-17', '2024-10-07 12:21:56', '15_241014133939_wm1p5t6n32.png', 'Nike-Logo.png', '', '', '', ''),
(16, 'valami@gmail.com', 'VALAMI', '249d6c99eff6d0ef6c470e4254629323', '2024-10-19', '2024-10-21 12:30:19', '', '', '', '', '', ''),
(17, 'valami@gmail.com', 'VALAMI', '249d6c99eff6d0ef6c470e4254629323', '2024-10-19', '2024-10-21 12:30:22', '', '', '', '', '', ''),
(18, 'valami@gmail.com', 'VALAMI', '249d6c99eff6d0ef6c470e4254629323', '2024-10-19', '2024-10-21 12:30:22', '', '', '', '', '', ''),
(19, 'valami@gmail.com', 'VALAMI', '249d6c99eff6d0ef6c470e4254629323', '2024-10-19', '2024-10-21 12:30:22', '', '', '', '', '', ''),
(20, 'valami@gmail.com', 'VALAMI', '249d6c99eff6d0ef6c470e4254629323', '2024-10-19', '2024-10-21 12:30:23', '', '', '', '', '', ''),
(21, 'valami@gmail.com', 'VALAMI', '249d6c99eff6d0ef6c470e4254629323', '2024-10-19', '2024-10-21 12:30:24', '', '', '', '', '', ''),
(22, 'valami@gmail.com', 'VALAMI', '249d6c99eff6d0ef6c470e4254629323', '2024-10-19', '2024-10-21 12:30:24', '', '', '', '', '', ''),
(23, 'valami@gmail.com', 'VALAMI', '249d6c99eff6d0ef6c470e4254629323', '2024-10-19', '2024-10-21 12:30:24', '', '', '', '', '', ''),
(24, 'valami@gmail.com', 'VALAMI', '249d6c99eff6d0ef6c470e4254629323', '2024-10-19', '2024-10-21 12:30:24', '', '', '', '', '', ''),
(25, 'valami@gmail.com', 'VALAMI', '249d6c99eff6d0ef6c470e4254629323', '2024-10-19', '2024-10-21 12:30:24', '', '', '', '', '', ''),
(26, 'valami@gmail.com', 'VALAMI', '249d6c99eff6d0ef6c470e4254629323', '2024-10-19', '2024-10-21 12:30:24', '', '', '', '', '', ''),
(27, 'valami@gmail.com', 'VALAMI', '249d6c99eff6d0ef6c470e4254629323', '2024-10-19', '2024-10-21 12:30:25', '', '', '', '', '', ''),
(28, 'valami@gmail.com', 'VALAMI', '249d6c99eff6d0ef6c470e4254629323', '2024-10-19', '2024-10-21 12:30:25', '', '', '', '', '', ''),
(29, 'valami@gmail.com', 'VALAMI', '249d6c99eff6d0ef6c470e4254629323', '2024-10-19', '2024-10-21 12:30:25', '', '', '', '', '', ''),
(30, 'valami@gmail.com', 'VALAMI', '249d6c99eff6d0ef6c470e4254629323', '2024-10-19', '2024-10-21 12:30:25', '', '', '', '', '', ''),
(31, 'valami@gmail.com', 'VALAMI', '249d6c99eff6d0ef6c470e4254629323', '2024-10-19', '2024-10-21 12:30:25', '', '', '', '', '', ''),
(32, 'valami@gmail.com', 'VALAMI', '249d6c99eff6d0ef6c470e4254629323', '2024-10-19', '2024-10-21 12:30:26', '', '', '', '', '', ''),
(33, 'valami@gmail.com', 'VALAMI', '249d6c99eff6d0ef6c470e4254629323', '2024-10-19', '2024-10-21 12:30:26', '', '', '', '', '', ''),
(34, 'valami@gmail.com', 'VALAMI', '249d6c99eff6d0ef6c470e4254629323', '2024-10-19', '2024-10-21 12:30:26', '', '', '', '', '', ''),
(35, 'valami@gmail.com', 'VALAMI', '249d6c99eff6d0ef6c470e4254629323', '2024-10-19', '2024-10-21 12:30:26', '', '', '', '', '', ''),
(36, 'felhasznalo@gmail.com', 'felhasznalo', 'cd327a0dca2edc1d1f8514761cf6b58d', '2025-01-24', '2025-01-13 14:36:21', '', '', '', '', '', '');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `ertekeles`
--
ALTER TABLE `ertekeles`
  ADD PRIMARY KEY (`eid`);

--
-- A tábla indexei `filmek`
--
ALTER TABLE `filmek`
  ADD PRIMARY KEY (`fid`);

--
-- A tábla indexei `karakterek`
--
ALTER TABLE `karakterek`
  ADD PRIMARY KEY (`kid`);

--
-- A tábla indexei `karakter_rangsorolas`
--
ALTER TABLE `karakter_rangsorolas`
  ADD PRIMARY KEY (`rid`);

--
-- A tábla indexei `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`lid`);

--
-- A tábla indexei `naplo`
--
ALTER TABLE `naplo`
  ADD PRIMARY KEY (`nid`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `ertekeles`
--
ALTER TABLE `ertekeles`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `filmek`
--
ALTER TABLE `filmek`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `karakterek`
--
ALTER TABLE `karakterek`
  MODIFY `kid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `karakter_rangsorolas`
--
ALTER TABLE `karakter_rangsorolas`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `login`
--
ALTER TABLE `login`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `naplo`
--
ALTER TABLE `naplo`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
