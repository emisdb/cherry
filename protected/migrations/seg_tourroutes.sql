-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost:3306
-- Время создания: Мар 10 2016 г., 12:16
-- Версия сервера: 5.5.41-0ubuntu0.14.04.1
-- Версия PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cherrydb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `seg_tourroutes`
--

CREATE TABLE `seg_tourroutes` (
  `idseg_tourroutes` int(11) NOT NULL,
  `id_tour_categories` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `maintext` varchar(2000) DEFAULT NULL,
  `maintext_en` varchar(2000) DEFAULT NULL,
  `shorttext` varchar(100) DEFAULT NULL,
  `shorttext_en` varchar(100) DEFAULT NULL,
  `gmaps_lnk` text,
  `meetingpoint_description` varchar(200) DEFAULT NULL,
  `meetingpoint_description_en` varchar(200) DEFAULT NULL,
  `TNmin` int(11) DEFAULT NULL,
  `TNmax` int(11) DEFAULT NULL,
  `inDevelopment` tinyint(4) DEFAULT NULL,
  `route_bigpic` varchar(45) DEFAULT NULL,
  `route_pic` varchar(45) DEFAULT NULL,
  `pic_icon` varchar(45) DEFAULT NULL,
  `pdf_path` varchar(45) DEFAULT NULL,
  `base_price` int(4) DEFAULT NULL,
  `standard_duration` int(11) DEFAULT NULL,
  `cityid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `seg_tourroutes`
--

INSERT INTO `seg_tourroutes` (`idseg_tourroutes`, `id_tour_categories`, `name`, `maintext`, `maintext_en`, `shorttext`, `shorttext_en`, `gmaps_lnk`, `meetingpoint_description`, `meetingpoint_description_en`, `TNmin`, `TNmax`, `inDevelopment`, `route_bigpic`, `route_pic`, `pic_icon`, `pdf_path`, `base_price`, `standard_duration`, `cityid`) VALUES
(43, 1, 'Classic', 'When you visit Berlin for the first time, this is the ideal tour for you. On this tour, we show you the most famous sights of the metropolis. The tour leads you to the most amazing sights of the city. Besides having fun walking through the city, you will learn about the city''s history. ', '', 'When you visit Berlin for the first time, this is the ideal tour for you. ', '', NULL, NULL, NULL, 2, 12, NULL, NULL, NULL, '559247db74bc3.jpg', '558d8bd821943.pdf', 15, 60, 1),
(44, 2, 'Historical', 'Munich as "Hauptstadt der Bewegung" („capital of the movement“): no other German city is linked more strongly with the beginning and rise of National Socialism as Munich. On our historic tour through the era of the Third Reich we will drive to the most important places of activity from this period. Especially the backgrounds of the Nazi regime and its resistance fighters are in focus. On our III. Reich Tour, not only the following questions will be answered: What was the role of the Thule Society in the early days of the movement, what was the reason for the Beer Hall Putsch, why was the Königsplatz fundamentally redesigned, where was the founding place of the Deutsche Arbeiter Partei (German Workers‘ Party, which was renamed to NSDAP in 1920) and who tried to stop the regime? We were able to win a former history teacher to do this tour. With his vast knowledge and all due respect, he will give you a profound understanding of this dark era. ', '', 'Munich as "Hauptstadt der Bewegung" („capital of the movement“): no other German city is linked more', '', NULL, NULL, NULL, 2, 12, NULL, NULL, NULL, '5596ccf3ec8f5.jpg', '559150ec15c8f.pdf', 20, 90, 1),
(45, 3, 'Special', 'When you visit Munich for the first time, this is the ideal tour for you. On this tour, we show you the most famous sights of the Bavarian metropolis. The tour leads you to the Frauenkirche and the Friedensengel, to the English Garden with its surfers and the historic Königsplatz. Besides having fun driving the Segway, you will hear some stories about the Bavarian kings and learn about Bavarian history. ', 'When you visit Munich for the first time, this is the ideal tour for you. On this tour, we show you ', 'When you visit Munich for the first time, this is the ideal tour for you. On this tour, we show you ', 'When you visit Munich for the first time, this is the ideal tour for you. On this tour, we show you ', NULL, NULL, NULL, 2, 12, NULL, NULL, NULL, '5596cd3ca96d4.jpg', '55915157267ca.pdf', 25, 90, 1),
(46, 1, 'Classic', 'When you visit Munich for the first time, this is the ideal tour for you. On this tour, we show you the most famous sights of the Bavarian metropolis. The tour leads you to the Frauenkirche and the Friedensengel, to the English Garden with its surfers and the historic Königsplatz. Besides having fun driving the Segway, you will hear some stories about the Bavarian kings and learn about Bavarian history. ', '', 'When you visit Munich for the first time, this is the ideal tour for you.', '', '<iframe src="https://www.google.com/maps/d/embed?mid=z3CGRTiR_aoM.kVf1y7IIzEEU" width="320" height="240"></iframe>', NULL, NULL, 2, 12, NULL, NULL, NULL, '5596cd56c82c7.jpg', '559255e322374.pdf', 15, 60, 2),
(47, 2, 'Historical', 'When you visit Munich for the first time, this is the ideal tour for you. On this tour, we show you the most famous sights of the Bavarian metropolis. The tour leads you to the Frauenkirche and the Friedensengel, to the English Garden with its surfers and the historic Königsplatz. Besides having fun driving the Segway, you will hear some stories about the Bavarian kings and learn about Bavarian history. ', '', 'When you visit Munich for the first time, this is the ideal tour for you. On this tour, we show you ', '', '<iframe src="https://www.google.com/maps/d/embed?mid=z3CGRTiR_aoM.kVf1y7IIzEEU" width="320" height="240"></iframe>', NULL, NULL, 2, 12, NULL, NULL, NULL, '5596cdb8dd860.jpg', '5596cdb8dd932.pdf', 20, 90, 2),
(48, 3, 'Special', 'When you visit Munich for the first time, this is the ideal tour for you. On this tour, we show you the most famous sights of the Bavarian metropolis. When you visit Munich for the first time, this is the ideal tour for you. On this tour, we show you the most famous sights of the Bavarian metropolis. When you visit Munich for the first time, this is the ideal tour for you. On this tour, we show you the most famous sights of the Bavarian metropolis. When you visit Munich for the first time, this is the ideal tour for you. On this tour, we show you the most famous sights of the Bavarian metropolis. ', '', 'When you visit Munich for the first time, this is the ideal tour for you. On this tour, we show you ', '', NULL, NULL, NULL, 2, 12, NULL, NULL, NULL, '5596ce1923999.jpg', '5596ce1923a81.pdf', 25, 90, 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `seg_tourroutes`
--
ALTER TABLE `seg_tourroutes`
  ADD PRIMARY KEY (`idseg_tourroutes`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `seg_tourroutes`
--
ALTER TABLE `seg_tourroutes`
  MODIFY `idseg_tourroutes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
