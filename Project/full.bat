../../../mysql/bin/mysql.exe -u root

CREATE USER 'SADUSER'@'localhost' IDENTIFIED BY 'SADUSER';
exit

../../../mysql/bin/mysql.exe -u root

CREATE DATABASE access;

CREATE TABLE `access`.`users` (
    `userId` INT(10) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL ,
    `firstName` VARCHAR(20) NOT NULL ,
    `surname` VARCHAR(20) NOT NULL ,
    `email` VARCHAR(30) NOT NULL ,
    PRIMARY KEY (`userId`),
    UNIQUE (`email`)
)
COMMENT = 'A table of all users';

exit
