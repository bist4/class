

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

INSERT INTO classschedule VALUES("9","2023-2024","Senior High School","11","1","ABM","Monday","00:08:00","00:09:00","Math","Mr. A","101","ABM -1","1","");



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
) ENGINE=InnoDB AUTO_INCREMENT=572 DEFAULT CHARSET=utf8mb4;

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
INSERT INTO department VALUES("416","1","11","1","163","1");
INSERT INTO department VALUES("417","1","11","2","163","1");
INSERT INTO department VALUES("418","1","12","1","163","1");
INSERT INTO department VALUES("419","1","12","2","163","1");
INSERT INTO department VALUES("420","1","11","1","164","1");
INSERT INTO department VALUES("421","1","11","2","164","1");
INSERT INTO department VALUES("422","1","12","1","164","1");
INSERT INTO department VALUES("423","1","12","2","164","1");
INSERT INTO department VALUES("424","1","11","1","165","1");
INSERT INTO department VALUES("425","1","11","2","165","1");
INSERT INTO department VALUES("426","1","12","1","165","1");
INSERT INTO department VALUES("427","1","12","2","165","1");
INSERT INTO department VALUES("428","1","11","1","166","1");
INSERT INTO department VALUES("429","1","11","2","166","1");
INSERT INTO department VALUES("430","1","12","1","166","1");
INSERT INTO department VALUES("431","1","12","2","166","1");
INSERT INTO department VALUES("432","1","11","1","167","1");
INSERT INTO department VALUES("433","1","11","2","167","1");
INSERT INTO department VALUES("434","1","12","1","167","1");
INSERT INTO department VALUES("435","1","12","2","167","1");
INSERT INTO department VALUES("436","1","11","1","168","1");
INSERT INTO department VALUES("437","1","11","2","168","1");
INSERT INTO department VALUES("438","1","12","1","168","1");
INSERT INTO department VALUES("439","1","12","2","168","1");
INSERT INTO department VALUES("440","1","11","1","169","1");
INSERT INTO department VALUES("441","1","11","2","169","1");
INSERT INTO department VALUES("442","1","12","1","169","1");
INSERT INTO department VALUES("443","1","12","2","169","1");
INSERT INTO department VALUES("444","1","11","1","170","1");
INSERT INTO department VALUES("445","1","11","2","170","1");
INSERT INTO department VALUES("446","1","12","1","170","1");
INSERT INTO department VALUES("447","1","12","2","170","1");
INSERT INTO department VALUES("448","1","11","1","171","1");
INSERT INTO department VALUES("449","1","11","2","171","1");
INSERT INTO department VALUES("450","1","12","1","171","1");
INSERT INTO department VALUES("451","1","12","2","171","1");
INSERT INTO department VALUES("452","1","11","1","172","1");
INSERT INTO department VALUES("453","1","11","2","172","1");
INSERT INTO department VALUES("454","1","12","1","172","1");
INSERT INTO department VALUES("455","1","12","2","172","1");
INSERT INTO department VALUES("456","1","11","1","173","1");
INSERT INTO department VALUES("457","1","11","2","173","1");
INSERT INTO department VALUES("458","1","12","1","173","1");
INSERT INTO department VALUES("459","1","12","2","173","1");
INSERT INTO department VALUES("460","1","11","1","174","1");
INSERT INTO department VALUES("461","1","11","2","174","1");
INSERT INTO department VALUES("462","1","12","1","174","1");
INSERT INTO department VALUES("463","1","12","2","174","1");
INSERT INTO department VALUES("464","1","11","1","175","1");
INSERT INTO department VALUES("465","1","11","2","175","1");
INSERT INTO department VALUES("466","1","12","1","175","1");
INSERT INTO department VALUES("467","1","12","2","175","1");
INSERT INTO department VALUES("468","1","11","1","176","1");
INSERT INTO department VALUES("469","1","11","2","176","1");
INSERT INTO department VALUES("470","1","12","1","176","1");
INSERT INTO department VALUES("471","1","12","2","176","1");
INSERT INTO department VALUES("472","1","11","1","177","1");
INSERT INTO department VALUES("473","1","11","2","177","1");
INSERT INTO department VALUES("474","1","12","1","177","1");
INSERT INTO department VALUES("475","1","12","2","177","1");
INSERT INTO department VALUES("476","1","11","1","178","1");
INSERT INTO department VALUES("477","1","11","2","178","1");
INSERT INTO department VALUES("478","1","12","1","178","1");
INSERT INTO department VALUES("479","1","12","2","178","1");
INSERT INTO department VALUES("480","1","11","1","179","1");
INSERT INTO department VALUES("481","1","11","2","179","1");
INSERT INTO department VALUES("482","1","12","1","179","1");
INSERT INTO department VALUES("483","1","12","2","179","1");
INSERT INTO department VALUES("484","1","11","1","180","1");
INSERT INTO department VALUES("485","1","11","2","180","1");
INSERT INTO department VALUES("486","1","12","1","180","1");
INSERT INTO department VALUES("487","1","12","2","180","1");
INSERT INTO department VALUES("488","1","11","1","181","1");
INSERT INTO department VALUES("489","1","11","2","181","1");
INSERT INTO department VALUES("490","1","12","1","181","1");
INSERT INTO department VALUES("491","1","12","2","181","1");
INSERT INTO department VALUES("492","1","11","1","182","1");
INSERT INTO department VALUES("493","1","11","2","182","1");
INSERT INTO department VALUES("494","1","12","1","182","1");
INSERT INTO department VALUES("495","1","12","2","182","1");
INSERT INTO department VALUES("496","1","11","1","183","1");
INSERT INTO department VALUES("497","1","11","2","183","1");
INSERT INTO department VALUES("498","1","12","1","183","1");
INSERT INTO department VALUES("499","1","12","2","183","1");
INSERT INTO department VALUES("500","1","11","1","184","1");
INSERT INTO department VALUES("501","1","11","2","184","1");
INSERT INTO department VALUES("502","1","12","1","184","1");
INSERT INTO department VALUES("503","1","12","2","184","1");
INSERT INTO department VALUES("504","1","11","1","185","1");
INSERT INTO department VALUES("505","1","11","2","185","1");
INSERT INTO department VALUES("506","1","12","1","185","1");
INSERT INTO department VALUES("507","1","12","2","185","1");
INSERT INTO department VALUES("508","1","11","1","186","1");
INSERT INTO department VALUES("509","1","11","2","186","1");
INSERT INTO department VALUES("510","1","12","1","186","1");
INSERT INTO department VALUES("511","1","12","2","186","1");
INSERT INTO department VALUES("512","1","11","1","187","1");
INSERT INTO department VALUES("513","1","11","2","187","1");
INSERT INTO department VALUES("514","1","12","1","187","1");
INSERT INTO department VALUES("515","1","12","2","187","1");
INSERT INTO department VALUES("516","1","11","1","188","1");
INSERT INTO department VALUES("517","1","11","2","188","1");
INSERT INTO department VALUES("518","1","12","1","188","1");
INSERT INTO department VALUES("519","1","12","2","188","1");
INSERT INTO department VALUES("520","1","11","1","189","1");
INSERT INTO department VALUES("521","1","11","2","189","1");
INSERT INTO department VALUES("522","1","12","1","189","1");
INSERT INTO department VALUES("523","1","12","2","189","1");
INSERT INTO department VALUES("524","1","11","1","190","1");
INSERT INTO department VALUES("525","1","11","2","190","1");
INSERT INTO department VALUES("526","1","12","1","190","1");
INSERT INTO department VALUES("527","1","12","2","190","1");
INSERT INTO department VALUES("528","1","11","1","191","1");
INSERT INTO department VALUES("529","1","11","2","191","1");
INSERT INTO department VALUES("530","1","12","1","191","1");
INSERT INTO department VALUES("531","1","12","2","191","1");
INSERT INTO department VALUES("532","1","11","1","192","1");
INSERT INTO department VALUES("533","1","11","2","192","1");
INSERT INTO department VALUES("534","1","12","1","192","1");
INSERT INTO department VALUES("535","1","12","2","192","1");
INSERT INTO department VALUES("536","1","11","1","193","1");
INSERT INTO department VALUES("537","1","11","2","193","1");
INSERT INTO department VALUES("538","1","12","1","193","1");
INSERT INTO department VALUES("539","1","12","2","193","1");
INSERT INTO department VALUES("540","1","11","1","194","1");
INSERT INTO department VALUES("541","1","11","2","194","1");
INSERT INTO department VALUES("542","1","12","1","194","1");
INSERT INTO department VALUES("543","1","12","2","194","1");
INSERT INTO department VALUES("544","1","11","1","195","1");
INSERT INTO department VALUES("545","1","11","2","195","1");
INSERT INTO department VALUES("546","1","12","1","195","1");
INSERT INTO department VALUES("547","1","12","2","195","1");
INSERT INTO department VALUES("548","1","11","1","196","1");
INSERT INTO department VALUES("549","1","11","2","196","1");
INSERT INTO department VALUES("550","1","12","1","196","1");
INSERT INTO department VALUES("551","1","12","2","196","1");
INSERT INTO department VALUES("552","1","11","1","197","1");
INSERT INTO department VALUES("553","1","11","2","197","1");
INSERT INTO department VALUES("554","1","12","1","197","1");
INSERT INTO department VALUES("555","1","12","2","197","1");
INSERT INTO department VALUES("556","1","11","1","198","1");
INSERT INTO department VALUES("557","1","11","2","198","1");
INSERT INTO department VALUES("558","1","12","1","198","1");
INSERT INTO department VALUES("559","1","12","2","198","1");
INSERT INTO department VALUES("560","1","11","1","199","1");
INSERT INTO department VALUES("561","1","11","2","199","1");
INSERT INTO department VALUES("562","1","12","1","199","1");
INSERT INTO department VALUES("563","1","12","2","199","1");
INSERT INTO department VALUES("564","1","11","1","200","1");
INSERT INTO department VALUES("565","1","11","2","200","1");
INSERT INTO department VALUES("566","1","12","1","200","1");
INSERT INTO department VALUES("567","1","12","2","200","1");
INSERT INTO department VALUES("568","1","11","1","201","1");
INSERT INTO department VALUES("569","1","11","2","201","1");
INSERT INTO department VALUES("570","1","12","1","201","1");
INSERT INTO department VALUES("571","1","12","2","201","1");



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
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=utf8mb4;

