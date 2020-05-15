# ************************************************************
# Sequel Pro SQL dump
# Версия 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Адрес: 127.0.0.1 (MySQL 5.7.28-0ubuntu0.18.04.4)
# Схема: exam
# Время создания: 2020-05-15 13:38:56 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Дамп таблицы classrooms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `classrooms`;

CREATE TABLE `classrooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(10) NOT NULL,
  `seats_number` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `number_UNIQUE` (`number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `classrooms` WRITE;
/*!40000 ALTER TABLE `classrooms` DISABLE KEYS */;

INSERT INTO `classrooms` (`id`, `number`, `seats_number`)
VALUES
	(1,'A-201',60),
	(5,'A-202',30),
	(6,'Н-505',60);

/*!40000 ALTER TABLE `classrooms` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы departments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `departments`;

CREATE TABLE `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;

INSERT INTO `departments` (`id`, `name`)
VALUES
	(1,'Кафедра инфокогнитивных технологий'),
	(2,'Аппаратурное оформление и автоматизация технических производств'),
	(3,'Кафедра математики'),
	(4,'Кафедра иностранных языков');

/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы directions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `directions`;

CREATE TABLE `directions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `faculty_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`,`faculty_id`),
  UNIQUE KEY `code_UNIQUE` (`code`),
  KEY `fk_directions_faculties1_idx` (`faculty_id`),
  CONSTRAINT `fk_directions_faculties1` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `directions` WRITE;
/*!40000 ALTER TABLE `directions` DISABLE KEYS */;

INSERT INTO `directions` (`id`, `code`, `name`, `faculty_id`)
VALUES
	(1,'09.03.01','Информатика и вычислительная техника',1),
	(3,'18.05.01','Химические технологии энергонасыщенных материалов и изделий',2),
	(5,'10.05.03','Информационная безопасность автоматизированных систем',1),
	(6,'01.03.02','Прикладная математика и информатика',1),
	(7,'09.03.02','Информационные системы и технологии',1),
	(8,'09.03.03','Прикладная информатика',1),
	(9,'10.03.01','Информационная безопасность',1),
	(10,'27.03.04','Управление в технических системах',1),
	(11,'38.03.05','Бизнес-информатика',1);

/*!40000 ALTER TABLE `directions` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы directions_has_subjects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `directions_has_subjects`;

CREATE TABLE `directions_has_subjects` (
  `directions_id` int(10) unsigned NOT NULL,
  `subjects_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`directions_id`,`subjects_id`),
  KEY `fk_directions_has_subjects_subjects1_idx` (`subjects_id`),
  KEY `fk_directions_has_subjects_directions1_idx` (`directions_id`),
  CONSTRAINT `fk_directions_has_subjects_directions1` FOREIGN KEY (`directions_id`) REFERENCES `directions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_directions_has_subjects_subjects1` FOREIGN KEY (`subjects_id`) REFERENCES `subjects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Дамп таблицы exam
# ------------------------------------------------------------

DROP TABLE IF EXISTS `exam`;

CREATE TABLE `exam` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `place_id` int(10) unsigned NOT NULL,
  `tsg_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`,`place_id`,`tsg_id`,`type_id`),
  KEY `fk_exams_exam_place1_idx` (`place_id`),
  KEY `fk_exams_subjects_teachers_groups1_idx` (`tsg_id`),
  KEY `fk_certification_certification_types1_idx` (`type_id`),
  CONSTRAINT `fk_exams_exam_place1` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_exams_subjects_teachers_groups1` FOREIGN KEY (`tsg_id`) REFERENCES `tsg` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_exams_types1` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `exam` WRITE;
/*!40000 ALTER TABLE `exam` DISABLE KEYS */;

INSERT INTO `exam` (`id`, `place_id`, `tsg_id`, `type_id`)
VALUES
	(1,1,1,1),
	(2,2,8,3),
	(4,4,10,3),
	(5,5,11,1);

