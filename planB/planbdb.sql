-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 14 jun 2019 om 15:03
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
-- Tabelstructuur voor tabel `bestellingen`
--

CREATE TABLE `bestellingen` (
  `id` int(11) NOT NULL,
  `klantnaam` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefoon` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `afhaaldatum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelregel`
--

CREATE TABLE `bestelregel` (
  `id` int(11) NOT NULL,
  `bestelling_id` int(11) DEFAULT NULL,
  `aantal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(2, 'peer', 'zomer', 'peer.jpg');

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
(1, 1, 'appelkaneelijs', '16.00', 'schil 1 kilo appels en snij in partjes. Leg de appels een halve dag in kaneel met suiker. Kook daarna de appels tot moes. Meng 150 ml room en 400 ml melk door de uitgelekte appels en laat afkoelen. Zet het mengsel in de vriezer en roer elk half uur.'),
(2, 1, 'test', '1.00', '3');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:json_array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `roles`) VALUES
(1, 'hanneke', '$2y$12$oA8Z.Nqd2j/5NgeLcQCQH.Io4rzWyjTgpbZG./ZHFVcQElAna.322', '[\"ROLE_USER\"]'),
(2, 'ijsmaker', '$2y$12$Bv2dtkPMphxH6Jhh.nne7Oy3Iuic//k8QhWmzPlerHKGUu8xpiqya', '[\"ROLE_IJSMAKER\"]');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `bestelregel`
--
ALTER TABLE `bestelregel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8D814692A2E63037` (`bestelling_id`);

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
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1483A5E9F85E0677` (`username`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `bestelregel`
--
ALTER TABLE `bestelregel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `fruit`
--
ALTER TABLE `fruit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `recepten`
--
ALTER TABLE `recepten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bestelregel`
--
ALTER TABLE `bestelregel`
  ADD CONSTRAINT `FK_8D814692A2E63037` FOREIGN KEY (`bestelling_id`) REFERENCES `bestellingen` (`id`);

--
-- Beperkingen voor tabel `recepten`
--
ALTER TABLE `recepten`
  ADD CONSTRAINT `FK_72C1CA2BAC115F0` FOREIGN KEY (`fruit_id`) REFERENCES `fruit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
