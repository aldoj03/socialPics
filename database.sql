CREATE database IF NOT EXISTS laravel_master;
USE laravel_master;

CREATE TABLE IF NOT EXISTS users(
id          INT(255)  auto_increment not null,
role        VARCHAR(20) NOT NULL,
name        VARCHAR(30) NOT NULL,
surname     VARCHAR(30) NOT NULL,
nickname    VARCHAR(30) NOT NULL,
email       VARCHAR(30) NOT NULL,
image       VARCHAR(255)NOT NULL,
password    VARCHAR(255)NOT NULL,
create_at   DATETIME,
update_at   DATETIME,
remember_token VARCHAR(255),
CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS images(
id           INT(255) AUTO_INCREMENT NOT NULL ,
user_id      INT(255) NOT NULL,
image_path   VARCHAR(255) NOT NULL,
description  text NOT NULL,
create_at    DATETIME,
update_at    DATETIME,
CONSTRAINT pk_images PRIMARY KEY(id),
CONSTRAINT fk_images_users foreign key(user_id) REFERENCES  users(id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS coments(
id              INT(255) AUTO_INCREMENT NOT NULL ,
content         text NOT NULL,
user_id         INT(255) NOT NULL, 
image_id        INT(255) NOT NULL, 
create_at       DATETIME not null,
update_at       DATETIME not null,
CONSTRAINT pk_coments PRIMARY KEY(id),
CONSTRAINT fk_coments_users foreign KEY(user_id) REFERENCES  users(id),
CONSTRAINT fk_coments_images foreign KEY(image_id) REFERENCES  images(id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS likes(
id               INT(255) NOT NULL AUTO_INCREMENT ,
user_id          INT(255) NOT NULL, 
image_id         INT(255) NOT NULL, 
create_at        DATETIME,
update_at        DATETIME,
CONSTRAINT pk_likes PRIMARY KEY(id),
CONSTRAINT fk_likes_users foreign KEY(user_id) REFERENCES  users(id),
CONSTRAINT fk_likes_images foreign KEY(image_id) REFERENCES  images(id)
)ENGINE=InnoDb;

/* inserts  de prueba*/

INSERT INTO users VALUES(null, 'user', 'Pedro', 'Cabrera', 'pedroj03', 'pedro@gmail.com', null,'123', curtime(), curtime(), null)