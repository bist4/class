

CREATE TABLE `day` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Days` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  CONSTRAINT `department_ibfk_1` FOREIGN KEY (`DepartmentTypeNameID`) REFERENCES `departmenttypename` (`DepartmentTypeNameID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `department_ibfk_2` FOREIGN KEY (`StrandID`) REFERENCES `strands` (`StrandID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=356 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
INSERT INTO department VALUES("338","1","11","1","125","1");
INSERT INTO department VALUES("339","1","11","2","125","1");
INSERT INTO department VALUES("340","1","12","1","125","1");
INSERT INTO department VALUES("341","1","12","2","125","1");
INSERT INTO department VALUES("350","1","11","1","128","1");
INSERT INTO department VALUES("352","1","11","1","129","1");
INSERT INTO department VALUES("353","1","11","2","129","1");
INSERT INTO department VALUES("354","1","12","1","129","1");
INSERT INTO department VALUES("355","1","12","2","129","1");



CREATE TABLE `departmenttypename` (
  `DepartmentTypeNameID` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentTypeName` varchar(45) NOT NULL,
  PRIMARY KEY (`DepartmentTypeNameID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  KEY `SectionID` (`SectionID`),
  CONSTRAINT `history_ibfk_1` FOREIGN KEY (`DepartmentID`) REFERENCES `department` (`DepartmentID`),
  CONSTRAINT `history_ibfk_2` FOREIGN KEY (`InstructorPreferredSubjectID`) REFERENCES `instructorpreferredsubject` (`InstructorPreferredSubjectID`),
  CONSTRAINT `history_ibfk_3` FOREIGN KEY (`InstructorTimeAvailabilityID`) REFERENCES `instructortimeavailabilities` (`InstructorTimeAvailabilityID`),
  CONSTRAINT `history_ibfk_4` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`),
  CONSTRAINT `history_ibfk_5` FOREIGN KEY (`SectionID`) REFERENCES `sections` (`SectionID`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`DepartmentID`) REFERENCES `department` (`DepartmentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO instructor VALUES("133","4","Frediric","Ewan","Guinto","Male","20","2002-12-12","Subic","09127339204","red@gmail.com","Math","Full Time","10","2023-11-12 21:20:20");
INSERT INTO instructor VALUES("135","339","Angel","Basa","Carpeso","Male","21","2002-01-01","Zambales","09359218401","angelmaecarpeso@gmail.com","Filipino, Mathematics, English","Full Time","1","2023-11-12 22:11:44");
INSERT INTO instructor VALUES("136","4","Angelo","Trimor","Cuenco","Male","21","2002-02-21","Subic","09127339201","cuenco@gmail.com","Math","Full Time","1","2023-11-12 22:11:41");
INSERT INTO instructor VALUES("137","4","Christopher ","Basa","Dente","Male","22","2001-08-13","GH","09127339202","tope@gmail.com","English","Full Time","10","2023-11-01 00:03:39");
INSERT INTO instructor VALUES("138","8","Jasmine Kaye","Pos","Osorio","Female","21","2002-07-21","Gordon Heights","09127339207","jas@gmail.com","Filipino","Full Time","1","2023-11-12 22:11:38");
INSERT INTO instructor VALUES("139","338","Laurence","FSDFSFSD","DSDFDSF","","21","2002-02-12","Zambales","09359218401","angelmaecarpeso@gmail.com","Web ","Part Time","1","2023-11-12 22:11:17");
INSERT INTO instructor VALUES("140","4","fasdasdadadadad","sadadadadadadad","asdadasdadasd","","21","2002-02-21","Zambales","09359218401","angelmaecarpeso@gmail.com","Filipino","Full Time","1","2023-11-12 22:11:20");
INSERT INTO instructor VALUES("141","4","asdadas12123","sadasdasd","sasfasfdfsf","Female","21","2002-01-01","tope@gmail.com","09359218401","angelmaecarpeso@gmail.com","tope@gmail.com","Part Time","1","2023-11-12 22:11:22");
INSERT INTO instructor VALUES("142","4","1234rsdsddzs","adadadadasdaeaweqweqewadada","adadadadadasdadasdasdasdadasdas","Female","20","2002-12-11","Zambales","09359218401","angelmaecarpeso@gmail.com","Zambales","Full Time","10","2023-11-01 00:03:46");
INSERT INTO instructor VALUES("143","340","Nano","Mema","Mekus","Male","21","2002-02-12","Banicain","09127339200","mekus@gmail.com","Oral Communication","Full Time","1","2023-11-12 22:11:27");
INSERT INTO instructor VALUES("144","341","Nano","Mema","Mekus","Male","21","2002-02-12","Banicain ","09127339200","mekus@gmail.com","Oral Communication","Full Time","1","2023-11-12 22:11:30");
INSERT INTO instructor VALUES("145","338","Shizuka","Nobita","Doraemon","Female","4642","6666-07-05","GHOC","09097888888","rencejian@gmail.com","Sex Education","Full Time","1","2023-11-12 22:11:32");



CREATE TABLE `instructorpreferredsubject` (
  `InstructorPreferredSubjectID` int(11) NOT NULL AUTO_INCREMENT,
  `InstructorID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Active` int(11) NOT NULL,
  PRIMARY KEY (`InstructorPreferredSubjectID`),
  KEY `InstructorID` (`InstructorID`),
  KEY `SubjectID` (`SubjectID`),
  CONSTRAINT `instructorpreferredsubject_ibfk_1` FOREIGN KEY (`InstructorID`) REFERENCES `instructor` (`InstructorID`),
  CONSTRAINT `instructorpreferredsubject_ibfk_2` FOREIGN KEY (`SubjectID`) REFERENCES `subjects` (`SubjectID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO instructorpreferredsubject VALUES("15","139","97","2023-11-12 22:12:32","1");
INSERT INTO instructorpreferredsubject VALUES("16","136","127","2023-11-09 18:22:31","1");
INSERT INTO instructorpreferredsubject VALUES("17","138","118","2023-11-09 18:22:38","1");
INSERT INTO instructorpreferredsubject VALUES("18","136","127","2023-11-12 17:53:17","1");
INSERT INTO instructorpreferredsubject VALUES("19","145","123","2023-11-13 10:58:04","1");
INSERT INTO instructorpreferredsubject VALUES("20","139","97","2023-11-13 11:04:22","1");



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
  CONSTRAINT `instructortimeavailabilities_ibfk_1` FOREIGN KEY (`DaysID`) REFERENCES `day` (`id`),
  CONSTRAINT `instructortimeavailabilities_ibfk_2` FOREIGN KEY (`InstructorID`) REFERENCES `instructor` (`InstructorID`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO instructortimeavailabilities VALUES("49","1","139","08:00:00","17:00:00","2023-11-12 22:12:44","1");
INSERT INTO instructortimeavailabilities VALUES("50","2","139","08:00:00","17:00:00","2023-11-12 22:12:50","1");
INSERT INTO instructortimeavailabilities VALUES("51","3","139","08:00:00","17:00:00","2023-11-12 22:12:52","1");
INSERT INTO instructortimeavailabilities VALUES("52","4","139","08:00:00","17:00:00","2023-11-12 22:12:54","1");
INSERT INTO instructortimeavailabilities VALUES("53","5","139","08:00:00","17:00:00","2023-11-12 22:12:57","1");
INSERT INTO instructortimeavailabilities VALUES("54","1","145","08:00:00","09:00:00","2023-11-13 07:36:50","1");



CREATE TABLE `logs` (
  `LogID` int(11) NOT NULL AUTO_INCREMENT,
  `DateTime` varchar(45) NOT NULL,
  `Activity` varchar(255) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Active` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`LogID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=1063 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO logs VALUES("718","2023-10-11 02:42:41","Added Subject: MATH1 | Mathematics","8","1","2023-10-11 08:42:41");
INSERT INTO logs VALUES("719","2023-10-11 02:42:47","Added section: Section Number 1, Section Name Rose","8","1","2023-10-11 08:42:47");
INSERT INTO logs VALUES("720","2023-10-11 02:42:57","Update Instructor: Angel (Department Type: 174 -> , Status:  -> Full Time)","19","1","2023-10-11 08:42:57");
INSERT INTO logs VALUES("721","2023-10-11 02:43:32","Added room: 12","8","1","2023-10-11 08:43:32");
INSERT INTO logs VALUES("722","2023-10-11 02:44:39","Updated Strand: ABM (Specialization: 29 -> Fundamentals of Accountancy, Business and Man)","19","1","2023-10-11 08:44:39");
INSERT INTO logs VALUES("723","2023-10-11 02:49:50","Update Room: 12 (Room Number: 12 -> 12, Capacity: 30 -> 30, Room Type: 1 -> 2, RoomTypeName: 1 -> Laboratory)","19","1","2023-10-11 08:49:50");
INSERT INTO logs VALUES("724","2023-10-11 03:16:18","Added room: 12","8","1","2023-10-11 09:16:18");
INSERT INTO logs VALUES("725","2023-10-11 03:34:23","Delete Room Number:  (Room Type: )","8","1","2023-10-11 09:34:23");
INSERT INTO logs VALUES("726","2023-10-11 03:34:37","Added room: 12","8","10","2023-10-12 08:13:44");
INSERT INTO logs VALUES("727","2023-10-11 03:42:56","Added room: 12","8","10","2023-10-12 08:13:44");
INSERT INTO logs VALUES("728","2023-10-11 17:13:51","Delete Room Number: Unknown (Room Type: Unknown)","19","1","2023-10-11 23:13:51");
INSERT INTO logs VALUES("729","2023-10-11 17:13:51","Delete Room Number: 12 (Room Type: Laboratory)","19","1","2023-10-11 23:13:51");
INSERT INTO logs VALUES("730","2023-10-11 17:17:03","Delete Room Number: 12 (Room Type: Laboratory)","19","1","2023-10-11 23:17:03");
INSERT INTO logs VALUES("731","2023-10-11 17:17:03","Delete Room Number: Unknown (Room Type: Unknown)","19","1","2023-10-11 23:17:03");
INSERT INTO logs VALUES("732","2023-10-11 17:30:48","Delete Room Number: 12 (Room Type: Laboratory)","19","1","2023-10-11 23:30:48");
INSERT INTO logs VALUES("733","2023-10-11 17:30:48","Delete Room Number: Unknown (Room Type: Unknown)","19","1","2023-10-11 23:30:48");
INSERT INTO logs VALUES("734","2023-10-13 12:21:37","Added Strand: ABM","19","1","2023-10-13 18:21:37");
INSERT INTO logs VALUES("735","2023-10-13 12:22:44","Deleted Strand with ID: ","19","1","2023-10-13 18:22:44");
INSERT INTO logs VALUES("736","2023-10-13 12:24:33","Updated Strand: ABM (Specialization: 31 -> Business Finance)","21","1","2023-10-13 18:24:33");
INSERT INTO logs VALUES("737","2023-10-13 12:24:56","Added Strand: STEM","19","1","2023-10-13 18:24:56");
INSERT INTO logs VALUES("738","2023-10-13 12:33:40","Added Instructor: Christopher  Basa Dente","21","1","2023-10-13 18:33:40");
INSERT INTO logs VALUES("739","2023-10-13 12:36:23","Added Instructor: Jasmine Kaye Pos Osorio","19","1","2023-10-13 18:36:23");
INSERT INTO logs VALUES("740","2023-10-14 03:25:39","Delete Room Number: 405 (Room Type: Laboratory)","19","1","2023-10-14 09:25:39");
INSERT INTO logs VALUES("741","2023-10-14 03:25:39","Delete Room Number: Unknown (Room Type: Unknown)","19","1","2023-10-14 09:25:39");
INSERT INTO logs VALUES("742","2023-10-14 03:48:09","Added Instructor: sadafDSFSAF FSDFSFSD DSDFDSF","21","1","2023-10-14 09:48:09");
INSERT INTO logs VALUES("743","2023-10-14 03:53:46","Added Strand: STEM","19","1","2023-10-14 09:53:46");
INSERT INTO logs VALUES("744","2023-10-14 04:15:55","Added Strand: HUMSS","21","1","2023-10-14 10:15:55");
INSERT INTO logs VALUES("745","2023-10-14 04:28:15","Delete Strand: Science, Technology, Engineering, and Mathematics (Strand Code: STEM)","19","1","2023-10-14 10:28:15");
INSERT INTO logs VALUES("746","2023-10-14 04:28:15","Delete Strand: Unknown (Strand Code: Unknown)","19","1","2023-10-14 10:28:15");
INSERT INTO logs VALUES("747","2023-10-14 04:33:23","Added Strand: ICT","21","1","2023-10-14 10:33:23");
INSERT INTO logs VALUES("748","2023-10-14 04:33:55","Delete Strand: Information Communication Technology (Strand Code: ICT)","19","1","2023-10-14 10:33:55");
INSERT INTO logs VALUES("749","2023-10-14 04:33:55","Delete Strand: Unknown (Strand Code: Unknown)","19","1","2023-10-14 10:33:55");
INSERT INTO logs VALUES("750","2023-10-14 04:38:27","Added Strand: ICT","21","1","2023-10-14 10:38:27");
INSERT INTO logs VALUES("751","2023-10-14 04:38:41","Delete Strand: Information Communication Technology (Strand Code: ICT)","19","1","2023-10-14 10:38:41");
INSERT INTO logs VALUES("752","2023-10-14 04:38:41","Delete Strand: Unknown (Strand Code: Unknown)","19","1","2023-10-14 10:38:41");
INSERT INTO logs VALUES("753","2023-10-14 04:38:48","Delete Strand: Unknown (Strand Code: Unknown)","19","1","2023-10-14 10:38:48");
INSERT INTO logs VALUES("754","2023-10-14 04:38:48","Delete Strand: Science, Technology, Engineering, and Mathematics (Strand Code: STEM)","19","1","2023-10-14 10:38:48");
INSERT INTO logs VALUES("755","2023-10-14 04:38:50","Delete Strand: Unknown (Strand Code: Unknown)","19","1","2023-10-14 10:38:50");
INSERT INTO logs VALUES("756","2023-10-14 04:38:50","Delete Strand: Science, Technology, Engineering, and Mathematics (Strand Code: STEM)","19","1","2023-10-14 10:38:50");
INSERT INTO logs VALUES("757","2023-10-14 04:38:53","Delete Strand: Accountancy, Business and Management (Strand Code: ABM)","19","1","2023-10-14 10:38:53");
INSERT INTO logs VALUES("758","2023-10-14 04:38:53","Delete Strand: Unknown (Strand Code: Unknown)","19","1","2023-10-14 10:38:53");
INSERT INTO logs VALUES("759","2023-10-14 04:38:55","Delete Strand: Home Economics (Strand Code: HE)","19","1","2023-10-14 10:38:55");
INSERT INTO logs VALUES("760","2023-10-14 04:38:55","Delete Strand: Unknown (Strand Code: Unknown)","19","1","2023-10-14 10:38:55");
INSERT INTO logs VALUES("761","2023-10-14 04:38:57","Delete Strand: Unknown (Strand Code: Unknown)","19","1","2023-10-14 10:38:57");
INSERT INTO logs VALUES("762","2023-10-14 04:39:38","Deleted Strand with ID: ","19","1","2023-10-14 10:39:38");
INSERT INTO logs VALUES("763","2023-10-14 04:39:45","Deleted Strand with ID: ","19","1","2023-10-14 10:39:45");
INSERT INTO logs VALUES("764","2023-10-14 04:39:53","Deleted Strand with ID: ","19","1","2023-10-14 10:39:53");
INSERT INTO logs VALUES("765","2023-10-14 04:39:58","Deleted Strand with ID: ","19","1","2023-10-14 10:39:58");
INSERT INTO logs VALUES("766","2023-10-14 04:40:02","Deleted Strand with ID: ","19","1","2023-10-14 10:40:02");
INSERT INTO logs VALUES("767","2023-10-14 04:40:05","Deleted Strand with ID: ","19","1","2023-10-14 10:40:05");
INSERT INTO logs VALUES("768","2023-10-14 04:40:09","Deleted Strand with ID: ","19","1","2023-10-14 10:40:09");
INSERT INTO logs VALUES("769","2023-10-14 04:40:12","Deleted Strand with ID: ","19","1","2023-10-14 10:40:12");
INSERT INTO logs VALUES("770","2023-10-14 04:40:14","Deleted Strand with ID: ","19","1","2023-10-14 10:40:14");
INSERT INTO logs VALUES("771","2023-10-14 04:40:17","Deleted Strand with ID: ","19","1","2023-10-14 10:40:17");
INSERT INTO logs VALUES("772","2023-10-14 04:40:20","Deleted Strand with ID: ","19","1","2023-10-14 10:40:20");
INSERT INTO logs VALUES("773","2023-10-14 04:40:24","Deleted Strand with ID: ","19","1","2023-10-14 10:40:24");
INSERT INTO logs VALUES("774","2023-10-14 04:42:42","Added Strand: HUMSS","21","1","2023-10-14 10:42:42");
INSERT INTO logs VALUES("775","2023-10-14 04:42:57","Delete Strand: Unknown (Strand Code: Unknown)","19","1","2023-10-14 10:42:57");
INSERT INTO logs VALUES("776","2023-10-14 04:42:57","Delete Strand: Humanities and Social Sciences (Strand Code: HUMSS)","19","1","2023-10-14 10:42:57");
INSERT INTO logs VALUES("777","2023-10-14 04:43:12","Deleted Strand with ID: ","19","1","2023-10-14 10:43:12");
INSERT INTO logs VALUES("778","2023-10-14 04:43:21","Added Strand: HUMSS","21","1","2023-10-14 10:43:21");
INSERT INTO logs VALUES("779","2023-10-14 04:43:35","Delete Strand: Humanities and Social Sciences (Strand Code: HUMSS)","19","1","2023-10-14 10:43:35");
INSERT INTO logs VALUES("780","2023-10-14 04:43:35","Delete Strand: Unknown (Strand Code: Unknown)","19","1","2023-10-14 10:43:35");
INSERT INTO logs VALUES("781","2023-10-14 04:56:15","Added Strand: HUMSS","21","1","2023-10-14 10:56:15");
INSERT INTO logs VALUES("782","2023-10-14 04:56:17","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-14 10:56:17");
INSERT INTO logs VALUES("783","2023-10-14 04:56:17","Delete Strand: Humanities and Social Sciences (Strand Code: HUMSS)","21","1","2023-10-14 10:56:17");
INSERT INTO logs VALUES("784","2023-10-14 04:57:37","Added Strand: HUMSS","21","1","2023-10-14 10:57:37");
INSERT INTO logs VALUES("785","2023-10-14 04:57:42","Updated Strand: HUMSS (Specialization: 42 -> Disciplines and Ideas in the Applied Social S)","21","1","2023-10-14 10:57:42");
INSERT INTO logs VALUES("786","2023-10-14 05:04:09","Added Subject: MATH1 | Mathematics","21","1","2023-10-14 11:04:09");
INSERT INTO logs VALUES("787","2023-10-14 05:09:42","Delete Strand: Humanities and Social Sciences (Strand Code: HUMSS)","21","1","2023-10-14 11:09:42");
INSERT INTO logs VALUES("788","2023-10-14 05:09:42","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-14 11:09:42");
INSERT INTO logs VALUES("789","2023-10-14 05:12:58","Added Subject: MATH1 | Mathematics","21","1","2023-10-14 11:12:58");
INSERT INTO logs VALUES("790","2023-10-14 05:15:31","Added Subject: MATH1 | Mathematics","21","1","2023-10-14 11:15:31");
INSERT INTO logs VALUES("791","2023-10-14 05:17:37","Delete Subject: Unknown (Subject Code: Unkown)","21","1","2023-10-14 11:17:37");
INSERT INTO logs VALUES("792","2023-10-14 05:17:51","Added Subject: MATH1 | Mathematics","21","1","2023-10-14 11:17:51");
INSERT INTO logs VALUES("793","2023-10-14 05:21:11","Update Subject: MATH (Department Type: 8 -> , Units: 1 -> 1)","21","1","2023-10-14 11:21:11");
INSERT INTO logs VALUES("794","2023-10-14 05:21:47","Delete Subject: Mathematics 1 (Subject Code: MATH)","21","1","2023-10-14 11:21:47");
INSERT INTO logs VALUES("795","2023-10-14 05:21:47","Delete Subject: Unknown (Subject Code: Unkown)","21","1","2023-10-14 11:21:47");
INSERT INTO logs VALUES("796","2023-10-14 05:23:38","Added section: Section Number 1, Section Name Respeto","21","1","2023-10-14 11:23:38");
INSERT INTO logs VALUES("797","2023-10-14 05:26:03","Delete Section: Unkown (Section Name: Unkown)","21","1","2023-10-14 11:26:03");
INSERT INTO logs VALUES("798","2023-10-14 05:26:20","Added section: Section Number 1, Section Name Ikaw","21","1","2023-10-14 11:26:20");
INSERT INTO logs VALUES("799","2023-10-14 05:26:33","Delete Section: 1 (Section Name: Ikaw)","21","1","2023-10-14 11:26:33");
INSERT INTO logs VALUES("800","2023-10-14 05:26:33","Delete Section: Unkown (Section Name: Unkown)","21","1","2023-10-14 11:26:33");
INSERT INTO logs VALUES("801","2023-10-14 05:27:18","Added section: Section Number 123, Section Name Venus","21","1","2023-10-14 11:27:18");
INSERT INTO logs VALUES("802","2023-10-14 05:27:27","Delete Section: 123 (Section Name: Venus)","21","1","2023-10-14 11:27:27");
INSERT INTO logs VALUES("803","2023-10-14 05:27:27","Delete Section: SectionNo (Section Name: SectionName)","21","1","2023-10-14 11:27:27");
INSERT INTO logs VALUES("804","2023-10-14 05:28:37","Added section: Section Number 12222, Section Name Jupiter","21","1","2023-10-14 11:28:37");
INSERT INTO logs VALUES("805","2023-10-14 05:28:59","Update Section: 12222 (Section Number: 12222 -> 12222)","21","1","2023-10-14 11:28:59");
INSERT INTO logs VALUES("806","2023-10-14 05:31:11","Delete Section:  -> ,  (Section Name: SectionName)","21","1","2023-10-14 11:31:11");
INSERT INTO logs VALUES("807","2023-10-14 05:31:11","Delete Section: 12222 (Section Name: Jupiter2)","21","1","2023-10-14 11:31:11");
INSERT INTO logs VALUES("808","2023-10-14 05:32:07","Added Instructor: fasdasdadadadad sadadadadadadad asdadasdadasd","21","1","2023-10-14 11:32:07");
INSERT INTO logs VALUES("809","2023-10-14 06:18:06","Delete Instructor: Unkown Unkown Unkown","21","1","2023-10-14 12:18:06");
INSERT INTO logs VALUES("810","2023-10-14 06:18:26","Delete Instructor: Jasmine Kaye Pos Osorio","21","1","2023-10-14 12:18:26");
INSERT INTO logs VALUES("811","2023-10-14 06:18:26","Delete Instructor: Unkown Unkown Unkown","21","1","2023-10-14 12:18:26");
INSERT INTO logs VALUES("812","2023-10-14 06:20:36","Delete Instructor:  -> ,  Unkown Unkown","21","1","2023-10-14 12:20:36");
INSERT INTO logs VALUES("813","2023-10-14 06:20:36","Delete Instructor: Christopher  Basa Dente","21","1","2023-10-14 12:20:36");
INSERT INTO logs VALUES("814","2023-10-14 06:22:03","Added Subject: SCI | Science","21","1","2023-10-14 12:22:03");
INSERT INTO logs VALUES("815","2023-10-14 06:22:06","Delete Subject:  -> ,  (Subject Code: Unkown)","21","1","2023-10-14 12:22:06");
INSERT INTO logs VALUES("816","2023-10-14 06:22:06","Delete Subject: Science (Subject Code: SCI)","21","1","2023-10-14 12:22:06");
INSERT INTO logs VALUES("817","2023-10-14 06:23:08","Added Subject: APE | Applied Economics","21","1","2023-10-14 12:23:08");
INSERT INTO logs VALUES("818","2023-10-14 06:23:12","Delete Subject:  -> ,  (Subject Code: ->,)","21","1","2023-10-14 12:23:12");
INSERT INTO logs VALUES("819","2023-10-14 06:23:12","Delete Subject: Applied Economics (Subject Code: APE)","21","1","2023-10-14 12:23:12");
INSERT INTO logs VALUES("820","2023-10-14 06:23:56","Delete Instructor: Angelo Trimor Cuenco","21","1","2023-10-14 12:23:56");
INSERT INTO logs VALUES("821","2023-10-14 06:23:56","Delete Instructor:  -> ,   -> ,   -> , ","21","1","2023-10-14 12:23:56");
INSERT INTO logs VALUES("822","2023-10-14 06:25:03","Delete Instructor: Frediric Ewan Guinto","21","1","2023-10-14 12:25:03");
INSERT INTO logs VALUES("823","2023-10-14 06:25:03","Delete Instructor:  -> ,  Unkown Unkown","21","1","2023-10-14 12:25:03");
INSERT INTO logs VALUES("824","2023-10-14 06:26:11","Added Instructor: asdadas sadasdasd sasfasfdfsf","21","1","2023-10-14 12:26:11");
INSERT INTO logs VALUES("825","2023-10-14 06:28:02","Update Instructor: asdadas1212 (Department Type: 4 -> , Status:  -> Full Time)","21","1","2023-10-14 12:28:02");
INSERT INTO logs VALUES("826","2023-10-14 06:28:36","Update Instructor: asdadas12123 (Department Type: 4 -> , Status:  -> Part Time)","21","1","2023-10-14 12:28:36");
INSERT INTO logs VALUES("827","2023-10-14 06:30:50","Delete Instructor: ,  ,  , ","21","1","2023-10-14 12:30:50");
INSERT INTO logs VALUES("828","2023-10-14 06:30:56","Delete Instructor: asdadas12123 sadasdasd sasfasfdfsf","21","1","2023-10-14 12:30:56");
INSERT INTO logs VALUES("829","2023-10-14 06:30:56","Delete Instructor: ,  ,  , ","21","1","2023-10-14 12:30:56");
INSERT INTO logs VALUES("830","2023-10-14 06:32:57","Delete Instructor: ,  ,  , ","21","1","2023-10-14 12:32:57");
INSERT INTO logs VALUES("831","2023-10-14 06:33:04","Delete Instructor: Frediric Ewan Guinto","21","1","2023-10-14 12:33:04");
INSERT INTO logs VALUES("832","2023-10-14 06:33:04","Delete Instructor: ,  ,  , ","21","1","2023-10-14 12:33:04");
INSERT INTO logs VALUES("833","2023-10-14 06:35:16","Delete Instructor: asdadas12123 sadasdasd sasfasfdfsf","21","1","2023-10-14 12:35:16");
INSERT INTO logs VALUES("834","2023-10-14 06:35:16","Delete Instructor:   ","21","1","2023-10-14 12:35:16");
INSERT INTO logs VALUES("835","2023-10-14 06:38:18","Delete Instructor: asdadas12123 sadasdasd sasfasfdfsf","21","1","2023-10-14 12:38:18");
INSERT INTO logs VALUES("836","2023-10-14 06:38:18","Delete Instructor:  -> ,   -> ,   -> , ","21","1","2023-10-14 12:38:18");
INSERT INTO logs VALUES("837","2023-10-14 06:44:37","Delete Instructor: Frediric Ewan Guinto","21","1","2023-10-14 12:44:37");
INSERT INTO logs VALUES("838","2023-10-14 06:44:37","Delete Instructor:  -> ,   -> ,   -> , ","21","1","2023-10-14 12:44:37");
INSERT INTO logs VALUES("839","2023-10-14 06:47:17","Update Room: 80 (Room Number: 79 -> 80, Capacity: 30 -> 29, Room Type: 1 -> 2, RoomTypeName: 1 -> Laboratory)","21","1","2023-10-14 12:47:17");
INSERT INTO logs VALUES("840","2023-10-14 06:47:56","Delete Room Number: Unknown (Room Type: Unknown)","19","1","2023-10-14 12:47:56");
INSERT INTO logs VALUES("841","2023-10-14 06:47:56","Delete Room Number: 80 (Room Type: Laboratory)","19","1","2023-10-14 12:47:56");
INSERT INTO logs VALUES("842","2023-10-14 06:48:00","Delete Room Number: 90 (Room Type: Laboratory)","19","1","2023-10-14 12:48:00");
INSERT INTO logs VALUES("843","2023-10-14 06:48:00","Delete Room Number: Unknown (Room Type: Unknown)","19","1","2023-10-14 12:48:00");
INSERT INTO logs VALUES("844","2023-10-14 06:50:10","Added room: 56","21","1","2023-10-14 12:50:10");
INSERT INTO logs VALUES("845","2023-10-14 06:50:21","Delete Room Number: Unknown (Room Type: Unknown)","19","1","2023-10-14 12:50:21");
INSERT INTO logs VALUES("846","2023-10-14 06:50:21","Delete Room Number: 56 (Room Type: Lecture)","19","1","2023-10-14 12:50:21");
INSERT INTO logs VALUES("847","2023-10-14 06:51:46","Delete Room Number: Unknown (Room Type: Unknown)","21","1","2023-10-14 12:51:46");
INSERT INTO logs VALUES("848","2023-10-14 06:51:46","Delete Room Number: 121212 (Room Type: Laboratory)","21","1","2023-10-14 12:51:46");
INSERT INTO logs VALUES("849","2023-10-14 06:51:51","Delete Room Number: Unknown (Room Type: Unknown)","21","1","2023-10-14 12:51:51");
INSERT INTO logs VALUES("850","2023-10-14 06:51:51","Delete Room Number: 212 (Room Type: Lecture)","21","1","2023-10-14 12:51:51");
INSERT INTO logs VALUES("851","2023-10-14 06:51:54","Delete Room Number: 212 (Room Type: Lecture)","21","1","2023-10-14 12:51:54");
INSERT INTO logs VALUES("852","2023-10-14 06:51:54","Delete Room Number: Unknown (Room Type: Unknown)","21","1","2023-10-14 12:51:54");
INSERT INTO logs VALUES("853","2023-10-14 06:51:58","Delete Room Number: 501 (Room Type: Lecture)","21","1","2023-10-14 12:51:58");
INSERT INTO logs VALUES("854","2023-10-14 06:51:58","Delete Room Number: Unknown (Room Type: Unknown)","21","1","2023-10-14 12:51:58");
INSERT INTO logs VALUES("855","2023-10-14 06:53:25","Delete Room Number:  -> ,  (Room Type: Unknown)","21","1","2023-10-14 12:53:25");
INSERT INTO logs VALUES("856","2023-10-14 06:53:32","Delete Room Number: 408 (Room Type: Lecture)","21","1","2023-10-14 12:53:32");
INSERT INTO logs VALUES("857","2023-10-14 06:53:32","Delete Room Number:  -> ,  (Room Type: Unknown)","21","1","2023-10-14 12:53:32");
INSERT INTO logs VALUES("858","2023-10-14 06:54:36","Delete Room Number:  -> ,  (Room Type:  -> , )","21","1","2023-10-14 12:54:36");
INSERT INTO logs VALUES("859","2023-10-14 06:54:36","Delete Room Number: 410 (Room Type: Lecture)","21","1","2023-10-14 12:54:36");
INSERT INTO logs VALUES("860","2023-10-14 06:54:40","Delete Room Number: 301 (Room Type: Lecture)","21","1","2023-10-14 12:54:40");
INSERT INTO logs VALUES("861","2023-10-14 06:54:40","Delete Room Number:  -> ,  (Room Type:  -> , )","21","1","2023-10-14 12:54:40");
INSERT INTO logs VALUES("862","2023-10-14 06:55:32","Added Strand: ICT","21","1","2023-10-14 12:55:32");
INSERT INTO logs VALUES("863","2023-10-14 06:55:50","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-14 12:55:50");
INSERT INTO logs VALUES("864","2023-10-14 06:55:50","Delete Strand: Information Communication Technology (Strand Code: ICT)","21","1","2023-10-14 12:55:50");
INSERT INTO logs VALUES("865","2023-10-14 08:52:52","Delete Room Number: 301 (Room Type: Lecture)","21","1","2023-10-14 14:52:52");
INSERT INTO logs VALUES("866","2023-10-14 08:52:52","Delete Room Number:  -> ,  (Room Type:  -> , )","21","1","2023-10-14 14:52:52");
INSERT INTO logs VALUES("867","2023-10-14 08:52:55","Update Room: 401 (Room Number: 401 -> 401, Capacity: 30 -> 30, Room Type: 1 -> 2, RoomTypeName: 1 -> Laboratory)","21","1","2023-10-14 14:52:55");
INSERT INTO logs VALUES("868","2023-10-14 08:53:00","Update Room: 401 (Room Number: 401 -> 401, Capacity: 30 -> 30, Room Type: 2 -> 1, RoomTypeName: 2 -> Lecture)","21","1","2023-10-14 14:53:00");
INSERT INTO logs VALUES("869","2023-10-14 08:53:05","Update Room: 401 (Room Number: 401 -> 401, Capacity: 30 -> 30, Room Type: 1 -> 2, RoomTypeName: 1 -> Laboratory)","21","1","2023-10-14 14:53:05");
INSERT INTO logs VALUES("870","2023-10-14 08:53:28","Deleted Room with ID: 67","19","1","2023-10-14 14:53:28");
INSERT INTO logs VALUES("871","2023-10-14 09:49:22","Added Strand: ABM","21","1","2023-10-14 15:49:22");
INSERT INTO logs VALUES("872","2023-10-14 09:49:36","Delete Strand: Accountancy, Business and Management (Strand Code: ABM)","21","1","2023-10-14 15:49:36");
INSERT INTO logs VALUES("873","2023-10-14 09:49:36","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-14 15:49:36");
INSERT INTO logs VALUES("874","2023-10-14 09:49:48","Added Strand: ABM","21","1","2023-10-14 15:49:48");
INSERT INTO logs VALUES("875","2023-10-14 09:52:13","Added Strand: STEM","21","1","2023-10-14 15:52:13");
INSERT INTO logs VALUES("876","2023-10-14 09:52:19","Updated Strand: ABM (Specialization: 32 -> Organization and Management)","21","1","2023-10-14 15:52:19");
INSERT INTO logs VALUES("877","2023-10-14 09:52:51","Deleted Room with ID: 69","19","1","2023-10-14 15:52:51");
INSERT INTO logs VALUES("878","2023-10-14 09:53:29","Delete Room Number: 401 (Room Type: Laboratory)","21","1","2023-10-14 15:53:29");
INSERT INTO logs VALUES("879","2023-10-14 09:53:29","Delete Room Number:  -> ,  (Room Type:  -> , )","21","1","2023-10-14 15:53:29");
INSERT INTO logs VALUES("880","2023-10-14 09:53:57","Added room: 401","21","1","2023-10-14 15:53:57");
INSERT INTO logs VALUES("881","2023-10-14 10:01:55","Deleted Room with ID: 74","19","1","2023-10-14 16:01:55");
INSERT INTO logs VALUES("882","2023-10-14 10:02:02","Deleted Strand with ID: ","19","1","2023-10-14 16:02:02");
INSERT INTO logs VALUES("883","2023-10-14 10:09:42","Deleted Strand with ID: ","19","1","2023-10-14 16:09:42");
INSERT INTO logs VALUES("884","2023-10-14 10:10:29","Deleted Strand with ID: ","19","1","2023-10-14 16:10:29");
INSERT INTO logs VALUES("885","2023-10-14 10:13:00","Deleted Strand with ID: 96","19","1","2023-10-14 16:13:00");
INSERT INTO logs VALUES("886","2023-10-14 10:13:06","Deleted Subject with ID: ","19","1","2023-10-14 16:13:06");
INSERT INTO logs VALUES("887","2023-10-14 10:13:43","Deleted Subject with ID: 64","19","1","2023-10-14 16:13:43");
INSERT INTO logs VALUES("888","2023-10-14 10:13:46","Deleted Subject with ID: 66","19","1","2023-10-14 16:13:46");
INSERT INTO logs VALUES("889","2023-10-14 10:13:50","Deleted Subject with ID: 65","19","1","2023-10-14 16:13:50");
INSERT INTO logs VALUES("890","2023-10-14 10:13:53","Deleted Subject with ID: 67","19","1","2023-10-14 16:13:53");
INSERT INTO logs VALUES("891","2023-10-14 10:14:06","Deleted Section with ID: 41","19","1","2023-10-14 16:14:06");
INSERT INTO logs VALUES("892","2023-10-14 10:24:15","Deleted Strand with ID: 96","19","1","2023-10-14 16:24:15");
INSERT INTO logs VALUES("893","2023-10-14 10:40:45","Added Strand: ICT","21","1","2023-10-14 16:40:45");
INSERT INTO logs VALUES("894","2023-10-14 10:43:39","Added Strand: ICT","21","1","2023-10-14 16:43:39");
INSERT INTO logs VALUES("895","2023-10-14 10:45:29","Added Strand:   ","21","1","2023-10-14 16:45:29");
INSERT INTO logs VALUES("896","2023-10-14 10:46:37","Updated Strand: ICT (Specialization: 20 -> Computer Programming (.net Technology)  (NC I)","21","1","2023-10-14 16:46:37");
INSERT INTO logs VALUES("897","2023-10-14 10:47:37","Delete Strand:   (Strand Code:   )","21","1","2023-10-14 16:47:37");
INSERT INTO logs VALUES("898","2023-10-14 10:47:37","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-14 16:47:37");
INSERT INTO logs VALUES("899","2023-10-14 10:47:52","Delete Strand: Information Communication Technology (Strand Code: ICT)","21","1","2023-10-14 16:47:52");
INSERT INTO logs VALUES("900","2023-10-14 10:47:52","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-14 16:47:52");
INSERT INTO logs VALUES("901","2023-10-14 10:48:44","Added Subject: MATH1 | Mathematics","21","1","2023-10-14 16:48:44");
INSERT INTO logs VALUES("902","2023-10-14 10:51:58","Update Subject: MATH1 (Department Type: 4 -> , Units: 1 -> 1)","21","1","2023-10-14 16:51:58");
INSERT INTO logs VALUES("903","2023-10-14 10:52:25","Update Subject: MATH1 (Department Type: 8 -> , Units: 2 -> 2)","21","1","2023-10-14 16:52:25");
INSERT INTO logs VALUES("904","2023-10-14 10:52:30","Delete Subject: Mathematics 1 (Subject Code: MATH1)","21","1","2023-10-14 16:52:30");
INSERT INTO logs VALUES("905","2023-10-14 10:52:30","Delete Subject:  -> ,  (Subject Code: ->,)","21","1","2023-10-14 16:52:30");
INSERT INTO logs VALUES("906","2023-10-14 10:53:50","Added section: Section Number 15, Section Name Angel","21","1","2023-10-14 16:53:50");
INSERT INTO logs VALUES("907","2023-10-14 10:54:41","Added section: Section Number 15, Section Name Jian","21","1","2023-10-14 16:54:41");
INSERT INTO logs VALUES("908","2023-10-14 10:57:24","Update Section: 15 (Section Number: 15 -> 15, SectionName: Jian -> Jians)","21","1","2023-10-14 16:57:24");
INSERT INTO logs VALUES("909","2023-10-14 10:57:35","Delete Section: 15 (Section Name: Jians)","21","1","2023-10-14 16:57:35");
INSERT INTO logs VALUES("910","2023-10-14 10:57:35","Delete Section:  -> ,  (Section Name: SectionName)","21","1","2023-10-14 16:57:35");
INSERT INTO logs VALUES("911","2023-10-14 10:58:24","Added Instructor: aasdasdadadadadadadadadadasd adadadadasdaeaweqweqewadada adadadadadasdadasdasdasdadasdas","21","1","2023-10-14 16:58:24");
INSERT INTO logs VALUES("912","2023-10-14 11:04:21","Update Instructor: 1234rsdsddzs (Department Type: 4 -> , Status:  -> Full Time)","21","1","2023-10-14 17:04:21");
INSERT INTO logs VALUES("913","2023-10-14 11:04:36","Delete Instructor: 1234rsdsddzs adadadadasdaeaweqweqewadada adadadadadasdadasdasdasdadasdas","21","1","2023-10-14 17:04:36");
INSERT INTO logs VALUES("914","2023-10-14 11:04:36","Delete Instructor:  -> ,   -> ,   -> , ","21","1","2023-10-14 17:04:36");
INSERT INTO logs VALUES("915","2023-10-14 11:05:03","Added room: 312","21","1","2023-10-14 17:05:03");
INSERT INTO logs VALUES("916","2023-10-14 11:06:16","Update Room: 312 (Room Number: 312 -> 312, Capacity: 30 -> 30, Room Type: 1 -> 2, RoomTypeName: 1 -> Laboratory)","21","1","2023-10-14 17:06:16");
INSERT INTO logs VALUES("917","2023-10-14 11:06:28","Delete Room Number: 312 (Room Type: Laboratory)","21","1","2023-10-14 17:06:28");
INSERT INTO logs VALUES("918","2023-10-14 11:06:28","Delete Room Number:  -> ,  (Room Type:  -> , )","21","1","2023-10-14 17:06:28");
INSERT INTO logs VALUES("919","2023-10-15 15:09:03","Added Strand: ICT","21","1","2023-10-15 21:09:03");
INSERT INTO logs VALUES("920","2023-10-15 15:09:11","Delete Strand: Information Communication Technology (Strand Code: ICT)","21","1","2023-10-15 21:09:11");
INSERT INTO logs VALUES("921","2023-10-15 15:09:11","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-15 21:09:11");
INSERT INTO logs VALUES("922","2023-10-15 15:56:35","Added Strand: HE","21","1","2023-10-15 21:56:35");
INSERT INTO logs VALUES("923","2023-10-15 15:56:55","Added Strand: ICT","21","1","2023-10-15 21:56:55");
INSERT INTO logs VALUES("924","2023-10-15 16:26:51","Added Strand: ABM","21","1","2023-10-15 22:26:51");
INSERT INTO logs VALUES("925","2023-10-15 16:43:20","Added Strand:        ","21","1","2023-10-15 22:43:20");
INSERT INTO logs VALUES("926","2023-10-15 16:46:07","Added Strand:        ","21","1","2023-10-15 22:46:07");
INSERT INTO logs VALUES("927","2023-10-15 16:46:12","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-15 22:46:12");
INSERT INTO logs VALUES("928","2023-10-15 16:46:12","Delete Strand:       (Strand Code:        )","21","1","2023-10-15 22:46:12");
INSERT INTO logs VALUES("929","2023-10-15 16:46:16","Delete Strand:       (Strand Code:        )","21","1","2023-10-15 22:46:16");
INSERT INTO logs VALUES("930","2023-10-15 16:46:16","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-15 22:46:16");
INSERT INTO logs VALUES("931","2023-10-15 16:48:10","Added Strand:       ","21","1","2023-10-15 22:48:10");
INSERT INTO logs VALUES("932","2023-10-15 16:49:20","Added Strand:    ","21","1","2023-10-15 22:49:20");
INSERT INTO logs VALUES("933","2023-10-15 16:50:29","Added Strand:  ","21","1","2023-10-15 22:50:29");
INSERT INTO logs VALUES("934","2023-10-15 16:52:59","Added Strand:  ","21","1","2023-10-15 22:52:59");
INSERT INTO logs VALUES("935","2023-10-15 16:53:28","Added section: Section Number 2, Section Name  ","21","1","2023-10-15 22:53:28");
INSERT INTO logs VALUES("936","2023-10-15 16:56:08","Added Strand: ABM","21","1","2023-10-15 22:56:08");
INSERT INTO logs VALUES("937","2023-10-15 16:57:03","Deleted Strand with ID: 96","19","1","2023-10-15 22:57:03");
INSERT INTO logs VALUES("938","2023-10-16 04:16:36","Deleted Room with ID: 70","19","1","2023-10-16 10:16:36");
INSERT INTO logs VALUES("939","2023-10-16 04:16:47","Deleted Room with ID: 72","19","1","2023-10-16 10:16:47");
INSERT INTO logs VALUES("940","2023-10-17 02:01:13","Added Strand: HE","21","1","2023-10-17 08:01:13");
INSERT INTO logs VALUES("941","2023-10-17 03:25:34","Deleted Room with ID: 61","19","1","2023-10-17 09:25:34");
INSERT INTO logs VALUES("942","2023-10-17 05:08:36","Added Strand: ICT","21","1","2023-10-17 11:08:36");
INSERT INTO logs VALUES("943","2023-10-18 16:24:03","Delete Strand: Information Communication Technology (Strand Code: ICT)","21","1","2023-10-18 22:24:03");
INSERT INTO logs VALUES("944","2023-10-18 16:24:03","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-18 22:24:03");
INSERT INTO logs VALUES("945","2023-10-18 16:24:06","Delete Strand: Humanities and Social Sciences (Strand Code: HE)","21","1","2023-10-18 22:24:06");
INSERT INTO logs VALUES("946","2023-10-18 16:24:06","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-18 22:24:06");
INSERT INTO logs VALUES("947","2023-10-18 16:24:09","Delete Strand: Accountancy, Business and Management (Strand Code: ABM)","21","1","2023-10-18 22:24:09");
INSERT INTO logs VALUES("948","2023-10-18 16:24:09","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-18 22:24:09");
INSERT INTO logs VALUES("949","2023-10-18 16:24:15","Delete Strand:        (Strand Code:       )","21","1","2023-10-18 22:24:15");
INSERT INTO logs VALUES("950","2023-10-18 16:24:15","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-18 22:24:15");
INSERT INTO logs VALUES("951","2023-10-18 16:24:18","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-18 22:24:18");
INSERT INTO logs VALUES("952","2023-10-18 16:24:18","Delete Strand:   (Strand Code:  )","21","1","2023-10-18 22:24:18");
INSERT INTO logs VALUES("953","2023-10-18 16:24:20","Delete Strand:   (Strand Code:  )","21","1","2023-10-18 22:24:20");
INSERT INTO logs VALUES("954","2023-10-18 16:24:20","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-18 22:24:20");
INSERT INTO logs VALUES("955","2023-10-18 16:24:26","Delete Strand:     (Strand Code:    )","21","1","2023-10-18 22:24:26");
INSERT INTO logs VALUES("956","2023-10-18 16:24:26","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-18 22:24:26");
INSERT INTO logs VALUES("957","2023-10-18 17:06:32","Added Strand: HE","21","1","2023-10-18 23:06:32");
INSERT INTO logs VALUES("958","2023-10-18 17:06:45","Added Strand: HE","21","1","2023-10-18 23:06:45");
INSERT INTO logs VALUES("959","2023-10-18 17:12:20","Added Subject:           |        ","21","1","2023-10-18 23:12:20");
INSERT INTO logs VALUES("960","2023-10-18 17:13:12","Added Subject:     SASDAD |       sasdad","21","1","2023-10-18 23:13:12");
INSERT INTO logs VALUES("961","2023-10-18 17:15:14","Added section: Section Number 1, Section Name      adds","21","1","2023-10-18 23:15:14");
INSERT INTO logs VALUES("962","2023-10-18 17:15:33","Update Section: 1 (Section Number: 1 -> 1, SectionName:      adds ->     dads)","21","1","2023-10-18 23:15:33");
INSERT INTO logs VALUES("963","2023-10-18 17:25:44","Added room: 12121","21","1","2023-10-18 23:25:44");
INSERT INTO logs VALUES("964","2023-10-18 18:21:24","Added Strand:            ICT","21","1","2023-10-19 00:21:24");
INSERT INTO logs VALUES("965","2023-10-18 18:30:40","Added Strand: HE","21","1","2023-10-19 00:30:40");
INSERT INTO logs VALUES("966","2023-10-18 18:40:56","Added Strand: ABM","21","1","2023-10-19 00:40:56");
INSERT INTO logs VALUES("967","2023-10-18 18:41:40","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-19 00:41:40");
INSERT INTO logs VALUES("968","2023-10-18 18:41:40","Delete Strand: Accountancy, Business and Management (Strand Code: ABM)","21","1","2023-10-19 00:41:40");
INSERT INTO logs VALUES("969","2023-10-18 18:41:49","Added Strand: ABM","21","1","2023-10-19 00:41:49");
INSERT INTO logs VALUES("970","2023-10-18 18:50:56","Added room: 1","21","1","2023-10-19 00:50:56");
INSERT INTO logs VALUES("971","2023-10-19 03:06:19","Added Instructor: Nano Mema Mekus","21","1","2023-10-19 09:06:19");
INSERT INTO logs VALUES("972","2023-10-19 03:45:33","Delete Subject:  -> ,  (Subject Code: ->,)","21","1","2023-10-19 09:45:33");
INSERT INTO logs VALUES("973","2023-10-19 03:45:33","Delete Subject:         (Subject Code:          )","21","1","2023-10-19 09:45:33");
INSERT INTO logs VALUES("974","2023-10-19 03:45:36","Delete Subject:  -> ,  (Subject Code: ->,)","21","1","2023-10-19 09:45:36");
INSERT INTO logs VALUES("975","2023-10-19 03:45:36","Delete Subject: Mathematics 1 (Subject Code: MATH1)","21","1","2023-10-19 09:45:36");
INSERT INTO logs VALUES("976","2023-10-19 03:45:39","Delete Subject:       sasdad (Subject Code:     SASDAD)","21","1","2023-10-19 09:45:39");
INSERT INTO logs VALUES("977","2023-10-19 03:45:39","Delete Subject:  -> ,  (Subject Code: ->,)","21","1","2023-10-19 09:45:39");
INSERT INTO logs VALUES("978","2023-10-19 03:47:25","Added Subject: PD | Personal Development","21","1","2023-10-19 09:47:25");
INSERT INTO logs VALUES("979","2023-10-19 03:47:56","Added Subject: MATH | Mathematics","21","1","2023-10-19 09:47:56");
INSERT INTO logs VALUES("980","2023-10-19 03:48:16","Added Subject: SCI | Science","21","1","2023-10-19 09:48:16");
INSERT INTO logs VALUES("981","2023-10-19 04:25:38","Update Instructor: Angel (Department Type: 230 -> , Status:  -> Full Time)","21","1","2023-10-19 10:25:38");
INSERT INTO logs VALUES("982","2023-10-19 05:37:38","Added Subject: MATH1 | Mathematics","21","1","2023-10-19 11:37:38");
INSERT INTO logs VALUES("983","2023-10-19 05:37:53","Update Subject: MATH1 (Department Type: 230 -> , Units: 1 -> 1)","21","1","2023-10-19 11:37:53");
INSERT INTO logs VALUES("984","2023-10-19 05:42:17","Added Subject: P.E1 | Physical Education 1","21","1","2023-10-19 11:42:17");
INSERT INTO logs VALUES("985","2023-10-19 16:05:10","Added Subject: MT | Mother Tounge","21","1","2023-10-19 22:05:10");
INSERT INTO logs VALUES("986","2023-10-19 16:10:45","Update Subject: MT (Department Type: 230 -> , Units: 1 -> 1)","21","1","2023-10-19 22:10:45");
INSERT INTO logs VALUES("987","2023-10-19 16:11:23","Update Subject: MT (Department Type: 230 -> , Units: 1 -> 1)","21","1","2023-10-19 22:11:23");
INSERT INTO logs VALUES("988","2023-10-19 16:11:30","Update Subject: MT (Department Type: 8 -> , Units: 1 -> 1)","21","1","2023-10-19 22:11:30");
INSERT INTO logs VALUES("989","2023-10-19 16:16:10","Deleted Strand with ID: 99","19","1","2023-10-19 22:16:10");
INSERT INTO logs VALUES("990","2023-10-19 16:47:06","Deleted Strand with ID: 101","19","1","2023-10-19 22:47:06");
INSERT INTO logs VALUES("991","2023-10-19 16:47:14","Deleted Strand with ID: 102","19","1","2023-10-19 22:47:14");
INSERT INTO logs VALUES("992","2023-10-19 16:47:23","Deleted Strand with ID: 119","19","1","2023-10-19 22:47:23");
INSERT INTO logs VALUES("993","2023-10-19 16:57:31","Deleted Strand with ID: 106","19","1","2023-10-19 22:57:31");
INSERT INTO logs VALUES("994","2023-10-22 15:17:40","Added Subject: PR1 | Practical Research 1","21","1","2023-10-22 21:17:40");
INSERT INTO logs VALUES("995","2023-10-22 17:29:15","Added Subject: FIL11 | Filipino","21","1","2023-10-22 23:29:15");
INSERT INTO logs VALUES("996","2023-10-22 17:46:13","Added Subject: MATH2 | Mathematics 2","21","1","2023-10-22 23:46:13");
INSERT INTO logs VALUES("997","2023-10-22 17:46:37","Added Subject: SCI | Science","21","1","2023-10-22 23:46:37");
INSERT INTO logs VALUES("998","2023-10-22 17:54:33","Added Subject: APE | Applied Economics","21","1","2023-10-22 23:54:33");
INSERT INTO logs VALUES("999","2023-10-22 18:37:43","Added Subject: TLE|TLE","21","1","2023-10-23 00:37:43");
INSERT INTO logs VALUES("1000","2023-10-22 18:42:39","Added Subject: TE | Test1","21","1","2023-10-23 00:42:39");
INSERT INTO logs VALUES("1001","2023-10-22 18:44:06","Added Subject: GT | Go na","21","1","2023-10-23 00:44:06");
INSERT INTO logs VALUES("1002","2023-10-22 18:44:51","Added Subject: SDFDFASFS | sdfasfsdfsdfsdf","21","1","2023-10-23 00:44:51");
INSERT INTO logs VALUES("1003","2023-10-22 18:55:36","Added Subject: LALALA | lalalala","21","1","2023-10-23 00:55:36");
INSERT INTO logs VALUES("1004","2023-10-22 19:08:49","Added Subject: KLAY | kalalallala","21","1","2023-10-23 01:08:49");
INSERT INTO logs VALUES("1005","2023-10-31 14:54:29","Deleted Room with ID: 63","19","1","2023-10-31 21:54:29");
INSERT INTO logs VALUES("1006","2023-10-31 14:54:39","Deleted Strand with ID: 112","19","1","2023-10-31 21:54:39");
INSERT INTO logs VALUES("1007","2023-10-31 15:08:12","Deleted Strand with ID: 114","19","1","2023-10-31 22:08:12");
INSERT INTO logs VALUES("1008","2023-10-31 15:14:34","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-31 22:14:34");
INSERT INTO logs VALUES("1009","2023-10-31 15:14:34","Delete Strand: Accountancy, Business and Management (Strand Code: ICT)","21","1","2023-10-31 22:14:34");
INSERT INTO logs VALUES("1010","2023-10-31 15:29:56","Deleted Section with ID: 45","19","1","2023-10-31 22:29:56");
INSERT INTO logs VALUES("1011","2023-10-31 15:36:03","Delete Strand: Accountancy, Business and Management (Strand Code: ICT)","21","1","2023-10-31 22:36:03");
INSERT INTO logs VALUES("1012","2023-10-31 15:36:03","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-31 22:36:03");
INSERT INTO logs VALUES("1013","2023-10-31 15:44:44","Delete Strand: Accountancy, Business and Management (Strand Code: ICT)","21","1","2023-10-31 22:44:44");
INSERT INTO logs VALUES("1014","2023-10-31 15:44:44","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-31 22:44:44");
INSERT INTO logs VALUES("1015","2023-10-31 15:46:28","Added Strand: ICT","21","1","2023-10-31 22:46:28");
INSERT INTO logs VALUES("1016","2023-10-31 15:46:36","Delete Strand: Information Communication Technology (Strand Code: ICT)","21","1","2023-10-31 22:46:36");
INSERT INTO logs VALUES("1017","2023-10-31 15:46:36","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-31 22:46:36");
INSERT INTO logs VALUES("1018","2023-10-31 16:01:26","Added Strand: ICT","21","1","2023-10-31 23:01:26");
INSERT INTO logs VALUES("1019","2023-10-31 16:02:22","Added Strand: ICT","21","1","2023-10-31 23:02:22");
INSERT INTO logs VALUES("1020","2023-10-31 16:02:48","Delete Strand: Information Communication Technology (Strand Code: ICT)","21","1","2023-10-31 23:02:48");
INSERT INTO logs VALUES("1021","2023-10-31 16:02:48","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-10-31 23:02:48");
INSERT INTO logs VALUES("1022","2023-10-31 16:07:18","Added Strand: ICT","21","1","2023-10-31 23:07:18");
INSERT INTO logs VALUES("1023","2023-10-31 16:07:28","Added Strand: ICT","21","1","2023-10-31 23:07:28");
INSERT INTO logs VALUES("1024","2023-10-31 16:07:38","Added Strand: ICT","21","1","2023-10-31 23:07:38");
INSERT INTO logs VALUES("1025","2023-10-31 16:10:25","Deleted Strand with ID: 124","19","1","2023-10-31 23:10:25");
INSERT INTO logs VALUES("1026","2023-10-31 16:58:18","Deleted Section with ID: 47","19","1","2023-10-31 23:58:18");
INSERT INTO logs VALUES("1027","2023-10-31 17:03:39","Deleted Instructor with ID: 137","19","1","2023-11-01 00:03:39");
INSERT INTO logs VALUES("1028","2023-10-31 17:03:46","Deleted Instructor with ID: 142","19","1","2023-11-01 00:03:46");
INSERT INTO logs VALUES("1029","2023-11-02 15:58:40","Delete Subject:  -> ,  (Subject Code: ->,)","21","1","2023-11-02 22:58:40");
INSERT INTO logs VALUES("1030","2023-11-02 15:58:40","Delete Subject: sfdasasf (Subject Code: SSDAASD)","21","1","2023-11-02 22:58:40");
INSERT INTO logs VALUES("1031","2023-11-02 15:58:44","Delete Subject: sndlaKdl;a (Subject Code: NLKHCLFFA "H)","21","1","2023-11-02 22:58:44");
INSERT INTO logs VALUES("1032","2023-11-02 15:58:44","Delete Subject:  -> ,  (Subject Code: ->,)","21","1","2023-11-02 22:58:44");
INSERT INTO logs VALUES("1033","2023-11-02 15:58:58","Update Subject: SFFDSFD (Department Type: 230 -> , Units: 2 -> 2)","21","1","2023-11-02 22:58:58");
INSERT INTO logs VALUES("1034","2023-11-02 16:20:30","Added Subject: DASDASDASD | asdasdadasdasd`","21","1","2023-11-02 23:20:30");
INSERT INTO logs VALUES("1035","2023-11-02 16:32:51","Added Subject: CTESTSTSTS | sdadadaasdasdasdas","21","1","2023-11-02 23:32:51");
INSERT INTO logs VALUES("1036","2023-11-02 16:38:08","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-11-02 23:38:08");
INSERT INTO logs VALUES("1037","2023-11-02 16:38:08","Delete Strand: Information Communication Technology (Strand Code: ICT)","21","1","2023-11-02 23:38:08");
INSERT INTO logs VALUES("1038","2023-11-02 17:45:49","Delete Strand: Unknown (Strand Code: Unknown)","21","1","2023-11-03 00:45:49");
INSERT INTO logs VALUES("1039","2023-11-04 10:53:14","Added Subject: SC | Science","21","1","2023-11-04 17:53:14");
INSERT INTO logs VALUES("1040","2023-11-04 10:53:46","Added Subject: ADASD | asdasdasd","21","1","2023-11-04 17:53:46");
INSERT INTO logs VALUES("1041","2023-11-04 11:02:13","Delete Subject:  -> ,  (Subject Code: ->,)","21","1","2023-11-04 18:02:13");
INSERT INTO logs VALUES("1042","2023-11-04 11:02:13","Delete Subject: asdasdasd (Subject Code: ADASD)","21","1","2023-11-04 18:02:13");
INSERT INTO logs VALUES("1043","2023-11-04 11:02:22","Delete Subject: Science (Subject Code: SC)","21","1","2023-11-04 18:02:22");
INSERT INTO logs VALUES("1044","2023-11-04 11:02:22","Delete Subject:  -> ,  (Subject Code: ->,)","21","1","2023-11-04 18:02:22");
INSERT INTO logs VALUES("1045","2023-11-04 11:11:04","Delete Section:  -> ,  (Section Name: SectionName)","21","1","2023-11-04 18:11:04");
INSERT INTO logs VALUES("1046","2023-11-04 11:11:04","Delete Section: 2 (Section Name:  )","21","1","2023-11-04 18:11:04");
INSERT INTO logs VALUES("1047","2023-11-04 11:11:17","Added section: Section Number 1, Section Name Asdas","21","1","2023-11-04 18:11:17");
INSERT INTO logs VALUES("1048","2023-11-05 15:07:49","Delete Subject:  -> ,  (Subject Code: ->,)","21","1","2023-11-05 22:07:49");
INSERT INTO logs VALUES("1049","2023-11-05 15:07:49","Delete Subject: tetststst (Subject Code: TETSTST)","21","1","2023-11-05 22:07:49");
INSERT INTO logs VALUES("1050","2023-11-05 15:31:20","Added Subject: DAASDASDASD | sadasdasdas","21","1","2023-11-05 22:31:20");
INSERT INTO logs VALUES("1051","2023-11-05 15:31:34","Added Subject: SADASDASASD | asdasdasdas","21","1","2023-11-05 22:31:34");
INSERT INTO logs VALUES("1052","2023-11-05 15:31:49","Added Subject: BKFDFSF;J | dsjksdbf","21","1","2023-11-05 22:31:49");
INSERT INTO logs VALUES("1053","2023-11-05 15:41:24","Added Subject: ADASDDS | asdasdasdas at Year Level 6","21","1","2023-11-05 22:41:24");
INSERT INTO logs VALUES("1054","2023-11-05 15:42:07","Added Subject: DASASDA | asdasdasd at Year Level 7","21","1","2023-11-05 22:42:07");
INSERT INTO logs VALUES("1055","2023-11-05 15:42:37","Added Subject: HAYS | haahah at Year Level 4","21","1","2023-11-05 22:42:37");
INSERT INTO logs VALUES("1056","2023-11-05 15:45:20","Added Subject: ASDAASD | asdasd1 at Year Level ","21","1","2023-11-05 22:45:20");
INSERT INTO logs VALUES("1057","2023-11-10 01:51:07","Delete Subject:  -> ,  (Subject Code: ->,)","21","1","2023-11-10 08:51:07");
INSERT INTO logs VALUES("1058","2023-11-10 01:51:07","Delete Subject: asdasdasd (Subject Code: DASASDA)","21","1","2023-11-10 08:51:07");
INSERT INTO logs VALUES("1059","2023-11-10 01:51:15","Delete Subject: haahah (Subject Code: HAYS)","21","1","2023-11-10 08:51:15");
INSERT INTO logs VALUES("1060","2023-11-10 01:51:15","Delete Subject:  -> ,  (Subject Code: ->,)","21","1","2023-11-10 08:51:15");
INSERT INTO logs VALUES("1061","2023-11-11 10:45:05","Added Strand: HUMSS","21","1","2023-11-11 17:45:05");
INSERT INTO logs VALUES("1062","2023-11-11 10:57:45","Added Instructor: Shizuka Nobita Doraemon","21","1","2023-11-11 17:57:45");



CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `Message` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `IsRead` int(11) NOT NULL,
  PRIMARY KEY (`NotificationID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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



CREATE TABLE `roles` (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `Roles` varchar(45) NOT NULL,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO roles VALUES("1","System Administrator");
INSERT INTO roles VALUES("2","School Director");
INSERT INTO roles VALUES("3","School Director Assitant");
INSERT INTO roles VALUES("4","Instructor");



CREATE TABLE `rooms` (
  `RoomID` int(11) NOT NULL AUTO_INCREMENT,
  `RoomNumber` int(11) NOT NULL,
  `Capacity` int(11) NOT NULL,
  `RoomTypeID` int(11) NOT NULL,
  `Active` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`RoomID`),
  KEY `RoomTypeID` (`RoomTypeID`),
  CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`RoomTypeID`) REFERENCES `roomtype` (`RoomTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO rooms VALUES("61","12","30","2","10","2023-10-17 09:25:34");
INSERT INTO rooms VALUES("62","12","30","2","1","2023-10-12 08:17:44");
INSERT INTO rooms VALUES("63","405","30","2","10","2023-10-31 21:54:29");
INSERT INTO rooms VALUES("64","405","30","2","1","2023-10-14 09:25:49");
INSERT INTO rooms VALUES("65","406","30","2","1","2023-10-14 09:29:51");
INSERT INTO rooms VALUES("66","401","30","2","0","2023-10-14 15:53:29");
INSERT INTO rooms VALUES("67","301","30","1","10","2023-10-14 14:53:28");
INSERT INTO rooms VALUES("68","410","30","1","1","2023-10-14 15:52:43");
INSERT INTO rooms VALUES("69","408","30","1","10","2023-10-14 15:52:51");
INSERT INTO rooms VALUES("70","501","30","1","10","2023-10-16 10:16:36");
INSERT INTO rooms VALUES("71","212","30","1","1","2023-10-16 10:17:09");
INSERT INTO rooms VALUES("72","121212","30","2","10","2023-10-16 10:16:47");
INSERT INTO rooms VALUES("73","90","30","2","1","2023-10-14 14:53:32");
INSERT INTO rooms VALUES("74","80","29","2","10","2023-10-14 16:01:55");
INSERT INTO rooms VALUES("75","56","30","1","1","2023-10-14 16:17:07");
INSERT INTO rooms VALUES("76","401","30","2","1","2023-10-14 15:53:57");
INSERT INTO rooms VALUES("77","312","30","2","1","2023-10-15 22:57:20");
INSERT INTO rooms VALUES("78","12121","1212","2","1","2023-10-18 23:25:44");
INSERT INTO rooms VALUES("79","1","1","1","1","2023-10-19 00:50:56");



CREATE TABLE `roomtype` (
  `RoomTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `RoomTypeName` varchar(45) NOT NULL,
  PRIMARY KEY (`RoomTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO roomtype VALUES("1","Lecture");
INSERT INTO roomtype VALUES("2","Laboratory");



CREATE TABLE `sections` (
  `SectionID` int(11) NOT NULL AUTO_INCREMENT,
  `SectionNo` int(11) NOT NULL,
  `SectionName` varchar(45) NOT NULL,
  `Active` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`SectionID`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO sections VALUES("41","1","Rose","10","2023-10-14 16:14:06");
INSERT INTO sections VALUES("42","1","Respeto","1","2023-10-14 16:24:37");
INSERT INTO sections VALUES("43","1","Ikaw","1","2023-10-14 16:24:46");
INSERT INTO sections VALUES("44","123","Venus","1","2023-10-14 16:32:23");
INSERT INTO sections VALUES("45","12222","Jupiter2","10","2023-10-31 22:29:56");
INSERT INTO sections VALUES("46","15","Jians","1","2023-10-31 23:55:23");
INSERT INTO sections VALUES("47","15","Jians","0","2023-10-31 23:58:29");
INSERT INTO sections VALUES("48","2"," ","0","2023-11-04 18:11:04");
INSERT INTO sections VALUES("49","1","    dads","1","2023-10-18 23:15:33");
INSERT INTO sections VALUES("50","1","Asdas","1","2023-11-04 18:11:17");



CREATE TABLE `specializations` (
  `SpecializationID` int(11) NOT NULL AUTO_INCREMENT,
  `Specialization` varchar(255) NOT NULL,
  PRIMARY KEY (`SpecializationID`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO specializations VALUES("1","Business Math");
INSERT INTO specializations VALUES("2","Emtech");
INSERT INTO specializations VALUES("3","Attractions and Theme Parks (NC II)");
INSERT INTO specializations VALUES("4","Barbering (NC II)");
INSERT INTO specializations VALUES("5","Bartending (NC II)");
INSERT INTO specializations VALUES("6","Beauty/Nail Care (NC II)");
INSERT INTO specializations VALUES("7","Bread and Pastry Production (NC II)");
INSERT INTO specializations VALUES("8","Caregiving (NC II)");
INSERT INTO specializations VALUES("9","Commercial Cooking (NC III)");
INSERT INTO specializations VALUES("10","Cookery (NC II)");
INSERT INTO specializations VALUES("11","Dressmaking (NC II)");
INSERT INTO specializations VALUES("12","Events Management Services (NC III)");
INSERT INTO specializations VALUES("13","Fashion Design (Apparel) (NC III)");
INSERT INTO specializations VALUES("14","Food and Beverage Services (NC II)");
INSERT INTO specializations VALUES("15","Front Office Services (NC II)");
INSERT INTO specializations VALUES("16","Hairdressing (NC II)");
INSERT INTO specializations VALUES("17","Handicraft (Basketry, Macrame) (Non-NC)");
INSERT INTO specializations VALUES("18","Handicraft (Fashion Accessories, Paper Craft)");
INSERT INTO specializations VALUES("19","Work Immersion");
INSERT INTO specializations VALUES("20","Computer Programming (.net Technology)  (NC I");
INSERT INTO specializations VALUES("21","Computer Programming (Java) (NC III)");
INSERT INTO specializations VALUES("22","Computer Programming (Oracle Database) (NC II");
INSERT INTO specializations VALUES("23","Computer Systems Servicing (NC II)");
INSERT INTO specializations VALUES("24","Contact Center Services (NC II)");
INSERT INTO specializations VALUES("25","Work Immersion");
INSERT INTO specializations VALUES("26","Telecom OSP Installation (Fiber Optic Cable) ");
INSERT INTO specializations VALUES("27","Applied Economics");
INSERT INTO specializations VALUES("28","Business Ethics and Social Responsibility");
INSERT INTO specializations VALUES("29","Fundamentals of Accountancy, Business and Man");
INSERT INTO specializations VALUES("30","Fundamentals of Accountancy, Business and Man");
INSERT INTO specializations VALUES("31","Business Finance");
INSERT INTO specializations VALUES("32","Organization and Management");
INSERT INTO specializations VALUES("33","Principles of Marketing");
INSERT INTO specializations VALUES("34","Work Immersion/Research/Career Advocacy/Culmi");
INSERT INTO specializations VALUES("35","Creative Writing / Malikhaing Pagsulat");
INSERT INTO specializations VALUES("36","Introduction to World Religions and Belief Sy");
INSERT INTO specializations VALUES("37","Creative Nonfiction");
INSERT INTO specializations VALUES("38","Trends, Networks, and Critical Thinking in th");
INSERT INTO specializations VALUES("39","Philippine Politics and Governance");
INSERT INTO specializations VALUES("40","Community Engagement, Solidarity, and Citizen");
INSERT INTO specializations VALUES("41","Disciplines and Ideas in the Social Sciences");
INSERT INTO specializations VALUES("42","Disciplines and Ideas in the Applied Social S");
INSERT INTO specializations VALUES("43","Work Immersion/Research/Career Advocacy/Culmi");
INSERT INTO specializations VALUES("44","Pre-Calculus");
INSERT INTO specializations VALUES("45","Basic Calculus");
INSERT INTO specializations VALUES("46","General Biology 1");
INSERT INTO specializations VALUES("47","General Biology 2");
INSERT INTO specializations VALUES("48","General Physics 1");
INSERT INTO specializations VALUES("49","General Physics 2");
INSERT INTO specializations VALUES("50","General Chemistry 1 and 2");
INSERT INTO specializations VALUES("51","Humanities 1*");
INSERT INTO specializations VALUES("52","Humanities 2*");
INSERT INTO specializations VALUES("53","Social Science 1**");
INSERT INTO specializations VALUES("54","Organization and Management");
INSERT INTO specializations VALUES("55","Disaster Readiness and Risk Reduction");
INSERT INTO specializations VALUES("56","Elective 1 (from any Track/Strand)***");
INSERT INTO specializations VALUES("57","Elective 2 (from any Track/Strand)***");



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
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO strands VALUES("125","ICT","Information Communication Technology","Technical-Vocational Livelihood","26","2023-10-31 23:07:18","1");
INSERT INTO strands VALUES("128","ABM","Accountancy, Business and Management","Academic Track","1","2023-11-02 23:39:31","1");
INSERT INTO strands VALUES("129","HUMSS","Humanities and Social Sciences","Academic Track","1","2023-11-11 17:45:04","1");



CREATE TABLE `subjects` (
  `SubjectID` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentID` int(11) NOT NULL,
  `SubjectCode` varchar(45) NOT NULL,
  `SubjectDescription` varchar(45) NOT NULL,
  `Units` int(11) NOT NULL,
  `Active` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`SubjectID`),
  KEY `subjects_ibfk_1` (`DepartmentID`),
  CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`DepartmentID`) REFERENCES `department` (`DepartmentID`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO subjects VALUES("97","338","try","try","1","1","2023-11-07 08:40:47");
INSERT INTO subjects VALUES("113","10","dasasd","asdasdas","1","1","2023-11-04 18:17:24");
INSERT INTO subjects VALUES("114","350","nnnnnnnn","nnnnnnn","1","1","2023-11-04 18:19:04");
INSERT INTO subjects VALUES("115","338","wNAN","SDASD","1","1","2023-11-04 18:43:38");
INSERT INTO subjects VALUES("116","339","saasasd","sdfsadf1","1","1","2023-11-04 18:44:09");
INSERT INTO subjects VALUES("118","8","MATH","Mathematics","1","1","2023-11-05 21:52:50");
INSERT INTO subjects VALUES("119","8","TETSTST","tetststst","1","0","2023-11-05 22:07:49");
INSERT INTO subjects VALUES("121","8","DAASDASDASD","sadasdasdas","1","1","2023-11-05 22:31:20");
INSERT INTO subjects VALUES("122","5","SADASDASASD","asdasdasdas","2","1","2023-11-05 22:31:34");
INSERT INTO subjects VALUES("123","338","BKFDFSF;J","dsjksdbf","1","1","2023-11-05 22:31:49");
INSERT INTO subjects VALUES("124","6","ADASDDS","asdasdasdas","1","1","2023-11-05 22:41:24");
INSERT INTO subjects VALUES("125","7","DASASDA","asdasdasd","1","0","2023-11-10 08:51:07");
INSERT INTO subjects VALUES("126","4","HAYS","haahah","1","1","2023-11-10 09:27:48");
INSERT INTO subjects VALUES("127","4","ASDAASD","asdasd1","1","1","2023-11-05 22:45:20");



CREATE TABLE `test1` (
  `InstructorTimeAvailabilityID` int(11) NOT NULL AUTO_INCREMENT,
  `InstructorID` int(11) NOT NULL,
  `DayID` int(11) NOT NULL,
  `Time_Start` time NOT NULL,
  `Time_End` time NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`InstructorTimeAvailabilityID`),
  KEY `InstructorID` (`InstructorID`),
  CONSTRAINT `InstructorTimeAvailability_ibfk_1` FOREIGN KEY (`InstructorID`) REFERENCES `instructor` (`InstructorID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




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
  KEY `RoleID` (`RoleID`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO users VALUES("15","jis","jis","jis","2023-06-26","0","09359218401","Zambales","Male","jis","$2y$10$PBOIgQYlnp/kIjsUmHd4EOo1fEOIHUS8RSuzb7","angelmaecarpeso@gmail.com","1","0","1","2023-10-11 08:34:44","0","2023-11-01 02:59:38");
INSERT INTO users VALUES("16","jasy","jasy","jasy","2023-06-27","0","09359218401","Zambales","Female","jasy","$2y$10$rpZceK2GVuyTOLAzCHEkz.Qgkmh5Gi6wkTkFOu","angelmaecarpeso@gmail.com","1","0","1","2023-10-11 08:34:44","0","2023-11-01 02:59:38");
INSERT INTO users VALUES("17","Joshua","D.","Gonzales","1789-02-12","234","09359218401","Zambales","Male","josh","$2y$10$tR4.dl4jkMQPCtqxtmyG0eibX5W7lr9Vj7bmJw","angelmaecarpeso@gmail.com","3","0","1","2023-10-13 14:23:20","0","2023-11-01 02:59:38");
INSERT INTO users VALUES("19","Robert","Masula","Bernaldo","2002-08-21","21","09692341231","Robvert House","Male","Admin1234","$2y$10$bIBfPwSGW53tdQkwGv726OSHW.cLCS.EIUkDCACf7vJgnRvOA0agS","robert@gmail.com","1","1","1","2023-11-23 10:28:04","0","2023-11-01 02:59:38");
INSERT INTO users VALUES("20","Jasmine","Osorio","Cerezo","2001-12-12","21","09359218401","Gordon Heights ","Female","Jasmine1234","$2y$10$ON9kBo0dTY86IXV6OoXPBOD4mpTHBYqBRwRG.ola.kbGw4AmI2GIS","jas@gmail.com","4","0","1","2023-10-13 15:11:12","0","2023-11-01 02:59:38");
INSERT INTO users VALUES("21","Jian Laurence","Salvedea","Ebidag","2002-02-01","21","09127339200","21 Luna St. Banicain ","Male","adminsiJian21","$2y$10$JLfiBavt1X.M2BOwsh4N9eLT/Iid/tEU35fd8oMPNu/pq5PkKlMlW","rencejian@gmail.com","1","1","1","2023-11-11 17:34:42","0","2023-11-01 02:59:38");
INSERT INTO users VALUES("22","Angel Mae","Carpeso","Dente","2002-05-01","21","09359218401","West Tapinac","Female","Angel1234","$2y$10$4M2SS9w5/ccPyxdyYZ8UUOpCU0LSvKEyw4v5g/bRiM9mr8WRyJrEC","angelmaecarpeso@gmail.com","2","0","1","2023-11-09 10:57:03","0","2023-11-01 02:59:38");
INSERT INTO users VALUES("23","Christopher ","Dente","Basa","2001-08-13","22","09458367289","Gordon Heights ","Male","Christopher1234","$2y$10$HHdn0ZBjWVBJJBuG6YXKA.pFG21EgR7FVEaY5BxHgMH5IK0mlzEVy","tope@gmail.com","3","1","1","2023-11-13 17:00:48","0","2023-11-01 02:59:38");
INSERT INTO users VALUES("24","Frederic","Alvaro","Guinto","1999-06-18","24","09112334455","Subic","Male","Red12345","$2y$10$GzBfVWz35QnF40Fdwgat2OV.hvL/SBasIy09P1K3gj/HTlSgdrGHa","red@gmail.com","4","0","1","2023-10-13 14:25:45","0","2023-11-01 02:59:38");
INSERT INTO users VALUES("25","Helen","Nalugon","Garces","2002-12-23","20","09112334458","Sta rita","Female","Helen54321","$2y$10$E9l4JHuU4vjmwCBNQ5zVh.CkhChfyvd9rVXG0YXDdXlrV.vNUhAty","helengarces7@gmail.com","4","0","1","2023-10-14 17:14:21","0","2023-11-01 02:59:38");
INSERT INTO users VALUES("26","Jhoncent","Pogi","Maurillio","2002-12-12","20","09127339280","Mabayuhan","Female","Mauricio123","$2y$10$ijQpDw83TDSyWS4k8/bWJe2guk/Ez/fgloCj2jy7OWsRj3I6FgoXK","christophetrdente1@gmail.com","4","0","1","2023-10-17 11:04:16","0","2023-11-01 02:59:38");
INSERT INTO users VALUES("27","Erwin","Tanga","Masula","2002-01-12","21","09127339201","Pag-asa","Female","Erwin123","$2y$10$Spd0iAzxAJJwDWFscRtpc.2xBqBJ2hQAKmhknB4/PfTg0MmKol7NS","christophetrdente1@gmail.com","4","0","1","2023-10-17 11:07:15","0","2023-11-01 02:59:38");
INSERT INTO users VALUES("28","Eden","Durago","Bake3at","1991-12-12","31","09127339209","Pag-asaq","Female","Eden1234","$2y$10$vxGYGVeVhUDZVbxPeal5yeCQwvKNKstijwvts2nb3mQhDbFaqA/ei","dngrc.drg@gmail.com","4","0","1","2023-10-17 11:21:05","0","2023-11-01 02:59:38");
INSERT INTO users VALUES("29","try","try","try","2002-12-12","20","09359218401","21 Luna St. Banicain ","Female","Trypo1234","$2y$10$VPs5oRokc3Y2YbmwfTiRdeylIUdap8jNHH7upXGhMCYrtQrqAgMla","bsit9200@gmail.com","4","0","1","2023-10-19 10:33:12","0","2023-11-01 02:59:38");
INSERT INTO users VALUES("30","Jerry Vic","Salvedea","Ebidag","2005-09-22","18","09127339201","21 Luna Banicain","Male","jerryVic23","$2y$10$.K1Ot93KAhSXcsP5zjsHT.cCxcWUa2gcHWsPU3S9mZ6.eKDdRZSOe","jerryvicebidag20@gmail.com","4","0","1","2023-11-01 01:28:24","0","2023-11-01 02:59:38");
INSERT INTO users VALUES("31","Cresencia","San Juan","Salvedea","1989-09-15","34","09127339203","21 Luna Banicain","Female","Myusername123","$2y$10$av3jhdszYnFw6WVu98vL0eu8cKR/yRw.mOMA5PuMNxVSsB4LRroUW","rencejian@gmail.com","2","0","1","2023-11-01 01:46:00","0","2023-11-01 02:59:38");
INSERT INTO users VALUES("32","Jhana","Salvedea","Ebidag","2007-12-07","15","09127339203","21 Luna Banicain","Female","Jhana123","$2y$10$ckS/NB4dXZICS7Y0qUjIv.3ikyie9vtVyi1lBgrOh9oRIC4n0715u","rencejian@gmail.com","4","0","1","2023-11-01 02:53:41","0","2023-11-01 02:59:38");

