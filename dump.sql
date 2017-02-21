CREATE DATABASE  IF NOT EXISTS `simpletable`
USE `simpletable`;
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `access_count` int(10) unsigned DEFAULT '0',
  `modify_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
LOCK TABLES `user` WRITE;
INSERT INTO `user` VALUES (1,'Victoria Aleman',41,'2017-01-24 10:30:42'),(2,'John Deacon',15,'2017-01-19 16:30:43'),(3,'Eric Aleman',104,'2017-01-26 23:43:11'),(4,'Daniel Bernstein',15,'2016-11-26 22:37:15'),(5,'Heeday Nakahashi',9,'2017-01-01 07:43:22'),(6,'James Calhoun',27,'2017-01-13 22:37:18'),(7,'David Rawson',19,'2016-12-26 22:43:19'),(8,'Angie Pineda',0,NULL),(9,'Jim Dorsey',0,NULL);
UNLOCK TABLES;