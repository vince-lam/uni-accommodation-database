CREATE TABLE `university_staff` (
  `uni_staff_id` smallint(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(50),
  `forename` varchar(50),
  `surname` varchar(50),
  `mobile_number` varchar(13),
  `university_email` varchar(50),
  `department_number` varchar(50),
  `course_id` smallint(10) ,
  PRIMARY KEY (`uni_staff_id`)
);

CREATE TABLE `next_of_kin` (
  `next_of_kin_id` smallint(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `forename` varchar(50),
  `surname` varchar(50),
  `date_of_birth` date,
  `gender` varchar(50),
  `home_address` varchar(250),
  `postcode` varchar(8),
  `contact_number` varchar(13),
  `personal_email` varchar(50),
  `role` varchar(50),
  `relation_to_student` varchar(50),
  PRIMARY KEY (`next_of_kin_id`)
);

CREATE TABLE `university` (
  `uni_id` smallint(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `university_name` varchar(250),
  `campus_address` varchar(250),
  `admin_email` varchar(50),
  PRIMARY KEY (`uni_id`)
);

CREATE TABLE `course` (
  `course_id` smallint(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_title` varchar(50),
  `course_duration_years` int(1),
  `head_staff_id` smallint(10) UNSIGNED,
  `course_type` varchar(50),
  `department` varchar(50),
  `course_start_date` date,
  `uni_id` smallint(10) UNSIGNED,
  PRIMARY KEY (`course_id`),
  FOREIGN KEY (`head_staff_id`) REFERENCES `university_staff`(`uni_staff_id`),
  FOREIGN KEY (`uni_id`) REFERENCES `university`(`uni_id`)
);

CREATE TABLE `student` (
  `student_id` smallint(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `next_of_kin_id` smallint(10) UNSIGNED,
  `title` varchar(50),
  `forename` varchar(50),
  `surname` varchar(50),
  `date_of_birth` date,
  `date_enrolled` date,
  `gender` varchar(50),
  `home_address` varchar(250),
  `postcode` varchar(8),
  `contact_number` varchar(13),
  `personal_email` varchar(50),
  `university_email` varchar(50),
  `student_category` varchar(50),
  `uni_advisor_id` smallint(10) UNSIGNED,
  `current_status` varchar(50),
  `course_id` smallint(10) UNSIGNED,
  PRIMARY KEY (`student_id`),
  FOREIGN KEY (`next_of_kin_id`) REFERENCES `next_of_kin`(`next_of_kin_id`),
  FOREIGN KEY (`uni_advisor_id`) REFERENCES `university_staff`(`uni_staff_id`),
  FOREIGN KEY (`course_id`) REFERENCES `course`(`course_id`)
);

CREATE TABLE `lease_agreement` (
  `lease_id` smallint(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` smallint(10) UNSIGNED,
  `lease_duration` varchar(50),
  `start_date` date,
  `end_date` date,
  `room_id` smallint(10) UNSIGNED,
  PRIMARY KEY (`lease_id`),
  FOREIGN KEY (`student_id`) REFERENCES `student`(`student_id`)
);

CREATE TABLE `room_type` (
  `room_type_id` smallint(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `room_description` varchar(250),
  `bed_size` varchar(50),
  `ensuite` binary,
  PRIMARY KEY (`room_type_id`)
);

CREATE TABLE `building` (
  `building_id` smallint(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `building_name` varchar(250),
  `building_address` varchar(250),
  `manager_id` smallint(10) UNSIGNED,
  `number_of_rooms` int(3),
  `number_of_floors` int(2),
  `max_capacity` int(3),
  `halls_id` smallint(10) UNSIGNED,
  PRIMARY KEY (`building_id`),
  KEY `Key` (`halls_id`)
);

CREATE TABLE `yahuas_account_details` (
  `username` varchar(50) NOT NULL,
  `yahuas_staff_id` smallint(10) UNSIGNED,
  `password` varchar(50),
  `date_account_created` date,
  PRIMARY KEY (`username`)
);

CREATE TABLE `halls` (
  `halls_id` smallint(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `halls_of_residence_name` varchar(50),
  `hall_manager_id` smallint(10) UNSIGNED,
  `hall_address` varchar(250),
  `halls_description` varchar(250),
  `uni_id` smallint(10) UNSIGNED,
  `buildings_count` int(3),
  `gym` binary,
  `prayer_room` binary,
  PRIMARY KEY (`halls_id`),
  FOREIGN KEY (`uni_id`) REFERENCES `university`(`uni_id`)
);

CREATE TABLE `room` (
  `room_id` smallint(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `room_type_id` smallint(10) UNSIGNED,
  `building_id` smallint(10) UNSIGNED,
  `room_number` int(3),
  `monthly_rent` float(6),
  PRIMARY KEY (`room_id`),
  FOREIGN KEY (`room_type_id`) REFERENCES `room_type`(`room_type_id`),
  FOREIGN KEY (`building_id`) REFERENCES `building`(`building_id`)
);

CREATE TABLE `invoice` (
  `invoice_id` smallint(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lease_id` smallint(10) UNSIGNED,
  `invoice_date` date,
  `year_semester` varchar(50),
  `payment_due` date,
  `invoice_paid` binary,
  `payment_method` varchar(50),
  `reminder_date` date,
  `reminder_date_2` date,
  PRIMARY KEY (`invoice_id`),
  FOREIGN KEY (`lease_id`) REFERENCES `lease_agreement`(`lease_id`)
);

CREATE TABLE `yahuas_staff` (
  `yahuas_staff_id` smallint(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(50),
  `forename` varchar(50),
  `surname` varchar(50),
  `home_address` varchar(250),
  `home_postcode` varchar(8),
  `mobile_number` varchar(13),
  `university_email` varchar(50),
  `role` varchar(50),
  PRIMARY KEY (`yahuas_staff_id`)
);

CREATE TABLE `inspection` (
  `inspection_id` smallint(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `yahuas_staff_id` smallint(10) UNSIGNED,
  `inspection_date` date,
  `room_id` smallint(10) UNSIGNED,
  `satisfactory_condition` binary,
  `inspection_comments` varchar(250),
  PRIMARY KEY (`inspection_id`),
  FOREIGN KEY (`room_id`) REFERENCES `room`(`room_id`),
  FOREIGN KEY (`yahuas_staff_id`) REFERENCES `yahuas_staff`(`yahuas_staff_id`)
);
