/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.6.17 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `agence` (
	`codeAg` varchar (90),
	`nomAg` varchar (180),
	`RegionAg` varchar (90),
	`typeAg` varchar (180),
	`isDelete` tinyint (1)
); 
insert into `agence` (`codeAg`, `nomAg`, `RegionAg`, `typeAg`, `isDelete`) values('001','Yaounde','Centre','AG','0');
insert into `agence` (`codeAg`, `nomAg`, `RegionAg`, `typeAg`, `isDelete`) values('002','Bamenda','Nord-Ouest','Simple','0');
insert into `agence` (`codeAg`, `nomAg`, `RegionAg`, `typeAg`, `isDelete`) values('003','Garoua','Extreme-Nord','Ag','0');
insert into `agence` (`codeAg`, `nomAg`, `RegionAg`, `typeAg`, `isDelete`) values('004','Maroua','Nord','Ag','0');
insert into `agence` (`codeAg`, `nomAg`, `RegionAg`, `typeAg`, `isDelete`) values('005','Nkambe','Nord','Ag','0');
insert into `agence` (`codeAg`, `nomAg`, `RegionAg`, `typeAg`, `isDelete`) values('006','Ndop','Nord','Ag','0');
insert into `agence` (`codeAg`, `nomAg`, `RegionAg`, `typeAg`, `isDelete`) values('007','NDu','Extreme-Nord','Ag','0');
insert into `agence` (`codeAg`, `nomAg`, `RegionAg`, `typeAg`, `isDelete`) values('008','Mile 17 Beua','Extreme-Nord','Ag','0');
insert into `agence` (`codeAg`, `nomAg`, `RegionAg`, `typeAg`, `isDelete`) values('009','mutengene','Extreme-Nord','Ag','0');
insert into `agence` (`codeAg`, `nomAg`, `RegionAg`, `typeAg`, `isDelete`) values('0090','test','Nord-Ouest','test','0');
insert into `agence` (`codeAg`, `nomAg`, `RegionAg`, `typeAg`, `isDelete`) values('010','Biyem assi Emia','Extreme-Nord','Ag','0');
insert into `agence` (`codeAg`, `nomAg`, `RegionAg`, `typeAg`, `isDelete`) values('099','Direction General','Centre','Direction General','0');
