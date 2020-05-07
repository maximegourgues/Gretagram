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

CREATE TABLE posts (
	post_id int AUTO_INCREMENT,
	user_id int NOT NULL,
	latitude float,
	longitude float,
	nom_position varchar(128),
	image_location varchar(128),
	contenu TEXT,
	likes int,
	comment int,
	PRIMARY KEY (post_id),
	FOREIGN KEY (user_id) REFERENCES users(id),
	UNIQUE (post_id),
	UNIQUE (user_id)
);


INSERT INTO users (username,fullname,password) VALUES ('Syldrom', 'Sylvain Lagarde','19/12/99');
INSERT INTO users (username,fullname,password) VALUES ('Random1','Random','123456');
