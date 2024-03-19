

CREATE TABLE `classschedule` (
  `ClasscheduleID` int(11) NOT NULL AUTO_INCREMENT,
  `AcademicYear` varchar(255) DEFAULT NULL,
  `Department` varchar(255) DEFAULT NULL,
  `YearLevel` varchar(255) DEFAULT NULL,
  `Semester` varchar(255) DEFAULT NULL,
  `Strand` varchar(255) DEFAULT NULL,
  `Day` varchar(255) DEFAULT NULL,
  `Time_Start` varchar(255) DEFAULT NULL,
  `Time_End` varchar(255) DEFAULT NULL,
  `Subject` varchar(255) DEFAULT NULL,
  `Instructor` varchar(255) DEFAULT NULL,
  `Room` varchar(255) DEFAULT NULL,
  `Section` varchar(255) DEFAULT NULL,
  `Active` varchar(255) DEFAULT NULL,
  `CreatedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ClasscheduleID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO classschedule VALUES("1","2023-2024","Senior High School","11","1","ICT","M","08:00:00","09:00:00","Science","Jian Laurence","401","ICT - 1","2","");
INSERT INTO classschedule VALUES("2","2023-2024","Senior High School","11","1","ICT","W","08:00:00","09:00:00","Science","Jian Laurence","401","ICT - 1","2","");
INSERT INTO classschedule VALUES("3","2023-2024","Primary","1","","","M","08:00:00","12:00:00","Makabayan","Angel","402","Sampaguita","2","");
INSERT INTO classschedule VALUES("4","2023-2024","Primary","1","","","M","08:00:00","12:00:00","Makabayan","Jasmine","403","Gumamela","2","");
INSERT INTO classschedule VALUES("5","2023-2024","Senior High School","11","1","ICT","M","10:00:00","11:00:00","Statistic","Christopher","404","ICT - 2","2","");
INSERT INTO classschedule VALUES("6","2023-2024","Junior High School","7","","","M","13:00:00","14:00:00","Probability","Christopher","405","Rizal","2","");
INSERT INTO classschedule VALUES("7","2023-2024","Junior High School","7","","","M","14:00:00","15:00:00","Probability","Christopher","406","Bonifacio","2","");
INSERT INTO classschedule VALUES("8","2023","Senior High School","11","2","HE","M","08:00:00","09:00:00","Bartending NC II","Angel,,Carpeso","102","","0","");



CREATE TABLE `day` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Days` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO day VALUES("1","Monday");
INSERT INTO day VALUES("2","Tuesday");
INSERT INTO day VALUES("3","Wednesday");
INSERT INTO day VALUES("4","Thursday");
INSERT INTO day VALUES("5","Friday");



CREATE TABLE `department` (
  `DepartmentID` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentTypeNameID` int(11) NOT NULL,
  `YearLevel` int(11) NOT NULL,
  `Semester` int(11) DEFAULT NULL,
  `StrandID` int(11) DEFAULT NULL,
  `Active` int(11) NOT NULL,
  PRIMARY KEY (`DepartmentID`),
  KEY `department_ibfk_1` (`DepartmentTypeNameID`),
  KEY `department_ibfk_2` (`StrandID`),
  CONSTRAINT `department_ibfk_1` FOREIGN KEY (`StrandID`) REFERENCES `strands` (`StrandID`),
  CONSTRAINT `department_ibfk_2` FOREIGN KEY (`DepartmentTypeNameID`) REFERENCES `departmenttypename` (`DepartmentTypeNameID`)
) ENGINE=InnoDB AUTO_INCREMENT=416 DEFAULT CHARSET=utf8mb4;

INSERT INTO department VALUES("4","2","10","","","1");
INSERT INTO department VALUES("5","2","9","","","1");
INSERT INTO department VALUES("6","2","8","","","1");
INSERT INTO department VALUES("7","2","7","","","1");
INSERT INTO department VALUES("8","3","6","","","1");
INSERT INTO department VALUES("9","3","5","","","1");
INSERT INTO department VALUES("10","3","4","","","1");
INSERT INTO department VALUES("11","3","3","","","1");
INSERT INTO department VALUES("12","3","2","","","1");
INSERT INTO department VALUES("13","3","1","","","1");
INSERT INTO department VALUES("400","1","11","1","152","1");
INSERT INTO department VALUES("401","1","11","2","152","1");
INSERT INTO department VALUES("402","1","12","1","152","1");
INSERT INTO department VALUES("403","1","12","2","152","1");
INSERT INTO department VALUES("404","1","11","1","153","1");
INSERT INTO department VALUES("405","1","11","2","153","1");
INSERT INTO department VALUES("406","1","12","1","153","1");
INSERT INTO department VALUES("407","1","12","2","153","1");
INSERT INTO department VALUES("408","1","11","1","154","1");
INSERT INTO department VALUES("409","1","11","2","154","1");
INSERT INTO department VALUES("410","1","12","1","154","1");
INSERT INTO department VALUES("411","1","12","2","154","1");
INSERT INTO department VALUES("412","1","11","1","155","1");
INSERT INTO department VALUES("413","1","11","2","155","1");
INSERT INTO department VALUES("414","1","12","1","155","1");
INSERT INTO department VALUES("415","1","12","2","155","1");



CREATE TABLE `departmenttypename` (
  `DepartmentTypeNameID` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentTypeName` varchar(45) NOT NULL,
  PRIMARY KEY (`DepartmentTypeNameID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO departmenttypename VALUES("1","Senior High School");
INSERT INTO departmenttypename VALUES("2","Junior High School");
INSERT INTO departmenttypename VALUES("3","Primary");



CREATE TABLE `history` (
  `ClassScheduleID` int(11) NOT NULL AUTO_INCREMENT,
  `AcademicYear` varchar(255) NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  `YearLevel` int(11) NOT NULL,
  `Semester` int(11) DEFAULT NULL,
  `Strand` varchar(255) DEFAULT NULL,
  `InstructorPreferredSubjectID` int(11) NOT NULL,
  `Instructor` varchar(255) NOT NULL,
  `SubjectDescription` varchar(255) NOT NULL,
  `InstructorTimeAvailabilityID` int(11) NOT NULL,
  `Day` varchar(255) NOT NULL,
  `Time_Start` varchar(255) NOT NULL,
  `Time_End` varchar(255) NOT NULL,
  `RoomID` int(11) NOT NULL,
  `New_Time_Start` varchar(255) NOT NULL,
  `New_Time_End` varchar(255) NOT NULL,
  `SectionID` int(11) DEFAULT NULL,
  `Status` int(11) NOT NULL,
  `Active` int(11) NOT NULL,
  PRIMARY KEY (`ClassScheduleID`),
  KEY `DepartmentID` (`DepartmentID`),
  KEY `InstructorPreferredSubjectID` (`InstructorPreferredSubjectID`),
  KEY `InstructorTimeAvailabilityID` (`InstructorTimeAvailabilityID`),
  KEY `RoomID` (`RoomID`),
  KEY `SectionID` (`SectionID`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4;

INSERT INTO history VALUES("109","2023-2024","338","11","1","ICT","15","Laurence DSDFDSF","try","49","1","08:00:00","09:00:00","68","08:00:00","09:00:00","42","2","1");
INSERT INTO history VALUES("110","2023-2024","338","11","1","ICT","15","Laurence DSDFDSF","try","50","2","08:00:00","09:00:00","68","08:00:00","09:00:00","42","2","1");
INSERT INTO history VALUES("111","2023-2024","338","11","1","ICT","15","Laurence DSDFDSF","try","53","5","13:00:00","14:00:00","68","13:00:00","14:00:00","42","2","1");
INSERT INTO history VALUES("112","2023-2024","350","11","1","ABM","19","Shizuka Doraemon","dsjksdbf","54","1","08:00:00","09:00:00","79","08:00:00","09:00:00","42","2","1");
INSERT INTO history VALUES("113","2023-2024","350","11","1","ABM","15","Laurence DSDFDSF","try","53","5","16:00:00","17:00:00","71","16:00:00","17:00:00","46","0","1");



CREATE TABLE `instructor` (
  `InstructorID` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentID` int(11) NOT NULL,
  `Fname` varchar(45) NOT NULL,
  `Mname` varchar(45) NOT NULL,
  `Lname` varchar(45) NOT NULL,
  `Gender` enum('Female','Male') NOT NULL,
  `Age` int(11) NOT NULL,
  `Birthday` varchar(45) NOT NULL,
  `Address` varchar(45) NOT NULL,
  `ContactNumber` varchar(11) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Specialization` varchar(45) NOT NULL,
  `Status` varchar(45) NOT NULL,
  `Active` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`InstructorID`),
  KEY `instructor_ibfk_1` (`DepartmentID`),
  CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`DepartmentID`) REFERENCES `departmenttypename` (`DepartmentTypeNameID`)
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=utf8mb4;

INSERT INTO instructor VALUES("196","1","Angel","","Carpeso","Female","21","2002-02-12","Zambales","935 921 840","angelmaecarpeso@gmail.com","English","Full Time","1","2023-11-25 03:24:45");
INSERT INTO instructor VALUES("197","1","Christopher ","","Dente","Male","21","2002-02-08","Block 1 Federico Upper st. Gordon Heights","912 733 920","tope@gmail.com","English, Mathematics","Full Time","1","2023-11-25 03:26:02");
INSERT INTO instructor VALUES("198","2","Christopher ","","Dente","Male","21","2002-02-08","Block 1 Federico Upper st. Gordon Heights","912 733 920","tope@gmail.com","English, Mathematics","Full Time","1","2023-11-25 03:26:02");



CREATE TABLE `instructorpreferredsubject` (
  `InstructorPreferredSubjectID` int(11) NOT NULL AUTO_INCREMENT,
  `InstructorID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Active` int(11) NOT NULL,
  PRIMARY KEY (`InstructorPreferredSubjectID`),
  KEY `InstructorID` (`InstructorID`),
  KEY `SubjectID` (`SubjectID`),
  CONSTRAINT `instructorpreferredsubject_ibfk_1` FOREIGN KEY (`InstructorID`) REFERENCES `instructor` (`InstructorID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;




CREATE TABLE `instructortimeavailabilities` (
  `InstructorTimeAvailabilityID` int(11) NOT NULL AUTO_INCREMENT,
  `DaysID` int(11) NOT NULL,
  `InstructorID` int(11) NOT NULL,
  `Time_Start` varchar(255) NOT NULL,
  `Time_End` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Active` int(11) NOT NULL,
  PRIMARY KEY (`InstructorTimeAvailabilityID`),
  KEY `DaysID` (`DaysID`),
  KEY `InstructorID` (`InstructorID`),
  CONSTRAINT `instructortimeavailabilities_ibfk_1` FOREIGN KEY (`InstructorID`) REFERENCES `instructor` (`InstructorID`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4;




CREATE TABLE `logs` (
  `LogID` int(11) NOT NULL AUTO_INCREMENT,
  `DateTime` varchar(45) NOT NULL,
  `Activity` varchar(255) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Active` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`LogID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=1390 DEFAULT CHARSET=utf8mb4;

INSERT INTO logs VALUES("1304","2023-11-23 01:44:19","Add Section 5 Mona 167","21","1","2023-11-23 08:44:19");
INSERT INTO logs VALUES("1305","2023-11-23 01:45:44","Add Section 1 ICT-1 175","21","1","2023-11-23 08:45:44");
INSERT INTO logs VALUES("1306","2023-11-23 01:50:25","Update Section: 1 (Section No: 1 -> 1, Section Name: ICT-12 -> ICT-1, Adviser: 175 -> 175)","21","1","2023-11-23 08:50:25");
INSERT INTO logs VALUES("1307","2023-11-23 01:50:52","Delete Section: 1<br> (Section Name: ICT-1)(Adviser : 175)","21","1","2023-11-23 08:50:52");
INSERT INTO logs VALUES("1308","2023-11-23 01:54:20","Delete Section: 1<br> (Section Name: ICT-1)(Adviser : 175)","21","1","2023-11-23 08:54:20");
INSERT INTO logs VALUES("1309","2023-11-23 01:56:28","Update Section: 2 (Section No: 2 -> 2, Section Name: Neptune1 -> Neptune, Adviser: Jian Laurence Salvedea Ebidag)","21","1","2023-11-23 08:56:28");
INSERT INTO logs VALUES("1310","2023-11-23 01:57:57","Delete Section: 2<br> (Section Name: Neptune) (Adviser : Jian Laurence Salvedea Ebidag)","21","1","2023-11-23 08:57:57");
INSERT INTO logs VALUES("1311","2023-11-23 02:01:26","Add Room: 301 (Lecture, Capacity: 30)","21","1","2023-11-23 09:01:26");
INSERT INTO logs VALUES("1312","2023-11-23 02:01:26","Add Room: 302 (Laboratory, Capacity: 30)","21","1","2023-11-23 09:01:26");
INSERT INTO logs VALUES("1313","2023-11-23 09:01:58","Updated Room: from RoomNumber: 102, Capacity: 30, RoomType: Lecture '->' RoomNumber: 102, Capacity: 30, RoomType: Laboratory","21","1","2023-11-23 09:01:58");
INSERT INTO logs VALUES("1314","2023-11-23 02:02:26","Delete Room: 301<br> (Room Capacity: 30)(RoomType : Lecture)","21","1","2023-11-23 09:02:26");
INSERT INTO logs VALUES("1315","2023-11-23 02:09:18","Delete Room: 302 (Room Capacity: 30) (RoomType: Laboratory)","21","1","2023-11-23 09:09:18");
INSERT INTO logs VALUES("1316","2023-11-23 02:24:33","Add Subject: MATH (Mathematics, Units: 1)","21","1","2023-11-23 09:24:33");
INSERT INTO logs VALUES("1317","2023-11-23 02:24:33","Add Subject: SCI (Science , Units: 1)","21","1","2023-11-23 09:24:33");
INSERT INTO logs VALUES("1318","2023-11-23 02:25:23","Update Subject: MATH (Subject Description: Mathematics -> Mathematics 1, Units: 1 -> 1)","21","1","2023-11-23 09:25:23");
INSERT INTO logs VALUES("1319","2023-11-23 02:25:48","Delete Subject: Mathematics 1 (Subject Code: MATH)","21","1","2023-11-23 09:25:48");
INSERT INTO logs VALUES("1320","2023-11-23 02:25:48","Delete Subject: Science  (Subject Code: SCI)","21","1","2023-11-23 09:25:48");
INSERT INTO logs VALUES("1321","2023-11-23 04:12:07","Add Room: 12 (Laboratory, Capacity: 30)","21","1","2023-11-23 11:12:07");
INSERT INTO logs VALUES("1322","2023-11-23 14:45:14","Added Instructor: Angel Carpeso","21","1","2023-11-23 21:45:14");
INSERT INTO logs VALUES("1323","2023-11-23 14:49:47","Added Instructor: Angel Carpeso","21","1","2023-11-23 21:49:47");
INSERT INTO logs VALUES("1324","2023-11-23 14:51:01","Added Instructor: Jin Ebidag","21","1","2023-11-23 21:51:01");
INSERT INTO logs VALUES("1325","2023-11-24 01:47:09","Added Instructor: Angelq1 Carpeso","21","1","2023-11-24 08:47:09");
INSERT INTO logs VALUES("1326","2023-11-24 02:13:57","Added Instructor: Jian Laurence Ebidag","21","1","2023-11-24 09:13:57");
INSERT INTO logs VALUES("1327","2023-11-24 02:31:04","Added Instructor: Angel Carpeso","21","1","2023-11-24 09:31:04");
INSERT INTO logs VALUES("1328","2023-11-24 02:51:09","Added Instructor: Angel12 Carpeso","21","1","2023-11-24 09:51:09");
INSERT INTO logs VALUES("1329","2023-11-24 02:52:29","Added Instructor: Christopher  Dente","21","1","2023-11-24 09:52:29");
INSERT INTO logs VALUES("1330","2023-11-24 03:13:32","Added Instructor: REdq Carpeso","21","1","2023-11-24 10:13:32");
INSERT INTO logs VALUES("1331","2023-11-24 03:26:44","Added Instructor: s s","21","1","2023-11-24 10:26:44");
INSERT INTO logs VALUES("1332","2023-11-24 06:54:09","Delete Instructor:  -> ,   -> ,   -> , ","21","1","2023-11-24 13:54:09");
INSERT INTO logs VALUES("1333","2023-11-24 06:54:16","Delete Instructor:  -> ,   -> ,   -> , ","21","1","2023-11-24 13:54:16");
INSERT INTO logs VALUES("1334","2023-11-24 06:56:36","Delete Instructor:   ","21","1","2023-11-24 13:56:36");
INSERT INTO logs VALUES("1335","2023-11-24 07:33:47","Added Instructor: Jian Ebidag","21","1","2023-11-24 14:33:47");
INSERT INTO logs VALUES("1336","2023-11-24 07:34:17","Update Instructor: Jian Ebidag","21","1","2023-11-24 14:34:17");
INSERT INTO logs VALUES("1337","2023-11-24 07:34:39","Delete Instructor: Jian Laurence Salvedea Ebidag","21","1","2023-11-24 14:34:39");
INSERT INTO logs VALUES("1338","2023-11-24 11:05:18","Added Strand: STEM","21","1","2023-11-24 18:05:18");
INSERT INTO logs VALUES("1339","2023-11-24 11:08:51","Added Strand: ABM","21","1","2023-11-24 18:08:51");
INSERT INTO logs VALUES("1340","2023-11-24 11:56:21","Added Strand: ABM","21","1","2023-11-24 18:56:21");
INSERT INTO logs VALUES("1341","2023-11-24 11:56:27","Added Strand: ABM","21","1","2023-11-24 18:56:27");
INSERT INTO logs VALUES("1342","2023-11-24 12:54:00","Added Strand: GAS","21","1","2023-11-24 19:54:00");
INSERT INTO logs VALUES("1343","2023-11-24 12:54:09","Added Strand: GAS","21","1","2023-11-24 19:54:09");
INSERT INTO logs VALUES("1344","2023-11-24 12:54:58","Added Strand: GAS","21","1","2023-11-24 19:54:58");
INSERT INTO logs VALUES("1345","2023-11-24 16:02:59","Updated Strand: ABM","21","1","2023-11-24 23:02:59");
INSERT INTO logs VALUES("1346","2023-11-24 16:11:35","Updated Strand: ABM","21","1","2023-11-24 23:11:35");
INSERT INTO logs VALUES("1347","2023-11-24 16:22:04","Delete Strand: GAS General Academic Strand 57","21","1","2023-11-24 23:22:04");
INSERT INTO logs VALUES("1348","2023-11-24 16:22:22","Delete Strand: ABM Accountancy and Business Management 30","21","1","2023-11-24 23:22:22");
INSERT INTO logs VALUES("1349","2023-11-24 16:22:27","Delete Strand: ABM Accountancy and Business Management 32","21","1","2023-11-24 23:22:27");
INSERT INTO logs VALUES("1350","2023-11-24 16:22:36","Delete Strand: ABM Accountancy and Business Management 54","21","1","2023-11-24 23:22:36");
INSERT INTO logs VALUES("1351","2023-11-24 16:23:46","Delete Strand: GAS General Academic Strand","21","1","2023-11-24 23:23:46");
INSERT INTO logs VALUES("1352","2023-11-24 16:26:52","Added Strand: GAS","21","1","2023-11-24 23:26:52");
INSERT INTO logs VALUES("1353","2023-11-24 19:03:40","Account Unlocked","21","1","2023-11-25 02:03:40");
INSERT INTO logs VALUES("1354","2023-11-24 19:03:47","Account Unlocked","21","1","2023-11-25 02:03:47");
INSERT INTO logs VALUES("1355","2023-11-24 19:04:36","Account Locked","21","1","2023-11-25 02:04:36");
INSERT INTO logs VALUES("1356","2023-11-24 19:04:58","Account Unlocked","21","1","2023-11-25 02:04:58");
INSERT INTO logs VALUES("1357","2023-11-24 19:05:36","Account Unlocked","21","1","2023-11-25 02:05:36");
INSERT INTO logs VALUES("1358","2023-11-24 19:05:59","Account Locked","21","1","2023-11-25 02:05:59");
INSERT INTO logs VALUES("1359","2023-11-24 19:07:43","Admin locked account for user: Christopher1234","21","1","2023-11-25 02:07:43");
INSERT INTO logs VALUES("1360","2023-11-24 19:09:06","Account Unlocked for user: Christopher1234","21","1","2023-11-25 02:09:06");
INSERT INTO logs VALUES("1361","2023-11-24 19:22:28","Account Unlocked for user: Angel1234","21","1","2023-11-25 02:22:28");
INSERT INTO logs VALUES("1362","2023-11-24 19:22:53","Admin locked account for user: Angel1234","21","1","2023-11-25 02:22:53");
INSERT INTO logs VALUES("1363","2023-11-24 19:57:06","Added Strand: ABM","21","1","2023-11-25 02:57:06");
INSERT INTO logs VALUES("1364","2023-11-24 20:07:31","Added Strand: ABM","21","1","2023-11-25 03:07:31");
INSERT INTO logs VALUES("1365","2023-11-24 20:07:57","Added Strand: ABM","21","1","2023-11-25 03:07:57");
INSERT INTO logs VALUES("1366","2023-11-24 20:21:12","Add Subject: MT (MATH, Units: 1)","21","1","2023-11-25 03:21:12");
INSERT INTO logs VALUES("1367","2023-11-24 20:21:40","Add Subject: ENG (English, Units: 1)","21","1","2023-11-25 03:21:40");
INSERT INTO logs VALUES("1368","2023-11-24 20:21:40","Add Subject: MT2 (Mathematics, Units: 1)","21","1","2023-11-25 03:21:40");
INSERT INTO logs VALUES("1369","2023-11-24 20:22:10","Add Subject: BM (Business Math, Units: 2)","21","1","2023-11-25 03:22:10");
INSERT INTO logs VALUES("1370","2023-11-24 20:24:45","Added Instructor: Angel Carpeso","21","1","2023-11-25 03:24:45");
INSERT INTO logs VALUES("1371","2023-11-24 20:26:02","Added Instructor: Christopher  Dente","21","1","2023-11-25 03:26:02");
INSERT INTO logs VALUES("1372","2023-11-24 20:27:57","Add Section 1 ABM -1  196","21","1","2023-11-25 03:27:57");
INSERT INTO logs VALUES("1373","2023-11-24 20:28:17","Add Section 1 Narra 197","21","1","2023-11-25 03:28:17");
INSERT INTO logs VALUES("1374","2023-11-24 20:28:57","Add Room: 102 (Lecture, Capacity: 30)","21","1","2023-11-25 03:28:57");
INSERT INTO logs VALUES("1375","2023-11-24 20:28:57","Add Room: 103 (Lecture, Capacity: 30)","21","1","2023-11-25 03:28:57");
INSERT INTO logs VALUES("1376","2023-11-24 20:28:57","Add Room: 104 (Lecture, Capacity: 30)","21","1","2023-11-25 03:28:57");
INSERT INTO logs VALUES("1377","2023-11-24 20:30:56","Add Room: 300 (Lecture, Capacity: 30)","21","1","2023-11-25 03:30:56");
INSERT INTO logs VALUES("1378","2023-11-24 20:30:56","Add Room: 301 (Lecture, Capacity: 30)","21","1","2023-11-25 03:30:56");
INSERT INTO logs VALUES("1379","2023-11-24 21:06:15","Added Strand: GAS","21","1","2023-11-25 04:06:15");
INSERT INTO logs VALUES("1380","2023-11-24 21:06:24","Added Strand: HE","21","1","2023-11-25 04:06:24");
INSERT INTO logs VALUES("1381","2023-11-24 21:16:30","Add Subject: MATH (Mathematics, Units: 1)","21","1","2023-11-25 04:16:30");
INSERT INTO logs VALUES("1382","2023-11-24 21:17:40","Add Subject: ORC (Oral Communication, Units: 1)","21","1","2023-11-25 04:17:40");
INSERT INTO logs VALUES("1383","2023-11-24 21:18:41","Add Subject: BAR2 (Bartending NC II, Units: 1)","21","1","2023-11-25 04:18:41");
INSERT INTO logs VALUES("1384","2023-11-24 21:22:03","Add Subject: BM (Business Math, Units: 1)","21","1","2023-11-25 04:22:03");
INSERT INTO logs VALUES("1385","2023-11-24 21:34:42","Add Section 1 HE - 1 198","21","1","2023-11-25 04:34:42");
INSERT INTO logs VALUES("1386","2023-11-24 21:46:21","Add Subject: BAR (Bartending NC II, Units: 1)","21","1","2023-11-25 04:46:21");
INSERT INTO logs VALUES("1387","2023-11-24 22:24:41","Add Subject: AP (Araling Panlipunan, Units: 1)","21","1","2023-11-25 05:24:41");
INSERT INTO logs VALUES("1388","2023-11-24 22:25:11","Add Subject: BIO (Biology, Units: 1)","21","1","2023-11-25 05:25:11");
INSERT INTO logs VALUES("1389","2023-11-24 22:25:35","Add Subject: TLE (Technical Livelihood Education, Units: 1)","21","1","2023-11-25 05:25:35");



CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `Message` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `IsRead` int(11) NOT NULL,
  PRIMARY KEY (`NotificationID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

INSERT INTO notifications VALUES("1","21","A new subject has been added: MATH2 - Mathematics 2","2023-10-22 23:46:13","0");
INSERT INTO notifications VALUES("2","21","A new subject has been added: SCI - Science","2023-10-22 23:46:37","0");
INSERT INTO notifications VALUES("3","21","UserID 21 added new data: APE - Applied Economics","2023-10-22 23:54:33","0");
INSERT INTO notifications VALUES("4","21","UserID 21 added new data: P.E - Phy1","2023-10-23 00:07:24","0");
INSERT INTO notifications VALUES("5","21","UserID 21 added new data: SDA - sadasdad","2023-10-23 00:20:17","0");
INSERT INTO notifications VALUES("6","21","'.21.'added new data: AP - Araling panlipunan","2023-10-23 00:32:12","0");
INSERT INTO notifications VALUES("7","21","21","2023-10-23 00:42:39","0");
INSERT INTO notifications VALUES("8","21","'.21.'added new data: GT - Go na","2023-10-23 00:44:06","0");
INSERT INTO notifications VALUES("9","21","Added new data: SDFDFASFS - sdfasfsdfsdfsdf","2023-10-23 00:44:51","0");
INSERT INTO notifications VALUES("10","21","(Role: System Administrator), Jian Laurence Salvedea Added new data: LALALA - lalalala","2023-10-23 00:55:36","0");
INSERT INTO notifications VALUES("11","21","(System Administrator), Jian Laurence Salvedea Added new data: KLAY - kalalallala","2023-10-23 01:08:49","0");
INSERT INTO notifications VALUES("12","21","(System Administrator), Jian Laurence Salvedea Added new data: DASDASDASD - asdasdadasdasd`","2023-11-02 23:20:30","0");
INSERT INTO notifications VALUES("13","21","(System Administrator), Jian Laurence Salvedea Added new data: CTESTSTSTS - sdadadaasdasdasdas","2023-11-02 23:32:51","0");
INSERT INTO notifications VALUES("14","21","(System Administrator), Jian Laurence Salvedea Added new data: SC - Science","2023-11-04 17:53:14","0");
INSERT INTO notifications VALUES("15","21","(System Administrator), Jian Laurence Salvedea Added new data: ADASD - asdasdasd","2023-11-04 17:53:46","0");
INSERT INTO notifications VALUES("16","21","(System Administrator), Jian Laurence Salvedea Added new data: DAASDASDASD - sadasdasdas","2023-11-05 22:31:20","0");
INSERT INTO notifications VALUES("17","21","(System Administrator), Jian Laurence Salvedea Added new data: SADASDASASD - asdasdasdas","2023-11-05 22:31:34","0");
INSERT INTO notifications VALUES("18","21","(System Administrator), Jian Laurence Salvedea Added new data: BKFDFSF;J - dsjksdbf","2023-11-05 22:31:49","0");
INSERT INTO notifications VALUES("19","21","(System Administrator), Jian Laurence Salvedea Added new data: ADASDDS - asdasdasdas","2023-11-05 22:41:25","0");
INSERT INTO notifications VALUES("20","21","(System Administrator), Jian Laurence Salvedea Added new data: DASASDA - asdasdasd","2023-11-05 22:42:07","0");
INSERT INTO notifications VALUES("21","21","(System Administrator), Jian Laurence Salvedea Added new data: HAYS - haahah","2023-11-05 22:42:37","0");
INSERT INTO notifications VALUES("22","21","(System Administrator), Jian Laurence Salvedea Added new data: ASDAASD - asdasd1","2023-11-05 22:45:20","0");
INSERT INTO notifications VALUES("23","21","(System Administrator), Jian Laurence Salvedea Added new data: MATH1 - Mathematics","2023-11-14 17:34:16","0");
INSERT INTO notifications VALUES("24","21","(System Administrator), Jian Laurence Salvedea Added new data: SASD - adsa","2023-11-17 00:09:22","0");
INSERT INTO notifications VALUES("25","21","(System Administrator), Jian Laurence Salvedea Added new data: SC - Science","2023-11-17 02:28:36","0");
INSERT INTO notifications VALUES("26","21","(System Administrator), Jian Laurence Salvedea Added new data: BM - Business Math 1","2023-11-17 02:29:21","0");
INSERT INTO notifications VALUES("27","21","(System Administrator), Jian Laurence Salvedea Added new data: TEST1 - test1","2023-11-17 02:34:58","0");
INSERT INTO notifications VALUES("28","21","(System Administrator), Jian Laurence Salvedea Added new data: TEst32 - Test22","2023-11-17 02:41:04","0");
INSERT INTO notifications VALUES("29","21","(System Administrator), Jian Laurence Salvedea Added new data: dente - dente","2023-11-17 02:41:52","0");
INSERT INTO notifications VALUES("30","21","(System Administrator), Jian Laurence Salvedea Added new data: hey - hey","2023-11-17 02:43:31","0");
INSERT INTO notifications VALUES("31","21","(System Administrator), Jian Laurence Salvedea Added new data: SLKJFLKASJFQJ - sdsnslkajlak1","2023-11-17 02:52:25","0");



CREATE TABLE `roles` (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `Roles` varchar(45) NOT NULL,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO roles VALUES("1","System Administrator");
INSERT INTO roles VALUES("2","School Director");
INSERT INTO roles VALUES("3","School Director Assitant");
INSERT INTO roles VALUES("4","Instructor");



CREATE TABLE `rooms` (
  `RoomID` int(11) NOT NULL AUTO_INCREMENT,
  `RoomNumber` int(11) NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  `Capacity` int(11) NOT NULL,
  `RoomType` varchar(255) NOT NULL,
  `Active` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`RoomID`),
  KEY `RoomTypeID` (`RoomType`),
  KEY `rooms_ibfk_2` (`DepartmentID`),
  CONSTRAINT `rooms_ibfk_2` FOREIGN KEY (`DepartmentID`) REFERENCES `departmenttypename` (`DepartmentTypeNameID`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb4;

INSERT INTO rooms VALUES("111","102","1","30","Lecture","1","2023-11-25 03:28:57");
INSERT INTO rooms VALUES("112","103","1","30","Lecture","1","2023-11-25 03:28:57");
INSERT INTO rooms VALUES("113","104","1","30","Lecture","1","2023-11-25 03:28:57");
INSERT INTO rooms VALUES("114","100","2","30","Lecture","1","2023-11-25 03:29:33");
INSERT INTO rooms VALUES("115","101","2","30","Lecture","1","2023-11-25 03:29:33");
INSERT INTO rooms VALUES("116","300","3","30","Lecture","1","2023-11-25 03:30:56");
INSERT INTO rooms VALUES("117","301","3","30","Lecture","1","2023-11-25 03:30:56");



CREATE TABLE `roomtype` (
  `RoomTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `RoomTypeName` varchar(45) NOT NULL,
  PRIMARY KEY (`RoomTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO roomtype VALUES("1","Lecture");
INSERT INTO roomtype VALUES("2","Laboratory");



CREATE TABLE `sections` (
  `SectionID` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentID` int(11) NOT NULL,
  `SectionNo` int(11) NOT NULL,
  `SectionName` varchar(45) NOT NULL,
  `Adviser` int(255) NOT NULL,
  `Active` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`SectionID`),
  KEY `DepartmentID` (`DepartmentID`),
  KEY `Adviser` (`Adviser`),
  CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`DepartmentID`) REFERENCES `department` (`DepartmentID`),
  CONSTRAINT `sections_ibfk_2` FOREIGN KEY (`Adviser`) REFERENCES `instructor` (`InstructorID`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4;

INSERT INTO sections VALUES("109","400","1","ABM -1 ","196","1","2023-11-25 03:27:57");
INSERT INTO sections VALUES("110","7","1","Narra","197","1","2023-11-25 03:28:17");
INSERT INTO sections VALUES("111","412","1","HE - 1","198","1","2023-11-25 04:34:42");



CREATE TABLE `specializations` (
  `SpecializationID` int(11) NOT NULL AUTO_INCREMENT,
  `Specialization` varchar(255) NOT NULL,
  `Code` varchar(255) NOT NULL,
  PRIMARY KEY (`SpecializationID`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4;

INSERT INTO specializations VALUES("1","Business Math","ABM");
INSERT INTO specializations VALUES("2","Emtech","");
INSERT INTO specializations VALUES("3","Attractions and Theme Parks (NC II)","HE");
INSERT INTO specializations VALUES("4","Barbering (NC II)","HE");
INSERT INTO specializations VALUES("5","Bartending (NC II)","HE");
INSERT INTO specializations VALUES("6","Beauty/Nail Care (NC II)","HE");
INSERT INTO specializations VALUES("7","Bread and Pastry Production (NC II)","HE");
INSERT INTO specializations VALUES("8","Caregiving (NC II)","HE");
INSERT INTO specializations VALUES("9","Commercial Cooking (NC III)","HE");
INSERT INTO specializations VALUES("10","Cookery (NC II)","HE");
INSERT INTO specializations VALUES("11","Dressmaking (NC II)","HE");
INSERT INTO specializations VALUES("12","Events Management Services (NC III)","HE");
INSERT INTO specializations VALUES("13","Fashion Design (Apparel) (NC III)","HE");
INSERT INTO specializations VALUES("14","Food and Beverage Services (NC II)","HE");
INSERT INTO specializations VALUES("15","Front Office Services (NC II)","HE");
INSERT INTO specializations VALUES("16","Hairdressing (NC II)","HE");
INSERT INTO specializations VALUES("17","Handicraft (Basketry, Macrame) (Non-NC)","HE");
INSERT INTO specializations VALUES("18","Handicraft (Fashion Accessories, Paper Craft)","HE");
INSERT INTO specializations VALUES("19","Work Immersion","HE");
INSERT INTO specializations VALUES("20","Computer Programming (.net Technology)  (NC II)","ICT");
INSERT INTO specializations VALUES("21","Computer Programming (Java) (NC III)","ICT");
INSERT INTO specializations VALUES("22","Computer Programming (Oracle Database) (NC II","ICT");
INSERT INTO specializations VALUES("23","Computer Systems Servicing (NC II)","ICT");
INSERT INTO specializations VALUES("24","Contact Center Services (NC II)","ICT");
INSERT INTO specializations VALUES("25","Work Immersion","ICT");
INSERT INTO specializations VALUES("26","Telecom OSP Installation (Fiber Optic Cable) ","ICT");
INSERT INTO specializations VALUES("27","Applied Economics","ABM");
INSERT INTO specializations VALUES("28","Business Ethics and Social Responsibility","ABM");
INSERT INTO specializations VALUES("29","Fundamentals of Accountancy, Business and Management","ABM");
INSERT INTO specializations VALUES("30","Fundamentals of Accountancy, Business and Management","ABM");
INSERT INTO specializations VALUES("31","Business Finance","ABM");
INSERT INTO specializations VALUES("32","Organization and Management","ABM");
INSERT INTO specializations VALUES("33","Principles of Marketing","ABM");
INSERT INTO specializations VALUES("34","Work Immersion/Research/Career Advocacy/Culmination","ABM");
INSERT INTO specializations VALUES("35","Creative Writing / Malikhaing Pagsulat","HUMSS");
INSERT INTO specializations VALUES("36","Introduction to World Religions and Belief Systems","HUMSS");
INSERT INTO specializations VALUES("37","Creative Nonfiction","HUMSS");
INSERT INTO specializations VALUES("38","Trends, Networks, and Critical Thinking in the 21st Century","HUMSS");
INSERT INTO specializations VALUES("39","Philippine Politics and Governance","HUMSS");
INSERT INTO specializations VALUES("40","Community Engagement, Solidarity, and Citizenship","HUMSS");
INSERT INTO specializations VALUES("41","Disciplines and Ideas in the Social Sciences","HUMSS");
INSERT INTO specializations VALUES("42","Disciplines and Ideas in the Applied Social S","HUMSS");
INSERT INTO specializations VALUES("43","Work Immersion/Research/Career Advocacy/Culmination","HUMSS");
INSERT INTO specializations VALUES("44","Pre-Calculus","STEM");
INSERT INTO specializations VALUES("45","Basic Calculus","STEM");
INSERT INTO specializations VALUES("46","General Biology 1","STEM");
INSERT INTO specializations VALUES("47","General Biology 2","STEM");
INSERT INTO specializations VALUES("48","General Physics 1","STEM");
INSERT INTO specializations VALUES("49","General Physics 2","STEM");
INSERT INTO specializations VALUES("50","General Chemistry 1 and 2","STEM");
INSERT INTO specializations VALUES("51","Humanities 1*","GAS");
INSERT INTO specializations VALUES("52","Humanities 2*","GAS");
INSERT INTO specializations VALUES("53","Social Science 1**","GAS");
INSERT INTO specializations VALUES("54","Organization and Management","GAS");
INSERT INTO specializations VALUES("55","Disaster Readiness and Risk Reduction","GAS");
INSERT INTO specializations VALUES("56","Elective 1 (from any Track/Strand)***","GAS");
INSERT INTO specializations VALUES("57","Elective 2 (from any Track/Strand)***","GAS");



CREATE TABLE `strands` (
  `StrandID` int(11) NOT NULL AUTO_INCREMENT,
  `StrandCode` varchar(45) NOT NULL,
  `StrandName` varchar(50) NOT NULL,
  `TrackTypeName` varchar(50) NOT NULL,
  `SpecializationID` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Active` int(11) NOT NULL,
  PRIMARY KEY (`StrandID`),
  KEY `SpecializationID` (`SpecializationID`),
  CONSTRAINT `strands_ibfk_1` FOREIGN KEY (`SpecializationID`) REFERENCES `specializations` (`SpecializationID`)
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8mb4;

INSERT INTO strands VALUES("152","ABM","Accountancy and Business Management","Academic","1","2023-11-25 03:07:31","1");
INSERT INTO strands VALUES("153","ABM","Accountancy and Business Management","Academic","27","2023-11-25 03:07:57","1");
INSERT INTO strands VALUES("154","GAS","General Academic Strand","Academic","51","2023-11-25 04:06:15","1");
INSERT INTO strands VALUES("155","HE","Home Economics","TVL","3","2023-11-25 04:06:24","1");



CREATE TABLE `subjects` (
  `SubjectID` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentID` int(11) NOT NULL,
  `SubjectCode` varchar(45) DEFAULT NULL,
  `SubjectDescription` varchar(45) NOT NULL,
  `Units` int(11) NOT NULL,
  `Active` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`SubjectID`),
  KEY `subjects_ibfk_1` (`DepartmentID`),
  CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`DepartmentID`) REFERENCES `department` (`DepartmentID`)
) ENGINE=InnoDB AUTO_INCREMENT=302 DEFAULT CHARSET=utf8mb4;

INSERT INTO subjects VALUES("290","13","MT","MATH","1","1","2023-11-25 03:21:12");
INSERT INTO subjects VALUES("291","12","ENG","English","1","1","2023-11-25 03:21:40");
INSERT INTO subjects VALUES("292","12","MT2","Mathematics","1","1","2023-11-25 03:21:40");
INSERT INTO subjects VALUES("294","408","MATH","Mathematics","1","1","2023-11-25 04:16:30");
INSERT INTO subjects VALUES("295","408","ORC","Oral Communication","1","1","2023-11-25 04:17:40");
INSERT INTO subjects VALUES("296","415","BAR2","Bartending NC II","1","1","2023-11-25 04:18:41");
INSERT INTO subjects VALUES("297","407","BM","Business Math","1","1","2023-11-25 04:22:03");
INSERT INTO subjects VALUES("298","413","BAR","Bartending NC II","1","1","2023-11-25 04:46:21");
INSERT INTO subjects VALUES("299","7","AP","Araling Panlipunan","1","1","2023-11-25 05:24:41");
INSERT INTO subjects VALUES("300","6","BIO","Biology","1","1","2023-11-25 05:25:11");
INSERT INTO subjects VALUES("301","5","TLE","Technical Livelihood Education","1","1","2023-11-25 05:25:35");



CREATE TABLE `test1` (
  `InstructorTimeAvailabilityID` int(11) NOT NULL AUTO_INCREMENT,
  `InstructorID` int(11) NOT NULL,
  `DayID` int(11) NOT NULL,
  `Time_Start` time NOT NULL,
  `Time_End` time NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`InstructorTimeAvailabilityID`),
  KEY `InstructorID` (`InstructorID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;




CREATE TABLE `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Fname` varchar(45) NOT NULL,
  `Mname` varchar(45) NOT NULL,
  `Lname` varchar(45) NOT NULL,
  `BirthDate` date NOT NULL,
  `Age` int(11) NOT NULL,
  `ContactNumber` varchar(11) NOT NULL,
  `Address` varchar(45) NOT NULL,
  `Gender` enum('Male','Female') NOT NULL,
  `Username` varchar(45) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `login` int(11) NOT NULL,
  `Active` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `lock_account` int(11) NOT NULL,
  `lock_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`UserID`),
  KEY `RoleID` (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

INSERT INTO users VALUES("20","Jasmine","Osorio","Cerezo","2001-12-12","21","09359218401","Gordon Heights ","Female","Jasmine1234","$2y$10$ON9kBo0dTY86IXV6OoXPBOD4mpTHBYqBRwRG.ola.kbGw4AmI2GIS","jas@gmail.com","4","1","1","2023-11-25 01:43:10","0","2023-11-01 02:59:38");
INSERT INTO users VALUES("21","Jian Laurence","Salvedea","Ebidag","2002-02-01","21","09127339200","21 Luna St. Banicain ","Male","adminsiJian21","$2y$10$JLfiBavt1X.M2BOwsh4N9eLT/Iid/tEU35fd8oMPNu/pq5PkKlMlW","rencejian@gmail.com","1","1","1","2023-11-25 03:32:03","0","2023-11-01 02:59:38");
INSERT INTO users VALUES("22","Angel Mae","Carpeso","Dente","2002-05-01","21","09359218401","West Tapinac","Female","Angel1234","$2y$10$4M2SS9w5/ccPyxdyYZ8UUOpCU0LSvKEyw4v5g/bRiM9mr8WRyJrEC","angelmaecarpeso@gmail.com","2","0","0","2023-11-25 02:22:53","1","2023-11-01 02:59:38");
INSERT INTO users VALUES("23","Christopher ","Dente","Basa","2001-08-13","22","09458367289","Gordon Heights ","Male","Christopher1234","$2y$10$HHdn0ZBjWVBJJBuG6YXKA.pFG21EgR7FVEaY5BxHgMH5IK0mlzEVy","tope@gmail.com","3","1","1","2023-11-25 03:31:12","0","2023-11-01 02:59:38");
INSERT INTO users VALUES("24","Frederic","Alvaro","Guinto","1999-06-18","24","09112334455","Subic","Male","Red12345","$2y$10$GzBfVWz35QnF40Fdwgat2OV.hvL/SBasIy09P1K3gj/HTlSgdrGHa","red@gmail.com","4","0","1","2023-11-25 01:43:59","0","2023-11-01 02:59:38");

