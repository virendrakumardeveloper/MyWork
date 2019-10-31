create database addressbook;
use addressbook;

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;


CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;



INSERT INTO `contacts` VALUES (1,'Laure','Tille','646 Longview Point','2440-153','Cela'),
(2,'Junette','Brewin','3219 Alpine Trail','8711','San Fernando'),
(3,'Hamnet','Dangl','10035 Duke Court',NULL,'Urasqui'),
(4,'Brose','Filgate','25 Knutson Trail',NULL,'Chengdong'),
(5,'Krissy','Aronstein','91304 Nevada Street',NULL,'Ayotupas'),
(6,'Goran','Thay','68744 Erie Court','969-7208','Fuji'),
(7,'Juline','Jeff','61 Dorton Circle',NULL,'Homeyo'),
(8,'Bianka','Daughton','30 Cambridge Center','6109','Kabankalan'),
(9,'Jammal','Conyard','75 Hoard Pass',NULL,'Muleba'),
(10,'Hiram','Keneforde','2 Talisman Hill','13130','Tha Ruea');


INSERT INTO `addressbook`.`cities` (`city_name`) VALUES ('Cela');
INSERT INTO `addressbook`.`cities` (`city_name`) VALUES ('San Fernando');
INSERT INTO `addressbook`.`cities` (`city_name`) VALUES ('Urasqui');
INSERT INTO `addressbook`.`cities` (`city_name`) VALUES ('Chengdong');
INSERT INTO `addressbook`.`cities` (`city_name`) VALUES ('Ayotupas');
INSERT INTO `addressbook`.`cities` (`city_name`) VALUES ('Fuji');
INSERT INTO `addressbook`.`cities` (`city_name`) VALUES ('Homeyo');
INSERT INTO `addressbook`.`cities` (`city_name`) VALUES ('Kabankalan');
INSERT INTO `addressbook`.`cities` (`city_name`) VALUES ('Muleba');
INSERT INTO `addressbook`.`cities` (`city_name`) VALUES ('Tha Ruea');
