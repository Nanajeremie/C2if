
drop table if exists ADMIN;

drop table if exists ANNOUCEMENT;

drop table if exists ANSWER;

drop table if exists COMMENT;

drop table if exists COURSE;

drop table if exists LEARNER;

drop table if exists NEWLETTER;

drop table if exists SUBCRIPTION;

drop table if exists SUBJECT;

drop table if exists TEST;

drop table if exists USER;


/*==============================================================*/
/* Table: ADMIN                                                 */
/*==============================================================*/
create table ADMIN
(
   IDADMIN                        int                            not null   AUTO_INCREMENT,
   IDUSER                         int  ,
   ADMINLASTNAME                  varchar(50),
   ADMINFIRTNAME                  varchar(50),
   ROLE                           varchar(40),
    primary key (IDADMIN)
);

/*==============================================================*/
/* Table: ANNOUCEMENT                                           */
/*==============================================================*/
create table ANNOUCEMENT
(
   IDANNOUNCEMENT                 int                            not null   AUTO_INCREMENT,
   IDADMIN                        int                            not null,
   TITLE                          varchar(24),
   DESCRIPTION                    longtext,
   COVERIMAGE                     varchar(50),
   POSTDATE                       timestamp,
   primary key (IDANNOUNCEMENT)
);

/*==============================================================*/
/* Table: ANSWER                                                */
/*==============================================================*/
create table ANSWER
(
   IDANSWER                       int                            not null   AUTO_INCREMENT,
   IDTEST                         int                            not null,
   MATRICULE                      char(40)                       not null,
   STARTDATE                      timestamp,
   ENDDATE                        timestamp,
   ANSWERCONTENT                  varchar(20),
   MARK                           decimal,
   primary key (IDANSWER)
);

/*==============================================================*/
/* Table: COMMENT                                               */
/*==============================================================*/
create table COMMENT
(
   IDCOMMENT                      int                            not null   AUTO_INCREMENT,
   IDCOURSE                       int                            not null,
   IDUSER                         int                            not null,
   CONTENT                        longtext,
   COMMENTDATE                    timestamp,
   primary key (IDCOMMENT)
);

/*==============================================================*/
/* Table: COURSE                                                */
/*==============================================================*/
create table COURSE
(
   IDCOURSE                       int                            not null   AUTO_INCREMENT,
   IDSUBJECT                      int                            not null,
   IDADMIN                        int                            not null,
   COURSETITLE                    varchar(30),
   AMOUNT                         decimal,
   COURSECONTENT                  varchar(64),
   COURSEDESCRIPTION              longtext,
   UPLOADDATE                     timestamp,
   primary key (IDCOURSE)
);

/*==============================================================*/
/* Table: LEARNER                                               */
/*==============================================================*/
create table LEARNER
(
   MATRICULE                      char(40)                       not null,
   IDUSER                         int  ,
   LASTNAMEN                      varchar(50),
   LEARNERFIRSTNAME               varchar(30),
   STATUT                         varchar(23),
   primary key (MATRICULE)
);

/*==============================================================*/
/* Table: NEWLETTER                                             */
/*==============================================================*/
create table NEWLETTER
(
   IDNEWS                         int                            not null   AUTO_INCREMENT,
   MATRICULE                      char(40)                       not null,
   EMAILADRESS                    varchar(24),
   primary key (IDNEWS)
);

/*==============================================================*/
/* Table: SUBCRIPTION                                           */
/*==============================================================*/
create table SUBCRIPTION
(
   IDSUBCRIPTION                  int                            not null   AUTO_INCREMENT,
   IDCOURSE                       int                            not null,
   MATRICULE                      char(40)                       not null,
   AMOUNTPAID                     decimal,
   SUBSCRIPTIONDATE               timestamp,
   READINGPAGE                    int,
   primary key (IDSUBCRIPTION)
);

/*==============================================================*/
/* Table: SUBJECT                                               */
/*==============================================================*/
create table SUBJECT
(
   IDSUBJECT                      int                            not null   AUTO_INCREMENT,
   SUBJECTNAME                    varchar(30),
   SUBJECTIMAGE                   varchar(64),
   primary key (IDSUBJECT)
);

/*==============================================================*/
/* Table: TEST                                                  */
/*==============================================================*/
create table TEST
(
   IDTEST                         int                            not null   AUTO_INCREMENT,
   IDCOURSE                       int                            not null,
   TESTCONTENT                    varchar(64),
   DURATION                       time,
   CORRECTION                     varchar(64),
   primary key (IDTEST)
);


/*==============================================================*/
/* Table: USER                                                  */
/*==============================================================*/
create table USER
(
   IDUSER                         int                            not null   AUTO_INCREMENT,
   USERNAME                       varchar(30),
   PASSWORD                       varchar(64),
   EMAIL                          varchar(20),
   TYPE                           varchar(30),
   IMAGEPROFILE                   varchar(30),
   primary key (IDUSER)
);


alter table ADMIN add constraint FK_EQUAL foreign key (IDUSER)
      references USER on delete restrict on update restrict;

alter table ANNOUCEMENT add constraint FK_POST foreign key (IDADMIN)
      references ADMIN on delete restrict on update restrict;

alter table ANSWER add constraint FK_CONCERNE foreign key (IDTEST)
      references TEST (IDTEST) on delete restrict on update restrict;

alter table ANSWER add constraint FK_SEND foreign key (MATRICULE)
      references LEARNER (MATRICULE) on delete restrict on update restrict;

alter table COMMENT add constraint FK_MAKE foreign key (IDUSER)
      references USER on delete restrict on update restrict;

alter table COMMENT add constraint FK_RELATED_TO foreign key (IDCOURSE)
      references COURSE (IDCOURSE) on delete restrict on update restrict;

alter table COURSE add constraint FK_LINK foreign key (IDSUBJECT)
      references SUBJECT (IDSUBJECT) on delete restrict on update restrict;

alter table COURSE add constraint FK_UPLOAD foreign key (IDADMIN)
      references ADMIN on delete restrict on update restrict;

alter table LEARNER add constraint FK_IS foreign key (IDUSER)
      references USER on delete restrict on update restrict;

alter table NEWLETTER add constraint FK_REGISTER foreign key (MATRICULE)
      references LEARNER (MATRICULE) on delete restrict on update restrict;

alter table SUBCRIPTION add constraint FK_DO foreign key (MATRICULE)
      references LEARNER (MATRICULE) on delete restrict on update restrict;

alter table SUBCRIPTION add constraint FK_IS_FOR foreign key (IDCOURSE)
      references COURSE (IDCOURSE) on delete restrict on update restrict;

alter table TEST add constraint FK_HAVE foreign key (IDCOURSE)
      references COURSE (IDCOURSE) on delete restrict on update restrict;

