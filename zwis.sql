SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `zwis` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `zwis` ;

-- -----------------------------------------------------
-- Table `zwis`.`Users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `users` (
  `id_user` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(64) NOT NULL ,
  `password` VARCHAR(64) NOT NULL ,
  `name` VARCHAR(32) NULL DEFAULT 'Anonymous' ,
  `surname` VARCHAR(32) NULL DEFAULT 'Anonymous' ,
  `registration_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `static_location` INT default NULL references `locations`,
  `photo` varchar(255) null,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  PRIMARY KEY (`id_user`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `zwis`.`Locations`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `locations` (
  `id_location` INT NOT NULL AUTO_INCREMENT,
  `id_user` INT NOT NULL ,
  `add_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latitude` FLOAT( 10, 7 )  NOT NULL,
  `longitude` FLOAT( 10, 7 )  NOT NULL,
  PRIMARY KEY (`id_location`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `zwis`.`Buildings_points`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `buildings_points` (
  `id_point` INT NOT NULL,
  `id_building` INT NOT NULL ,
  `latitude` FLOAT( 10, 7 )  NOT NULL,
  `longitude` FLOAT( 10, 7 )  NOT NULL,
  PRIMARY KEY (`id_point`,`id_building`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `zwis`.`Buildings`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `buildings` (
  `id_building` INT NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`id_building`))
ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `zwis`.`Univerity`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `university` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `established` int(4) NOT NULL,
  `students` int(5) NOT NULL,
  `home_page` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'http://www.',
  `is_public` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
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

-- -----------------------------------------------------
-- Table `zwis`.`faculty`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `faculty` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_uni` int(10) unsigned NOT NULL,
  `name` varchar(64) NOT NULL,
  `info` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB; 

-- -----------------------------------------------------
-- Table `zwis`.`field_of_study`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `field_of_study` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_faculty` int(10) unsigned NOT NULL,
  `name` varchar(64) NOT NULL,
  `info` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `zwis`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  `comment_content` text NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `zwis`.`posts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) unsigned NOT NULL,
  `post_content` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_com_date` datetime NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `zwis`.`messages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) unsigned NOT NULL,
  `sender_id` int(10) unsigned NOT NULL,
  `message_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message_content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
-- -----------------------------------------------------
-- Table `zwis`.`friends`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `friends` (
  `id_user` int(10) unsigned NOT NULL,
  `id_friend` int(10) unsigned NOT NULL
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `zwis`.`session`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS  `sessions` (
	session_id varchar(40) DEFAULT '0' NOT NULL,
	ip_address varchar(45) DEFAULT '0' NOT NULL,
	user_agent varchar(120) NOT NULL,
	last_activity int(10) unsigned DEFAULT 0 NOT NULL,
	user_data text NOT NULL,
	PRIMARY KEY (session_id),
	KEY `last_activity_idx` (`last_activity`)
);

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
