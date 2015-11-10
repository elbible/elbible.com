
drop table onthebible.BibleTrans;
drop table onthebible.BibleSentence;
drop table onthebible.BibleTransTitle;

/* 번역본 테이블 */
create Table BibleTrans (
  seq Integer not null auto_increment primary key,   /* Key */
  transId Integer NOT NULL UNIQUE,  /* 번역 ID (1000부터 시작하는 숫자)*/
  langId varchar(3) NOT NULL, /* 언어 KOR, ENG */
  description  varchar (256)    /* 번역본 명, 개역 한글 성경, 새번역 한글 성경 */
) DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

/* 성경 구절 테이블  */
create Table onthebible.BibleSentence (
  seq Integer not null auto_increment primary key,
  sentenceId BIGINT NOT NULL UNIQUE,      /* 구절ID : 번역ID(4자리) + 타이틀ID(2자리) + 장(3자리) + 절(3자리)  */
  transId Integer NOT NULL,         /* 번역 ID */
  titleId Integer NOT NULL,         /* 타이틀ID , 창세기:1 ~ 요한계시록:66 */
  page Integer NOT NULL,               /* 장 */
  row Integer NOT NULL,                /* 절 */
  sentence varchar(1024)               /* 구절  */
) DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

/* 번역본 타이틀 명 */
create Table onthebible.BibleTransTitle (
  transId Integer Not NULL,     /* 번역 ID  */
  titleId Integer NOT NULL,        /* 타이틀 ID  */
  transTitle varchar(128) NOT NULL    /* 번역본 타이틀 명 */
) DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;



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
