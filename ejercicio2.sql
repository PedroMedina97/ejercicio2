create database ejercicio2;

use ejercicio2;

create table files(
    id int(255) AUTO_INCREMENT,
    title varchar(100) not null,
    description varchar (255),
    url varchar(255),
    constraint pk_files primary key(id)
);