CREATE DATABASE IF NOT EXISTS airasiadb;
USE airasiadb;

create table account
(
    accountId   int auto_increment
        primary key,
    userId      int          not null,
    accountType varchar(100) not null,
    points      int          not null
);

INSERT INTO `account` (`accountId`, `userId`, `accountType`, `points`)
VALUES ('1', '1', 'admin', '1000');

INSERT INTO `account` (`accountId`, `userId`, `accountType`, `points`)
VALUES ('2', '2', 'employee', '1000');

INSERT INTO `account` (`accountId`, `userId`, `accountType`, `points`)
VALUES ('3', '3', 'customer', '1000');

INSERT INTO `account` (`accountId`, `userId`, `accountType`, `points`)
VALUES ('4', '4', 'customer', '1000');

INSERT INTO `account` (`accountId`, `userId`, `accountType`, `points`)
VALUES ('4', '4', 'customer', '1000');


