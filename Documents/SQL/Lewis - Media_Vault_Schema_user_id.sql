
CREATE TABLE `Media_Vault_Schema`.`user_id` (
  `user_name` varchar(40) NOT NULL,
  `email_address` varchar(200) NOT NULL,
  `password` varchar(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  PRIMARY KEY (`user_name`,`email_address`)
) 
