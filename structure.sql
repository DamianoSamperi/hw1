CREATE DATABASE IF NOT EXISTS login;
use login;
CREATE TABLE utente (
    id integer primary key auto_increment,
    username varchar(16) not null unique,
    password varchar(255) not null,
    email varchar(255) not null unique,
    cellulare int(10) not null unique
) Engine = InnoDB;

CREATE TABLE labels (
    id integer primary key auto_increment,
    user_id integer not null,
    username varchar(16) not null,
    label varchar(255) not null,
    foreign key(user_id) references utente(id) on delete cascade on update cascade
) Engine = InnoDB;

CREATE TABLE creations (
    creation_id integer primary key auto_increment,
    user_id integer not null,
    username varchar(16) not null,
    label varchar(255) not null unique,
    preparazione  varchar(255) not null,
    img varchar(255) not null,
    foreign key(user_id) references utente(id) on delete cascade on update cascade
) Engine = InnoDB;