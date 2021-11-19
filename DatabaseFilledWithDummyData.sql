-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: databasedesign
-- ------------------------------------------------------
-- Server version	8.0.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `AdminUsername` varchar(20) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  PRIMARY KEY (`AdminUsername`),
  UNIQUE KEY `Email_UNIQUE` (`Email`),
  UNIQUE KEY `AdminUsername_UNIQUE` (`AdminUsername`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('adover','ashqtcat12@gmail.com','Ashley','Dover','5512'),('jdoberman','jakeyjake@gmail.com','Jake','Doberman','tree43'),('jdoe','normal@gmail.com','John','Doe','password123'),('jedelman','joredelma3@gmail.com','Jordan','Edelman','porkyM99'),('jsmith','johnsmith@yahoo.com','John','Smith','john12'),('mchief','halo@gmail.com','Master','Chief','also6halo'),('msed','michael.sedlack@knights.ucf.edu','Michael','Sedlack','GoKnights'),('mwise','mitchellswise@gmail.com','Mitch ','Wise','123'),('pminch','ness@gmail.com','Porky','Minch','P@55w0rd'),('ralien','Aliens@gmail.com','Ripley','Alien','Robot3'),('rgay','ryangay92@gmail.com','Ryan','Gay','dover19'),('rzanchez','tvshow@yahoo.com','Rick','Sanchez','Circle'),('sman','clark@aol.com','Super','Man','0pants'),('ztowelson','zzt2018@yahoo.com','Zeke','Towelson','zekeman10');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deadlines`
--

DROP TABLE IF EXISTS `deadlines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deadlines` (
  `Semester` varchar(12) NOT NULL,
  `Deadline Date` date NOT NULL,
  PRIMARY KEY (`Semester`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deadlines`
--

LOCK TABLES `deadlines` WRITE;
/*!40000 ALTER TABLE `deadlines` DISABLE KEYS */;
INSERT INTO `deadlines` VALUES ('Fall2021','2021-08-20'),('Fall2022','2022-07-20'),('Spring2022','2021-12-20'),('Spring2023','2022-12-20'),('Summer2022','2022-04-20');
/*!40000 ALTER TABLE `deadlines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faculty` (
  `FacultyUsername` varchar(20) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  PRIMARY KEY (`FacultyUsername`),
  UNIQUE KEY `Email_UNIQUE` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faculty`
--

LOCK TABLES `faculty` WRITE;
/*!40000 ALTER TABLE `faculty` DISABLE KEYS */;
INSERT INTO `faculty` VALUES ('Professional','alice@gmail.com','Alice','Wonder','abcdefg'),('Steve','Steve@steve.com','Ste','ve','steveiscool'),('teachman','teachman@gmail.com','Tee','Eachman','iLoveTeaching'),('TheLibrarian','librarianjane@ucf.edu','Jane','Earnest','booksAndSuch');
/*!40000 ALTER TABLE `faculty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_list`
--

DROP TABLE IF EXISTS `forms_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forms_list` (
  `FacultyUsername` varchar(20) NOT NULL,
  `Semester` varchar(12) NOT NULL,
  `FormID` int NOT NULL,
  UNIQUE KEY `FormID_UNIQUE` (`FormID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_list`
--

LOCK TABLES `forms_list` WRITE;
/*!40000 ALTER TABLE `forms_list` DISABLE KEYS */;
INSERT INTO `forms_list` VALUES ('Steve','Fall2021',1),('Professional','Fall2021',2),('TheLibrarian','Fall2021',3),('Steve','Spring2022',4),('Professional','Spring2022',5),('TheLibrarian','Spring2022',6);
/*!40000 ALTER TABLE `forms_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `individual_forms`
--

DROP TABLE IF EXISTS `individual_forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `individual_forms` (
  `FormID` int NOT NULL,
  `Class` varchar(45) NOT NULL,
  `Title` varchar(45) NOT NULL,
  `Authors` varchar(45) NOT NULL,
  `Edition` int NOT NULL,
  `Publisher` varchar(45) NOT NULL,
  `ISBN` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `individual_forms`
--

LOCK TABLES `individual_forms` WRITE;
/*!40000 ALTER TABLE `individual_forms` DISABLE KEYS */;
INSERT INTO `individual_forms` VALUES (1,'WhoCares','I Got Nothing','Unknown',40,'Random House',12),(2,'Less Old Books','Tales from Shakespeare','Carles and Mary Lamb',1,'Unkown',424),(1,'WhoCares','I Got Nothing','Unknown',40,'Random House',12),(1,'Old Books','Divine Songs','Isaac Watts',1,'Unknown',3),(1,'Old Books','The Little Pretty Pocket-Book','John Newbery',1,'Unkown',5555),(2,'Less Old Books','Tales from Shakespeare','Carles and Mary Lamb',1,'Unkown',424),(2,'Less Old Books','The Rose and the Ring','William Makepeace Thackeray',34,'Warner Bros',420);
/*!40000 ALTER TABLE `individual_forms` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-19 15:54:52
