-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 02 2015 г., 00:25
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.4.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `cherrybase`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cashbox_change_requests`
--

CREATE TABLE IF NOT EXISTS `cashbox_change_requests` (
  `idcashbox_change_requests` int(11) NOT NULL AUTO_INCREMENT,
  `id_users` INT( 11 ) NOT NULL,
   `id_type` INT( 11 ) NOT NULL,
  `delta_cash` float NOT NULL,
  `reason` varchar(1500) NOT NULL,
  `isApproved` tinyint(4) NOT NULL DEFAULT '0',
  `approvedBy` tinyint(4) NOT NULL,
  `request_date` datetime NOT NULL,
  `approval_date` datetime NOT NULL,
  PRIMARY KEY (`idcashbox_change_requests`),
    KEY `FK_cashbox_user` (`id_users`),
    KEY `FK_cashbox_type` (`id_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=130 ;

-- --------------------------------------------------------

--
-- Структура таблицы `cashbox_change_request_documents`
--

CREATE TABLE IF NOT EXISTS `cashbox_change_request_documents` (
  `idcashbox_change_request_documents` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(150) NOT NULL,
  `cashbox_change_requestid` int(11) NOT NULL,
  PRIMARY KEY (`idcashbox_change_request_documents`),
    KEY `FK_cashbox_id` (`cashbox_change_requestid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

ALTER TABLE `cashbox_change_requests`
  ADD CONSTRAINT `FK_cashbox_user` FOREIGN KEY (`id_users`) REFERENCES `tbl_user` (`id`)ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `cashbox_change_requests`
  ADD CONSTRAINT `FK_cashbox_type` FOREIGN KEY (`id_type`) REFERENCES `cashbox_type` (`id`)ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `cashbox_change_request_documents`
  ADD CONSTRAINT `FK_cashbox_id` FOREIGN KEY (`cashbox_change_requestid`) REFERENCES `cashbox_change_requests` (`idcashbox_change_requests`)ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
