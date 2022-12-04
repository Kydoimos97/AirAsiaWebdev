# noinspection SpellCheckingInspectionForFile

--
-- Table structure for table `users`
--

CREATE DATABASE IF NOT EXISTS airasiadb;
USE airasiadb;

-- CREATE USER 'root'@'localhost:3306' IDENTIFIED BY 'root';

GRANT ALL ON airasiadb.* TO 'root'
    IDENTIFIED BY 'root';

SET FOREIGN_KEY_CHECKS = 0; -- to disable them

DROP TABLE IF EXISTS users;

SET FOREIGN_KEY_CHECKS = 1; -- to re-enable them

CREATE TABLE `users`
(
    `userId`      int(8)       NOT NULL,
    `userName`    varchar(55)  NOT NULL,
    `password`    varchar(255) NOT NULL,
    `security`    varchar(500) NOT NULL,
    `displayName` varchar(55)  NOT NULL,
    `adress`      varchar(100) NOT NULL,
    `city`        varchar(100) NOT NULL,
    `state`       varchar(100) NOT NULL,
    `zip`         varchar(100) NOT NULL,
    `points`      int(50)      NOT NULL,
    `role`        varchar(100) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users`
VALUES (1, 'admin', '$2a$10$0FHEQ5/cplO3eEKillHvh.y009Wsf4WCKvQHsZntLamTUToIBe.fG', 'I am the admin', 'Admin',
        '100w 100s', 'Salt Lake City', 'UT', '84102', 1000, 'admin');

INSERT INTO `users`
VALUES (2, 'msis@utah.edu', '$2y$10$IASw3hGOm.nbnT8Fk.7vxu571A4Z6wQfltx5lhfdYwV6bzVqG32IO', 'testPhrase', 'Msis',
        '500w 500s', 'Salt Lake City', 'UT', '84111', 0, 'user');

INSERT INTO `users`
VALUES (3, 'msba@utah.edu', '$2y$10$IASw3hGOm.nbnT8Fk.7vxu571A4Z6wQfltx5lhfdYwV6bzVqG32IO', 'testPhrase', 'Msba',
        '500w 500s', 'Salt Lake City', 'UT', '84111', 0, 'user');

INSERT INTO `users`
VALUES (4, 'msf@utah.edu', '$2y$10$IASw3hGOm.nbnT8Fk.7vxu571A4Z6wQfltx5lhfdYwV6bzVqG32IO', 'testPhrase', 'Msf',
        '500w 500s', 'Salt Lake City', 'UT', '84111', 0, 'user');

INSERT INTO `users`
VALUES (5, 'mre@utah.edu', '$2y$10$IASw3hGOm.nbnT8Fk.7vxu571A4Z6wQfltx5lhfdYwV6bzVqG32IO', 'testPhrase', 'MRE',
        '500w 500s', 'Salt Lake City', 'UT', '84111', 0, 'user');

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `userId` int(8) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 2;

