-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 22 mei 2019 om 12:14
-- Serverversie: 10.1.28-MariaDB
-- PHP-versie: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `planbdb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `fruit`
--

CREATE TABLE `fruit` (
  `id` int(11) NOT NULL,
  `naam` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `seizoen` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `afbeelding` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `fruit`
--

INSERT INTO `fruit` (`id`, `naam`, `seizoen`, `afbeelding`) VALUES
(1, 'appel', 'zomer', 'appel.jpg'),
(2, 'abrikoos', 'zomer', 'abrikoos.jpg'),
(3, 'banaan', 'alle', 'banaan.jpg'),
(5, 'druif', 'herfst', 'druif.jpg'),
(6, 'kruisbes', 'zomer', 'kruisbes.jpg'),
(7, 'aardbei', 'zomer', 'aardbei.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `recepten`
--

CREATE TABLE `recepten` (
  `id` int(11) NOT NULL,
  `fruit_id` int(11) DEFAULT NULL,
  `naam` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kostenPerLiter` decimal(5,2) NOT NULL,
  `bereidingswijze` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `recepten`
--

INSERT INTO `recepten` (`id`, `fruit_id`, `naam`, `kostenPerLiter`, `bereidingswijze`) VALUES
(2, 6, 'kruisbessenijs', '14.50', 'Maak 1 kilo kruisbessen schoon. Kook deze met 100 g suiker en 100 ml sinaasappelsap gedurende 15 minuten. Meng room door de saus als deze is afgekoeld. Roeren tot een dichte massa is ontstaan. Bewaar in de koeling.'),
(3, 3, 'bananenijs', '17.90', '');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `fruit`
--
ALTER TABLE `fruit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_A00BD29766871D1E` (`afbeelding`);

--
-- Indexen voor tabel `recepten`
--
ALTER TABLE `recepten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_72C1CA2BAC115F0` (`fruit_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `fruit`
--
ALTER TABLE `fruit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `recepten`
--
ALTER TABLE `recepten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `recepten`
--
ALTER TABLE `recepten`
  ADD CONSTRAINT `FK_72C1CA2BAC115F0` FOREIGN KEY (`fruit_id`) REFERENCES `fruit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
