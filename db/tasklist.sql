/*
SQLyog Community v9.20 
MySQL - 5.5.47-0ubuntu0.14.04.1 : Database - tasklist
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `tasklist`;

/*Table structure for table `task` */

DROP TABLE IF EXISTS `task`;

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('done','onprogress','new') NOT NULL DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `task` */

insert  into `task`(`task_id`,`user_id`,`name`,`description`,`status`,`created_at`) values (1,1,'task pertama','ini task pertama','new','2016-01-23 09:24:48'),(2,1,'task kedua','ini task kedua','new','2016-01-23 14:21:35'),(3,1,'task ketiga','ini task ketiga','new','2016-01-23 14:22:13'),(4,1,'task keempat','ini task keempat','new','2016-01-23 14:24:08'),(5,2,'task kesatu','ini task kesatu','new','2016-01-23 14:34:12'),(6,2,'task kesatu','ini task kesatu','new','2016-01-23 14:38:35'),(9,5,'3 task','this is 3 task','new','2016-01-24 08:25:53');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`user_id`,`email`,`password`,`api_key`,`created_at`) values (1,'bayu@bayu.com','a4bcc7b4cc573b022860dcca0da01f28e2eccdde','2402a377f193f1cb82a5c9847562c05536d19d15','2016-01-23 00:30:42'),(2,'joko@joko.com','bd309238509e2e9d9f92fd6c3717dba5c31c2935','40229ff780438bf20b53c529e4ab2c633559a572','2016-01-23 00:32:56'),(3,'budi@budi.com','0054e679f1d4ccdf95436ec0a30f4d737ad5dae7','e528376124a17628745735d735a78db30250b830','2016-01-23 09:13:25'),(4,'indah@indah.com','844efe5def6a897f8b5552433d954f968078bbe0','5ddb1dda2300d6412f8aecb46cbdcf38d8ad6384','2016-01-23 09:14:56'),(5,'bayoe13@gmail.com','069287e06f6b33452fcdaed763915077a09a46db','a22bbcd8c32575afe2f00d6907257703899330ee','2016-01-24 07:49:12');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