INSERT INTO instructor VALUES("196","1","Angel","","Carpeso","Female","21","2002-02-12","Zambales","935 921 840","angelmaecarpeso@gmail.com","English","Full Time","1","2023-11-25 03:24:45");
INSERT INTO instructor VALUES("197","1","Christopher ","","Dente","Male","21","2002-02-08","Block 1 Federico Upper st. Gordon Heights","912 733 920","tope@gmail.com","English, Mathematics","Full Time","1","2023-11-25 03:26:02");
INSERT INTO instructor VALUES("198","2","Christopher ","","Dente","Male","21","2002-02-08","Block 1 Federico Upper st. Gordon Heights","912 733 920","tope@gmail.com","English, Mathematics","Full Time","1","2023-11-25 03:26:02");
INSERT INTO instructor VALUES("199","3","Helen","Nalugon","Garces","Female","20","2002-12-23","Sta Rita","912 733 920","helen@gmail.com","English, Filipino","Full Time","1","2023-11-25 12:14:48");
INSERT INTO instructor VALUES("200","1","roger","","gerero","Male","21","2002-02-01","21 Luna St. New Banicain Olongapo City","912 733 920","reho@gmail.com","Filipino","Full Time","1","2023-12-01 22:53:58");
INSERT INTO instructor VALUES("201","2","roger","","gerero","Male","21","2002-02-01","21 Luna St. New Banicain Olongapo City","912 733 920","reho@gmail.com","Filipino","Full Time","1","2023-12-01 22:53:58");
INSERT INTO instructor VALUES("202","1","Klay","Salvedea","Ebidag","Female","22","2001-01-01","21 Luna St. New Banicain Olongapo City","912 733 920","klay@gmail.com","Filipino","Full Time","1","2023-12-01 23:03:43");
INSERT INTO instructor VALUES("203","3","Klay","Salvedea","Ebidag","Female","22","2001-01-01","21 Luna St. New Banicain Olongapo City","912 733 920","klay@gmail.com","Filipino","Full Time","1","2023-12-01 23:03:43");
INSERT INTO instructor VALUES("204","2","Michael","Salvedea","Montevirgen","Male","18","2004-12-19","21 Luna St. New Banicain Olongapo City","935 921 840","kitty@gmail.com","Math","Full Time","1","2023-12-01 23:07:06");
INSERT INTO instructor VALUES("205","2","WynLeigh","","San Juan","Male","22","2001-03-03","GH","9127339200","gh@gmail.com","Web ","Full Time","1","2023-12-01 23:09:42");
INSERT INTO instructor VALUES("206","2","Daniel","","Paddilla","Male","22","2001-11-05","Sta rita","9359218404","dan@gmail.com","Science","Full Time","1","2023-12-01 23:11:32");
INSERT INTO instructor VALUES("207","2","Kath","","Bernaldo","Female","22","2001-01-01","Mabayuhan","9359218302","kat@gmail.com","Filipino","Full Time","1","2023-12-01 23:12:35");



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
) ENGINE=InnoDB AUTO_INCREMENT=1552 DEFAULT CHARSET=utf8mb4;

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
INSERT INTO logs VALUES("1390","2023-11-25 05:14:49","Added Instructor: Helen Garces","21","1","2023-11-25 12:14:49");
INSERT INTO logs VALUES("1391","2023-11-29 13:25:17","Add Subject: EY (Hhhhh, Units: 1)","21","1","2023-11-29 20:25:17");
INSERT INTO logs VALUES("1392","2023-11-29 15:42:14","Admin locked account for user: Christopher1234","21","1","2023-11-29 22:42:14");
INSERT INTO logs VALUES("1393","2023-11-29 15:53:29","Admin locked account for user: Red12345","21","1","2023-11-29 22:53:29");
INSERT INTO logs VALUES("1394","2023-11-29 15:56:23","Account Unlocked for user: Angel1234","21","1","2023-11-29 22:56:23");
INSERT INTO logs VALUES("1395","2023-11-29 18:20:09","Add Strand: SASDAD (Sadasd, Track Type: sdas<br>Specializationasaadasd)","21","1","2023-11-30 01:20:09");
INSERT INTO logs VALUES("1396","2023-11-29 18:32:40","Add Strand:  (, Track Type: <br>Specialization:  )","21","1","2023-11-30 01:32:40");
INSERT INTO logs VALUES("1397","2023-11-29 18:44:32","Add Strand: XZDKADK (Jhjhzlkjda, Track Type: askjdaskb<br>Specialization:  mksadnbm,)","21","1","2023-11-30 01:44:32");
INSERT INTO logs VALUES("1398","2023-11-29 18:44:32","Add Strand: 12 (12, Track Type: 21<br>Specialization:  12)","21","1","2023-11-30 01:44:32");
INSERT INTO logs VALUES("1399","2023-11-29 18:59:37","Add Strand: ASDASDASD (Sada, Track Type: asdad<br>Specialization:  asdad)","21","1","2023-11-30 01:59:37");
INSERT INTO logs VALUES("1400","2023-11-29 19:03:59","Add Strand: FDFDSq (Sdfsdf, Track Type: dsfsf<br>Specialization:  sdsdsa)","21","1","2023-11-30 02:03:59");
INSERT INTO logs VALUES("1401","2023-11-29 19:15:22","Add Strand: ABM (Accountancy & Business Management, Track Type: Academic<br>Specialization:  Business Math)","21","1","2023-11-30 02:15:22");
INSERT INTO logs VALUES("1402","2023-11-29 19:16:44","Add Strand: ABM (Accountacny & Business Management, Track Type: Academic<br>Specialization:  Business Math)","21","1","2023-11-30 02:16:44");
INSERT INTO logs VALUES("1403","2023-11-29 19:17:50","Add Strand: ABM (Eyy, Track Type: dsfsdf<br>Specialization:  dsdffd)","21","1","2023-11-30 02:17:50");
INSERT INTO logs VALUES("1404","2023-11-29 19:18:24","Add Strand: ABM (Accountacny & Business College, Track Type: Academic <br>Specialization:   Business Math)","21","1","2023-11-30 02:18:24");
INSERT INTO logs VALUES("1405","2023-11-29 19:20:42","Add Strand: ABM (Accountancy & Business College, Track Type: Academic<br>Specialization:  Business Math)","21","1","2023-11-30 02:20:42");
INSERT INTO logs VALUES("1406","2023-11-29 19:20:43","Add Strand: ABM (Accountancy & Business College, Track Type: Academic<br>Specialization:  Business Math)","21","1","2023-11-30 02:20:43");
INSERT INTO logs VALUES("1407","2023-11-29 19:21:36","Add Strand: ABM (Accountancy & Business College, Track Type: Academic <br>Specialization:  Business Math)","21","1","2023-11-30 02:21:36");
INSERT INTO logs VALUES("1408","2023-11-29 19:23:42","Add Strand: ABM (Accountancy & Business Management, Track Type: Academic<br>Specialization:  Business Math)","21","1","2023-11-30 02:23:42");
INSERT INTO logs VALUES("1409","2023-11-29 19:23:42","Add Strand: ABM (Accountancy & Business Management, Track Type: Academic<br>Specialization:  Business Math)","21","1","2023-11-30 02:23:42");
INSERT INTO logs VALUES("1410","2023-11-29 19:23:43","Add Strand: ABM (Accountancy & Business Management, Track Type: Academic<br>Specialization:  Business Math)","21","1","2023-11-30 02:23:43");
INSERT INTO logs VALUES("1411","2023-11-29 19:25:52","Add Strand: ABM (Accountancy & Business Management, Track Type: Academic<br>Specialization:  Business Math)","21","1","2023-11-30 02:25:52");
INSERT INTO logs VALUES("1412","2023-11-29 19:35:14","Add Strand: HE (Home Economics, Track Type: TVL<br>Specialization:  Bartending NCII)","21","1","2023-11-30 02:35:14");
INSERT INTO logs VALUES("1413","2023-11-29 19:35:38","Add Strand: HE (Home Economics, Track Type: TVL<br>Specialization:  Bartending NCII)","21","1","2023-11-30 02:35:38");
INSERT INTO logs VALUES("1414","2023-11-29 19:35:47","Add Strand: HE (Home Economics, Track Type: TVL<br>Specialization:  Bartending NCII)","21","1","2023-11-30 02:35:47");
INSERT INTO logs VALUES("1415","2023-11-29 19:35:52","Add Strand: HE (Home Economics, Track Type: TVL<br>Specialization:  Bartending NCII)","21","1","2023-11-30 02:35:52");
INSERT INTO logs VALUES("1416","2023-11-29 19:35:53","Add Strand: HE (Home Economics, Track Type: TVL<br>Specialization:  Bartending NCII)","21","1","2023-11-30 02:35:53");
INSERT INTO logs VALUES("1417","2023-11-29 19:35:53","Add Strand: HE (Home Economics, Track Type: TVL<br>Specialization:  Bartending NCII)","21","1","2023-11-30 02:35:53");
INSERT INTO logs VALUES("1418","2023-11-29 19:35:53","Add Strand: HE (Home Economics, Track Type: TVL<br>Specialization:  Bartending NCII)","21","1","2023-11-30 02:35:53");
INSERT INTO logs VALUES("1419","2023-11-29 19:35:53","Add Strand: HE (Home Economics, Track Type: TVL<br>Specialization:  Bartending NCII)","21","1","2023-11-30 02:35:53");
INSERT INTO logs VALUES("1420","2023-11-29 19:39:30","Add Strand: HE (Home Economics, Track Type: TVL<br>Specialization:  Bartending NCII)","21","1","2023-11-30 02:39:30");
INSERT INTO logs VALUES("1421","2023-11-29 19:40:22","Add Strand: HE (Home Economics, Track Type: TVL<br>Specialization:  Bartending NCII)","21","1","2023-11-30 02:40:22");
INSERT INTO logs VALUES("1422","2023-11-29 19:42:35","Add Strand: HE (Home Economics, Track Type: TVL<br>Specialization:  Bartending NCII)","21","1","2023-11-30 02:42:35");
INSERT INTO logs VALUES("1423","2023-11-29 19:42:41","Add Strand: HE (Home Economics, Track Type: TVL<br>Specialization:  Bartending NCII)","21","1","2023-11-30 02:42:41");
INSERT INTO logs VALUES("1424","2023-11-29 19:42:41","Add Strand: HE (Home Economics, Track Type: TVL<br>Specialization:  Bartending NCII)","21","1","2023-11-30 02:42:41");
INSERT INTO logs VALUES("1425","2023-11-29 19:45:30","Add Strand: HE (Home Econimics, Track Type: TVL<br>Specialization:  Bartending NCII)","21","1","2023-11-30 02:45:30");
INSERT INTO logs VALUES("1426","2023-12-01 02:57:46","Add Strand: STEM (Science, Technology, Engineering and Mathematics, Track Type: Ac0ademic<br>Specialization:  Math)","21","1","2023-12-01 09:57:46");
INSERT INTO logs VALUES("1427","2023-12-01 02:58:43","Add Strand: STEM (Science, Technology, Engineering and Mathematics, Track Type: Academic<br>Specialization:  Math)","21","1","2023-12-01 09:58:43");
INSERT INTO logs VALUES("1428","2023-12-01 03:05:47","Add Strand: STEM (Science, Technology, Engineering and Mathematics, Track Type: Academic<br>Specialization:  Math)","21","1","2023-12-01 10:05:47");
INSERT INTO logs VALUES("1429","2023-12-01 03:06:47","Add Strand: STEM (Science, Technology, Engineering and Mathematics, Track Type: Academic<br>Specialization:  Math)","21","1","2023-12-01 10:06:47");
INSERT INTO logs VALUES("1430","2023-12-01 03:15:04","Add Strand: GAS (General Academic Strand, Track Type: Academic<br>Specialization:  Math)","21","1","2023-12-01 10:15:04");
INSERT INTO logs VALUES("1431","2023-12-01 03:18:33","Add Strand: ER (Errr, Track Type: ettt<br>Specialization:  etetet)","21","1","2023-12-01 10:18:33");
INSERT INTO logs VALUES("1432","2023-12-01 03:27:48","Add Strand: JIAN (Jian, Track Type: jian<br>Specialization:  jian)","21","1","2023-12-01 10:27:49");
INSERT INTO logs VALUES("1433","2023-12-01 03:30:07","Add Subject: TEST121 (Joashdkaldklas, Units: 1)","21","1","2023-12-01 10:30:07");
INSERT INTO logs VALUES("1434","2023-12-01 03:37:44","Add Subject: JAS (Jas, Units: 1)","21","1","2023-12-01 10:37:44");
INSERT INTO logs VALUES("1435","2023-12-01 03:47:55","Add Strand: HIU (Hu, Track Type: hu<br>Specialization:  hi)","21","1","2023-12-01 10:47:55");
INSERT INTO logs VALUES("1436","2023-12-01 03:49:19","Add Strand: SDAASD (SADASD, Track Type: ASDASD<br>Specialization:  SADASD)","21","1","2023-12-01 10:49:19");
INSERT INTO logs VALUES("1437","2023-12-01 03:55:13","Add Strand: TEST121212 (Tst122112, Track Type: tst<br>Specialization:  tstq1)","21","1","2023-12-01 10:55:13");
INSERT INTO logs VALUES("1438","2023-12-01 03:58:38","Add Strand: ASDS (Sdas, Track Type: qdasd<br>Specialization:  sadasd)","21","1","2023-12-01 10:58:38");
INSERT INTO logs VALUES("1439","2023-12-01 04:05:55","Add Subject: ZX (Zxxz, Units: 1)","21","1","2023-12-01 11:05:55");
INSERT INTO logs VALUES("1440","2023-12-01 04:05:55","Add Subject: ASD (Sadsadsd, Units: 1)","21","1","2023-12-01 11:05:55");
INSERT INTO logs VALUES("1441","2023-12-01 04:06:04","Add Subject: ASD (Asd, Units: 1)","21","1","2023-12-01 11:06:04");
INSERT INTO logs VALUES("1442","2023-12-01 04:06:04","Add Subject:  (, Units: )","21","1","2023-12-01 11:06:04");
INSERT INTO logs VALUES("1443","2023-12-01 04:12:32","Add Subject: SD (Sdads, Units: 1)","21","1","2023-12-01 11:12:32");
INSERT INTO logs VALUES("1444","2023-12-01 04:12:32","Add Subject: SDADS (Asd, Units: 1)","21","1","2023-12-01 11:12:32");
INSERT INTO logs VALUES("1445","2023-12-01 13:49:02","Add Strand: HH (L;x;lx, Track Type: cxz<br>Specialization:  xz)","21","1","2023-12-01 20:49:02");
INSERT INTO logs VALUES("1446","2023-12-01 13:50:26","Add Strand: RQ (RQ, Track Type: RQ<br>Specialization:  RQ)","21","1","2023-12-01 20:50:26");
INSERT INTO logs VALUES("1447","2023-12-01 13:50:43","Add Strand: RQE (E, Track Type: RQ<br>Specialization:  E)","21","1","2023-12-01 20:50:43");
INSERT INTO logs VALUES("1448","2023-12-01 13:51:29","Add Strand: TQ1 (TQ1, Track Type: TQ<br>Specialization:  TQ)","21","1","2023-12-01 20:51:29");
INSERT INTO logs VALUES("1449","2023-12-01 13:52:49","Add Strand: G (G1, Track Type: G1<br>Specialization:  G1)","21","1","2023-12-01 20:52:49");
INSERT INTO logs VALUES("1450","2023-12-01 13:59:08","Add Strand: B1 (B1, Track Type: B1<br>Specialization:  B1)","21","1","2023-12-01 20:59:08");
INSERT INTO logs VALUES("1451","2023-12-01 13:59:08","Add Strand: A1 (A1, Track Type: A1<br>Specialization:  A1)","21","1","2023-12-01 20:59:08");
INSERT INTO logs VALUES("1452","2023-12-01 14:08:54","Add Strand: F1 (F1, Track Type: F1<br>Specialization:  F1)","21","1","2023-12-01 21:08:54");
INSERT INTO logs VALUES("1453","2023-12-01 14:08:54","Add Strand: F2 (F2, Track Type: F2<br>Specialization:  F2)","21","1","2023-12-01 21:08:54");
INSERT INTO logs VALUES("1454","2023-12-01 14:08:54","Add Strand: F3 (F3, Track Type: F3<br>Specialization:  F3)","21","1","2023-12-01 21:08:54");
INSERT INTO logs VALUES("1455","2023-12-01 14:08:54","Add Strand: F4 (F4, Track Type: F4<br>Specialization:  F4)","21","1","2023-12-01 21:08:54");
INSERT INTO logs VALUES("1456","2023-12-01 14:27:49","Add Subject: H1 (H1, Units: 1)","21","1","2023-12-01 21:27:49");
INSERT INTO logs VALUES("1457","2023-12-01 14:27:49","Add Subject: H2 (H2, Units: 1)","21","1","2023-12-01 21:27:49");
INSERT INTO logs VALUES("1458","2023-12-01 14:38:15","Add Subject: V1 (V1, Units: 1)","21","1","2023-12-01 21:38:15");
INSERT INTO logs VALUES("1459","2023-12-01 14:39:51","Add Subject: V4 (V4, Units: 1)","21","1","2023-12-01 21:39:51");
INSERT INTO logs VALUES("1460","2023-12-01 14:40:44","Add Subject: V6 (V6, Units: 1)","21","1","2023-12-01 21:40:44");
INSERT INTO logs VALUES("1461","2023-12-01 14:40:44","Add Subject: V7 (V7 , Units: 1)","21","1","2023-12-01 21:40:44");
INSERT INTO logs VALUES("1462","2023-12-01 14:40:44","Add Subject: V8 (V8 , Units: 1)","21","1","2023-12-01 21:40:44");
INSERT INTO logs VALUES("1463","2023-12-01 14:44:18","Add Subject: BB (Bb, Units: 1)","21","1","2023-12-01 21:44:18");
INSERT INTO logs VALUES("1464","2023-12-01 14:44:18","Add Subject: VV (Vv, Units: 1)","21","1","2023-12-01 21:44:18");
INSERT INTO logs VALUES("1465","2023-12-01 14:44:30","Add Subject: VV (Vv, Units: 1)","21","1","2023-12-01 21:44:30");
INSERT INTO logs VALUES("1466","2023-12-01 14:45:06","Add Subject: NN (Nn, Units: 1)","21","1","2023-12-01 21:45:06");
INSERT INTO logs VALUES("1467","2023-12-01 14:45:06","Add Subject: CC (Cc, Units: 1)","21","1","2023-12-01 21:45:06");
INSERT INTO logs VALUES("1468","2023-12-01 14:45:06","Add Subject: NN (Nh, Units: 1)","21","1","2023-12-01 21:45:06");
INSERT INTO logs VALUES("1469","2023-12-01 14:50:17","Add Subject: L (L1, Units: 1)","21","1","2023-12-01 21:50:17");
INSERT INTO logs VALUES("1470","2023-12-01 14:50:17","Add Subject: L2 (L2, Units: 1)","21","1","2023-12-01 21:50:17");
INSERT INTO logs VALUES("1471","2023-12-01 14:50:17","Add Subject: L3 (L3, Units: 1)","21","1","2023-12-01 21:50:17");
INSERT INTO logs VALUES("1472","2023-12-01 14:50:17","Add Subject: L1 (L1, Units: 1)","21","1","2023-12-01 21:50:17");
INSERT INTO logs VALUES("1473","2023-12-01 14:51:09","Add Subject: M1 (M1, Units: 1)","21","1","2023-12-01 21:51:09");
INSERT INTO logs VALUES("1474","2023-12-01 14:51:09","Add Subject: M2 (M2, Units: 1)","21","1","2023-12-01 21:51:09");
INSERT INTO logs VALUES("1475","2023-12-01 14:51:09","Add Subject: M3 (M3, Units: 1)","21","1","2023-12-01 21:51:09");
INSERT INTO logs VALUES("1476","2023-12-01 14:51:09","Add Subject: M4 (M4, Units: 1)","21","1","2023-12-01 21:51:09");
INSERT INTO logs VALUES("1477","2023-12-01 14:51:09","Add Subject: M5 (M2, Units: 1)","21","1","2023-12-01 21:51:09");
INSERT INTO logs VALUES("1478","2023-12-01 14:56:51","Add Subject: E1 (E1, Units: 1)","21","1","2023-12-01 21:56:51");
INSERT INTO logs VALUES("1479","2023-12-01 14:56:51","Add Subject: E2 (E2, Units: 1)","21","1","2023-12-01 21:56:51");
INSERT INTO logs VALUES("1480","2023-12-01 14:56:51","Add Subject: E3 (E3, Units: 1)","21","1","2023-12-01 21:56:51");
INSERT INTO logs VALUES("1481","2023-12-01 14:56:51","Add Subject: E4 (E4, Units: 1)","21","1","2023-12-01 21:56:51");
INSERT INTO logs VALUES("1482","2023-12-01 14:57:01","Add Subject: E1 (E1, Units: 1)","21","1","2023-12-01 21:57:01");
INSERT INTO logs VALUES("1483","2023-12-01 14:59:39","Add Subject: G2 (G2, Units: 1)","21","1","2023-12-01 21:59:39");
INSERT INTO logs VALUES("1484","2023-12-01 15:03:09","Add Subject: G2 (G3, Units: 1)","21","1","2023-12-01 22:03:09");
INSERT INTO logs VALUES("1485","2023-12-01 15:06:59","Add Subject: S1 (S1, Units: 1)","21","1","2023-12-01 22:06:59");
INSERT INTO logs VALUES("1486","2023-12-01 15:26:46","Add Subject: S1 (S1, Units: 1)","21","1","2023-12-01 22:26:46");
INSERT INTO logs VALUES("1487","2023-12-01 15:26:58","Add Subject: S1 (S1, Units: 1)","21","1","2023-12-01 22:26:58");
INSERT INTO logs VALUES("1488","2023-12-01 15:27:54","Add Subject: S1 (S1, Units: 1)","21","1","2023-12-01 22:27:54");
INSERT INTO logs VALUES("1489","2023-12-01 15:34:23","Add Strand: BN (Bn, Track Type: bn<br>Specialization:  bn)","21","1","2023-12-01 22:34:23");
INSERT INTO logs VALUES("1490","2023-12-01 15:53:58","Added Instructor: roger gerero","21","1","2023-12-01 22:53:58");
INSERT INTO logs VALUES("1491","2023-12-01 16:03:43","Added Instructor: Klay Ebidag","21","1","2023-12-01 23:03:43");
INSERT INTO logs VALUES("1492","2023-12-01 16:07:06","Added Instructor: Michael Montevirgen","21","1","2023-12-01 23:07:06");
INSERT INTO logs VALUES("1493","2023-12-01 16:09:42","Added Instructor: WynLeigh San Juan","21","1","2023-12-01 23:09:42");
INSERT INTO logs VALUES("1494","2023-12-01 16:11:32","Added Instructor: Daniel Paddilla","21","1","2023-12-01 23:11:32");
INSERT INTO logs VALUES("1495","2023-12-01 16:12:35","Added Instructor: Kath Bernaldo","21","1","2023-12-01 23:12:35");
INSERT INTO logs VALUES("1496","2023-12-01 16:18:25","Add Section 1 Dsd 204","21","1","2023-12-01 23:18:25");
INSERT INTO logs VALUES("1497","2023-12-01 17:56:35","Add Section 03 Sdad 206","21","1","2023-12-02 00:56:35");
INSERT INTO logs VALUES("1498","2023-12-01 17:57:21","Add Section 11 Sdasdsad 205","21","1","2023-12-02 00:57:21");
INSERT INTO logs VALUES("1499","2023-12-02 02:36:21","Add Section 1 Neptune 196","21","1","2023-12-02 09:36:21");
INSERT INTO logs VALUES("1500","2023-12-02 02:36:35","Add Section 1 Rizal 196","21","1","2023-12-02 09:36:35");
INSERT INTO logs VALUES("1501","2023-12-02 02:40:51","Add Section 2 Mars 197","21","1","2023-12-02 09:40:51");
INSERT INTO logs VALUES("1502","2023-12-02 02:43:13","Add Section 3 Jupiter 202","21","1","2023-12-02 09:43:13");
INSERT INTO logs VALUES("1503","2023-12-02 02:43:24","Add Section 1 Rizal 196","21","1","2023-12-02 09:43:24");
INSERT INTO logs VALUES("1504","2023-12-02 02:47:05","Add Section 1 Narra 199","21","1","2023-12-02 09:47:05");
INSERT INTO logs VALUES("1505","2023-12-02 02:47:19","Add Section 2 Mangga 200","21","1","2023-12-02 09:47:19");
INSERT INTO logs VALUES("1506","2023-12-02 02:47:40","Add Section 1 Java 199","21","1","2023-12-02 09:47:40");
INSERT INTO logs VALUES("1507","2023-12-02 02:51:25","Add Section 1 Mars 196","21","1","2023-12-02 09:51:25");
INSERT INTO logs VALUES("1508","2023-12-02 02:51:25","Add Section 2 Neptune 197","21","1","2023-12-02 09:51:25");
INSERT INTO logs VALUES("1509","2023-12-02 02:51:25","Add Section 3 Jupiter 199","21","1","2023-12-02 09:51:25");
INSERT INTO logs VALUES("1510","2023-12-02 02:52:27","Add Section 5 Neptune 198","21","1","2023-12-02 09:52:27");
INSERT INTO logs VALUES("1511","2023-12-02 03:43:56","Add Section 1 Mars 196","21","1","2023-12-02 10:43:56");
INSERT INTO logs VALUES("1512","2023-12-02 03:43:56","Add Section 2 Jupiter 197","21","1","2023-12-02 10:43:56");
INSERT INTO logs VALUES("1513","2023-12-02 03:53:22","Add Section 1 Mars 196","21","1","2023-12-02 10:53:22");
INSERT INTO logs VALUES("1514","2023-12-02 03:53:22","Add Section 2 Jupiter 197","21","1","2023-12-02 10:53:22");
INSERT INTO logs VALUES("1515","2023-12-02 03:57:28","Add Section 1 Mars 196","21","1","2023-12-02 10:57:28");
INSERT INTO logs VALUES("1516","2023-12-02 03:57:37","Add Section 3 Neptune 196","21","1","2023-12-02 10:57:37");
INSERT INTO logs VALUES("1517","2023-12-02 03:59:59","Add Section 5 Ey 196","21","1","2023-12-02 10:59:59");
INSERT INTO logs VALUES("1518","2023-12-02 04:05:59","Add Section 1 Jupiter 196","21","1","2023-12-02 11:05:59");
INSERT INTO logs VALUES("1519","2023-12-02 04:05:59","Add Section 2 Mars 197","21","1","2023-12-02 11:05:59");
INSERT INTO logs VALUES("1520","2023-12-02 04:10:04","Add Section 1 Neptune 196","21","1","2023-12-02 11:10:04");
INSERT INTO logs VALUES("1521","2023-12-02 04:19:12","Add Section 4 Neptune 196","21","1","2023-12-02 11:19:12");
INSERT INTO logs VALUES("1522","2023-12-02 04:22:31","Add Section 3 Neptune 207","21","1","2023-12-02 11:22:31");
INSERT INTO logs VALUES("1523","2023-12-02 04:31:04","Add Section 1 Mars 196","21","1","2023-12-02 11:31:04");
INSERT INTO logs VALUES("1524","2023-12-02 04:31:04","Add Section 2 Jupiter 197","21","1","2023-12-02 11:31:04");
INSERT INTO logs VALUES("1525","2023-12-02 04:31:04","Add Section 3 Neptune 199","21","1","2023-12-02 11:31:04");
INSERT INTO logs VALUES("1526","2023-12-02 04:45:04","Add Section 1 Try 204","21","1","2023-12-02 11:45:04");
INSERT INTO logs VALUES("1527","2023-12-02 04:48:27","Add Section 1 Tr 207","21","1","2023-12-02 11:48:27");
INSERT INTO logs VALUES("1528","2023-12-02 04:52:47","Add Section 1 Test 201","21","1","2023-12-02 11:52:47");
INSERT INTO logs VALUES("1529","2023-12-02 04:54:22","Add Section 1 Gh 204","21","1","2023-12-02 11:54:22");
INSERT INTO logs VALUES("1530","2023-12-02 06:53:53","Add Room: 101 (Lecture, Capacity: 30)","21","1","2023-12-02 13:53:53");
INSERT INTO logs VALUES("1531","2023-12-02 06:53:53","Add Room: 102 (Lecture, Capacity: 30)","21","1","2023-12-02 13:53:53");
INSERT INTO logs VALUES("1532","2023-12-02 07:00:59","Add Room: 1 (Lecture, Capacity: 12)","21","1","2023-12-02 14:00:59");
INSERT INTO logs VALUES("1533","2023-12-02 07:01:40","Add Room: 123 (Lecture, Capacity: 123)","21","1","2023-12-02 14:01:40");
INSERT INTO logs VALUES("1534","2023-12-02 07:02:54","Add Section 12 12 204","21","1","2023-12-02 14:02:54");
INSERT INTO logs VALUES("1535","2023-12-02 07:11:37","Add Room: 401 (Lecture, Capacity: 20)","21","1","2023-12-02 14:11:37");
INSERT INTO logs VALUES("1536","2023-12-02 07:12:01","Add Room: 90 (Lecture, Capacity: 0)","21","1","2023-12-02 14:12:01");
INSERT INTO logs VALUES("1537","2023-12-02 07:13:18","Add Room: 0 (Lecture, Capacity: 2)","21","1","2023-12-02 14:13:18");
INSERT INTO logs VALUES("1538","2023-12-02 07:15:27","Add Room: 4 (Lecture, Capacity: 7)","21","1","2023-12-02 14:15:27");
INSERT INTO logs VALUES("1539","2023-12-02 07:20:33","Add Room: 301 (Lecture, Capacity: 30)","21","1","2023-12-02 14:20:33");
INSERT INTO logs VALUES("1540","2023-12-02 07:20:33","Add Room: 302 (Lecture, Capacity: 30)","21","1","2023-12-02 14:20:33");
INSERT INTO logs VALUES("1541","2023-12-02 07:20:33","Add Room: 303 (Lecture, Capacity: 30)","21","1","2023-12-02 14:20:33");
INSERT INTO logs VALUES("1542","2023-12-02 07:20:33","Add Room: 4 (Lecture, Capacity: 30)","21","1","2023-12-02 14:20:33");
INSERT INTO logs VALUES("1543","2023-12-02 07:21:02","Add Room: 304 (Lecture, Capacity: 30)","21","1","2023-12-02 14:21:02");
INSERT INTO logs VALUES("1544","2023-12-02 07:21:02","Add Room: 4 (Lecture, Capacity: 30)","21","1","2023-12-02 14:21:02");
INSERT INTO logs VALUES("1545","2023-12-02 07:23:27","Add Room: 301 (Lecture, Capacity: 30)","21","1","2023-12-02 14:23:27");
INSERT INTO logs VALUES("1546","2023-12-02 07:23:27","Add Room: 302 (Lecture, Capacity: 30)","21","1","2023-12-02 14:23:27");
INSERT INTO logs VALUES("1547","2023-12-02 07:23:27","Add Room: 303 (Lecture, Capacity: 30)","21","1","2023-12-02 14:23:27");
INSERT INTO logs VALUES("1548","2023-12-02 07:23:27","Add Room: 304 (Lecture, Capacity: 30)","21","1","2023-12-02 14:23:27");
INSERT INTO logs VALUES("1549","2023-12-02 07:23:27","Add Room: 305 (Lecture, Capacity: 30)","21","1","2023-12-02 14:23:27");
INSERT INTO logs VALUES("1550","2023-12-02 07:27:41","Add Room: 306 (Lecture, Capacity: 30)","21","1","2023-12-02 14:27:41");
INSERT INTO logs VALUES("1551","2023-12-03 08:49:29","Admin locked account for user: Angel1234","21","1","2023-12-03 15:49:29");



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
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb4;

