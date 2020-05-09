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
	latitude varchar(128),
	longitude varchar(128),
	nom_position varchar(128),
	image_location varchar(128),
	contenu TEXT,
	likes int,
	comment int,
	date_now datetime,
	PRIMARY KEY (post_id),
	FOREIGN KEY (user_id) REFERENCES users(id),
	UNIQUE (post_id)
);

CREATE TABLE likes (
	post_id int NOT NULL,
	user_id int NOT NULL,
	FOREIGN KEY (post_id) REFERENCES posts(post_id),
	FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE comments (
	comment_id int AUTO_INCREMENT,
	post_id int NOT NULL,
	contenu text NOT NULL,
	UNIQUE(comment_id),
	FOREIGN KEY (post_id) REFERENCES posts(post_id)
);

CREATE TABLE followings (
	user_id int NOT NULL,
	follow_id int NOT NULL,
	FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE followers (
	user_id int NOT NULL,
	follower_id int NOT NULL,
	FOREIGN KEY (user_id) REFERENCES users(id)
);


INSERT INTO users (username,fullname,password) VALUES ('Syldrom', 'Sylvain Lagarde','19/12/99');
INSERT INTO users (username,fullname,password) VALUES ('Random1','Random','123456');
INSERT INTO users (username,fullname,password) VALUES ('Random2','Random','123456');
INSERT INTO users (username,fullname,password) VALUES ('Random3','Random','123456');
INSERT INTO users (username,fullname,password) VALUES ('Random4','Random','123456');
INSERT INTO users (username,fullname,password) VALUES ('Random5','Random','123456');
INSERT INTO users (username,fullname,password) VALUES ('Random6','Random','123456');
INSERT INTO users (username,fullname,password) VALUES ('Random7','Random','123456');

INSERT INTO users (username,fullname,password) VALUES ('Random8','Random','123456');

INSERT INTO followings(user_id,follow_id) VALUES ('1','2');
INSERT INTO followings(user_id,follow_id) VALUES ('1','3');
INSERT INTO followings(user_id,follow_id) VALUES ('1','4');
INSERT INTO followings(user_id,follow_id) VALUES ('1','5');
INSERT INTO followings(user_id,follow_id) VALUES ('1','6');
INSERT INTO followings(user_id,follow_id) VALUES ('1','7');

INSERT INTO followers(user_id,follower_id) VALUES ('2','1');
INSERT INTO followers(user_id,follower_id) VALUES ('3','1');
INSERT INTO followers(user_id,follower_id) VALUES ('4','1');
INSERT INTO followers(user_id,follower_id) VALUES ('5','1');
INSERT INTO followers(user_id,follower_id) VALUES ('6','1');
INSERT INTO followers(user_id,follower_id) VALUES ('7','1');

