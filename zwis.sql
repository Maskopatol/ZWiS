-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas wygenerowania: 11 Sty 2013, 10:23
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
-- Struktura tabeli dla tabeli `buildings`
--

CREATE TABLE IF NOT EXISTS `buildings` (
  `id_building` int(11) NOT NULL AUTO_INCREMENT,
  `id_university` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_building`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `buildings`
--

INSERT INTO `buildings` (`id_building`, `id_university`, `name`, `desc`) VALUES
(1, 13, 'C-3', ' Elektronicy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `buildings_points`
--

CREATE TABLE IF NOT EXISTS `buildings_points` (
  `id_point` int(11) NOT NULL,
  `id_building` int(11) NOT NULL,
  `latitude` float(10,7) NOT NULL,
  `longitude` float(10,7) NOT NULL,
  PRIMARY KEY (`id_point`,`id_building`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `buildings_points`
--

INSERT INTO `buildings_points` (`id_point`, `id_building`, `latitude`, `longitude`) VALUES
(0, 1, 51.1092186, 17.0605011),
(1, 1, 51.1089821, 17.0602818),
(2, 1, 51.1089134, 17.0605278),
(3, 1, 51.1091461, 17.0607262);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
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
(1, 1, 1, '#1', '2013-01-11 02:45:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_uni` int(10) unsigned NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `faculty`
--

INSERT INTO `faculty` (`id`, `id_uni`, `name`, `info`) VALUES
(1, 13, 'W-01', 'Wydział Architektury'),
(2, 13, 'W-02', 'Wydział Budownictwa'),
(3, 13, 'W-03', 'Wydział Chemiczny'),
(4, 13, 'W-04', 'Wydział Elektroniki');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `field_of_study`
--

CREATE TABLE IF NOT EXISTS `field_of_study` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_faculty` int(10) unsigned NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `field_of_study`
--

INSERT INTO `field_of_study` (`id`, `id_faculty`, `name`, `info`) VALUES
(1, 4, 'AIR', 'Automatyka i Robotyka'),
(2, 4, 'EKA', 'Elektronika'),
(3, 4, 'INF', 'Informatka'),
(4, 4, 'TIN', 'Teleinformatyka'),
(5, 4, 'TEL', 'Telekomunikacja');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `id_user` int(10) unsigned NOT NULL,
  `id_friend` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `friends`
--

INSERT INTO `friends` (`id_user`, `id_friend`) VALUES
(3, 1),
(1, 3),
(2, 1),
(1, 2),
(1, 5),
(5, 1),
(2, 5),
(5, 2),
(2, 6),
(6, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id_location` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latitude` float(10,7) NOT NULL,
  `longitude` float(10,7) NOT NULL,
  PRIMARY KEY (`id_location`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `locations`
--

INSERT INTO `locations` (`id_location`, `id_user`, `add_date`, `latitude`, `longitude`) VALUES
(1, 2, '2013-01-04 23:18:13', 51.1062851, 17.1040459),
(2, 1, '2013-01-04 23:22:06', 51.1085892, 17.0790195),
(3, 2, '2013-01-04 23:22:32', 51.1062851, 17.1040459);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`id`, `id_user`, `sender_id`, `message_date`, `message_content`) VALUES
(1, 2, 1, '2013-01-10 18:43:22', 'Ty i nadawca wiadomości jesteście znajomymi.'),
(2, 3, 1, '2013-01-11 02:14:33', 'Ty i nadawca wiadomości jesteście znajomymi.'),
(3, 3, 5, '2013-01-11 04:30:33', 'Anonymous Anonymous chce dodać cię do listy swoich znajomych.\n		<form action="http://192.168.0.12/index.php/user/add_friend/5" method="post" accept-charset="utf-8"><input type="submit" value="Zatwierdź" ?>\n		<input name="redirect" type="hidden" value="<?= $this->uri->uri_string() ?>" />\n		</form>'),
(4, 1, 5, '2013-01-11 04:30:51', 'Anonymous Anonymous chce dodać cię do listy swoich znajomych.\n		<form action="http://192.168.0.12/index.php/user/add_friend/5" method="post" accept-charset="utf-8"><input type="submit" value="Zatwierdź" ?>\n		<input name="redirect" type="hidden" value="<?= $this->uri->uri_string() ?>" />\n		</form>'),
(5, 2, 5, '2013-01-11 04:32:54', 'Anonymous Anonymous chce dodać cię do listy swoich znajomych.\n		<form action="http://192.168.0.12/index.php/user/add_friend/5" method="post" accept-charset="utf-8"><input type="submit" value="Zatwierdź" ?>\n		<input name="redirect" type="hidden" value="<?= $this->uri->uri_string() ?>" />\n		</form>'),
(6, 2, 5, '2013-01-11 04:36:04', 'dupa sraka i chuj'),
(7, 2, 6, '2013-01-11 04:36:14', 'Ty i nadawca wiadomości jesteście znajomymi.');

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
(1, 3, 'huehuehue', '2013-01-11 02:44:20', '2013-01-11 03:45:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('760df1b9896c498af8b61c34f391d1ac', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.29 Safari/537.22', 1357895083, 'a:3:{s:9:"user_data";s:0:"";s:7:"user_id";s:1:"3";s:24:"flash:old:global-notices";a:1:{i:0;a:2:{s:4:"type";s:2:"ok";s:7:"message";s:24:"Sukces - kierunek dodany";}}}'),
('761ac3311ee4ab2bd5fda7e8501b679e', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.26 Safari/537.22', 1357881348, 'a:4:{s:9:"user_data";s:0:"";s:12:"google_token";s:863:"{"access_token":"ya29.AHES6ZSBCDLMQ-LH-jJqDZCiQazeVoxAg1tprgV5xEyyD3NE0d_d","token_type":"Bearer","expires_in":3600,"id_token":"eyJhbGciOiJSUzI1NiIsImtpZCI6IjBkZTZhMDc4YWIxYTRmMjQ0Y2QwZDI3M2RhNmJjMTA1Nzg3ZTFjOGYifQ.eyJpc3MiOiJhY2NvdW50cy5nb29nbGUuY29tIiwiZW1haWwiOiJyYWRlay5jemVybmlha0BnbWFpbC5jb20iLCJpZCI6IjExMTM1NjAxNzA5NjUxMTAxMjU3OSIsImNpZCI6IjQ4Njg5NjU5MDg2OC5hcHBzLmdvb2dsZXVzZXJjb250ZW50LmNvbSIsInRva2VuX2hhc2giOiJyZlk2LTdWTU9Wa2R0LUxLU3oydmVBIiwiYXVkIjoiNDg2ODk2NTkwODY4LmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwidmVyaWZpZWRfZW1haWwiOiJ0cnVlIiwiaWF0IjoxMzU3ODc4NjkyLCJleHAiOjEzNTc4ODI1OTJ9.kQKv52yXEfci-iJ0MoH1hiz25o47qDwtxn-nE39nBcK97Zk39760tyFgIs28kF0w-ZwFwtUMTUyyVQfE4lEVrQ8UJiWmQNeLhzWlcEx7XvtQfpqfQNdXKElCZ6EYUXXRiw1cNDWx3vacfoc7X0HDXjhJt8HuL5WOasEuBR5hh6Y","refresh_token":"1{{slash}}/UOydnQQbvhCy5eXyV7lyar396wSqE2Nj5K0l7h7Jhw8","created":1357878989}";s:7:"user_id";s:1:"2";s:18:"logged_with_google";b:1;}'),
('9e49808f17766e23696890554a7796e4', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.26 Safari/537.22', 1357877297, ''),
('a829ff8f7f1710a55dfda6fe152ee5a8', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.26 Safari/537.22', 1357881348, ''),
('ac8fb137befe844bf278cb6550fa5f93', '192.168.0.10', 'Mozilla/5.0 (Windows NT 6.1; rv:17.0) Gecko/20100101 Firefox/17.0', 1357878874, 'a:3:{s:9:"user_data";s:0:"";s:7:"user_id";s:1:"5";s:24:"flash:old:global-notices";a:1:{i:0;a:2:{s:4:"type";s:2:"ok";s:7:"message";s:29:"Wiadomość została wysłana";}}}'),
('c99e939693dda4c12b76ace2212fab1d', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.26 Safari/537.22', 1357894177, 'a:5:{s:9:"user_data";s:0:"";s:12:"google_token";s:858:"{"access_token":"ya29.AHES6ZQGmRskA3DIb0mmXjuBGSySY0zVo0O9yByFvRFGuY0","token_type":"Bearer","expires_in":3600,"id_token":"eyJhbGciOiJSUzI1NiIsImtpZCI6IjBkZTZhMDc4YWIxYTRmMjQ0Y2QwZDI3M2RhNmJjMTA1Nzg3ZTFjOGYifQ.eyJpc3MiOiJhY2NvdW50cy5nb29nbGUuY29tIiwiYXVkIjoiNDg2ODk2NTkwODY4LmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwidG9rZW5faGFzaCI6IjFEOWo3ODVGNFNnYU1XU2lTejM4RmciLCJ2ZXJpZmllZF9lbWFpbCI6InRydWUiLCJpZCI6IjExMTM1NjAxNzA5NjUxMTAxMjU3OSIsImNpZCI6IjQ4Njg5NjU5MDg2OC5hcHBzLmdvb2dsZXVzZXJjb250ZW50LmNvbSIsImVtYWlsIjoicmFkZWsuY3plcm5pYWtAZ21haWwuY29tIiwiaWF0IjoxMzU3ODkzODkwLCJleHAiOjEzNTc4OTc3OTB9.X-yv5pX-oy4uFuBdP6ERAXJZ9g03fQcWA1oTaJjYxjfnBUo15a0TCFzBACX7plwzxEP9EvFPZ6D-MA9tNzu_niEZzqS5Dj1x4oGFXoVS0QzpxDgd4-u-9ftI6_07CUUmAqI-6cNvlYHnTj_daTU35VcTUbCIz0x4FJ7IjL98zP0","refresh_token":"1{{slash}}/MWzeymom_9FWpd6r4_Z7OXcj5cEohS_M-7Pg8wFcP-M","created":1357894185}";s:7:"user_id";s:1:"2";s:18:"logged_with_google";b:1;s:24:"flash:old:global-notices";a:1:{i:0;a:2:{s:4:"type";s:2:"ok";s:7:"message";s:36:"Wystąpił bład - spróbuj ponownie";}}}'),
('e07a1ef659f2cac279f21956310557f0', '192.168.0.12', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.26 Safari/537.22', 1357878673, '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id_user` int(10) NOT NULL,
  `id_fos` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `students`
--

INSERT INTO `students` (`id_user`, `id_fos`) VALUES
(1, 3),
(1, 5),
(2, 3),
(3, 2),
(3, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `university`
--

CREATE TABLE IF NOT EXISTS `university` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `established` int(4) NOT NULL,
  `students` int(5) NOT NULL,
  `home_page` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'http://www.',
  `is_public` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Zrzut danych tabeli `university`
--

INSERT INTO `university` (`id`, `name`, `address`, `established`, `students`, `home_page`, `is_public`) VALUES
(1, 'Akademia Muzyczna im. Karola Lipińskiego', 'pl. Jana Pawła II 2 50-043 Wrocław', 1948, 624, 'http://www.amuz.wroc.pl/', 1),
(2, 'Akademia Sztuk Pięknych im. Eugeniusza Gepperta we Wrocławiu', 'pl. Polski 3/4, 50-156 Wrocław', 1946, 915, 'http://www.asp.wroc.pl/', 1),
(3, 'Akademia Wychowania Fizycznego we Wrocławiu ', 'al. Ignacego Jana Paderewskiego 35 51-612 Wrocław', 1946, 3885, 'http://www.awf.wroc.pl/pl/index', 1),
(4, 'Dolnośląska Szkoła Wyższa', 'ul. Wagonowa 9 53-609 Wrocław', 1997, 8500, 'http://www.dsw.edu.pl/', 0),
(5, 'Dolnośląska Wyższa Szkoła Służb Publicznych "Asesor" we Wrocławiu', 'ul. Dawida 9/11 50-527 Wrocław', 2000, 0, 'http://www.asesor.pl/', 0),
(6, 'Ewangelikalna Wyższa Szkoła Teologiczna we Wrocławiu', 'ul. św. Jadwigi 12 50-266 Wrocław', 0, 0, 'http://www.ewst.pl/', 0),
(7, 'Kolegium Nauczycielskie im. Grzegorza Piramowicza ', 'ul. Trzebnicka 42, 50 - 230 Wrocław', 1992, 400, 'http://www.kolegiumnauczycielskie.pl/', 1),
(8, 'Kolegium Pracowników Służb Społecznych', 'ul. Trzebnicka 42, 50-230 Wrocław', 0, 0, 'http://www.kpss.com.pl/', 1),
(9, 'Metropolitalne Wyższe Seminarium Duchowne we Wrocławiu', 'pl. Katedralny 14 50-329 Wrocław', 1947, 0, 'http://www.seminarium.wroclaw.pl/site/', 0),
(10, 'Międzynarodowa Wyższa Szkoła Logistyki i Transportu we Wrocławiu', 'Sołtysowicka 19b 51-168 Wrocław', 2001, 1200, 'http://www.mwsl.eu/', 0),
(11, 'Nauczycielskie Kolegium Języków Obcych', 'ul. Skarbowców 8a 53-025 Wrocław', 1990, 410, 'http://www.nkjo.wroc.pl/', 1),
(12, 'Niepubliczna Wyższa Szkoła Medyczna', '50-340 Wrocław ul. Nowowiejska 69', 2006, 0, 'http://www.nwsm.pl/', 0),
(13, 'Politechnika Wrocławska', 'wybrzeże Stanisława Wyspiańskiego 27 50-370 Wrocław', 1910, 33775, 'http://www.pwr.wroc.pl/index.dhtml', 1),
(14, 'Szkoła Wyższa Rzemiosł Artystycznych i Zarządzania we Wrocławiu', 'pl. św. Macieja 21 50-257 Wrocław', 2002, 0, 'http://www.swraiz.pl/', 0),
(15, 'Uniwersytet Ekonomiczny', 'ul. Komandorska 118/120, 53-345 Wrocław', 1947, 18174, 'http://www.ue.wroc.pl/', 1),
(16, 'Uniwersytet Medyczny im. Piastów Śląskich', 'Wybrzeże Ludwika Pasteura 1, 50-367 ', 1811, 5915, 'http://www.umed.wroc.pl/', 1),
(17, 'Uniwersytet Przyrodniczy', 'ul. C. K. Norwida 25/27 50-375 Wrocław', 1951, 10800, 'http://www.up.wroc.pl/', 1),
(18, 'Uniwersytet Wrocławski', 'pl. Uniwersytecki 1 50-137 Wrocław', 1702, 34621, 'http://www.uni.wroc.pl/', 1),
(19, 'Wrocławska Wyższa Szkoła Informatyki Stosowanej "HORYZONT" we Wrocławiu', 'ul. Słubicka 29-33 53-615 Wrocław', 2004, 0, 'http://www.horyzont.eu/', 0),
(20, 'Wyższa Szkoła Bankowa we Wrocławiu', 'ul. Fabryczna 29-31 53-609 Wrocław', 1998, 0, 'http://www.wsb.wroclaw.pl/', 0),
(21, 'Wyższa Szkoła Filologiczna we Wrocławiu', 'ul. Sienkiewicza 32 50-335 Wrocław', 2002, 2000, 'http://www.wsf.edu.pl/', 0),
(22, 'Wyższa Szkoła Fizjoterapii', 'ul. Kościuszki 4, 50-038 Wrocław', 0, 0, 'http://www.wsf.wroc.pl/', 0),
(23, 'Wyższa Szkoła Oficerska Wojsk Lądowych im. gen. Tadeusza Kościuszki', 'ul. Czajkowskiego 109 51-150 Wrocław', 2002, 0, 'http://www.wso.wroc.pl/', 1);

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
  `static_location` int(11) DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lecturer` int(1) DEFAULT '0',
  `admin` int(1) DEFAULT '0',
  `about` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `name`, `surname`, `registration_date`, `static_location`, `photo`, `lecturer`, `admin`, `about`) VALUES
(1, 'asd@asd.asd', 'f10e2821bbbea527ea02200352313bc059445190', 'Pan', 'Admin', '2013-01-04 23:17:37', 2, 'http://localhost/static/images/1.png', 0, 1, NULL),
(2, 'radek.czerniak@gmail.com', 'b1833219388e1bce975db5657d7c5eebf3706ec7', 'Radek', 'Czerniak', '2013-01-04 23:18:07', NULL, 'https://lh6.googleusercontent.com/-_PU6pw5tFIE/AAAAAAAAAAI/AAAAAAAAAAA/GUoG2cQugWc/photo.jpg', 0, 1, NULL),
(3, 'qq@ww.ee', '056eafe7cf52220de2df36845b8ed170c67e23e3', 'Albert', 'Brat', '2013-01-11 01:03:22', NULL, NULL, 0, 0, NULL),
(4, 'harry123132@o2.pl', '4347d0f8ba661234a8eadc005e2e1d1b646c9682', 'Anonymous', 'Anonymous', '2013-01-11 04:09:08', NULL, NULL, 0, 0, NULL),
(5, 'dupa@dupa.pl', '5fa339bbbb1eeaced3b52e54f44576aaf0d77d96', 'Anonymous', 'Anonymous', '2013-01-11 04:29:27', NULL, NULL, 0, 0, NULL),
(6, 'test@test.tes', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test', 'test', '2013-01-11 04:35:47', NULL, NULL, 0, 0, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
