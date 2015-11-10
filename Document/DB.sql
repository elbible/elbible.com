

// user table
CREATE TABLE `user` (
  `sn` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `profile_img` varchar(50),
  `comment` varchar(128),
  `password` varchar(255) NOT NULL,
  `reg_date` datetime NOT NULL,
  PRIMARY KEY (`sn`),
  UNIQUE KEY `email_idx` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

// insert user table


// post table
CREATE TABLE `post` (
  `sn` int(11) NOT NULL AUTO_INCREMENT,
  `user_sn` int(11) NOT NULL,
  `reg_date` datetime NOT NULL,
  `update_date` datetime,
  `bible_id` varchar(24),  
  `comment` varchar(4096),
  `like_count` int(11) DEFAULT 0,
  `attached_file` varchar(128),    
  `file_type` int(2) NOT NULL,     
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


// timeline 
CREATE TABLE `timeline` (
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
