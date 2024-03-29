-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas wygenerowania: 30 Lis 2012, 10:11
-- Wersja serwera: 5.5.27
-- Wersja PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `zwis`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zwis.comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  `comment_content` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `id_user`, `comment_content`, `comment_date`) VALUES
(1, 1, 1, 'Pierwszy komentarz do pierwszego posta', '2012-11-30 08:42:37');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id_user` int(10) unsigned NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) unsigned NOT NULL,
  `sender_id` int(10) unsigned NOT NULL,
  `message_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message_content` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) unsigned NOT NULL,
  `post_content` text COLLATE utf8_unicode_ci NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_com_date` datetime NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `posts`
--

INSERT INTO `posts` (`post_id`, `id_user`, `post_content`, `post_date`, `last_com_date`) VALUES
(1, 1, 'Pierwszy post', '2012-11-30 08:42:23', '2012-11-30 09:42:37');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `university`
--

CREATE TABLE IF NOT EXISTS `university` (
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `established` int(4) NOT NULL,
  `students` int(5) NOT NULL,
  `home_page` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'http://www.',
  `is_public` tinyint(1) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `university`
--

INSERT INTO `university` (`name`, `address`, `established`, `students`, `home_page`, `is_public`) VALUES
('Akademia Muzyczna im. Karola Lipińskiego', 'pl. Jana Pawła II 2 50-043 Wrocław', 1948, 624, 'http://www.amuz.wroc.pl/', 1),
('Akademia Sztuk Pięknych im. Eugeniusza Gepperta we Wrocławiu', 'pl. Polski 3/4, 50-156 Wrocław', 1946, 915, 'http://www.asp.wroc.pl/', 1),
('Akademia Wychowania Fizycznego we Wrocławiu ', 'al. Ignacego Jana Paderewskiego 35 51-612 Wrocław', 1946, 3885, 'http://www.awf.wroc.pl/pl/index', 1),
('Dolnośląska Szkoła Wyższa', 'ul. Wagonowa 9 53-609 Wrocław', 1997, 8500, 'http://www.dsw.edu.pl/', 0),
('Dolnośląska Wyższa Szkoła Służb Publicznych "Asesor" we Wrocławiu', 'ul. Dawida 9/11 50-527 Wrocław', 2000, 0, 'http://www.asesor.pl/', 0),
('Ewangelikalna Wyższa Szkoła Teologiczna we Wrocławiu', 'ul. św. Jadwigi 12 50-266 Wrocław', 0, 0, 'http://www.ewst.pl/', 0),
('Kolegium Nauczycielskie im. Grzegorza Piramowicza ', 'ul. Trzebnicka 42, 50 - 230 Wrocław', 1992, 400, 'http://www.kolegiumnauczycielskie.pl/', 1),
('Kolegium Pracowników Służb Społecznych', 'ul. Trzebnicka 42, 50-230 Wrocław', 0, 0, 'http://www.kpss.com.pl/', 1),
('Metropolitalne Wyższe Seminarium Duchowne we Wrocławiu', 'pl. Katedralny 14 50-329 Wrocław', 1947, 0, 'http://www.seminarium.wroclaw.pl/site/', 0),
('Międzynarodowa Wyższa Szkoła Logistyki i Transportu we Wrocławiu', 'Sołtysowicka 19b 51-168 Wrocław', 2001, 1200, 'http://www.mwsl.eu/', 0),
('Nauczycielskie Kolegium Języków Obcych', 'ul. Skarbowców 8a 53-025 Wrocław', 1990, 410, 'http://www.nkjo.wroc.pl/', 1),
('Niepubliczna Wyższa Szkoła Medyczna', '50-340 Wrocław ul. Nowowiejska 69', 2006, 0, 'http://www.nwsm.pl/', 0),
('Politechnika Wrocławska', 'wybrzeże Stanisława Wyspiańskiego 27 50-370 Wrocław', 1910, 33775, 'http://www.pwr.wroc.pl/index.dhtml', 1),
('Szkoła Wyższa Rzemiosł Artystycznych i Zarządzania we Wrocławiu', 'pl. św. Macieja 21 50-257 Wrocław', 2002, 0, 'http://www.swraiz.pl/', 0),
('Uniwersytet Ekonomiczny', 'ul. Komandorska 118/120, 53-345 Wrocław', 1947, 18174, 'http://www.ue.wroc.pl/', 1),
('Uniwersytet Medyczny im. Piastów Śląskich', 'Wybrzeże Ludwika Pasteura 1, 50-367 ', 1811, 5915, 'http://www.umed.wroc.pl/', 1),
('Uniwersytet Przyrodniczy', 'ul. C. K. Norwida 25/27 50-375 Wrocław', 1951, 10800, 'http://www.up.wroc.pl/', 1),
('Uniwersytet Wrocławski', 'pl. Uniwersytecki 1 50-137 Wrocław', 1702, 34621, 'http://www.uni.wroc.pl/', 1),
('Wrocławska Wyższa Szkoła Informatyki Stosowanej "HORYZONT" we Wrocławiu', 'ul. Słubicka 29-33 53-615 Wrocław', 2004, 0, 'http://www.horyzont.eu/', 0),
('Wyższa Szkoła Bankowa we Wrocławiu', 'ul. Fabryczna 29-31 53-609 Wrocław', 1998, 0, 'http://www.wsb.wroclaw.pl/', 0),
('Wyższa Szkoła Filologiczna we Wrocławiu', 'ul. Sienkiewicza 32 50-335 Wrocław', 2002, 2000, 'http://www.wsf.edu.pl/', 0),
('Wyższa Szkoła Fizjoterapii', 'ul. Kościuszki 4, 50-038 Wrocław', 0, 0, 'http://www.wsf.wroc.pl/', 0),
('Wyższa Szkoła Oficerska Wojsk Lądowych im. gen. Tadeusza Kościuszki', 'ul. Czajkowskiego 109 51-150 Wrocław', 2002, 0, 'http://www.wso.wroc.pl/', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci DEFAULT 'Anonymous',
  `surname` varchar(32) COLLATE utf8_unicode_ci DEFAULT 'Anonymous',
  `registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `name`, `surname`, `registration_date`, `photo`) VALUES
(1, 'radek.czerniak@gmail.com', 'f1fa30e9660fff452c6739f4294c5c688479736a', 'Radek', 'Czerniak', '2012-11-30 08:41:57', 'https://lh6.googleusercontent.com/-_PU6pw5tFIE/AAAAAAAAAAI/AAAAAAAAAAA/GUoG2cQugWc/photo.jpg'),
(2, 'asd@asd', 'f10e2821bbbea527ea02200352313bc059445190', 'Anonymous', 'Anonymous', '2012-11-30 09:00:57', NULL);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `fk_Locations_Users` FOREIGN KEY (`id_user`) REFERENCES `mydb`.`users` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
