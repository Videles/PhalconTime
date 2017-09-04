-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 04 sep 2017 om 11:15
-- Serverversie: 5.7.14
-- PHP-versie: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phalcon-time`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `fax` varchar(24) DEFAULT NULL,
  `mobile` varchar(16) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `number_addition` varchar(11) DEFAULT NULL,
  `zipcode` varchar(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `coc` varchar(32) DEFAULT NULL,
  `vat` varchar(32) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `note` text,
  `active` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `client_contact`
--

CREATE TABLE `client_contact` (
  `id` int(11) NOT NULL,
  `client_contact_id` int(11) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `addition` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `phonetic` varchar(64) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `fax` varchar(16) DEFAULT NULL,
  `mobile` varchar(16) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `note` text,
  `active` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `price_type`
--

CREATE TABLE `price_type` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `price_type`
--

INSERT INTO `price_type` (`id`, `name`, `active`, `created_at`, `modified`) VALUES
(2, 'Fixed', 1, '2017-04-24 08:30:45', NULL),
(1, 'Hourly', 1, '2017-04-24 08:30:51', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `client_contact_id` int(11) NOT NULL,
  `client_purchase_number` varchar(64) DEFAULT NULL,
  `project_status_id` int(11) NOT NULL,
  `price_type_id` int(11) NOT NULL,
  `price_type_value` float DEFAULT NULL,
  `estimated_time` float DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `description` text,
  `delivery_date` varchar(16) DEFAULT NULL,
  `delivered` int(1) DEFAULT NULL,
  `delivered_date` varchar(16) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `project_status`
--

CREATE TABLE `project_status` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `project_status`
--

INSERT INTO `project_status` (`id`, `name`, `active`, `created_at`, `modified`) VALUES
(1, 'Open', 1, '2017-04-24 08:30:00', '2017-04-24 08:30:18'),
(2, 'Closed', 1, '2017-04-24 08:30:24', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `time_registration`
--

CREATE TABLE `time_registration` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `time_type_id` int(11) NOT NULL,
  `start_time` varchar(5) DEFAULT NULL,
  `end_time` varchar(5) DEFAULT NULL,
  `total_time` varchar(11) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `time_type`
--

CREATE TABLE `time_type` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `time_type`
--

INSERT INTO `time_type` (`id`, `name`, `active`, `created_at`, `modified`) VALUES
(1, 'Support', 1, '2017-04-24 08:33:25', '2017-04-24 08:33:39'),
(2, 'Maintenance', 1, '2017-04-24 08:33:59', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `token` varchar(128) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `last_logged` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `token`, `active`, `last_logged`, `modified`, `created_at`) VALUES
(1, 'Admin', 'example@example.com', NULL, '$2y$12$b2V6Q1RiTU5OZnNuODBxSuNRWifXh6kqDe/ScsprR9AveJ485/Zli', NULL, 1, NULL, NULL, '2017-09-04 10:53:06');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `client_contact`
--
ALTER TABLE `client_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `price_type`
--
ALTER TABLE `price_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `project_status`
--
ALTER TABLE `project_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `time_registration`
--
ALTER TABLE `time_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `time_type`
--
ALTER TABLE `time_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `client_contact`
--
ALTER TABLE `client_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `price_type`
--
ALTER TABLE `price_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `project_status`
--
ALTER TABLE `project_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `time_registration`
--
ALTER TABLE `time_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `time_type`
--
ALTER TABLE `time_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
