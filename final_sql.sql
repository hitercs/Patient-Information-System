-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 573dc08a9d3d2.bj.cdb.myqcloud.com    Database: test
-- ------------------------------------------------------
-- Server version	5.6.28-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED='4d14a7b2-19cc-11e6-bb14-ec388f73a168:1-448';

--
-- Temporary view structure for view `clinical_process`
--

DROP TABLE IF EXISTS `clinical_process`;
/*!50001 DROP VIEW IF EXISTS `clinical_process`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `clinical_process` AS SELECT 
 1 AS `patient_id`,
 1 AS `symptom_id`,
 1 AS `symptom_recorded_on`,
 1 AS `diagnosis_id`,
 1 AS `diagnosis_recorded_on`,
 1 AS `treatment_id`,
 1 AS `treatment_recorded_on`,
 1 AS `nursing_record_id`,
 1 AS `nursing_record_recorded_on`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `epide_analysis`
--

DROP TABLE IF EXISTS `epide_analysis`;
/*!50001 DROP VIEW IF EXISTS `epide_analysis`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `epide_analysis` AS SELECT 
 1 AS `PID`,
 1 AS `ID`,
 1 AS `Married`,
 1 AS `age`,
 1 AS `addr`,
 1 AS `gender`,
 1 AS `Test`,
 1 AS `DiseaseCate`,
 1 AS `MedicalHis`,
 1 AS `recorded_on`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `specialty`
--

DROP TABLE IF EXISTS `specialty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specialty` (
  `Specname` varchar(30) NOT NULL,
  `pnum` int(11) DEFAULT NULL,
  `dnum` int(11) unsigned NOT NULL DEFAULT '0',
  `nnum` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Specname`),
  UNIQUE KEY `Specname_UNIQUE` (`Specname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specialty`
--

LOCK TABLES `specialty` WRITE;
/*!40000 ALTER TABLE `specialty` DISABLE KEYS */;
INSERT INTO `specialty` VALUES ('Andrology',1,0,0),('Dentistry',1,0,0),('Gynecology',1,0,0),('Ophtalmology department',1,0,0),('Pediatrics',10,0,0),('Physician',1,0,0),('Radiology department',1,0,0),('Respiratory department',1,0,0),('Surgery',1,0,0),('Urology department',1,0,0);
/*!40000 ALTER TABLE `specialty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_diagnosis`
--

DROP TABLE IF EXISTS `tb_diagnosis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_diagnosis` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Test` tinytext,
  `DiseaseCate` tinytext,
  `Suggestion` tinytext,
  `MedicalHis` tinytext,
  `recorded_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Pid` int(11) DEFAULT NULL,
  `Did` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  KEY `foreign2_idx` (`Did`),
  KEY `foreign1_idx` (`Pid`),
  CONSTRAINT `foreign1` FOREIGN KEY (`Pid`) REFERENCES `tb_patients` (`PID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `foreign2` FOREIGN KEY (`Did`) REFERENCES `tb_doctors` (`Did`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_diagnosis`
--

LOCK TABLES `tb_diagnosis` WRITE;
/*!40000 ALTER TABLE `tb_diagnosis` DISABLE KEYS */;
INSERT INTO `tb_diagnosis` VALUES (1,'Blood Test','anemia','Drink more water','No','2016-05-05 03:15:24',127,1),(3,'surgical department test',' Andrology','Be carefully','No','2016-05-25 20:23:54',129,1);
/*!40000 ALTER TABLE `tb_diagnosis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_doctors`
--

DROP TABLE IF EXISTS `tb_doctors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_doctors` (
  `Did` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `title` int(11) DEFAULT NULL,
  `specname` varchar(30) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`Did`),
  UNIQUE KEY `Did_UNIQUE` (`Did`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `specname_idx` (`specname`),
  KEY `email` (`email`),
  CONSTRAINT `specname` FOREIGN KEY (`specname`) REFERENCES `specialty` (`Specname`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_doctors`
--

LOCK TABLES `tb_doctors` WRITE;
/*!40000 ALTER TABLE `tb_doctors` DISABLE KEYS */;
INSERT INTO `tb_doctors` VALUES (1,'Frank',1,'Pediatrics','98989@qq.com'),(2,'Kobe',2,'Dentistry','Kobe@denntist.com'),(3,'John',1,'Pediatrics','John@hit.edu.cn'),(4,'Obama',3,'Surgery','Obama@qq.com'),(6,'Johansson',3,'Gynecology','Johansson@qq.com'),(7,'Kelly',1,'Ophtalmology department','Kelly@qq.com'),(10,'Lamada',1,'Radiology department','Lamada@qq.com');
/*!40000 ALTER TABLE `tb_doctors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_nurses`
--

DROP TABLE IF EXISTS `tb_nurses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_nurses` (
  `Nid` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `pos` varchar(45) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `specname` varchar(30) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`Nid`),
  UNIQUE KEY `Nid_UNIQUE` (`Nid`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `specname_idx` (`specname`),
  KEY `email` (`email`),
  CONSTRAINT `foreignkey1` FOREIGN KEY (`specname`) REFERENCES `specialty` (`Specname`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_nurses`
--

LOCK TABLES `tb_nurses` WRITE;
/*!40000 ALTER TABLE `tb_nurses` DISABLE KEYS */;
INSERT INTO `tb_nurses` VALUES (1,'Kelly','Primary Nurse',1,'Pediatrics','989823@qq.com'),(2,'Abbey','Principle',1,'Pediatrics','Abbey@qq.com'),(3,'Athena','Associate',1,'Pediatrics','Athena@qq.com'),(7,'Loya','Principle',1,'Surgery','Loya@qq.com');
/*!40000 ALTER TABLE `tb_nurses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_nursingrecord`
--

DROP TABLE IF EXISTS `tb_nursingrecord`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_nursingrecord` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `evaluation` tinytext,
  `State` tinytext,
  `Nid` int(11) DEFAULT NULL,
  `Pid` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  KEY `Nid_idx` (`Nid`),
  KEY `nursing_foreign2_idx` (`Pid`),
  CONSTRAINT `nursing_foreign1` FOREIGN KEY (`Nid`) REFERENCES `tb_nurses` (`Nid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `nursing_foreign2` FOREIGN KEY (`Pid`) REFERENCES `tb_patients` (`PID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_nursingrecord`
--

LOCK TABLES `tb_nursingrecord` WRITE;
/*!40000 ALTER TABLE `tb_nursingrecord` DISABLE KEYS */;
INSERT INTO `tb_nursingrecord` VALUES (5,'可以减少药量','今天状态很好',1,123,'2016-05-28'),(7,'减少药量','状态比较好',1,127,'2016-05-11'),(8,'病情基本康复','今天状态很好',1,127,'2016-05-26'),(9,'Fine','Fine',1,123,'2016-05-13'),(10,'Medicine Less','Fine ',2,129,'2016-05-12');
/*!40000 ALTER TABLE `tb_nursingrecord` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_patients`
--

DROP TABLE IF EXISTS `tb_patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_patients` (
  `PID` int(11) NOT NULL AUTO_INCREMENT,
  `Married` tinyint(1) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `outdate` date DEFAULT NULL,
  `indate` date DEFAULT NULL,
  `addr` varchar(45) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `Did` int(11) DEFAULT NULL,
  `Nid` int(11) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `is_recovered` tinyint(1) DEFAULT '0',
  `password` varchar(30) DEFAULT NULL,
  `specname` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`PID`),
  UNIQUE KEY `PID_UNIQUE` (`PID`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `Did_idx` (`Did`),
  KEY `Nid_idx` (`Nid`),
  KEY `foreign1_pa_idx` (`specname`),
  KEY `email` (`email`),
  CONSTRAINT `Did` FOREIGN KEY (`Did`) REFERENCES `tb_doctors` (`Did`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Nid` FOREIGN KEY (`Nid`) REFERENCES `tb_nurses` (`Nid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `foreign1_pa` FOREIGN KEY (`specname`) REFERENCES `specialty` (`Specname`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_patients`
--

LOCK TABLES `tb_patients` WRITE;
/*!40000 ALTER TABLE `tb_patients` DISABLE KEYS */;
INSERT INTO `tb_patients` VALUES (123,1,20,'Mike','2016-05-12','2016-05-13','HIT A-18',1,1,1,'hit@qq.com',0,NULL,NULL),(125,NULL,NULL,'Richard Chen',NULL,NULL,NULL,NULL,NULL,NULL,'123456789@qq.com',0,'df994dd159e0f1e',NULL),(126,NULL,NULL,'Hello',NULL,NULL,NULL,NULL,NULL,NULL,'shuangchen1994@163.com',0,'15e2b0d3c33891e',NULL),(127,0,20,'Miya','2016-05-02','2016-05-12','哈工大英才学院A18公寓2011室',1,1,1,'zy@163.com',0,'df994dd159e0f1e',NULL),(128,0,20,'Nil',NULL,NULL,'HIT',0,4,7,'Nil@qq.com',0,'8d969eef6ecad3c',NULL),(129,0,20,'Frank WAN','2016-05-28','2016-05-25','HIT A18-2011 Dorm',0,1,2,'Frank@qq.com',0,'8d969eef6ecad3c',NULL);
/*!40000 ALTER TABLE `tb_patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_prescription`
--

DROP TABLE IF EXISTS `tb_prescription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_prescription` (
  `Psid` int(11) NOT NULL AUTO_INCREMENT,
  `Tid` int(11) DEFAULT NULL,
  `recorded_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `drug` tinytext,
  `dosage` tinytext,
  PRIMARY KEY (`Psid`),
  UNIQUE KEY `PrescripID_UNIQUE` (`Psid`),
  KEY `pre_foreign1_idx` (`Tid`),
  CONSTRAINT `pre_foreign1` FOREIGN KEY (`Tid`) REFERENCES `tb_treatment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_prescription`
--

LOCK TABLES `tb_prescription` WRITE;
/*!40000 ALTER TABLE `tb_prescription` DISABLE KEYS */;
INSERT INTO `tb_prescription` VALUES (1,12,'2016-05-25 19:24:12','dsa','dsad'),(2,13,'2016-05-25 19:29:25','Vitame','2 times a week'),(3,14,'2016-05-25 20:24:26','Vitame','2 times a week');
/*!40000 ALTER TABLE `tb_prescription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_symptom`
--

DROP TABLE IF EXISTS `tb_symptom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_symptom` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `symptom` tinytext,
  `complain` tinytext,
  `PID` int(11) DEFAULT NULL,
  `DID` int(11) DEFAULT NULL,
  `recorded_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  KEY `sym_foreign2_idx` (`DID`),
  KEY `sym_foreign1_idx` (`PID`),
  CONSTRAINT `sym_foreign1` FOREIGN KEY (`PID`) REFERENCES `tb_patients` (`PID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `sym_foreign2` FOREIGN KEY (`DID`) REFERENCES `tb_doctors` (`Did`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_symptom`
--

LOCK TABLES `tb_symptom` WRITE;
/*!40000 ALTER TABLE `tb_symptom` DISABLE KEYS */;
INSERT INTO `tb_symptom` VALUES (1,'have a temperature','Headache ',123,1,'2016-05-25 17:00:58'),(5,'Dan....','DanTeng',129,1,'2016-05-25 20:22:50');
/*!40000 ALTER TABLE `tb_symptom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_treatment`
--

DROP TABLE IF EXISTS `tb_treatment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_treatment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `InHospital` tinyint(1) DEFAULT NULL,
  `IsOperation` tinyint(1) DEFAULT NULL,
  `Remarks` tinytext,
  `patient_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `recorded_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `TID_UNIQUE` (`id`),
  KEY `Pid_idx` (`patient_id`),
  KEY `Foreignkey1_idx` (`doctor_id`),
  CONSTRAINT `foreign1_treatment` FOREIGN KEY (`doctor_id`) REFERENCES `tb_doctors` (`Did`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `foreign2_treatment` FOREIGN KEY (`patient_id`) REFERENCES `tb_patients` (`PID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_treatment`
--

LOCK TABLES `tb_treatment` WRITE;
/*!40000 ALTER TABLE `tb_treatment` DISABLE KEYS */;
INSERT INTO `tb_treatment` VALUES (1,1,1,'Surgery operation',127,1,'2016-05-25 10:13:10'),(12,0,0,'dsad',123,1,'2016-05-25 19:24:12'),(13,1,1,'Drink more water ',123,1,'2016-05-25 19:29:25'),(14,0,0,'Medicine Based Treatment',129,1,'2016-05-25 20:24:26');
/*!40000 ALTER TABLE `tb_treatment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `treatment_eval`
--

DROP TABLE IF EXISTS `treatment_eval`;
/*!50001 DROP VIEW IF EXISTS `treatment_eval`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `treatment_eval` AS SELECT 
 1 AS `PID`,
 1 AS `Test`,
 1 AS `DiseaseCate`,
 1 AS `diagnosis_recorded_on`,
 1 AS `Remarks`,
 1 AS `treatment_recorded_on`,
 1 AS `State`,
 1 AS `evaluation`,
 1 AS `nursing_record_recorded_on`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `clinical_process`
--

/*!50001 DROP VIEW IF EXISTS `clinical_process`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `clinical_process` AS select `tb_patients`.`PID` AS `patient_id`,`tb_symptom`.`ID` AS `symptom_id`,`tb_symptom`.`recorded_on` AS `symptom_recorded_on`,`tb_diagnosis`.`ID` AS `diagnosis_id`,`tb_diagnosis`.`recorded_on` AS `diagnosis_recorded_on`,`tb_treatment`.`id` AS `treatment_id`,`tb_treatment`.`recorded_on` AS `treatment_recorded_on`,`tb_nursingrecord`.`ID` AS `nursing_record_id`,`tb_nursingrecord`.`date` AS `nursing_record_recorded_on` from ((((`tb_patients` join `tb_symptom`) join `tb_diagnosis`) join `tb_treatment`) join `tb_nursingrecord`) where ((`tb_patients`.`PID` = `tb_diagnosis`.`Pid`) and (`tb_symptom`.`PID` = `tb_patients`.`PID`) and (`tb_treatment`.`patient_id` = `tb_patients`.`PID`) and (`tb_nursingrecord`.`Pid` = `tb_patients`.`PID`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `epide_analysis`
--

/*!50001 DROP VIEW IF EXISTS `epide_analysis`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `epide_analysis` AS select `tb_patients`.`PID` AS `PID`,`tb_diagnosis`.`ID` AS `ID`,`tb_patients`.`Married` AS `Married`,`tb_patients`.`age` AS `age`,`tb_patients`.`addr` AS `addr`,`tb_patients`.`gender` AS `gender`,`tb_diagnosis`.`Test` AS `Test`,`tb_diagnosis`.`DiseaseCate` AS `DiseaseCate`,`tb_diagnosis`.`MedicalHis` AS `MedicalHis`,`tb_diagnosis`.`recorded_on` AS `recorded_on` from (`tb_diagnosis` join `tb_patients`) where (`tb_diagnosis`.`Pid` = `tb_patients`.`PID`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `treatment_eval`
--

/*!50001 DROP VIEW IF EXISTS `treatment_eval`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `treatment_eval` AS select `tb_patients`.`PID` AS `PID`,`tb_diagnosis`.`Test` AS `Test`,`tb_diagnosis`.`DiseaseCate` AS `DiseaseCate`,`tb_diagnosis`.`recorded_on` AS `diagnosis_recorded_on`,`tb_treatment`.`Remarks` AS `Remarks`,`tb_treatment`.`recorded_on` AS `treatment_recorded_on`,`tb_nursingrecord`.`State` AS `State`,`tb_nursingrecord`.`evaluation` AS `evaluation`,`tb_nursingrecord`.`date` AS `nursing_record_recorded_on` from (((`tb_patients` join `tb_diagnosis`) join `tb_treatment`) join `tb_nursingrecord`) where ((`tb_diagnosis`.`Pid` = `tb_patients`.`PID`) and (`tb_treatment`.`patient_id` = `tb_patients`.`PID`) and (`tb_nursingrecord`.`Pid` = `tb_patients`.`PID`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-25 23:04:53
