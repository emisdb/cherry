-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 27 2015 г., 14:15
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `cherrydb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cancellation_reason`
--

CREATE TABLE IF NOT EXISTS `cancellation_reason` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `cancellation_reason`
--

INSERT INTO `cancellation_reason` (`id`, `name`, `value`) VALUES
(1, 'not enough people', NULL),
(2, 'weather', NULL);

ALTER TABLE  `seg_scheduled_tours` ADD  `cancelReason` INT( 11 ) NULL ,
ADD INDEX (  `cancelReason` ) ;
ALTER TABLE  `seg_scheduled_tours` ADD FOREIGN KEY (  `cancelReason` ) REFERENCES  `cherrydb`.`cancellation_reason` (
`id`
) ON DELETE SET NULL ON UPDATE CASCADE ;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
