

CREATE TABLE `classification` (
  `ClassificationID` int(11) NOT NULL AUTO_INCREMENT,
  `ClassificationName` varchar(255) NOT NULL,
  PRIMARY KEY (`ClassificationID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO classification VALUES("1","BEED");
INSERT INTO classification VALUES("2","MAPEH");



CREATE TABLE `classschedule` (
  `ClasscheduleID` int(11) NOT NULL AUTO_INCREMENT,
  `AcademicYear` varchar(255) NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  `SectionID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `Time_Start` varchar(255) NOT NULL,
  `Time_End` varchar(255) NOT NULL,
  `Monday` int(11) NOT NULL,
  `Tuesday` int(11) NOT NULL,
  `Wednesday` int(11) NOT NULL,
  `Thursday` int(11) NOT NULL,
  `Friday` int(11) NOT NULL,
  `InstructorID` int(11) NOT NULL,
  `RoomID` int(11) NOT NULL,
  `Active` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ClasscheduleID`),
  KEY `DepartmentID` (`DepartmentID`),
  KEY `InstructorID` (`InstructorID`),
  KEY `RoomID` (`RoomID`),
  KEY `SubjectID` (`SubjectID`),
  KEY `SectionID` (`SectionID`),
  CONSTRAINT `DepartmentID` FOREIGN KEY (`DepartmentID`) REFERENCES `department` (`DepartmentID`),
  CONSTRAINT `InstructorID` FOREIGN KEY (`InstructorID`) REFERENCES `userroles` (`UserRoleID`),
  CONSTRAINT `RoomID` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`),
  CONSTRAINT `SectionID` FOREIGN KEY (`SectionID`) REFERENCES `sections` (`SectionID`),
  CONSTRAINT `SubjectID` FOREIGN KEY (`SubjectID`) REFERENCES `subjects` (`SubjectID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

INSERT INTO classschedule VALUES("7","2023-2024","5","1","1","08:00:00","09:00:00","1","1","0","0","0","6","1","0","2024-02-16 10:31:56");
INSERT INTO classschedule VALUES("9","2023-2024","5","1","2","09:00:00","10:00:00","1","1","1","0","0","6","1","1","2024-02-16 14:32:19");



CREATE TABLE `department` (
  `DepartmentID` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentTypeNameID` int(11) NOT NULL,
  `YearLevel` int(11) NOT NULL,
  `Semester` int(11) DEFAULT NULL,
  `StrandID` int(11) DEFAULT NULL,
  `Active` int(11) NOT NULL,
  PRIMARY KEY (`DepartmentID`),
  KEY `Department Type` (`DepartmentTypeNameID`),
  KEY `Strand` (`StrandID`),
  CONSTRAINT `Department Type` FOREIGN KEY (`DepartmentTypeNameID`) REFERENCES `departmenttypename` (`DepartmentTypeNameID`),
  CONSTRAINT `Strand` FOREIGN KEY (`StrandID`) REFERENCES `strands` (`StrandID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

INSERT INTO department VALUES("1","1","11","1","1","1");
INSERT INTO department VALUES("2","1","11","2","1","1");
INSERT INTO department VALUES("3","1","12","1","1","1");
INSERT INTO department VALUES("4","1","12","2","1","1");
INSERT INTO department VALUES("5","3","1","","","1");
INSERT INTO department VALUES("6","3","2","","","1");
INSERT INTO department VALUES("7","3","3","","","1");
INSERT INTO department VALUES("8","3","4","","","1");
INSERT INTO department VALUES("9","3","5","","","1");
INSERT INTO department VALUES("10","3","6","","","1");
INSERT INTO department VALUES("11","2","7","","","1");
INSERT INTO department VALUES("12","2","8","","","1");
INSERT INTO department VALUES("13","2","9","","","1");
INSERT INTO department VALUES("14","2","10","","","1");



CREATE TABLE `departmenttypename` (
  `DepartmentTypeNameID` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentTypeName` varchar(255) NOT NULL,
  PRIMARY KEY (`DepartmentTypeNameID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO departmenttypename VALUES("1","Senior High School");
INSERT INTO departmenttypename VALUES("2","Junior High School");
INSERT INTO departmenttypename VALUES("3","Primary");



CREATE TABLE `instructortimeavailabilities` (
  `InstructorTimeAvailabilityID` int(11) NOT NULL AUTO_INCREMENT,
  `Monday` int(11) NOT NULL,
  `Tuesday` int(11) NOT NULL,
  `Wednesday` int(11) NOT NULL,
  `Thursday` int(11) NOT NULL,
  `Friday` int(11) NOT NULL,
  `InstructorID` int(11) NOT NULL,
  `Time_Start` varchar(255) NOT NULL,
  `Time_End` varchar(255) NOT NULL,
  `Active` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`InstructorTimeAvailabilityID`),
  KEY `Instructor` (`InstructorID`),
  CONSTRAINT `Instructor` FOREIGN KEY (`InstructorID`) REFERENCES `userroles` (`UserRoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO instructortimeavailabilities VALUES("1","1","1","0","0","0","7","13:00:00","17:00:00","0","2024-02-16 09:32:34");
INSERT INTO instructortimeavailabilities VALUES("2","0","0","1","1","0","7","08:00:00","11:00:00","1","2024-02-15 23:38:15");
INSERT INTO instructortimeavailabilities VALUES("3","0","0","0","0","1","7","09:00:00","16:00:00","1","2024-02-15 23:38:15");



CREATE TABLE `logs` (
  `LogID` int(11) NOT NULL AUTO_INCREMENT,
  `Activity` varchar(255) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Active` int(11) NOT NULL,
  `DateTime` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`LogID`),
  KEY `Users` (`UserID`),
  CONSTRAINT `Users` FOREIGN KEY (`UserID`) REFERENCES `userinfo` (`UserInfoID`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4;

INSERT INTO logs VALUES("4","Admin updated user information: Jian Rence Ebidag","1","1","2024-02-12 07:03:22","2024-02-12 14:03:22");
INSERT INTO logs VALUES("5","Admin updated user information to Jian Rence Ebidag","1","1","2024-02-12 07:06:29","2024-02-12 14:06:29");
INSERT INTO logs VALUES("6","Admin updated user information to Jian Laurence Ebidag","1","1","2024-02-12 07:08:58","2024-02-12 14:08:58");
INSERT INTO logs VALUES("7","Add Strand: HE (HomeEconomics, Track Type: TVL<br>Specialization:  BartendingNCII)","1","1","2024-02-12 07:29:23","2024-02-12 14:29:23");
INSERT INTO logs VALUES("8","Login as System Admin","1","1","2024-02-13 10:05:59","2024-02-13 10:05:59");
INSERT INTO logs VALUES("9","Login as System Admin","1","1","2024-02-13 10:09:44","2024-02-13 10:09:44");
INSERT INTO logs VALUES("10","Login as System Admin","1","1","2024-02-13 13:48:56","2024-02-13 13:48:56");
INSERT INTO logs VALUES("11","Delete Strand: HE HomeEconomics","1","1","2024-02-13 07:06:17","2024-02-13 14:06:17");
INSERT INTO logs VALUES("12","Login as System Admin","1","1","2024-02-13 16:48:38","2024-02-13 16:48:38");
INSERT INTO logs VALUES("13","Login as School Director Assistant","2","1","2024-02-13 16:48:46","2024-02-13 16:48:46");
INSERT INTO logs VALUES("14","Login as School Director Assistant","2","1","2024-02-13 18:26:42","2024-02-13 18:26:42");
INSERT INTO logs VALUES("15","Login as School Director Assistant","2","1","2024-02-13 18:34:34","2024-02-13 18:34:34");
INSERT INTO logs VALUES("16","Login as School Director Assistant","2","1","2024-02-13 19:13:33","2024-02-13 19:13:33");
INSERT INTO logs VALUES("17","Login as System Admin","1","1","2024-02-14 12:09:13","2024-02-14 12:09:13");
INSERT INTO logs VALUES("18","Login as School Director Assistant","2","1","2024-02-14 13:45:56","2024-02-14 13:45:56");
INSERT INTO logs VALUES("19","Login as School Director Assistant","2","1","2024-02-14 14:15:28","2024-02-14 14:15:28");
INSERT INTO logs VALUES("20","Login as School Director Assistant","2","1","2024-02-14 14:51:27","2024-02-14 14:51:27");
INSERT INTO logs VALUES("21","Login as School Director Assistant","2","1","2024-02-14 15:43:31","2024-02-14 15:43:31");
INSERT INTO logs VALUES("22","Login as School Director Assistant","2","1","2024-02-14 16:41:07","2024-02-14 16:41:07");
INSERT INTO logs VALUES("23","Login as System Admin","1","1","2024-02-15 13:19:50","2024-02-15 13:19:50");
INSERT INTO logs VALUES("24","Admin added new account helenG2321","1","1","2024-02-15 06:52:39","2024-02-15 13:52:39");
INSERT INTO logs VALUES("25","Admin updated user information to Jasmine Osorio","1","1","2024-02-15 07:37:05","2024-02-15 14:37:05");
INSERT INTO logs VALUES("26","Admin locked account for user: Christopher1234","1","1","2024-02-15 07:59:50","2024-02-15 14:59:50");
INSERT INTO logs VALUES("27","Account Unlocked for user: Christopher1234","1","1","2024-02-15 08:00:21","2024-02-15 15:00:21");
INSERT INTO logs VALUES("28","Login as School Director","5","1","2024-02-15 18:40:06","2024-02-15 18:40:06");
INSERT INTO logs VALUES("29","Login as System Admin","1","1","2024-02-15 22:10:35","2024-02-15 22:10:35");
INSERT INTO logs VALUES("30","Admin updated user information to Angel Mae Carpeso","1","1","2024-02-15 15:52:22","2024-02-15 22:52:22");
INSERT INTO logs VALUES("31","Admin updated user information to Jian  Ebidag","1","1","2024-02-15 16:09:33","2024-02-15 23:09:33");
INSERT INTO logs VALUES("32","Admin updated user information to Jian  Ebidag","1","1","2024-02-15 16:10:38","2024-02-15 23:10:38");
INSERT INTO logs VALUES("33","Admin updated user information to Jian  Ebidag","1","1","2024-02-15 16:12:14","2024-02-15 23:12:14");
INSERT INTO logs VALUES("34","Admin updated user information to Angel Carpeso","1","1","2024-02-15 16:12:35","2024-02-15 23:12:35");
INSERT INTO logs VALUES("35","Admin updated user information for Jian Laurence Ebidag","1","1","2024-02-15 16:15:21","2024-02-15 23:15:21");
INSERT INTO logs VALUES("36","Admin updated user information for Angel Mae Carpeso","1","1","2024-02-15 16:16:02","2024-02-15 23:16:02");
INSERT INTO logs VALUES("37","Admin updated user information for Jian Laurence Ebidag","1","1","2024-02-15 16:18:17","2024-02-15 23:18:17");
INSERT INTO logs VALUES("38","Add Instructor Availability: <br>Instructor: Helen   <br>Day: (Monday, Tuesday)<br>Time Start: 13:00:00, Time End: 17:00:00","1","1","2024-02-15 16:38:15","2024-02-15 23:38:15");
INSERT INTO logs VALUES("39","Add Instructor Availability: <br>Instructor: Helen   <br>Day: (Wednesday, Thursday)<br>Time Start: 08:00:00, Time End: 11:00:00","1","1","2024-02-15 16:38:15","2024-02-15 23:38:15");
INSERT INTO logs VALUES("40","Add Instructor Availability: <br>Instructor: Helen   <br>Day: (Friday)<br>Time Start: 09:00:00, Time End: 16:00:00","1","1","2024-02-15 16:38:15","2024-02-15 23:38:15");
INSERT INTO logs VALUES("41","Login as School Director Assistant","2","1","2024-02-16 00:47:50","2024-02-16 00:47:50");
INSERT INTO logs VALUES("42","Login as System Admin","1","1","2024-02-16 00:49:03","2024-02-16 00:49:03");
INSERT INTO logs VALUES("43","Login as School Director Assistant","2","1","2024-02-16 00:55:22","2024-02-16 00:55:22");
INSERT INTO logs VALUES("44","Add Subject: FIL (Filipino, Units: 200)","1","1","2024-02-15 18:21:44","2024-02-16 01:21:44");
INSERT INTO logs VALUES("45","Add Subject: ENG (English, Units: 160)","1","1","2024-02-15 18:21:44","2024-02-16 01:21:44");
INSERT INTO logs VALUES("46","Add Subject: SRA (Sra, Units: 40)","1","1","2024-02-15 18:21:44","2024-02-16 01:21:44");
INSERT INTO logs VALUES("47","Add Subject: GEO (Geography, Units: 160)","1","1","2024-02-15 18:21:44","2024-02-16 01:21:44");
INSERT INTO logs VALUES("48","Add Subject: SCI (Science, Units: 200)","1","1","2024-02-15 18:21:44","2024-02-16 01:21:44");
INSERT INTO logs VALUES("49","Add Subject: ARALPAN (Aralinpanlipunan, Units: 200)","1","1","2024-02-15 18:21:44","2024-02-16 01:21:44");
INSERT INTO logs VALUES("50","Add Subject: MUSIC (Music, Units: 40)","1","1","2024-02-15 18:21:44","2024-02-16 01:21:44");
INSERT INTO logs VALUES("51","Add Subject: ARTS (Arts, Units: 40)","1","1","2024-02-15 18:21:44","2024-02-16 01:21:44");
INSERT INTO logs VALUES("52","Add Subject: PE (Physicaleducation, Units: 40)","1","1","2024-02-15 18:21:44","2024-02-16 01:21:44");
INSERT INTO logs VALUES("53","Add Subject: HEALTH (Health, Units: 40)","1","1","2024-02-15 18:21:44","2024-02-16 01:21:44");
INSERT INTO logs VALUES("54","Add Subject: ESP (Edukasyonsapagpapakatao, Units: 40)","1","1","2024-02-15 18:21:44","2024-02-16 01:21:44");
INSERT INTO logs VALUES("55","Add Subject: TLE (Tle, Units: 200)","1","1","2024-02-15 18:21:44","2024-02-16 01:21:44");
INSERT INTO logs VALUES("56","Add Subject: MATH (Mathematics, Units: 200)","1","1","2024-02-15 18:21:44","2024-02-16 01:21:44");
INSERT INTO logs VALUES("57","Add Subject: PSEP (Psep, Units: 40)","1","1","2024-02-15 18:21:44","2024-02-16 01:21:44");
INSERT INTO logs VALUES("58","Login as School Director Assistant","2","1","2024-02-16 02:30:57","2024-02-16 02:30:57");
INSERT INTO logs VALUES("59","Login as School Director Assistant","2","1","2024-02-16 03:12:47","2024-02-16 03:12:47");
INSERT INTO logs VALUES("60","Login as System Admin","1","1","2024-02-16 03:28:18","2024-02-16 03:28:18");
INSERT INTO logs VALUES("61","Login as School Director Assistant","2","1","2024-02-16 08:43:57","2024-02-16 08:43:57");
INSERT INTO logs VALUES("62","Login as System Admin","1","1","2024-02-16 08:51:20","2024-02-16 08:51:20");
INSERT INTO logs VALUES("63","Login as School Director Assistant","2","1","2024-02-16 09:59:09","2024-02-16 09:59:09");
INSERT INTO logs VALUES("64","Login as School Director Assistant","2","1","2024-02-16 10:14:19","2024-02-16 10:14:19");
INSERT INTO logs VALUES("65","Login as School Director Assistant","2","1","2024-02-16 10:30:36","2024-02-16 10:30:36");
INSERT INTO logs VALUES("66","Login as System Admin","1","1","2024-02-16 10:59:31","2024-02-16 10:59:31");
INSERT INTO logs VALUES("67","Login as System Admin","1","1","2024-02-16 12:23:20","2024-02-16 12:23:20");
INSERT INTO logs VALUES("68","Login as School Director Assistant","2","1","2024-02-16 12:25:53","2024-02-16 12:25:53");
INSERT INTO logs VALUES("69","Login as School Director Assistant","2","1","2024-02-16 13:04:50","2024-02-16 13:04:50");
INSERT INTO logs VALUES("70","Admin locked account for user: Jasmine1234","1","1","2024-02-16 07:13:28","2024-02-16 14:13:28");
INSERT INTO logs VALUES("71","Account Unlocked for user: Jasmine1234","1","1","2024-02-16 07:13:40","2024-02-16 14:13:40");
INSERT INTO logs VALUES("72","Admin locked account for user: Jasmine1234","1","1","2024-02-16 07:15:36","2024-02-16 14:15:36");
INSERT INTO logs VALUES("73","Account Unlocked for user: Jasmine1234","1","1","2024-02-16 07:15:46","2024-02-16 14:15:46");
INSERT INTO logs VALUES("74","Admin locked account for user: Jasmine1234","1","1","2024-02-16 07:20:02","2024-02-16 14:20:02");
INSERT INTO logs VALUES("75","Login as Instructor","4","1","2024-02-16 14:23:47","2024-02-16 14:23:47");
INSERT INTO logs VALUES("76","Login as System Admin","1","1","2024-02-16 14:39:49","2024-02-16 14:39:49");
INSERT INTO logs VALUES("77","Account Unlocked for user: Jasmine1234","1","1","2024-02-16 07:44:43","2024-02-16 14:44:43");
INSERT INTO logs VALUES("78","Login as School Director Assistant","2","1","2024-02-16 14:48:01","2024-02-16 14:48:01");
INSERT INTO logs VALUES("79","Login as System Admin","1","1","2024-02-16 15:03:15","2024-02-16 15:03:15");
INSERT INTO logs VALUES("80","Admin locked account for user: Jasmine1234","1","1","2024-02-16 10:37:42","2024-02-16 17:37:42");
INSERT INTO logs VALUES("81","Account Unlocked for user: Jasmine1234","1","1","2024-02-16 10:53:16","2024-02-16 17:53:16");
INSERT INTO logs VALUES("82","Add Room: 888 (Laboratory, Capacity: 999999)","1","1","2024-02-16 10:59:46","2024-02-16 17:59:46");
INSERT INTO logs VALUES("83","Add Room: 999 (Lecture, Capacity: 7812371897398)","1","1","2024-02-16 11:02:01","2024-02-16 18:02:01");
INSERT INTO logs VALUES("84","Update Strand: HE (Strand Name: HomeEconomics -> Home Economics)","1","1","2024-02-16 11:42:37","2024-02-16 18:42:37");



CREATE TABLE `message` (
  `MessageID` int(11) NOT NULL AUTO_INCREMENT,
  `Message` varchar(255) DEFAULT NULL,
  `UserFrom` int(11) DEFAULT NULL,
  `UserTo` int(11) DEFAULT NULL,
  `YearLevel` int(11) DEFAULT NULL,
  `Section` varchar(255) DEFAULT NULL,
  `Strand` int(11) DEFAULT NULL,
  `Request` varchar(255) DEFAULT NULL,
  `Action` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`MessageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `roles` (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `Roles` varchar(255) NOT NULL,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO roles VALUES("1","System Administrator");
INSERT INTO roles VALUES("2","School Director");
INSERT INTO roles VALUES("3","School Director Assistant");
INSERT INTO roles VALUES("4","Instructor");



CREATE TABLE `rooms` (
  `RoomID` int(11) NOT NULL AUTO_INCREMENT,
  `RoomNumber` int(11) NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  `Capacity` int(11) NOT NULL,
  `RoomType` varchar(255) NOT NULL,
  `Active` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`RoomID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO rooms VALUES("1","1","3","30","Lecture","1","2024-02-13 17:21:43");
INSERT INTO rooms VALUES("2","2","3","30","Lecture","1","2024-02-13 17:21:43");
INSERT INTO rooms VALUES("3","888","1","999999","Laboratory","1","2024-02-16 17:59:46");
INSERT INTO rooms VALUES("4","999","1","2147483647","Lecture","1","2024-02-16 18:02:01");



CREATE TABLE `sections` (
  `SectionID` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentID` int(11) NOT NULL,
  `SectionNo` int(11) NOT NULL,
  `SectionName` varchar(255) NOT NULL,
  `Active` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`SectionID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO sections VALUES("1","5","1","G-1","1","2024-02-13 17:15:28");



CREATE TABLE `strands` (
  `StrandID` int(11) NOT NULL AUTO_INCREMENT,
  `StrandCode` varchar(255) NOT NULL,
  `StrandName` varchar(255) NOT NULL,
  `TrackTypeName` varchar(255) NOT NULL,
  `Specialization` varchar(255) NOT NULL,
  `Active` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`StrandID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO strands VALUES("1","HE","Home Economics","TVL","BartendingNCII","1","2024-02-16 18:42:37");



CREATE TABLE `subjects` (
  `SubjectID` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentID` int(11) NOT NULL,
  `SubjectCode` varchar(255) DEFAULT NULL,
  `SubjectDescription` varchar(255) NOT NULL,
  `Classification` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Units` int(11) NOT NULL,
  `Active` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`SubjectID`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;

INSERT INTO subjects VALUES("1","5","Math-01","Math","BEED","CORE","240","1","2024-02-13 17:17:16");
INSERT INTO subjects VALUES("2","5","Eng-01","English","BEED","CORE","240","1","2024-02-13 17:17:16");
INSERT INTO subjects VALUES("3","8","FIL","Filipino","BEED","N/A","200","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("4","8","ENG","English","BEED","N/A","160","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("5","8","SRA","Sra","BEED","N/A","40","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("6","8","GEO","Geography","BEED","N/A","160","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("7","8","SCI","Science","BEED","N/A","200","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("8","8","ARALPAN","Aralinpanlipunan","BEED","N/A","200","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("9","8","MUSIC","Music","BEED","N/A","40","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("10","8","ARTS","Arts","BEED","N/A","40","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("11","8","PE","Physicaleducation","BEED","N/A","40","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("12","8","HEALTH","Health","BEED","N/A","40","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("13","8","ESP","Edukasyonsapagpapakatao","BEED","N/A","40","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("14","8","TLE","Tle","BEED","N/A","200","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("15","8","MATH","Mathematics","BEED","N/A","200","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("16","8","PSEP","Psep","BEED","N/A","40","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("17","9","FIL","Filipino","BEED","N/A","200","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("18","9","ENG","English","BEED","N/A","160","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("19","9","SRA","Sra","BEED","N/A","40","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("20","9","GEO","Geography","BEED","N/A","160","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("21","9","SCI","Science","BEED","N/A","200","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("22","9","ARALPAN","Aralinpanlipunan","BEED","N/A","200","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("23","9","MUSIC","Music","BEED","N/A","40","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("24","9","ARTS","Arts","BEED","N/A","40","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("25","9","PE","Physicaleducation","BEED","N/A","40","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("26","9","HEALTH","Health","BEED","N/A","40","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("27","9","ESP","Edukasyonsapagpapakatao","BEED","N/A","40","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("28","9","TLE","Tle","BEED","N/A","200","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("29","9","MATH","Mathematics","BEED","N/A","200","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("30","9","PSEP","Psep","BEED","N/A","40","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("31","10","FIL","Filipino","BEED","N/A","200","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("32","10","ENG","English","BEED","N/A","160","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("33","10","SRA","Sra","BEED","N/A","40","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("34","10","GEO","Geography","BEED","N/A","160","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("35","10","SCI","Science","BEED","N/A","200","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("36","10","ARALPAN","Aralinpanlipunan","BEED","N/A","200","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("37","10","MUSIC","Music","BEED","N/A","40","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("38","10","ARTS","Arts","BEED","N/A","40","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("39","10","PE","Physicaleducation","BEED","N/A","40","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("40","10","HEALTH","Health","BEED","N/A","40","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("41","10","ESP","Edukasyonsapagpapakatao","BEED","N/A","40","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("42","10","TLE","Tle","BEED","N/A","200","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("43","10","MATH","Mathematics","BEED","N/A","200","1","2024-02-16 01:21:44");
INSERT INTO subjects VALUES("44","10","PSEP","Psep","BEED","N/A","40","1","2024-02-16 01:21:44");



CREATE TABLE `userdepartment` (
  `UserDepID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  PRIMARY KEY (`UserDepID`),
  KEY `User` (`UserID`),
  KEY `Department` (`DepartmentID`),
  CONSTRAINT `Department` FOREIGN KEY (`DepartmentID`) REFERENCES `departmenttypename` (`DepartmentTypeNameID`),
  CONSTRAINT `User` FOREIGN KEY (`UserID`) REFERENCES `userinfo` (`UserInfoID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO userdepartment VALUES("3","3","3");
INSERT INTO userdepartment VALUES("4","4","3");



CREATE TABLE `userinfo` (
  `UserInfoID` int(11) NOT NULL AUTO_INCREMENT,
  `Fname` varchar(255) NOT NULL,
  `Mname` varchar(255) NOT NULL,
  `Lname` varchar(255) NOT NULL,
  `Age` int(11) NOT NULL,
  `BirthDate` date NOT NULL,
  `Gender` enum('Male','Female') NOT NULL,
  `Address` varchar(255) NOT NULL,
  `ContactNumber` varchar(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `login` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `lock_account` int(11) NOT NULL,
  `archive` int(11) NOT NULL,
  `DateArchived` varchar(255) NOT NULL,
  `Active` int(11) NOT NULL,
  PRIMARY KEY (`UserInfoID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

INSERT INTO userinfo VALUES("1","Jian Laurence","Salvedea","Ebidag","22","2002-01-21","Male","#21 Luna st, Banicain Olongapo City","912739200","rencejian@gmail.com","Full Time","admin","$2y$10$JLfiBavt1X.M2BOwsh4N9eLT/Iid/tEU35fd8oMPNu/pq5PkKlMlW","1","2024-02-16 15:03:15","0","0","","1");
INSERT INTO userinfo VALUES("2","Christopher","Basa","Dente","22","2002-08-13","Male","#Block 1 Upper Federico St. Gordon Heights Olongapo City, Zambales","09458367289","christophetr1@gmail.com","Full Time","Christopher1234","$2y$10$HHdn0ZBjWVBJJBuG6YXKA.pFG21EgR7FVEaY5BxHgMH5IK0mlzEVy","0","2024-02-16 15:03:01","0","0","","1");
INSERT INTO userinfo VALUES("3","Jasmine","P","Osorio","22","2002-08-13","Male","#Block 5 Upper Federico St. Gordon Heights Olongapo City, Zambales","09456789008","jas@gmail.com","Full Time","Jasmine1234","$2y$10$HHdn0ZBjWVBJJBuG6YXKA.pFG21EgR7FVEaY5BxHgMH5IK0mlzEVy","0","2024-02-16 17:53:16","0","1","2024-02-16 17:37:42","1");
INSERT INTO userinfo VALUES("4","Helen ","","Garces","21","2002-12-23","Female","1227 Clark St. Sta Rita, Olongapo City","09666568606","helengarces71@gmail.com","Part Time","helenG2321","$2y$10$gUukqPDjyEGkfSNt.KbQwelAfvMLNhMF3FmapfRrlYU3/hajiI7fu","0","2024-02-16 14:39:37","0","0","","1");
INSERT INTO userinfo VALUES("5","Angel","","Carpeso","22","2002-05-01","Female","#32 5th st West Tapinac Olongapo City","09359218401","angelmaecarpeso@gmail.com","Full Time","Angel1234","$2y$10$4M2SS9w5/ccPyxdyYZ8UUOpCU0LSvKEyw4v5g/bRiM9mr8WRyJrEC","0","2024-02-15 23:10:17","0","0","","1");
INSERT INTO userinfo VALUES("10","Eden","","direc","24","1999-12-12","Male","Pag-asa","9127339200","ren@gmail.com","Full Time","EdenGGGrt2","$2y$10$bVuctoGrO8yFMd0XgLBNRu2mRynZylW.smXRdFr69FO.RdgtStIuK","0","2024-02-16 17:23:20","0","0","","1");



CREATE TABLE `userroles` (
  `UserRoleID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  PRIMARY KEY (`UserRoleID`),
  KEY `Roles` (`RoleID`),
  KEY `UserInfo` (`UserID`),
  CONSTRAINT `Roles` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`),
  CONSTRAINT `UserInfo` FOREIGN KEY (`UserID`) REFERENCES `userinfo` (`UserInfoID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

INSERT INTO userroles VALUES("1","1","1");
INSERT INTO userroles VALUES("6","3","4");
INSERT INTO userroles VALUES("7","5","2");
INSERT INTO userroles VALUES("8","2","3");
INSERT INTO userroles VALUES("13","10","4");
INSERT INTO userroles VALUES("14","3","2");
INSERT INTO userroles VALUES("15","3","3");



CREATE TABLE `userspecialization` (
  `UserSpecID` int(11) NOT NULL AUTO_INCREMENT,
  `ClassificationID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`UserSpecID`),
  KEY `UserID` (`UserID`),
  KEY `ClassificationID` (`ClassificationID`),
  CONSTRAINT `ClassificationID` FOREIGN KEY (`ClassificationID`) REFERENCES `classification` (`ClassificationID`),
  CONSTRAINT `UserID` FOREIGN KEY (`UserID`) REFERENCES `userinfo` (`UserInfoID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO userspecialization VALUES("1","1","4");
INSERT INTO userspecialization VALUES("2","1","3");
INSERT INTO userspecialization VALUES("3","2","4");

