Create database marketplace_db;

Use database marketplace_db;

CREATE TABLE `marketplace_db`.`user` (
  `userid` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(75) NULL,
  `password` VARCHAR(30) NULL,
  `firstname` VARCHAR(45) NULL,
  `lastname` VARCHAR(45) NULL,
  `phone` VARCHAR(45) NULL,
  PRIMARY KEY (`userId`));

create table merchant (merchantid INT NOT NULL AUTO_INCREMENT, merchantname VARCHAR(100), url VARCHAR(100),PRIMARY KEY (merchantid));

create table productrating (reviewid INT NOT NULL AUTO_INCREMENT, merchantid INT NOT NULL, productid INT NOT NULL, rating INT, comment VARCHAR(500), username VARCHAR(100), date DATE, PRIMARY KEY (reviewid));

create table productvisithistory (merchantid INT NOT NULL, productid INT NOT NULL, visitcount INT, PRIMARY KEY (merchantid, productid));

create table productvisitlog (merchantid INT NOT NULL, productid INT NOT NULL, userid INT, email varchar(100), productName varchar(100), ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP);


