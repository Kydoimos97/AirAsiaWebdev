--
-- Table structure for table `redemption`
--

CREATE DATABASE IF NOT EXISTS airasiadb;
USE airasiadb;

DROP TABLE IF EXISTS redemption;

CREATE TABLE `redemption`
(
    `redeemId`      int(8)       NOT NULL,
    `timestamp`    varchar(55),
    `pointsRedeemed`    varchar(255) NOT NULL,
    `accountId`    varchar(55)  NOT NULL,
    `cardId`   varchar(55)  NOT NULL

) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Indexes for table `redemption`
--
ALTER TABLE `redemption`
    ADD PRIMARY KEY (`redeemId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `redemption`
--
ALTER TABLE `redemption`
    MODIFY `redeemId` int(8) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 2;

--
-- Dumping data for table `redemption`
--

