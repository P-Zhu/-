SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS  `msg_info`;
CREATE TABLE `msg_info` (
  `Msg_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Stu_NO` int(11) NOT NULL,
  `Role_ID` char(4) NOT NULL,
  `Res_ID` int(11) unsigned NOT NULL,
  `Res_STATUS` int(1) unsigned NOT NULL,
  `Msg_STATUS` tinyint(1) NOT NULL,
  `Msg_DT` timestamp NULL DEFAULT NULL,
  `Msg_TEXT` text,
  PRIMARY KEY (`Msg_ID`,`Res_ID`),
  KEY `Res_ID` (`Res_ID`) USING BTREE,
  KEY `Res_STATUS` (`Res_STATUS`) USING BTREE,
  KEY `Stu_NO` (`Stu_NO`),
  CONSTRAINT `Res_ID` FOREIGN KEY (`Res_ID`) REFERENCES `res_info` (`Res_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `Stu_NO` FOREIGN KEY (`Stu_NO`) REFERENCES `user_stu` (`Stu_NO`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS  `res_class`;
CREATE TABLE `res_class` (
  `Class_CODE` char(4) NOT NULL,
  `Class_NAME` varchar(128) NOT NULL,
  `Clas_DESC` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Class_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS  `res_info`;
CREATE TABLE `res_info` (
  `Res_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Res_CD` char(4) NOT NULL,
  `Res_RDT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Res_DESC` text NOT NULL,
  `Res_CP` int(11) NOT NULL,
  `Res_P` varchar(32) NOT NULL,
  `Res_PIC` char(18) NOT NULL,
  `Res_STATUS` int(1) unsigned NOT NULL,
  `Res_CLA` int(11) DEFAULT NULL,
  `Res_CT` timestamp NULL DEFAULT NULL,
  `Res_CDT` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Res_ID`),
  KEY `class` (`Res_CD`),
  KEY `cp` (`Res_CP`),
  KEY `cla` (`Res_CLA`),
  CONSTRAINT `cla` FOREIGN KEY (`Res_CLA`) REFERENCES `user_stu` (`Stu_NO`) ON UPDATE CASCADE,
  CONSTRAINT `class` FOREIGN KEY (`Res_CD`) REFERENCES `res_class` (`Class_CODE`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `cp` FOREIGN KEY (`Res_CP`) REFERENCES `user_stu` (`Stu_NO`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS  `stu_college`;
CREATE TABLE `stu_college` (
  `College_CODE` char(4) NOT NULL,
  `College_NAME` varchar(255) NOT NULL,
  `College_DESC` text,
  PRIMARY KEY (`College_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS  `user_stu`;
CREATE TABLE `user_stu` (
  `Stu_NO` int(11) NOT NULL,
  `Stu_PW` char(128) NOT NULL,
  `Stu_NAME` varchar(32) NOT NULL,
  `Stu_SEX` tinyint(1) NOT NULL,
  `Stu_DATE` date DEFAULT NULL,
  `Stu_TEL` char(11) NOT NULL,
  `Stu_EMAIL` varchar(255) DEFAULT NULL,
  `Stu_College_CODE` char(4) NOT NULL COMMENT ' ',
  `Stu_RT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Stu_STATUS` char(128) DEFAULT NULL,
  `Stu_MSG` int(2) DEFAULT NULL,
  `theme` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Stu_NO`),
  KEY `college` (`Stu_College_CODE`),
  CONSTRAINT `college` FOREIGN KEY (`Stu_College_CODE`) REFERENCES `stu_college` (`College_CODE`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=gbk;

SET FOREIGN_KEY_CHECKS = 1;

