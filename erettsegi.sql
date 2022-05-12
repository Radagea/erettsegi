-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2015. Okt 11. 21:49
-- Kiszolgáló verziója: 5.6.26
-- PHP verzió: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `erettsegi`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `evszam`
--

CREATE TABLE IF NOT EXISTS `evszam` (
  `id` int(11) NOT NULL,
  `evho` varchar(30) NOT NULL,
  `emeltszintu` varchar(30) NOT NULL,
  `feladatlap` varchar(40) NOT NULL,
  `forrasfajl` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `evszam`
--

INSERT INTO `evszam` (`id`, `evho`, `emeltszintu`, `feladatlap`, `forrasfajl`) VALUES
(40, '2014_MÃ¡jus', 'KÃ¶zÃ©p szintÅ± feladatlap', 'k_inf_14maj_fl (1).pdf', 'k_inffor_14maj_fl (1).zip');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `feladat`
--

CREATE TABLE IF NOT EXISTS `feladat` (
  `id` int(11) NOT NULL,
  `felveteliido` datetime NOT NULL,
  `hatarido` date NOT NULL,
  `ido` time NOT NULL,
  `feladattipusa` int(11) NOT NULL,
  `feladatlap` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `feladat`
--

INSERT INTO `feladat` (`id`, `felveteliido`, `hatarido`, `ido`, `feladattipusa`, `feladatlap`) VALUES
(24, '2015-10-11 21:45:17', '2015-10-12', '16:00:00', 2, 40);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `feladat_tipus`
--

CREATE TABLE IF NOT EXISTS `feladat_tipus` (
  `id` int(11) NOT NULL,
  `megnev` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `feladat_tipus`
--

INSERT INTO `feladat_tipus` (`id`, `megnev`) VALUES
(1, 'Word'),
(2, 'Excel'),
(3, 'Web'),
(4, 'Power Point');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE IF NOT EXISTS `felhasznalok` (
  `id` int(11) NOT NULL,
  `nev` varchar(40) NOT NULL,
  `azon` varchar(4) NOT NULL,
  `jelszo` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `jog` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `nev`, `azon`, `jelszo`, `email`, `jog`) VALUES
(21, 'KitalÃ¡lt TanÃ¡r', 'kita', '12345', 'kita@iskola.hu', 2),
(22, 'KitalÃ¡lt DiÃ¡k', 'kidi', '12345', 'kidi@iskola.hu', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `megoldasok`
--

CREATE TABLE IF NOT EXISTS `megoldasok` (
  `id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `feladat_id` int(11) NOT NULL,
  `fajlnev` varchar(50) NOT NULL,
  `megoldas` datetime NOT NULL,
  `megjegyzes` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `megoldasok`
--

INSERT INTO `megoldasok` (`id`, `login_id`, `feladat_id`, `fajlnev`, `megoldas`, `megjegyzes`) VALUES
(9, 22, 24, 'kidi_teszt.txt', '2015-10-11 21:45:43', '1,2,3,4 nemjÃ³'),
(10, 22, 24, 'kidi_teszt.txt', '2015-10-11 21:46:20', '1,2,3,4 nemjÃ³');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `evszam`
--
ALTER TABLE `evszam`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `feladat`
--
ALTER TABLE `feladat`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `feladat_tipus`
--
ALTER TABLE `feladat_tipus`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `megoldasok`
--
ALTER TABLE `megoldasok`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `evszam`
--
ALTER TABLE `evszam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT a táblához `feladat`
--
ALTER TABLE `feladat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT a táblához `feladat_tipus`
--
ALTER TABLE `feladat_tipus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT a táblához `megoldasok`
--
ALTER TABLE `megoldasok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