/*!40000 ALTER TABLE `exam` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы faculties
# ------------------------------------------------------------

DROP TABLE IF EXISTS `faculties`;

CREATE TABLE `faculties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `faculties` WRITE;
/*!40000 ALTER TABLE `faculties` DISABLE KEYS */;

INSERT INTO `faculties` (`id`, `name`)
VALUES
	(1,'Факультет информационных технологий'),
	(5,'Факультет машиностроения'),
	(2,'Факультет химических технологий и биотехнологий');

/*!40000 ALTER TABLE `faculties` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(7) NOT NULL,
  `students_number` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `number_UNIQUE` (`number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;

INSERT INTO `groups` (`id`, `number`, `students_number`)
VALUES
	(1,'171-332',27),
	(2,'171-331',24),
	(3,'191-531',30);

/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы groups_tsg
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups_tsg`;

CREATE TABLE `groups_tsg` (
  `tsg_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`tsg_id`,`group_id`),
  KEY `fk_tsg_has_groups_groups1_idx` (`group_id`),
  KEY `fk_tsg_has_groups_tsg_idx` (`tsg_id`),
  CONSTRAINT `fk_tsg_has_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `groups_tsg` WRITE;
/*!40000 ALTER TABLE `groups_tsg` DISABLE KEYS */;

INSERT INTO `groups_tsg` (`tsg_id`, `group_id`)
VALUES
	(1,1),
	(8,1),
	(10,1),
	(11,1);

/*!40000 ALTER TABLE `groups_tsg` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы lessons
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lessons`;

CREATE TABLE `lessons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `time_UNIQUE` (`number`),
  UNIQUE KEY `start_UNIQUE` (`start`),
  UNIQUE KEY `end_UNIQUE` (`end`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `lessons` WRITE;
/*!40000 ALTER TABLE `lessons` DISABLE KEYS */;

INSERT INTO `lessons` (`id`, `number`, `start`, `end`)
VALUES
	(1,1,'09:00:00','10:30:00'),
	(2,2,'10:40:00','12:10:00'),
	(3,3,'12:20:00','13:50:00'),
	(4,4,'14:30:00','16:00:00'),
	(5,5,'16:10:00','17:40:00'),
	(6,6,'17:50:00','19:20:00'),
	(7,7,'19:30:00','21:00:00');

/*!40000 ALTER TABLE `lessons` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы place
# ------------------------------------------------------------

DROP TABLE IF EXISTS `place`;

CREATE TABLE `place` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `classroom_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`,`classroom_id`),
  KEY `fk_occupied_classroom1_idx` (`classroom_id`),
  CONSTRAINT `fk_occupied_classroom1` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `place` WRITE;
/*!40000 ALTER TABLE `place` DISABLE KEYS */;

INSERT INTO `place` (`id`, `date`, `classroom_id`)
VALUES
	(1,'2020-05-29',1),
	(2,'2020-05-28',5),
	(4,'2020-05-30',6),
	(5,'2020-06-03',5);

/*!40000 ALTER TABLE `place` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы place_time
# ------------------------------------------------------------

DROP TABLE IF EXISTS `place_time`;

CREATE TABLE `place_time` (
  `place_id` int(10) unsigned NOT NULL,
  `lesson_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`place_id`,`lesson_id`),
  KEY `fk_lesson_has_exam_place_exam_place1_idx` (`place_id`),
  KEY `fk_lesson_has_exam_place_lesson1_idx` (`lesson_id`),
  CONSTRAINT `fk_lesson_has_exam_place_exam_place1` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lesson_has_exam_place_lesson1` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `place_time` WRITE;
/*!40000 ALTER TABLE `place_time` DISABLE KEYS */;

INSERT INTO `place_time` (`place_id`, `lesson_id`)
VALUES
	(1,1),
	(2,1),
	(4,4),
	(5,4);

