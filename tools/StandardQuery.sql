/* 성경을 위한 기본 테이블 생성 쿼리 */

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


/* 번역본 추가 */
/*
insert into onthebible.BibleTrans (transId, language, description) values ( '1001', 'KOR', '개역 성경');
insert into onthebible.BibleTrans ( transId, language, description) values ( '1002', 'KOR', '새번역 성경');
insert into onthebible.BibleTrans (transId, language, description) values ( '1003', 'ENG', 'King James');
*/


/* 타이틀 추가  */
/*
insert into onthebible.BibleTransTitle (transId ,TitleId, TransTitle) values ('1001', 1, '창세기');
*/

/* 구절 추가 */
/*
insert into onthebible.BibleSentence (sentenceId, transId, TitleId, page, row, sentence) values('100101001001', '1001',1,1,1,'태초에 천지를 창조하시느라');
*/

/* 구절 조회  */
/*
select B.TransTitle, C.page, C.row, C.sentence from onthebible.BibleTrans A, onthebible.BibleTransTitle B, onthebible.BibleSentence C where A.transId = B.transId AND B.transId = C.transId AND A.trandId='1001' AND C.titleId='1';



*/