INSERT INTO rooms VALUES("133","301","1","30","Lecture","1","2023-12-02 14:23:26");
INSERT INTO rooms VALUES("134","302","1","30","Lecture","1","2023-12-02 14:23:26");
INSERT INTO rooms VALUES("135","303","1","30","Lecture","1","2023-12-02 14:23:27");
INSERT INTO rooms VALUES("136","304","1","30","Lecture","1","2023-12-02 14:23:27");
INSERT INTO rooms VALUES("137","305","1","30","Lecture","1","2023-12-02 14:23:27");
INSERT INTO rooms VALUES("138","306","2","30","Lecture","1","2023-12-02 14:27:41");



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
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=utf8mb4;

INSERT INTO sections VALUES("163","13","1","Mars","196","1","2023-12-02 11:31:04");
INSERT INTO sections VALUES("164","13","2","Jupiter","197","1","2023-12-02 11:31:04");
INSERT INTO sections VALUES("165","13","3","Neptune","199","1","2023-12-02 11:31:04");
INSERT INTO sections VALUES("170","481","12","12","204","1","2023-12-02 14:02:54");



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
  `Specialization` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Active` int(11) NOT NULL,
  PRIMARY KEY (`StrandID`)
) ENGINE=InnoDB AUTO_INCREMENT=202 DEFAULT CHARSET=utf8mb4;

INSERT INTO strands VALUES("156","SASDAD","Sadasd","sdas","asaadasd","2023-11-30 01:20:09","1");
INSERT INTO strands VALUES("157","","","","","2023-11-30 01:32:40","1");
INSERT INTO strands VALUES("158","TEST","Test","test","etst","2023-11-30 01:41:50","1");
INSERT INTO strands VALUES("159","XZDKADK","Jhjhzlkjda","askjdaskb","mksadnbm,","2023-11-30 01:44:32","1");
INSERT INTO strands VALUES("160","12","12","21","12","2023-11-30 01:44:32","1");
INSERT INTO strands VALUES("161","ASDASDASD","Sada","asdad","asdad","2023-11-30 01:59:37","1");
INSERT INTO strands VALUES("162","FDFDSq","Sdfsdf","dsfsf","sdsdsa","2023-11-30 02:03:59","1");
INSERT INTO strands VALUES("163","ABM","Accountancy & Business Management","Academic","Business Math","2023-11-30 02:15:21","1");
INSERT INTO strands VALUES("164","HE","Home Economics","TVL","Bartending NCII","2023-11-30 02:35:14","1");
INSERT INTO strands VALUES("165","STEM","Science, Technology, Engineering and Mathematics","Ac0ademic","Math","2023-12-01 09:57:46","1");
INSERT INTO strands VALUES("166","GAS","General Academic Strand","Academic","Math","2023-12-01 10:15:04","1");
INSERT INTO strands VALUES("167","ER","Errr","ettt","etetet","2023-12-01 10:18:33","1");
INSERT INTO strands VALUES("168","JIAN","Jian","jian","jian","2023-12-01 10:27:47","1");
INSERT INTO strands VALUES("169","TRYT","Trey","tey","tey","2023-12-01 10:41:23","1");
INSERT INTO strands VALUES("170","JIN","Jin","jian","jiansda","2023-12-01 10:46:59","1");
INSERT INTO strands VALUES("171","JIAJSJ","Jajsjsj","ajsdjsadaj","asdjsdjjasd","2023-12-01 10:47:26","1");
INSERT INTO strands VALUES("172","HIU","Hu","hu","hi","2023-12-01 10:47:55","1");
INSERT INTO strands VALUES("173","MAM","Mam","mam","mam","2023-12-01 10:48:05","1");
INSERT INTO strands VALUES("174","JLKAS","Jlk","xzcnlkm,N/LZ,C","NLKCZ.,N","2023-12-01 10:48:14","1");
INSERT INTO strands VALUES("175","SDAASD","SADASD","ASDASD","SADASD","2023-12-01 10:49:19","1");
INSERT INTO strands VALUES("176","ASDADADA1","Sadasq1","dawd1","zcasdqw","2023-12-01 10:49:33","1");
INSERT INTO strands VALUES("177","TEST121212","Tst122112","tst","tstq1","2023-12-01 10:55:13","1");
INSERT INTO strands VALUES("178","ASDS","Sdas","qdasd","sadasd","2023-12-01 10:58:37","1");
INSERT INTO strands VALUES("179","HH","L;x;lx","cxz","xz","2023-12-01 20:49:02","1");
INSERT INTO strands VALUES("180","R1","R1","R1","R1","2023-12-01 20:49:42","1");
INSERT INTO strands VALUES("181","R2","R2","r2","r2","2023-12-01 20:49:42","1");
INSERT INTO strands VALUES("182","RQ","RQ","RQ","RQ","2023-12-01 20:50:25","1");
INSERT INTO strands VALUES("183","RQE","E","RQ","E","2023-12-01 20:50:43","1");
INSERT INTO strands VALUES("184","TQ","TQ","TQ","TQ","2023-12-01 20:51:06","1");
INSERT INTO strands VALUES("185","TQ1","TQ1","TQ","TQ","2023-12-01 20:51:29","1");
INSERT INTO strands VALUES("186","G1","G1","G1","G1","2023-12-01 20:52:04","1");
INSERT INTO strands VALUES("187","G2","G2","G2","G2","2023-12-01 20:52:04","1");
INSERT INTO strands VALUES("188","G3","G3","G3","G3","2023-12-01 20:52:16","1");
INSERT INTO strands VALUES("189","G","G1","G1","G1","2023-12-01 20:52:49","1");
INSERT INTO strands VALUES("190","H1","H1","H1","H1","2023-12-01 20:54:27","1");
INSERT INTO strands VALUES("191","H2","H2","H2","H2","2023-12-01 20:54:27","1");
INSERT INTO strands VALUES("192","H3","H3","H3","H3","2023-12-01 20:54:27","1");
INSERT INTO strands VALUES("193","B1","B1","B1","B1","2023-12-01 20:59:08","1");
INSERT INTO strands VALUES("194","A1","A1","A1","A1","2023-12-01 20:59:08","1");
INSERT INTO strands VALUES("195","F1","F1","F1","F1","2023-12-01 21:08:54","1");
INSERT INTO strands VALUES("196","F2","F2","F2","F2","2023-12-01 21:08:54","1");
INSERT INTO strands VALUES("197","F3","F3","F3","F3","2023-12-01 21:08:54","1");
INSERT INTO strands VALUES("198","F4","F4","F4","F4","2023-12-01 21:08:54","1");
INSERT INTO strands VALUES("199","BN","Bn","bn","bn","2023-12-01 22:34:23","1");
INSERT INTO strands VALUES("200","BM","Bm","bm","bm","2023-12-01 22:34:54","1");
INSERT INTO strands VALUES("201","BNSDSD","Bnsddsd","bndsasdsd","bdsd","2023-12-01 22:35:26","1");



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
) ENGINE=InnoDB AUTO_INCREMENT=360 DEFAULT CHARSET=utf8mb4;

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
INSERT INTO subjects VALUES("302","408","EY","Hhhhh","1","1","2023-11-29 20:25:17");
INSERT INTO subjects VALUES("303","7","TEST121","Joashdkaldklas","1","1","2023-12-01 10:30:07");
INSERT INTO subjects VALUES("304","13","JAS","Jas","1","1","2023-12-01 10:37:44");
INSERT INTO subjects VALUES("305","436","ZX","Zxxz","1","1","2023-12-01 11:05:55");
INSERT INTO subjects VALUES("306","436","ASD","Sadsadsd","1","1","2023-12-01 11:05:55");
INSERT INTO subjects VALUES("307","461","ASD","Asd","1","1","2023-12-01 11:06:04");
INSERT INTO subjects VALUES("308","461","","","0","1","2023-12-01 11:06:04");
INSERT INTO subjects VALUES("309","437","SD","Sdads","1","1","2023-12-01 11:12:32");
INSERT INTO subjects VALUES("310","437","SDADS","Asd","1","1","2023-12-01 11:12:32");
INSERT INTO subjects VALUES("311","6","HH1","Hhh1","1","1","2023-12-01 21:18:15");
INSERT INTO subjects VALUES("312","6","HH2","Hh2","1","1","2023-12-01 21:18:15");
INSERT INTO subjects VALUES("313","7","H1","H1","1","1","2023-12-01 21:27:49");
INSERT INTO subjects VALUES("314","7","H2","H2","1","1","2023-12-01 21:27:49");
INSERT INTO subjects VALUES("315","7","V1","V1","1","1","2023-12-01 21:38:15");
INSERT INTO subjects VALUES("316","7","V2","V2","1","1","2023-12-01 21:38:59");
INSERT INTO subjects VALUES("317","7","V3","V3","1","1","2023-12-01 21:38:59");
INSERT INTO subjects VALUES("318","7","V4","V4","1","1","2023-12-01 21:38:59");
INSERT INTO subjects VALUES("319","6","V4","V4","1","1","2023-12-01 21:39:51");
INSERT INTO subjects VALUES("320","6","V6","V6","1","1","2023-12-01 21:40:44");
INSERT INTO subjects VALUES("321","6","V7","V7 ","1","1","2023-12-01 21:40:44");
INSERT INTO subjects VALUES("322","6","V8","V8 ","1","1","2023-12-01 21:40:44");
INSERT INTO subjects VALUES("323","6","V0","V0","1","1","2023-12-01 21:41:09");
INSERT INTO subjects VALUES("324","6","V12","V12","1","1","2023-12-01 21:41:09");
INSERT INTO subjects VALUES("325","6","V13","V13","1","1","2023-12-01 21:41:40");
INSERT INTO subjects VALUES("326","8","BB","Bb","1","1","2023-12-01 21:44:18");
INSERT INTO subjects VALUES("327","8","VV","Vv","1","1","2023-12-01 21:44:18");
INSERT INTO subjects VALUES("328","8","VV","Vv","1","1","2023-12-01 21:44:30");
INSERT INTO subjects VALUES("329","8","NN","Nn","1","1","2023-12-01 21:45:06");
INSERT INTO subjects VALUES("330","8","CC","Cc","1","1","2023-12-01 21:45:06");
INSERT INTO subjects VALUES("331","8","NN","Nh","1","1","2023-12-01 21:45:06");
INSERT INTO subjects VALUES("332","11","L","L1","1","1","2023-12-01 21:50:17");
INSERT INTO subjects VALUES("333","11","L2","L2","1","1","2023-12-01 21:50:17");
INSERT INTO subjects VALUES("334","11","L3","L3","1","1","2023-12-01 21:50:17");
INSERT INTO subjects VALUES("335","11","L1","L1","1","1","2023-12-01 21:50:17");
INSERT INTO subjects VALUES("336","11","M1","M1","1","1","2023-12-01 21:51:09");
INSERT INTO subjects VALUES("337","11","M2","M2","1","1","2023-12-01 21:51:09");
INSERT INTO subjects VALUES("338","11","M3","M3","1","1","2023-12-01 21:51:09");
INSERT INTO subjects VALUES("339","11","M4","M4","1","1","2023-12-01 21:51:09");
INSERT INTO subjects VALUES("340","11","M5","M2","1","1","2023-12-01 21:51:09");
INSERT INTO subjects VALUES("341","11","E1","E1","1","1","2023-12-01 21:56:51");
INSERT INTO subjects VALUES("342","11","E2","E2","1","1","2023-12-01 21:56:51");
INSERT INTO subjects VALUES("343","11","E3","E3","1","1","2023-12-01 21:56:51");
INSERT INTO subjects VALUES("344","11","E4","E4","1","1","2023-12-01 21:56:51");
INSERT INTO subjects VALUES("345","10","E1","E1","1","1","2023-12-01 21:57:01");
INSERT INTO subjects VALUES("346","10","G2","G2","1","1","2023-12-01 21:59:39");
INSERT INTO subjects VALUES("347","10","G2","G3","1","1","2023-12-01 22:03:09");
INSERT INTO subjects VALUES("348","10","S1","S1","1","1","2023-12-01 22:06:59");
INSERT INTO subjects VALUES("349","10","FG1","Fg1","1","1","2023-12-01 22:11:18");
INSERT INTO subjects VALUES("350","10","FG2","Fg2","1","1","2023-12-01 22:11:40");
INSERT INTO subjects VALUES("351","10","GH1","Gh1","1","1","2023-12-01 22:16:14");
INSERT INTO subjects VALUES("352","10","GH2","Gh2","1","1","2023-12-01 22:16:51");
INSERT INTO subjects VALUES("353","10","GH","Ghh","1","1","2023-12-01 22:17:42");
INSERT INTO subjects VALUES("354","10","YY","Yy","1","1","2023-12-01 22:20:16");
INSERT INTO subjects VALUES("355","10","Y5","Y5","1","1","2023-12-01 22:21:56");
INSERT INTO subjects VALUES("356","10","Y6","Y6","1","1","2023-12-01 22:21:56");
INSERT INTO subjects VALUES("357","10","GGG","Ggg","1","1","2023-12-01 22:30:20");
INSERT INTO subjects VALUES("358","10","HHH","Hhh","1","1","2023-12-01 22:30:35");
INSERT INTO subjects VALUES("359","10","NENA","Nena","1","1","2023-12-01 22:32:47");



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
INSERT INTO users VALUES("21","Jian Laurence","Salvedea","Ebidag","2002-02-01","21","09127339200","21 Luna St. Banicain ","Male","adminsiJian21","$2y$10$JLfiBavt1X.M2BOwsh4N9eLT/Iid/tEU35fd8oMPNu/pq5PkKlMlW","rencejian@gmail.com","1","1","1","2023-12-03 15:15:26","0","2023-11-01 02:59:38");
INSERT INTO users VALUES("22","Angel Mae","Carpeso","Dente","2002-05-01","21","09359218401","West Tapinac","Female","Angel1234","$2y$10$4M2SS9w5/ccPyxdyYZ8UUOpCU0LSvKEyw4v5g/bRiM9mr8WRyJrEC","angelmaecarpeso@gmail.com","2","0","0","2023-12-03 15:49:29","1","2023-11-01 02:59:38");
INSERT INTO users VALUES("23","Christopher ","Dente","Basa","2001-08-13","22","09458367289","Gordon Heights ","Male","Christopher1234","$2y$10$HHdn0ZBjWVBJJBuG6YXKA.pFG21EgR7FVEaY5BxHgMH5IK0mlzEVy","tope@gmail.com","3","1","0","2023-11-29 22:42:14","1","2023-11-01 02:59:38");
INSERT INTO users VALUES("24","Frederic","Alvaro","Guinto","1999-06-18","24","09112334455","Subic","Male","Red12345","$2y$10$GzBfVWz35QnF40Fdwgat2OV.hvL/SBasIy09P1K3gj/HTlSgdrGHa","red@gmail.com","4","0","0","2023-11-29 22:53:28","1","2023-11-01 02:59:38");