/*!40000 ALTER TABLE `place_time` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `runame` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;

INSERT INTO `status` (`id`, `name`, `runame`)
VALUES
	(1,'administrator','Администратор'),
	(2,'dispetcher','Диспетчер'),
	(3,'dekan','Декан'),
	(4,'kadrovic','Кадровик');

/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы subjects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `subjects`;

CREATE TABLE `subjects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `department_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`,`department_id`),
  KEY `fk_subjects_departments_idx` (`department_id`),
  CONSTRAINT `fk_subjects_departments` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;

INSERT INTO `subjects` (`id`, `name`, `department_id`)
VALUES
	(2,'Проектирование информационных систем',1),
	(3,'Основы UI/UX-дизайна',1),
	(4,'Business English',4),
	(5,'Математическая логика и теория алгоритмов',3);

/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы teachers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `teachers`;

CREATE TABLE `teachers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `fathername` varchar(45) DEFAULT NULL,
  `full_name` varchar(150) NOT NULL DEFAULT '',
  `department_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`,`department_id`),
  KEY `fk_teachers_departments1_idx` (`department_id`),
  CONSTRAINT `fk_teachers_departments1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `teachers` WRITE;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;

INSERT INTO `teachers` (`id`, `name`, `surname`, `fathername`, `full_name`, `department_id`)
VALUES
	(1,'Михаил','Михайлов','Михайлович','Михайлов Михаил Михайлович',1),
	(3,'Екатерина','Королева','Владимировна','Королева Екатерина Владимировна',2),
	(4,'Павел','Скляр','Олегович','Скляр Павел Олегович',1);

/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы tsg
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tsg`;

CREATE TABLE `tsg` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject_id` int(10) unsigned NOT NULL,
  `teacher_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`,`subject_id`,`teacher_id`),
  KEY `fk_subjects_has_teachers_teachers1_idx` (`teacher_id`),
  KEY `fk_subjects_has_teachers_subjects1_idx` (`subject_id`),
  CONSTRAINT `fk_subjects_has_teachers_subjects1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_subjects_has_teachers_teachers1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tsg` WRITE;
/*!40000 ALTER TABLE `tsg` DISABLE KEYS */;

INSERT INTO `tsg` (`id`, `subject_id`, `teacher_id`)
VALUES
	(1,2,1),
	(8,2,1),
	(10,3,3),
	(11,3,3);

/*!40000 ALTER TABLE `tsg` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `types`;

CREATE TABLE `types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;

INSERT INTO `types` (`id`, `name`)
VALUES
	(2,'зачёт'),
	(3,'консультация'),
	(1,'экзамен');

/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `password` varchar(128) NOT NULL,
  `salt` varchar(45) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `fathername` varchar(25) DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `auth_token` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`,`status_id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_users_status1_idx` (`status_id`),
  CONSTRAINT `fk_users_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `password`, `salt`, `name`, `surname`, `fathername`, `status_id`, `auth_token`)
VALUES
	(3,'ozpavel@yandex.ru','b6c8ce8a1d51d69675c27a401fb598998e4853958841106160aa05235eb00dbc15c434e3896bee5392d0d61ffc1e3e590a3c3b4deeaa401bfbae0cf95559ce19','GNKIAGKWRTFDLWIEPJBHUCOMJKOYVYAKLFTHRPQBQAWGL','Pavel','Sklyar','Olegovich',1,'0d7c682dfaaa1f04ea5c33026cef1e4dab858424ab8098efa1fd7ba0186ff5d8'),
	(5,'user@email.com','684d5964e3af8eb2a224df5646acf98d9c1bd878cac4e265aa1035faa4be70888523fa07839cdcf646bfc6af3fca04171beb0b62e0b36f46a44c60740ea9747b','GNHKMDTNALIZWGJWBKMVATXFWILEXHRJHTPSYEUCFOJDQ','User','User','User',3,''),
	(6,'admin@admin.ru','a25d0166c0c362f487056a8952836cd69bd2d5b0a3364545405468e926c2a8bb9855c963e12e525190f8bedca52cf3e33bea3df13eb4763cde5f4e48dc617bab','MYLUVJIPLTJDHGKTMWXWLVJOIEKOEGIUSSZTRFLLBZYLF','Admin','Admin','Admin',1,'');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
