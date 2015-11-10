
drop table onthebible.BibleTrans;
drop table onthebible.BibleSentence;
drop table onthebible.BibleTransTitle;

/* ������ ���̺� */
create Table BibleTrans (
  seq Integer not null auto_increment primary key,   /* Key */
  transId Integer NOT NULL UNIQUE,  /* ���� ID (1000���� �����ϴ� ����)*/
  langId varchar(3) NOT NULL, /* ��� KOR, ENG */
  description  varchar (256)    /* ������ ��, ���� �ѱ� ����, ������ �ѱ� ���� */
) DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

/* ���� ���� ���̺�  */
create Table onthebible.BibleSentence (
  seq Integer not null auto_increment primary key,
  sentenceId BIGINT NOT NULL UNIQUE,      /* ����ID : ����ID(4�ڸ�) + Ÿ��ƲID(2�ڸ�) + ��(3�ڸ�) + ��(3�ڸ�)  */
  transId Integer NOT NULL,         /* ���� ID */
  titleId Integer NOT NULL,         /* Ÿ��ƲID , â����:1 ~ ���Ѱ�÷�:66 */
  page Integer NOT NULL,               /* �� */
  row Integer NOT NULL,                /* �� */
  sentence varchar(1024)               /* ����  */
) DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

/* ������ Ÿ��Ʋ �� */
create Table onthebible.BibleTransTitle (
  transId Integer Not NULL,     /* ���� ID  */
  titleId Integer NOT NULL,        /* Ÿ��Ʋ ID  */
  transTitle varchar(128) NOT NULL    /* ������ Ÿ��Ʋ �� */
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
