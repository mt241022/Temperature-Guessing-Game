-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 01. Apr 2026 um 14:17
-- Server-Version: 10.11.14-MariaDB-0ubuntu0.24.04.1
-- PHP-Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `php_mt241022_21756`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sp_cities`
--

CREATE TABLE `sp_cities` (
  `id` int(11) NOT NULL,
  `city_name` varchar(100) NOT NULL,
  `country_code` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `sp_cities`
--

INSERT INTO `sp_cities` (`id`, `city_name`, `country_code`) VALUES
(1, 'Berlin', 'DE'),
(2, 'Vienna', 'AT'),
(3, 'Paris', 'FR'),
(4, 'Rome', 'IT'),
(5, 'Madrid', 'ES'),
(6, 'London', 'GB'),
(7, 'Amsterdam', 'NL'),
(8, 'Brussels', 'BE'),
(9, 'Lisbon', 'PT'),
(10, 'Stockholm', 'SE'),
(11, 'Oslo', 'NO'),
(12, 'Copenhagen', 'DK'),
(13, 'Helsinki', 'FI'),
(14, 'Warsaw', 'PL'),
(15, 'Prague', 'CZ'),
(16, 'Budapest', 'HU'),
(17, 'Bratislava', 'SK'),
(18, 'Ljubljana', 'SI'),
(19, 'Zagreb', 'HR'),
(20, 'Athens', 'GR'),
(21, 'Dublin', 'IE'),
(22, 'Luxembourg', 'LU'),
(23, 'Tallinn', 'EE'),
(24, 'Riga', 'LV'),
(25, 'Vilnius', 'LT'),
(26, 'Sofia', 'BG'),
(27, 'Bucharest', 'RO'),
(28, 'Reykjavik', 'IS'),
(29, 'Bern', 'CH'),
(30, 'Valletta', 'MT'),
(31, 'Nicosia', 'CY'),
(32, 'Andorra la Vella', 'AD'),
(33, 'Monaco', 'MC'),
(34, 'San Marino', 'SM'),
(35, 'Vatican City', 'VA'),
(36, 'Tirana', 'AL'),
(37, 'Sarajevo', 'BA'),
(38, 'Belgrade', 'RS'),
(39, 'Podgorica', 'ME'),
(40, 'Skopje', 'MK'),
(41, 'Chisinau', 'MD'),
(42, 'Kyiv', 'UA'),
(43, 'Minsk', 'BY');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sp_highscores`
--

CREATE TABLE `sp_highscores` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `date_played` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sp_users`
--

CREATE TABLE `sp_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `sp_cities`
--
ALTER TABLE `sp_cities`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `sp_highscores`
--
ALTER TABLE `sp_highscores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `sp_users`
--
ALTER TABLE `sp_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `sp_cities`
--
ALTER TABLE `sp_cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT für Tabelle `sp_highscores`
--
ALTER TABLE `sp_highscores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `sp_users`
--
ALTER TABLE `sp_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `sp_highscores`
--
ALTER TABLE `sp_highscores`
  ADD CONSTRAINT `sp_highscores_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sp_users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
