DROP DATABASE if exists quiz;

CREATE DATABASE quiz;

use quiz;

create table question(
    id int auto_increment primary key ,
    text varchar(255),
    description varchar(255)
);


create table answer(
    id int auto_increment primary key ,
    text varchar(255),
    correct smallint,
    question_id int,
    foreign key (question_id) references question(id)
);