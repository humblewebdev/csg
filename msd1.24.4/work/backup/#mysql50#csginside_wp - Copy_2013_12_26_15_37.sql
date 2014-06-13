-- Status:3:4:MP_0:#mysql50#csginside_wp - Copy:php:1.24.4::5.5.28:1:::utf8:EXTINFO
--
-- TABLE-INFO
-- TABLE|wp_bp_cp_galleries|0|4096|2012-10-12 14:46:10|MyISAM
-- TABLE|wp_bp_easyalbums_templates|3|2172|2012-10-12 14:46:10|MyISAM
-- TABLE|wp_hexam_questions|1|2124|2012-10-12 14:46:09|MyISAM
-- EOF TABLE-INFO
--
-- Dump by MySQLDumper 1.24.4 (http://mysqldumper.net)
/*!40101 SET NAMES 'utf8' */;
SET FOREIGN_KEY_CHECKS=0;
-- Dump created: 2013-12-26 15:37

--
-- Create Table `wp_bp_cp_galleries`
--

DROP TABLE IF EXISTS `wp_bp_cp_galleries`;
CREATE TABLE `wp_bp_cp_galleries` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `uID` varchar(255) DEFAULT NULL,
  `fID` varchar(255) DEFAULT NULL,
  `gal_type` varchar(255) DEFAULT NULL,
  `gal_title` varchar(255) DEFAULT NULL,
  `published` int(11) DEFAULT '0',
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`ID`),
  KEY `idx_uid` (`uID`),
  KEY `idx_fid` (`fID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Data for Table `wp_bp_cp_galleries`
--

/*!40000 ALTER TABLE `wp_bp_cp_galleries` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_bp_cp_galleries` ENABLE KEYS */;


--
-- Create Table `wp_bp_easyalbums_templates`
--

DROP TABLE IF EXISTS `wp_bp_easyalbums_templates`;
CREATE TABLE `wp_bp_easyalbums_templates` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `tpl` varchar(20) DEFAULT NULL,
  `indx` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Data for Table `wp_bp_easyalbums_templates`
--

/*!40000 ALTER TABLE `wp_bp_easyalbums_templates` DISABLE KEYS */;
INSERT INTO `wp_bp_easyalbums_templates` (`ID`,`title`,`tpl`,`indx`,`type`) VALUES ('1','General','AEAAqSaD_z3h','10','images');
INSERT INTO `wp_bp_easyalbums_templates` (`ID`,`title`,`tpl`,`indx`,`type`) VALUES ('2','Video','AELA3RKs_nti','20','video');
INSERT INTO `wp_bp_easyalbums_templates` (`ID`,`title`,`tpl`,`indx`,`type`) VALUES ('3','Audio','AkIALS6N_Xrj','30','audio');
/*!40000 ALTER TABLE `wp_bp_easyalbums_templates` ENABLE KEYS */;


--
-- Create Table `wp_hexam_questions`
--

DROP TABLE IF EXISTS `wp_hexam_questions`;
CREATE TABLE `wp_hexam_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `testid` int(11) DEFAULT NULL,
  `content` text,
  `answers` text,
  `correct` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Data for Table `wp_hexam_questions`
--

/*!40000 ALTER TABLE `wp_hexam_questions` DISABLE KEYS */;
INSERT INTO `wp_hexam_questions` (`id`,`testid`,`content`,`answers`,`correct`) VALUES ('1','1','What is the answer to this question?','~Not Answer?~Anser?','1');
/*!40000 ALTER TABLE `wp_hexam_questions` ENABLE KEYS */;

SET FOREIGN_KEY_CHECKS=1;
-- EOB

