CREATE DATABASE IF NOT EXISTS gretabase;
USE gretabase;
CREATE TABLE users (
	id int AUTO_INCREMENT,
	username varchar(50) NOT NULL,
	fullname varchar(50),
	password varchar(128),
	PRIMARY KEY (id),
	UNIQUE (username)
);
