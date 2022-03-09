-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Már 09. 06:25
-- Kiszolgáló verziója: 10.4.11-MariaDB
-- PHP verzió: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `jl`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `carlog`
--

CREATE TABLE `carlog` (
  `carlogID` int(10) NOT NULL,
  `carID` int(10) NOT NULL,
  `event_date` datetime NOT NULL,
  `logtypeID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `carlog`
--

INSERT INTO `carlog` (`carlogID`, `carID`, `event_date`, `logtypeID`) VALUES
(1, 5, '2022-03-05 22:06:42', 7),
(2, 4, '2022-03-05 22:06:43', 7),
(3, 4, '2022-03-05 22:06:45', 6),
(4, 5, '2022-03-05 22:06:46', 6),
(5, 3, '2022-03-06 14:21:27', 7),
(6, 2, '2022-03-07 05:51:48', 7),
(7, 2, '2022-03-07 05:51:51', 6);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cars`
--

CREATE TABLE `cars` (
  `carID` int(10) NOT NULL,
  `brand` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `lpn` varchar(10) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `license` char(1) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `freecar` tinyint(1) NOT NULL,
  `activeCar` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `cars`
--

INSERT INTO `cars` (`carID`, `brand`, `type`, `lpn`, `license`, `freecar`, `activeCar`) VALUES
(1, 'KIA', 'Ceed', 'SDE-249', 'B', 0, 1),
(2, 'Ford', 'Focus', 'HTR-623', 'B', 0, 1),
(3, 'Lada', 'Samara', 'ANU-834', 'C', 1, 0),
(4, 'Ford', '67', 'SKG-391', 'B', 1, 1),
(5, 'Opel', 'Corsa', 'DFT-876', 'B', 0, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `logincode`
--

CREATE TABLE `logincode` (
  `id` int(10) NOT NULL,
  `ecode` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `logincode`
--

INSERT INTO `logincode` (`id`, `ecode`) VALUES
(1, 297029);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `logs`
--

CREATE TABLE `logs` (
  `logID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `date` datetime NOT NULL,
  `logtypeID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `logs`
--

INSERT INTO `logs` (`logID`, `userID`, `date`, `logtypeID`) VALUES
(1, 1, '2022-03-05 13:25:51', 1),
(2, 1, '2022-03-05 13:25:53', 2),
(3, 2, '2022-03-05 13:25:58', 1),
(4, 2, '2022-03-05 13:25:59', 2),
(5, 4, '2022-03-05 13:26:05', 1),
(6, 4, '2022-03-05 13:26:06', 2),
(7, 3, '2022-03-05 13:26:12', 1),
(8, 3, '2022-03-05 13:54:50', 2),
(9, 1, '2022-03-05 13:54:59', 1),
(10, 1, '2022-03-05 13:55:29', 3),
(11, 1, '2022-03-05 13:55:47', 2),
(12, 1, '2022-03-05 13:55:52', 1),
(13, 1, '2022-03-05 13:56:01', 3),
(14, 1, '2022-03-05 14:14:55', 2),
(15, 2, '2022-03-05 14:16:53', 4),
(16, 2, '2022-03-05 14:46:42', 5),
(17, 2, '2022-03-05 14:47:19', 1),
(18, 2, '2022-03-05 14:47:29', 3),
(19, 2, '2022-03-05 15:20:01', 2),
(20, 4, '2022-03-05 15:20:06', 5),
(21, 4, '2022-03-05 15:20:12', 1),
(22, 4, '2022-03-05 15:20:15', 2),
(23, 1, '2022-03-05 16:17:01', 1),
(24, 5, '2022-03-05 22:07:42', 2),
(25, 1, '2022-03-05 22:07:46', 2),
(26, 5, '2022-03-06 09:55:26', 1),
(27, 5, '2022-03-06 16:17:57', 2),
(28, 1, '2022-03-06 16:18:08', 4),
(29, 1, '2022-03-06 16:19:57', 4),
(30, 1, '2022-03-06 16:20:21', 1),
(31, 1, '2022-03-06 16:20:30', 3),
(32, 1, '2022-03-06 16:20:34', 2),
(33, 5, '2022-03-06 16:20:38', 1),
(34, 5, '2022-03-06 19:09:09', 2),
(35, 5, '2022-03-07 05:49:54', 1),
(36, 1, '2022-03-07 06:02:07', 1),
(37, 1, '2022-03-07 06:03:58', 2),
(38, 2, '2022-03-07 06:05:09', 1),
(39, 2, '2022-03-07 06:05:40', 2),
(40, 1, '2022-03-07 06:05:45', 1),
(41, 1, '2022-03-07 06:29:59', 2),
(42, 5, '2022-03-07 06:30:04', 2),
(43, 1, '2022-03-08 21:10:23', 1),
(44, 1, '2022-03-08 21:13:43', 2),
(45, 5, '2022-03-08 21:13:50', 1),
(46, 5, '2022-03-08 21:27:34', 2);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `logtype`
--

CREATE TABLE `logtype` (
  `logtypeID` int(10) NOT NULL,
  `logtypename` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `logtype`
--

INSERT INTO `logtype` (`logtypeID`, `logtypename`) VALUES
(1, 'Belépés'),
(2, 'Kilépés'),
(3, 'Jelszómódosítás'),
(4, 'Új jelszó kérése'),
(5, 'Hibás belépési kísérlet'),
(6, 'Aktiválás'),
(7, 'Inaktiválás'),
(8, 'Felhasználó módosítása');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `messagelog`
--

CREATE TABLE `messagelog` (
  `messlogID` int(10) NOT NULL,
  `senderID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `sent_date` datetime NOT NULL,
  `subject` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `m_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `messagelog`
--

INSERT INTO `messagelog` (`messlogID`, `senderID`, `userID`, `sent_date`, `subject`, `m_status`) VALUES
(1, 5, 1, '2022-03-05 16:13:46', 'Próba', 1),
(2, 5, 1, '2022-03-05 16:18:25', 'Javítás értesítő', 1),
(3, 5, 1, '2022-03-05 16:18:37', 'Engedélyezés', 1),
(4, 5, 1, '2022-03-05 16:18:45', 'Elutasítás', 1),
(5, 5, 1, '2022-03-05 17:08:20', 'próba', 1),
(6, 1, 5, '2022-03-05 17:08:35', 'adminproba', 1),
(7, 5, 1, '2022-03-05 20:46:03', 'Javítás értesítő', 1),
(8, 2, 1, '2022-03-07 06:05:25', 'Próba', 1),
(9, 5, 1, '2022-03-07 06:19:02', 'Engedélyezés', 1),
(10, 5, 1, '2022-03-07 06:19:10', 'Elutasítás', 1),
(11, 5, 1, '2022-03-07 06:19:16', 'Elutasítás', 1),
(12, 1, 5, '2022-03-08 21:13:27', 'ffh', 1),
(13, 5, 1, '2022-03-08 21:14:59', 'Javítás értesítő', 1),
(14, 5, 1, '2022-03-08 21:15:31', 'Elutasítás', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `messages`
--

CREATE TABLE `messages` (
  `messID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `senderID` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `sent_date` datetime NOT NULL,
  `subject` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_hungarian_ci NOT NULL,
  `viewed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `messages`
--

INSERT INTO `messages` (`messID`, `userID`, `senderID`, `sent_date`, `subject`, `message`, `viewed`) VALUES
(5, 1, '5', '2022-03-05 16:18:45', 'Elutasítás', 'Elutasítom a 2. számú járműfoglalást.</br> Az elutasítás oka: Csak mert nem', 1),
(6, 1, '5', '2022-03-05 17:08:20', 'próba', 'próba ', 1),
(8, 1, '5', '2022-03-05 20:46:03', 'Javítás értesítő', 'A 15. számon bejelentett hibát javítottuk!', 1),
(9, 1, '2', '2022-03-07 06:05:25', 'Próba', 'Próba üzenet', 1),
(10, 1, '5', '2022-03-07 06:19:02', 'Engedélyezés', 'Engedélyezem a 3. számú járműfoglalást', 1),
(11, 1, '5', '2022-03-07 06:19:10', 'Elutasítás', 'Elutasítom a 4. számú járműfoglalást.</br> Az elutasítás oka:  mmgkkjkfj', 1),
(12, 1, '5', '2022-03-07 06:19:16', 'Elutasítás', 'Elutasítom a 5. számú járműfoglalást.</br> Az elutasítás oka: nvbnbvn', 1),
(13, 5, '1', '2022-03-08 21:13:27', 'ffh', 'gfhgfhg', 1),
(14, 1, '5', '2022-03-08 21:14:59', 'Javítás értesítő', 'A 16. számon bejelentett hibát javítottuk!', 0),
(15, 1, '5', '2022-03-08 21:15:31', 'Elutasítás', 'Elutasítom a 7. számú járműfoglalást.</br> Az elutasítás oka: ghghfgh', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `reservation`
--

CREATE TABLE `reservation` (
  `resID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `carID` int(10) NOT NULL,
  `res_day` date NOT NULL,
  `res_typeID` char(1) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `travel_dest` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `res_status` char(1) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `reservation`
--

INSERT INTO `reservation` (`resID`, `userID`, `carID`, `res_day`, `res_typeID`, `travel_dest`, `res_status`) VALUES
(1, 1, 1, '2022-03-06', '2', 'Miskolc', '1'),
(2, 1, 1, '2022-03-15', '3', 'Encs', '2'),
(3, 1, 2, '2022-03-08', '3', 'Encs', '1'),
(4, 1, 5, '2022-03-08', '1', 'Encs', '2'),
(5, 1, 2, '2022-03-08', '2', 'Miskolc', '2'),
(6, 1, 4, '2022-03-09', '3', 'Encs', '1'),
(7, 1, 5, '2022-03-25', '3', 'Encs', '2'),
(8, 1, 4, '2022-03-26', '1', 'Encs', '1');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `restype`
--

CREATE TABLE `restype` (
  `restypeID` int(10) NOT NULL,
  `restypename` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `restype`
--

INSERT INTO `restype` (`restypeID`, `restypename`) VALUES
(1, '6:00 - 12:00'),
(2, '12:00 - 18:00'),
(3, '6:00 - 18:00');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `service`
--

CREATE TABLE `service` (
  `serviceID` int(10) NOT NULL,
  `carID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `problem` longtext COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date_not` datetime NOT NULL,
  `date_rep` datetime NOT NULL,
  `repair` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `service`
--

INSERT INTO `service` (`serviceID`, `carID`, `userID`, `problem`, `date_not`, `date_rep`, `repair`) VALUES
(1, 2, 2, 'jjhgjhgjhg', '2022-03-01 06:11:17', '2022-03-01 06:14:06', 1),
(2, 4, 2, 'jjhgjhgjhg', '2022-03-01 06:11:23', '2022-03-01 06:13:48', 1),
(3, 3, 1, 'Izzócsere', '2022-03-01 06:11:47', '2022-03-01 06:13:45', 1),
(4, 4, 1, 'Nem fog a fék.', '2022-03-01 06:11:51', '2022-03-01 06:13:53', 1),
(5, 3, 2, 'Izzócsere', '2022-03-03 20:09:59', '2022-03-03 20:10:49', 1),
(6, 5, 2, 'Izzócsere', '2022-03-03 20:14:19', '2022-03-03 20:14:31', 1),
(7, 3, 2, 'Izzócsere', '2022-03-03 20:15:50', '2022-03-03 20:16:05', 1),
(8, 2, 2, 'Izzócsere', '2022-03-03 20:16:40', '2022-03-03 20:17:26', 1),
(9, 2, 2, 'Teszt', '2022-03-03 20:19:35', '2022-03-03 20:19:56', 1),
(10, 1, 1, 'Izzócsere', '2022-03-04 11:29:53', '2022-03-04 11:30:29', 1),
(11, 1, 1, 'Izzócsere', '2022-03-04 11:31:11', '2022-03-04 11:31:17', 1),
(12, 1, 1, 'Izzócsere', '2022-03-04 17:11:56', '2022-03-04 17:18:45', 1),
(13, 3, 1, 'A fék kicsit nehezen fog és csúszik a kuplung is.', '2022-03-04 20:45:10', '2022-03-04 20:49:02', 1),
(14, 1, 1, 'Izzócsere', '2022-03-05 16:17:27', '2022-03-05 16:18:25', 1),
(15, 5, 1, 'bvcbvcbvcvcb', '2022-03-05 20:45:43', '2022-03-05 20:46:03', 1),
(16, 1, 1, 'gdhgfhgjgf', '2022-03-08 21:13:11', '2022-03-08 21:14:59', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `userlog`
--

CREATE TABLE `userlog` (
  `userlogID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `telnumber` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `licence` char(1) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `event_date` datetime NOT NULL,
  `logtypeID` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `userlog`
--

INSERT INTO `userlog` (`userlogID`, `userID`, `name`, `email`, `telnumber`, `licence`, `event_date`, `logtypeID`) VALUES
(1, 6, 'Kovács Krisztián', 'as2@gt.com', '+36 20 123 4567', 'B', '2022-03-05 21:48:49', 8),
(2, 6, 'Kovács Krisztián', 'as@gt.com', '+36 20 123 4567', 'B', '2022-03-05 21:55:17', 8),
(3, 9, '', '', '', '', '2022-03-06 10:17:09', 6),
(4, 9, '', '', '', '', '2022-03-06 10:17:11', 7),
(5, 6, '', '', '', '', '2022-03-06 10:19:31', 7),
(6, 6, '', '', '', '', '2022-03-06 10:19:33', 6),
(7, 9, 'Valaki Valaki', 'hjzu@fg.com', '362', 'B', '2022-03-06 10:19:56', 8),
(8, 1, '', '', '', '', '2022-03-06 14:32:31', 7),
(9, 1, '', '', '', '', '2022-03-06 14:32:33', 6),
(10, 2, '', '', '', '', '2022-03-06 14:32:35', 7),
(11, 2, '', '', '', '', '2022-03-06 14:32:36', 6),
(12, 3, '', '', '', '', '2022-03-06 14:32:37', 7),
(13, 3, '', '', '', '', '2022-03-06 14:32:38', 6),
(14, 4, '', '', '', '', '2022-03-06 14:32:39', 7),
(15, 4, '', '', '', '', '2022-03-06 14:32:40', 6),
(16, 6, '', '', '', '', '2022-03-06 14:32:45', 7),
(17, 6, '', '', '', '', '2022-03-06 14:32:46', 6),
(18, 6, 'Kovács Krisztián', 'as2@gt.com', '+36 20 123 4567', 'B', '2022-03-06 14:57:05', 8),
(19, 6, 'Kovács Krisztián', 'as2@gt.com', '+36 20 123 4569', 'B', '2022-03-06 14:57:14', 8),
(20, 4, 'Nyitrai Ákos', 'csabi8114@gmail.com', '+36 30 457 8989', 'B', '2022-03-06 15:50:52', 8),
(21, 4, 'Nyitrai Ákos', 'akos@gmail.com', '+36 30 457 8989', 'B', '2022-03-06 15:51:16', 8),
(22, 4, 'Nyitrai Ákos', 'akos@gmail.com', '+36 30 457 8977', 'B', '2022-03-06 15:55:54', 8);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `userID` int(10) NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `telnumber` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `licence` char(1) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `activeUser` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `name`, `email`, `telnumber`, `licence`, `activeUser`) VALUES
(1, 'csabi', '$2y$10$t6NqWAP1CA0v2MI0R1E50e/5vlFRiMdyzi5KLZTs3CkaqX3T6xv/.', 'Dezső Csaba', 'csabi8114@gmail.com', '+36 20 327 2666', 'B', 1),
(2, 'patrik', '$2y$10$tRU15M2kZ3P5k0fp6/XePertPVsGgv4tln/B1pzEmPXBIhW94ls3q', 'Takács Patrik', 'dcsaba.pti@gmail.com', '+36 20 123 4567', 'C', 1),
(3, 'jozsef', '$2y$10$fmbLAkMjZNkw5gvq4bT4Mujs.PGRHpPrDEevPAS5h7gs5ssyc/iZO', 'Dezső József', 'gtr8107@gmail.com', '+36 20 500 0024', 'A', 1),
(4, 'akos', '$2y$10$I9WdDQwWPqH0LtA2MdoYiOU.djF6FuzYAD5iK.J6YSqlfbGHslesy', 'Nyitrai Ákos', 'akos@gmail.com', '+36 30 457 8977', 'B', 1),
(5, 'admin', '$2y$10$FWRfmhEX1yhs3KBTNDrHju6zpI/yxMMgpHEMRPdWJrussGGlqKNVi', 'Adminisztrátor', 'dobokoczka@gmail.com', '+36 20 344 0184', 'A', 1),
(6, 'krisz', '$2y$10$rG2U1lkBIzlwzRO.4Si6COPkaaKLJx/h9OvhSdbB9yxZJ7lbn3khq', 'Kovács Krisztián', 'as2@gt.com', '+36 20 123 4569', 'B', 1),
(9, 'valaki', '$2y$10$Q/Uo6GYtokPjWLDLAHPYxu8ha/rmmPkOtlLukYK1miYNlHq/Huye6', 'Valaki Valaki', 'hjzu@fg.com', '362', 'B', 0);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `carlog`
--
ALTER TABLE `carlog`
  ADD PRIMARY KEY (`carlogID`);

--
-- A tábla indexei `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`carID`);

--
-- A tábla indexei `logincode`
--
ALTER TABLE `logincode`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`logID`);

--
-- A tábla indexei `logtype`
--
ALTER TABLE `logtype`
  ADD PRIMARY KEY (`logtypeID`);

--
-- A tábla indexei `messagelog`
--
ALTER TABLE `messagelog`
  ADD PRIMARY KEY (`messlogID`);

--
-- A tábla indexei `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messID`);

--
-- A tábla indexei `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`resID`);

--
-- A tábla indexei `restype`
--
ALTER TABLE `restype`
  ADD PRIMARY KEY (`restypeID`);

--
-- A tábla indexei `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`serviceID`);

--
-- A tábla indexei `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`userlogID`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `carlog`
--
ALTER TABLE `carlog`
  MODIFY `carlogID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `cars`
--
ALTER TABLE `cars`
  MODIFY `carID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `logincode`
--
ALTER TABLE `logincode`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `logs`
--
ALTER TABLE `logs`
  MODIFY `logID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT a táblához `logtype`
--
ALTER TABLE `logtype`
  MODIFY `logtypeID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `messagelog`
--
ALTER TABLE `messagelog`
  MODIFY `messlogID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT a táblához `messages`
--
ALTER TABLE `messages`
  MODIFY `messID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT a táblához `reservation`
--
ALTER TABLE `reservation`
  MODIFY `resID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `restype`
--
ALTER TABLE `restype`
  MODIFY `restypeID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `service`
--
ALTER TABLE `service`
  MODIFY `serviceID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT a táblához `userlog`
--
ALTER TABLE `userlog`
  MODIFY `userlogID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
