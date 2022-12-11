CREATE DATABASE IF NOT EXISTS urbanstore;
USE urbanstore;

SET FOREIGN_KEY_CHECKS = 0; -- to disable them

DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS OrderProductQuantity;
DROP TABLE IF EXISTS Payments;
DROP TABLE IF EXISTS Vendors;
DROP TABLE IF EXISTS Inventory;
DROP TABLE IF EXISTS Returns;

SET FOREIGN_KEY_CHECKS = 1; -- to re-enable them

CREATE TABLE `Orders`
(
    `orderId`      int(8)       PRIMARY KEY NOT NULL,
    `Amount`       varchar(55)  NOT NULL,
    `Timestamp`    varchar(255) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

CREATE TABLE `OrderProductQuantity`
(
    `orderId`      int(8)        PRIMARY KEY NOT NULL,
    `productId`    int(8)        PRIMARY KEY NOT NULL,
    `Quantity`     varchar(255) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

CREATE TABLE `Payments`
(
    `paymentId`      int(8)        PRIMARY KEY NOT NULL,
    `orderId`        int(8)        PRIMARY KEY NOT NULL,
    `Amount`         int(8)       NOT NULL,
    `PaymentType`    int(8)       NOT NULL,
    `Completed`      int(1)       NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

CREATE TABLE `Returns`
(
    `returnId`       int(8)        PRIMARY KEY NOT NULL,
    `orderId`        int(8)        PRIMARY KEY NOT NULL,
    `Timestamp`      varchar(255) NOT NULL,
    `ReturnRecieved` int(1)       NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

CREATE TABLE `Vendors`
(
    `VendorId`       int(8)        PRIMARY KEY NOT NULL,
    `Adress`         varchar(255) NOT NULL,
    `PhoneNumber`    varchar(255) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

CREATE TABLE `VendorSupplies`
(
    `VendorId`      int(8)        PRIMARY KEY NOT NULL,
    `SupplyId`      int(8)        PRIMARY KEY NOT NULL,
    `ProductId`     int(8)        PRIMARY KEY NOT NULL,
    `Quantity`      int(8)       NOT NULL,
    `Timestamp`     varchar(255) NOT NULL,
    `Recieved`      int(1)       NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

Create Table `Inventory`
(
    `ProductId`     int(8)        PRIMARY KEY NOT NULL,
    `Quantity`      int(8)       NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;



