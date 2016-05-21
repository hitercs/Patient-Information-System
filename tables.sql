-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 192.168.56.1    Database: mydb
-- ------------------------------------------------------
-- Server version	5.7.9-log

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

--
-- Table structure for table `re_shown`
--

DROP TABLE IF EXISTS `re_shown`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `re_shown` (
  `ID` int(11) NOT NULL,
  `Pid` int(11) DEFAULT NULL,
  `Sid` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  KEY `Pid_idx` (`Pid`),
  KEY `Sid_idx` (`Sid`),
  CONSTRAINT `Pid` FOREIGN KEY (`Pid`) REFERENCES `tb_patients` (`PID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Sid` FOREIGN KEY (`Sid`) REFERENCES `tb_symptom` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_shown`
--

LOCK TABLES `re_shown` WRITE;
/*!40000 ALTER TABLE `re_shown` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_shown` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specialty`
--

DROP TABLE IF EXISTS `specialty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specialty` (
  `Specname` varchar(25) NOT NULL,
  `pnum` int(11) DEFAULT NULL,
  PRIMARY KEY (`Specname`),
  UNIQUE KEY `Specname_UNIQUE` (`Specname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specialty`
--

LOCK TABLES `specialty` WRITE;
/*!40000 ALTER TABLE `specialty` DISABLE KEYS */;
/*!40000 ALTER TABLE `specialty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_diagnosis`
--

DROP TABLE IF EXISTS `tb_diagnosis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_diagnosis` (
  `ID` int(11) NOT NULL,
  `Test` varchar(45) DEFAULT NULL,
  `DiseaseCate` varchar(45) DEFAULT NULL,
  `Suggestion` varchar(45) DEFAULT NULL,
  `MedicalHis` varchar(45) DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `Pid` int(11) DEFAULT NULL,
  `Did` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  KEY `Pid_idx` (`Pid`),
  KEY `Did_idx` (`Did`),
  CONSTRAINT `foreign1` FOREIGN KEY (`Pid`) REFERENCES `tb_patients` (`PID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `foreign2` FOREIGN KEY (`Did`) REFERENCES `tb_doctors` (`Did`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_diagnosis`
--

LOCK TABLES `tb_diagnosis` WRITE;
/*!40000 ALTER TABLE `tb_diagnosis` DISABLE KEYS */;
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
  `specname` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Did`),
  UNIQUE KEY `Did_UNIQUE` (`Did`),
  KEY `specname_idx` (`specname`),
  CONSTRAINT `specname` FOREIGN KEY (`specname`) REFERENCES `specialty` (`Specname`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_doctors`
--

LOCK TABLES `tb_doctors` WRITE;
/*!40000 ALTER TABLE `tb_doctors` DISABLE KEYS */;
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
  `specname` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Nid`),
  UNIQUE KEY `Nid_UNIQUE` (`Nid`),
  KEY `specname_idx` (`specname`),
  CONSTRAINT `foreignkey1` FOREIGN KEY (`specname`) REFERENCES `specialty` (`Specname`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_nurses`
--

LOCK TABLES `tb_nurses` WRITE;
/*!40000 ALTER TABLE `tb_nurses` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_nurses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_nursingrecord`
--

DROP TABLE IF EXISTS `tb_nursingrecord`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_nursingrecord` (
  `ID` int(11) NOT NULL,
  `Remark` varchar(45) DEFAULT NULL,
  `State` varchar(45) DEFAULT NULL,
  `Nid` int(11) DEFAULT NULL,
  `Pid` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  KEY `Nid_idx` (`Nid`),
  KEY `Pid_idx` (`Pid`),
  CONSTRAINT `nursing_foreign1` FOREIGN KEY (`Nid`) REFERENCES `tb_nurses` (`Nid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `nursing_foreign2` FOREIGN KEY (`Pid`) REFERENCES `tb_patients` (`PID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_nursingrecord`
--

LOCK TABLES `tb_nursingrecord` WRITE;
/*!40000 ALTER TABLE `tb_nursingrecord` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_nursingrecord` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_patients`
--

DROP TABLE IF EXISTS `tb_patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_patients` (
  `PID` int(11) NOT NULL,
  `Married` tinyint(1) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `outdate` datetime DEFAULT NULL,
  `indate` datetime DEFAULT NULL,
  `addr` varchar(45) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `Did` int(11) DEFAULT NULL,
  `Nid` int(11) DEFAULT NULL,
  PRIMARY KEY (`PID`),
  UNIQUE KEY `PID_UNIQUE` (`PID`),
  KEY `Did_idx` (`Did`),
  KEY `Nid_idx` (`Nid`),
  CONSTRAINT `Did` FOREIGN KEY (`Did`) REFERENCES `tb_doctors` (`Did`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Nid` FOREIGN KEY (`Nid`) REFERENCES `tb_nurses` (`Nid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_patients`
--

LOCK TABLES `tb_patients` WRITE;
/*!40000 ALTER TABLE `tb_patients` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_prescription`
--

DROP TABLE IF EXISTS `tb_prescription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_prescription` (
  `PrescripID` decimal(10,0) NOT NULL,
  `Date` datetime DEFAULT NULL,
  `Medications` varchar(45) DEFAULT NULL,
  `tb_prescriptioncol` varchar(45) DEFAULT NULL,
  `Tid` int(11) DEFAULT NULL,
  PRIMARY KEY (`PrescripID`),
  UNIQUE KEY `PrescripID_UNIQUE` (`PrescripID`),
  KEY `Tid_idx` (`Tid`),
  CONSTRAINT `precription_foreign1` FOREIGN KEY (`Tid`) REFERENCES `tb_treatment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_prescription`
--

LOCK TABLES `tb_prescription` WRITE;
/*!40000 ALTER TABLE `tb_prescription` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_prescription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_symptom`
--

DROP TABLE IF EXISTS `tb_symptom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_symptom` (
  `ID` int(11) NOT NULL,
  `basic state` varchar(45) DEFAULT NULL,
  `oraldescription` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_symptom`
--

LOCK TABLES `tb_symptom` WRITE;
/*!40000 ALTER TABLE `tb_symptom` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_symptom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_treatment`
--

DROP TABLE IF EXISTS `tb_treatment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_treatment` (
  `id` int(11) NOT NULL,
  `InHospital` tinyint(1) DEFAULT NULL,
  `IsOperation` tinyint(1) DEFAULT NULL,
  `Remarks` varchar(45) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `TID_UNIQUE` (`id`),
  KEY `Pid_idx` (`patient_id`),
  KEY `Foreignkey1_idx` (`doctor_id`),
  CONSTRAINT `foreign1_treatment` FOREIGN KEY (`doctor_id`) REFERENCES `tb_doctors` (`Did`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `foreign2_treatment` FOREIGN KEY (`patient_id`) REFERENCES `tb_patients` (`PID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_treatment`
--

LOCK TABLES `tb_treatment` WRITE;
/*!40000 ALTER TABLE `tb_treatment` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_treatment` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-19 19:20:55
