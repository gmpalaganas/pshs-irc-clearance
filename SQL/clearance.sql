/*
SQLyog Ultimate v8.55 
MySQL - 5.5.16-log : Database - clearance
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`clearance` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `clearance`;

/*Table structure for table `accounts` */

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `username` varchar(20) NOT NULL DEFAULT ' ',
  `pword` varchar(255) NOT NULL DEFAULT ' ',
  `role` varchar(255) NOT NULL DEFAULT 'student',
  `id` varchar(255) NOT NULL DEFAULT '00000',
  PRIMARY KEY (`username`),
  KEY `FK_accounts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `accounts` */

insert  into `accounts`(`username`,`pword`,`role`,`id`) values ('admin','e5b3a3b020d5263b183419664b1eb551','administrator','00000'),('agsunoddl','27cedf146998e4d71dfda6af693267e7','student','12085'),('albanojs','628c1e6a1d3ab4bffa210ff770cc8cc3','signatant','55555'),('alcaindm','cbce627935c512620b8068a5c948ac0f','student','11001'),('alejandreat','14b5f8d86f01466dbb2aa63cb71dc29b','student','11002'),('balderiamb','ec1ff8962aae8c94e64a1ce0d5e28190','student','11003'),('batadmo','3df936cf70f1f50ab13f782e043563bf','signatant','19711'),('bisenorr','6855b9e6284d89248ee1b6b51e2bb128','signatant','99999'),('cabaticll','d4b189b9f06acca51ad3514b5d3abeb4','signatant','66666'),('chuaas','003cbde6006ad59d0d079d75903887fe','student','12061'),('ducusinmm','3c575fe4b6c023e33eb322f74890d090','signatant','22222'),('escaroas','1c21d9b19298645fa2534d9828ee0778','student','12066'),('fabijq','1bd0e2a1d5596b9651ae9c0c70696f8c','student','12090'),('fajatinet','599f7b6ff5b6eff1ca403e7cf8049189','signatant','23002'),('gorospeab','06d7b5d28c9e68a4bafc00b264d5d81c','student','12068'),('laguams','eb5e03133c34a229ea5bb216ced9977a','signatant','33333'),('macugayjb','73a3ad3546cec5a3278f0db0ab75c6c9','student','12070'),('manalangae','6c465847ee24f3540b262ebc1382d821','student','12071'),('nacardt','00ef5771a21158337b37a6f3ef5f94f4','student','11030'),('palaganasgm','7ffbbba7c0252d605b4e7c756209c000','student','12074'),('pojasmv','51388d29df78840d8c0bde3f16c77e07','student','12097'),('rapadaea','97f077f7f082535f08594d0d7b65c0ae','signatant','77777'),('tabaradm','def641f3a61346094092ca2b3c3ffbb1','student','12078'),('tabernaas','cf13d076a8d69a54740967be43c308cb','student','12103'),('villoriapm','3f0b38ff39bddfd4e96240f0d2fcf40a','signatant','11111');

/*Table structure for table `clubs` */

DROP TABLE IF EXISTS `clubs`;

CREATE TABLE `clubs` (
  `club_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `club` varchar(255) NOT NULL DEFAULT ' ',
  `adviser` varchar(11) NOT NULL DEFAULT '0',
  `announce` varchar(255) NOT NULL DEFAULT 'No Announcements',
  `post_date` varchar(255) NOT NULL DEFAULT ' ',
  PRIMARY KEY (`club_id`),
  KEY `FK_clubs` (`adviser`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `clubs` */

insert  into `clubs`(`club_id`,`club`,`adviser`,`announce`,`post_date`) values (1,'SMT','33333','No Announcements',' '),(2,'Student Aliance','77777','No Announcements',' '),(3,'Computer Guild','0','No Announcements',' '),(4,'Glee','23002','No Announcements',' ');

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `to_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `message` text,
  `date_sent` timestamp NULL DEFAULT NULL,
  `new_msg` tinyint(1) DEFAULT '1',
  `msgid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`msgid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `messages` */

insert  into `messages`(`to_id`,`from_id`,`message`,`date_sent`,`new_msg`,`msgid`) values (22222,19711,'Ma\'am cnu na ang ok?','2012-03-05 15:53:44',0,1);

/*Table structure for table `non_teaching` */

DROP TABLE IF EXISTS `non_teaching`;

CREATE TABLE `non_teaching` (
  `ot_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `des` varchar(255) NOT NULL DEFAULT ' ',
  `signatant` varchar(11) NOT NULL DEFAULT '00000',
  `announce` varchar(255) NOT NULL DEFAULT 'No Announcements',
  `post_date` varchar(255) NOT NULL DEFAULT ' ',
  PRIMARY KEY (`ot_id`),
  KEY `FK_subjects` (`signatant`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `non_teaching` */

insert  into `non_teaching`(`ot_id`,`des`,`signatant`,`announce`,`post_date`) values (1,'Comp Lab Custodian','00000','No Announcements',' '),(2,'Campus Director','66666','No Announcements',' '),(3,'Registrar','19711','No Announcements',' '),(4,'Dorm','11111','No Announcements',' ');

/*Table structure for table `related` */

DROP TABLE IF EXISTS `related`;

CREATE TABLE `related` (
  `id1` int(11) DEFAULT NULL,
  `id2` int(11) DEFAULT NULL,
  `rel_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`rel_id`),
  UNIQUE KEY `rel` (`id1`,`id2`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `related` */

insert  into `related`(`id1`,`id2`,`rel_id`) values (19711,22222,1);

/*Table structure for table `sections` */

DROP TABLE IF EXISTS `sections`;

CREATE TABLE `sections` (
  `secid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `section` varchar(255) NOT NULL DEFAULT '0',
  `adviser_id` int(11) NOT NULL DEFAULT '0',
  `announce` varchar(255) NOT NULL DEFAULT 'No Announcements',
  PRIMARY KEY (`secid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `sections` */

insert  into `sections`(`secid`,`section`,`adviser_id`,`announce`) values (1,'Emerald',0,'No Announcements'),(2,'Diamond',0,'No Announcements'),(3,'Ruby',0,'No Announcements'),(4,'Adelfa',0,'No Announcements'),(5,'Camia',0,'No Announcements'),(6,'Dahlia',0,'No Announcements'),(7,'Berylium',0,'No Announcements'),(8,'Cesium',0,'No Announcements'),(9,'Lithium',0,'No Announcements'),(10,'Graviton',22222,'No Announcements'),(11,'Photon',55555,'No Announcements');

/*Table structure for table `signatory` */

DROP TABLE IF EXISTS `signatory`;

CREATE TABLE `signatory` (
  `stid` varchar(10) NOT NULL DEFAULT ' ',
  `lname` varchar(255) NOT NULL DEFAULT ' ',
  `fname` varchar(255) NOT NULL DEFAULT ' ',
  `mname` varchar(255) NOT NULL DEFAULT ' ',
  PRIMARY KEY (`stid`),
  KEY `sig_index` (`stid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `signatory` */

insert  into `signatory`(`stid`,`lname`,`fname`,`mname`) values ('11111','Villoria','Pablo Jr','Middle'),('19711','Batad','Maam ','O'),('22222','Ducusin','Michelle','Ma'),('23002','Fajatin','Elden','T'),('33333','Lagua','Mary Anne','Signatant'),('55555','Albano','Johnellyn','Stohner'),('66666','Cabatic','Larry','L'),('77777','Rapada','Elma','A'),('99999','Biseno','Richard','R');

/*Table structure for table `st_clubs` */

DROP TABLE IF EXISTS `st_clubs`;

CREATE TABLE `st_clubs` (
  `clid` int(11) NOT NULL DEFAULT '0',
  `stid` varchar(11) NOT NULL DEFAULT '0',
  `cleared` varchar(255) NOT NULL DEFAULT 'NOT CLEARED',
  `comments` varchar(255) NOT NULL DEFAULT ' ',
  `year` year(4) NOT NULL DEFAULT '2011',
  `yrlevel` int(1) NOT NULL DEFAULT '4',
  `date_signed` datetime DEFAULT '0000-00-00 00:00:00',
  `notif` tinyint(1) NOT NULL DEFAULT '0',
  `year2` year(4) DEFAULT NULL,
  UNIQUE KEY `u_id` (`clid`,`stid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `st_clubs` */

insert  into `st_clubs`(`clid`,`stid`,`cleared`,`comments`,`year`,`yrlevel`,`date_signed`,`notif`,`year2`) values (1,'11001','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2013),(1,'11002','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2013),(1,'11003','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2013),(1,'11030','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2013),(1,'12061','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2013),(1,'12066','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2013),(1,'12068','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2013),(1,'12070','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2013),(1,'12071','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2013),(1,'12074','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2013),(1,'12078','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2013),(1,'12085','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2013),(1,'12090','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2013),(1,'12097','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2013),(1,'12103','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2013);

/*Table structure for table `st_non_teaching` */

DROP TABLE IF EXISTS `st_non_teaching`;

CREATE TABLE `st_non_teaching` (
  `ot_id` int(11) NOT NULL DEFAULT '0',
  `stid` varchar(11) NOT NULL DEFAULT '0',
  `cleared` varchar(255) NOT NULL DEFAULT 'NOT CLEARED',
  `comments` varchar(255) NOT NULL DEFAULT ' ',
  `year` year(4) NOT NULL DEFAULT '2011',
  `yrlevel` int(1) NOT NULL DEFAULT '4',
  `date_signed` datetime DEFAULT '0000-00-00 00:00:00',
  `notif` tinyint(1) NOT NULL DEFAULT '0',
  `year2` year(4) DEFAULT NULL,
  UNIQUE KEY `u_id` (`ot_id`,`stid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `st_non_teaching` */

insert  into `st_non_teaching`(`ot_id`,`stid`,`cleared`,`comments`,`year`,`yrlevel`,`date_signed`,`notif`,`year2`) values (1,'11001','NOT CLEARED',' ',2011,4,NULL,0,2012),(1,'11002','NOT CLEARED',' ',2011,4,NULL,0,2012),(1,'11003','NOT CLEARED',' ',2011,4,NULL,0,2012),(1,'11030','NOT CLEARED',' ',2011,4,NULL,0,2012),(1,'12061','NOT CLEARED',' ',2011,4,NULL,0,NULL),(1,'12066','NOT CLEARED',' ',2001,4,NULL,0,2012),(1,'12068','NOT CLEARED',' ',2011,4,NULL,0,NULL),(1,'12070','NOT CLEARED',' ',2011,4,NULL,0,NULL),(1,'12071','NOT CLEARED',' ',2001,4,NULL,0,2012),(1,'12074','NOT CLEARED',' ',2001,4,NULL,0,2012),(1,'12078','NOT CLEARED',' ',2001,4,NULL,0,2012),(1,'12085','NOT CLEARED',' ',2011,4,NULL,0,2012),(1,'12090','NOT CLEARED',' ',2011,4,NULL,0,2012),(1,'12097','NOT CLEARED',' ',2011,4,NULL,0,2012),(1,'12103','NOT CLEARED',' ',2001,4,NULL,0,2012),(2,'11001','NOT CLEARED',' ',2011,4,NULL,0,2012),(2,'11002','NOT CLEARED',' ',2011,4,NULL,0,2012),(2,'11003','NOT CLEARED',' ',2011,4,NULL,0,2012),(2,'11030','NOT CLEARED',' ',2011,4,NULL,0,2012),(2,'12061','NOT CLEARED',' ',2011,4,NULL,0,NULL),(2,'12066','NOT CLEARED',' ',2011,4,NULL,0,2012),(2,'12068','NOT CLEARED',' ',2011,4,NULL,0,NULL),(2,'12070','NOT CLEARED',' ',2011,4,NULL,0,NULL),(2,'12071','NOT CLEARED',' ',2011,4,NULL,0,2012),(2,'12074','NOT CLEARED',' ',2011,4,NULL,0,2012),(2,'12078','NOT CLEARED',' ',2011,4,NULL,0,2012),(2,'12085','NOT CLEARED',' ',2011,4,NULL,0,2012),(2,'12090','NOT CLEARED',' ',2011,4,NULL,0,2012),(2,'12097','NOT CLEARED',' ',2011,4,NULL,0,2012),(2,'12103','NOT CLEARED',' ',2011,4,NULL,0,2012),(3,'11001','NOT CLEARED',' ',2011,4,NULL,0,NULL),(3,'11002','NOT CLEARED',' ',2011,4,NULL,0,NULL),(3,'11003','NOT CLEARED',' ',2011,4,NULL,0,NULL),(3,'11030','NOT CLEARED',' ',2011,4,NULL,0,NULL),(3,'12061','NOT CLEARED',' ',2011,4,NULL,0,NULL),(3,'12066','NOT CLEARED',' ',2011,4,NULL,0,NULL),(3,'12068','NOT CLEARED',' ',2011,4,NULL,0,NULL),(3,'12070','NOT CLEARED',' ',2011,4,NULL,0,NULL),(3,'12071','NOT CLEARED',' ',2011,4,NULL,0,NULL),(3,'12074','NOT CLEARED',' ',2011,4,NULL,0,NULL),(3,'12078','NOT CLEARED',' ',2011,4,NULL,0,NULL),(3,'12085','NOT CLEARED',' ',2011,4,NULL,0,NULL),(3,'12090','NOT CLEARED',' ',2011,4,NULL,0,NULL),(3,'12097','NOT CLEARED',' ',2011,4,NULL,0,NULL),(3,'12103','NOT CLEARED',' ',2011,4,NULL,0,NULL),(4,'11001','NOT CLEARED',' ',2011,4,NULL,0,NULL),(4,'11002','NOT CLEARED',' ',2011,4,NULL,0,NULL),(4,'11003','NOT CLEARED',' ',2011,4,NULL,0,NULL),(4,'11030','NOT CLEARED',' ',2011,4,NULL,0,NULL),(4,'12061','NOT CLEARED',' ',2011,4,NULL,0,NULL),(4,'12066','NOT CLEARED',' ',2011,4,NULL,0,NULL),(4,'12068','NOT CLEARED',' ',2011,4,NULL,0,NULL),(4,'12070','NOT CLEARED',' ',2011,4,NULL,0,NULL),(4,'12071','NOT CLEARED',' ',2011,4,NULL,0,NULL),(4,'12074','NOT CLEARED',' ',2011,4,NULL,0,NULL),(4,'12078','NOT CLEARED',' ',2011,4,NULL,0,NULL),(4,'12085','NOT CLEARED',' ',2011,4,NULL,0,NULL),(4,'12090','NOT CLEARED',' ',2011,4,NULL,0,NULL),(4,'12097','NOT CLEARED',' ',2011,4,NULL,0,NULL),(4,'12103','NOT CLEARED',' ',2011,4,NULL,0,NULL);

/*Table structure for table `st_sec` */

DROP TABLE IF EXISTS `st_sec`;

CREATE TABLE `st_sec` (
  `secid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stid` varchar(11) NOT NULL DEFAULT '0',
  `cleared` varchar(255) NOT NULL DEFAULT 'NOT CLEARED',
  `comments` varchar(255) NOT NULL DEFAULT ' ',
  `year` year(4) NOT NULL DEFAULT '2011',
  `yrlevel` int(1) NOT NULL DEFAULT '4',
  `date_signed` datetime DEFAULT NULL,
  `notif` tinyint(1) NOT NULL DEFAULT '0',
  `year2` year(4) DEFAULT NULL,
  UNIQUE KEY `u_id` (`secid`,`stid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `st_sec` */

insert  into `st_sec`(`secid`,`stid`,`cleared`,`comments`,`year`,`yrlevel`,`date_signed`,`notif`,`year2`) values (10,'12066','NOT CLEARED',' ',2011,4,NULL,0,2012),(10,'12068','NOT CLEARED',' ',2011,4,NULL,0,NULL),(10,'12070','NOT CLEARED',' ',2011,4,NULL,0,2012),(10,'12074','CLEARED',' ',2012,4,'2012-03-11 17:27:33',0,2012),(10,'12103','NOT CLEARED',' ',2011,4,NULL,0,2012),(11,'12061','NOT CLEARED',' ',2011,4,NULL,0,2012),(11,'12071','NOT CLEARED',' ',2011,4,NULL,0,2012),(11,'12078','NOT CLEARED',' ',2011,4,NULL,0,2012),(11,'12085','NOT CLEARED',' ',2011,4,NULL,0,2012),(11,'12097','NOT CLEARED',' ',2011,4,NULL,0,2012);

/*Table structure for table `st_subjects` */

DROP TABLE IF EXISTS `st_subjects`;

CREATE TABLE `st_subjects` (
  `sub_id` int(11) NOT NULL DEFAULT '0',
  `stid` varchar(11) NOT NULL DEFAULT '0',
  `cleared` varchar(255) NOT NULL DEFAULT 'NOT CLEARED',
  `comments` varchar(255) NOT NULL DEFAULT ' ',
  `year` year(4) NOT NULL DEFAULT '2011',
  `yrlevel` int(1) NOT NULL DEFAULT '4',
  `date_signed` datetime DEFAULT '0000-00-00 00:00:00',
  `notif` tinyint(1) NOT NULL DEFAULT '0',
  `year2` year(4) DEFAULT NULL,
  UNIQUE KEY `u_id` (`sub_id`,`stid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `st_subjects` */

insert  into `st_subjects`(`sub_id`,`stid`,`cleared`,`comments`,`year`,`yrlevel`,`date_signed`,`notif`,`year2`) values (4,'11001','NOT CLEARED',' ',2010,2,NULL,0,2012),(4,'11002','NOT CLEARED',' ',2010,2,NULL,0,2012),(4,'11003','NOT CLEARED',' ',2010,2,NULL,0,2012),(4,'11030','NOT CLEARED',' ',2010,2,NULL,0,2012),(5,'11001','NOT CLEARED',' ',2010,3,NULL,0,2012),(5,'11002','NOT CLEARED',' ',2010,3,NULL,0,2012),(5,'11003','NOT CLEARED',' ',2010,3,NULL,0,2012),(5,'11030','NOT CLEARED',' ',2010,3,NULL,0,2012),(10,'11001','NOT CLEARED',' ',2010,4,NULL,0,2012),(10,'11002','NOT CLEARED',' ',2010,4,NULL,0,2012),(10,'11003','NOT CLEARED',' ',2010,4,NULL,0,2012),(10,'11030','NOT CLEARED',' ',2010,4,NULL,0,2012),(10,'12061','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(10,'12066','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(10,'12068','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(10,'12070','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(10,'12071','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(10,'12074','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(10,'12078','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(10,'12085','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(10,'12090','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(10,'12097','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(10,'12103','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(11,'11001','NOT CLEARED',' ',2010,1,NULL,0,2012),(11,'11002','NOT CLEARED',' ',2010,1,NULL,0,2012),(11,'11003','NOT CLEARED',' ',2010,1,NULL,0,2012),(11,'11030','NOT CLEARED',' ',2010,1,NULL,0,2012),(12,'11001','NOT CLEARED',' ',2010,2,NULL,0,2012),(12,'11002','NOT CLEARED',' ',2010,2,NULL,0,2012),(12,'11003','NOT CLEARED',' ',2010,2,NULL,0,2012),(12,'11030','NOT CLEARED',' ',2010,2,NULL,0,2012),(13,'11001','NOT CLEARED',' ',2010,3,NULL,0,2012),(13,'11002','NOT CLEARED',' ',2010,3,NULL,0,2012),(13,'11003','NOT CLEARED',' ',2010,3,NULL,0,2012),(13,'11030','NOT CLEARED',' ',2010,3,NULL,0,2012),(14,'11001','NOT CLEARED',' ',2010,4,NULL,0,2012),(14,'11002','NOT CLEARED',' ',2010,4,NULL,0,2012),(14,'11003','NOT CLEARED',' ',2010,4,NULL,0,2012),(14,'11030','NOT CLEARED',' ',2010,4,NULL,0,2012),(14,'12061','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(14,'12066','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(14,'12068','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(14,'12070','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(14,'12071','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(14,'12074','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(14,'12078','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(14,'12085','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(14,'12090','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(14,'12097','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(14,'12103','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(16,'11001','NOT CLEARED',' ',2010,4,NULL,0,2012),(16,'11002','NOT CLEARED',' ',2010,4,NULL,0,2012),(16,'11003','NOT CLEARED',' ',2010,4,NULL,0,2012),(16,'11030','NOT CLEARED',' ',2010,4,NULL,0,2012),(16,'12061','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(16,'12066','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(16,'12068','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(16,'12070','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(16,'12071','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(16,'12074','CLEARED',' ',2012,4,'2012-03-11 18:41:35',0,2012),(16,'12078','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(16,'12085','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(16,'12090','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(16,'12097','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(16,'12103','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(18,'11001','NOT CLEARED',' ',2010,4,NULL,0,2012),(18,'11002','NOT CLEARED',' ',2010,4,NULL,0,2012),(18,'11003','NOT CLEARED',' ',2010,4,NULL,0,2012),(18,'11030','NOT CLEARED',' ',2010,4,NULL,0,2012),(18,'12061','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(18,'12066','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(18,'12068','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(18,'12070','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(18,'12071','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(18,'12074','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(18,'12078','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(18,'12085','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(18,'12090','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(18,'12097','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(18,'12103','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(19,'11001','NOT CLEARED',' ',2010,3,NULL,0,2012),(19,'11002','NOT CLEARED',' ',2010,3,NULL,0,2012),(19,'11003','NOT CLEARED',' ',2010,3,NULL,0,2012),(19,'11030','NOT CLEARED',' ',2010,3,NULL,0,2012),(20,'11001','NOT CLEARED',' ',2010,3,NULL,0,2012),(20,'11002','NOT CLEARED',' ',2010,3,NULL,0,2012),(20,'11003','NOT CLEARED',' ',2010,3,NULL,0,2012),(20,'11030','NOT CLEARED',' ',2010,3,NULL,0,2012),(21,'11001','NOT CLEARED',' ',2010,4,NULL,0,2012),(21,'11002','NOT CLEARED',' ',2010,4,NULL,0,2012),(21,'11003','NOT CLEARED',' ',2010,4,NULL,0,2012),(21,'11030','NOT CLEARED',' ',2010,4,NULL,0,2012),(21,'12061','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(21,'12066','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(21,'12068','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(21,'12070','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(21,'12071','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(21,'12074','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(21,'12078','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(21,'12085','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(21,'12090','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(21,'12097','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012),(21,'12103','NOT CLEARED',' ',2011,4,'0000-00-00 00:00:00',0,2012);

/*Table structure for table `students` */

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `stid` varchar(10) NOT NULL,
  `lname` varchar(255) NOT NULL DEFAULT ' ',
  `fname` varchar(255) NOT NULL DEFAULT ' ',
  `mname` varchar(255) NOT NULL DEFAULT ' ',
  `yrlevel` int(11) NOT NULL DEFAULT '1',
  `cont_num` varchar(11) NOT NULL DEFAULT '0',
  `address` varchar(255) NOT NULL DEFAULT ' ',
  `is_alumni` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`stid`),
  KEY `st_index` (`stid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `students` */

insert  into `students`(`stid`,`lname`,`fname`,`mname`,`yrlevel`,`cont_num`,`address`,`is_alumni`) values ('11001','Alcain','Drenfurt','Magante',2011,'0927181857','Vigan, Ilocos Sur',1),('11002','Alejandre','Alberto Carlos','Tacuycuy',2011,'09278965729','Vigan, Ilocos Sur',1),('11003','Balderia','Maria Czarina','Bautista',2011,'09067846245','Urdaneta, Pangasinan',1),('11030','Nacar','David Christy Ann','Tinao',2011,'09276170712','San Fernando, La Union',1),('12061','Chua','Austin Paolo','Samson',4,'09993914215','55-D Burgos Street, Dagupan City, Pangasinan',0),('12066','Escaro','Archel','Susvilla',4,'09159161545','1617 Bldg. 16, MRB Compd., Pilot Area, Brgy. Commonwealth, Quezon City',0),('12068','Gorospe','Alloyssius E.G.','Baltazar',4,'09274452782','Calasiao, Pangasinan',0),('12070','Macugay','Joshua Kae','Balanay',4,'09246123722','Ilocos Norte',0),('12071','Manalang','Alfonso','Ebonia',4,'1234567890','Marikina City',0),('12074','Palaganas','Genesis Ian','Martinez',4,'09272491685','Poblacion Zone 2, Bayambang,Pangasinan',0),('12078','Tabara','Dexter','Mabalot',4,'09277793799','084 Castro Sarmenta Village, Bolosan District, Dagupan City, Pangasinan',0),('12085','Agsunod','Deetz Beryl','Leano',4,'09276647080','Vintar, Ilocos Norte',0),('12090','Fabi','Jillean Camille','Quiddaoen',4,'09176624017','P. Gomez St. Laoag City',0),('12097','Pojas','Marielle Joy','Visitacion',4,'09272580796','Quiling Sur, Batac City',0),('12103','Taberna','Ariana Grace','Soliven',4,'09065716578','Cavite',0);

/*Table structure for table `subjects` */

DROP TABLE IF EXISTS `subjects`;

CREATE TABLE `subjects` (
  `sub_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sub` varchar(255) NOT NULL DEFAULT ' ',
  `teacher` varchar(11) NOT NULL DEFAULT '00000',
  `yrlevel` int(1) NOT NULL DEFAULT '0',
  `announce` varchar(255) NOT NULL DEFAULT 'No Announcements',
  `post_date` varchar(255) NOT NULL DEFAULT ' ',
  `is_elective` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sub_id`),
  KEY `FK_subjects` (`teacher`),
  KEY `sub_index` (`sub_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `subjects` */

insert  into `subjects`(`sub_id`,`sub`,`teacher`,`yrlevel`,`announce`,`post_date`,`is_elective`) values (4,'Bio1','00000',2,'No Announcements','2011-08-24',0),(5,'Bio2','22222',3,'No Announcements','2011-08-24',0),(10,'CAT1','00000',4,'No Announcements','2011-08-24',0),(11,'ComSci1','00000',1,'No Announcements','2011-08-24',0),(12,'ComSci2','00000',2,'No Announcements','2011-08-24',0),(13,'ComSci3','11111',3,'No Announcements','2011-08-24',0),(14,'ComSci4','11111',4,'No Announcements','August 24, 2011 - Wednesday 08:23 PM',0),(16,'Research 2','22222',4,'Present your proposals tommorrow!!! Asap','January 26, 2012 - Thursday 09:25 AM',0),(18,'Chem3','33333',4,'No Announcements',' ',0),(19,'Research 1','22222',3,'No Announcements',' ',0),(20,'Chem2','33333',3,'No Announcements',' ',0),(21,'Biology 3','22222',4,'Fix your books now','February 16, 2012 - Thursday 07:53 PM',0),(22,'ComSciElective2','00000',4,'No Announcements',' ',1),(23,'ChemElective1','33333',3,'No Announcements',' ',1),(24,'ChemElec2','33333',4,'No Announcements',' ',1),(25,'IntegSci','33333',1,'No Announcements',' ',0);

/*Table structure for table `signatory_view` */

DROP TABLE IF EXISTS `signatory_view`;

/*!50001 DROP VIEW IF EXISTS `signatory_view` */;
/*!50001 DROP TABLE IF EXISTS `signatory_view` */;

/*!50001 CREATE TABLE  `signatory_view`(
 `stid` varchar(10) ,
 `lname` varchar(255) ,
 `fname` varchar(255) ,
 `mname` varchar(255) 
)*/;

/*View structure for view signatory_view */

/*!50001 DROP TABLE IF EXISTS `signatory_view` */;
/*!50001 DROP VIEW IF EXISTS `signatory_view` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `signatory_view` AS select `signatory`.`stid` AS `stid`,`signatory`.`lname` AS `lname`,`signatory`.`fname` AS `fname`,`signatory`.`mname` AS `mname` from `signatory` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
