--
-- Table structure for table `cards`
--

CREATE DATABASE IF NOT EXISTS airasiadb;
USE airasiadb;

DROP TABLE IF EXISTS cards;

CREATE TABLE `cards`
(
    `id`      int(8)       NOT NULL,
    `name`    varchar(55),
    `type`    varchar(255) NOT NULL,
    `cost`    varchar(55)  NOT NULL,
    `value`   varchar(55)  NOT NULL,
    `website` varchar(250)

) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
    MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 1;

--
-- Dumping data for table `cards`
--
INSERT INTO `cards` (`id`, `name`, `type`, `cost`, `value`, `website`)
VALUES ('1', 'amazon', 'gift-card', '1000', '100', 'www.Amazon.com');

INSERT INTO `cards` (`id`, `name`, `type`, `cost`, `value`, `website`)
VALUES ('2', 'delta', 'gift-card', '500', '50', 'www.delta.com');

INSERT INTO `cards` (`id`, `name`, `type`, `cost`, `value`, `website`)
VALUES ('3', 'nvidia', 'gift-card', '2000', '200', 'www.nvidia.com');

INSERT INTO `cards` (`id`, `name`, `type`, `cost`, `value`, `website`)
VALUES ('4', 'walgreens', 'gift-card', '1000', '100', 'www.walgreens.com');

INSERT INTO `cards` (`id`, `name`, `type`, `cost`, `value`, `website`)
VALUES ('5', NULL, 'cash-card', '10000', '1000', Null);

INSERT INTO `cards` (`id`, `name`, `type`, `cost`, `value`, `website`)
VALUES ('6', NULL, 'gift-card', '1500', '150', Null);

INSERT INTO `cards` (`id`, `name`, `type`, `cost`, `value`, `website`)
VALUES ('7', NULL, 'gift-card', '1500', '150', Null);

INSERT INTO `cards` (`id`, `name`, `type`, `cost`, `value`, `website`)
VALUES ('8', NULL, 'gift-card', '1500', '150', Null);

INSERT INTO `cards` (`id`, `name`, `type`, `cost`, `value`, `website`)
VALUES ('9', NULL, 'gift-card', '1500', '150', Null);

INSERT INTO `cards` (`id`, `name`, `type`, `cost`, `value`, `website`)
VALUES ('10', 'amazon', 'gift-card', '500', '100', 'www.Amazon.com');

INSERT INTO `cards` (`id`, `name`, `type`, `cost`, `value`, `website`)
VALUES ('11', 'amazon', 'gift-card', '1000', '100', 'www.Amazon.com');

INSERT INTO `cards` (`id`, `name`, `type`, `cost`, `value`, `website`)
VALUES ('12', 'delta', 'gift-card', '500', '50', 'www.delta.com');

INSERT INTO `cards` (`id`, `name`, `type`, `cost`, `value`, `website`)
VALUES ('13', 'nvidia', 'gift-card', '2000', '200', 'www.nvidia.com');

INSERT INTO `cards` (`id`, `name`, `type`, `cost`, `value`, `website`)
VALUES ('14', 'walgreens', 'gift-card', '1000', '100', 'www.walgreens.com');

INSERT INTO `cards` (`id`, `name`, `type`, `cost`, `value`, `website`)
VALUES ('15', NULL, 'cash-card', '10000', '1000', Null);

INSERT INTO `cards` (`id`, `name`, `type`, `cost`, `value`, `website`)
VALUES ('16', NULL, 'gift-card', '1500', '150', Null);

INSERT INTO `cards` (`id`, `name`, `type`, `cost`, `value`, `website`)
VALUES ('17', NULL, 'gift-card', '1500', '150', Null);

INSERT INTO `cards` (`id`, `name`, `type`, `cost`, `value`, `website`)
VALUES ('18', NULL, 'gift-card', '1500', '150', Null);

INSERT INTO `cards` (`id`, `name`, `type`, `cost`, `value`, `website`)
VALUES ('19', NULL, 'gift-card', '1500', '150', Null);

INSERT INTO `cards` (`id`, `name`, `type`, `cost`, `value`, `website`)
VALUES ('20', 'amazon', 'gift-card', '500', '100', 'www.Amazon.com');

