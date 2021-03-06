
CREATE TABLE `Media_Vault_Schema`.`file_details` (
  `file_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `file_type` varchar(45) DEFAULT NULL,
  `creation_date` varchar(45) DEFAULT NULL,
  `file_size` varchar(45) DEFAULT NULL,
  `file_name` varchar(45) DEFAULT NULL,
  `file_location` varchar(200) DEFAULT NULL,
  `details` varchar(45) DEFAULT NULL,
  `location_inside` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`file_id`,`user_name`),
  CONSTRAINT `user_name` FOREIGN KEY (`user_name`) REFERENCES `user_id` (`user_name`) ON DELETE NO ACTION ON UPDATE NO ACTION
) 