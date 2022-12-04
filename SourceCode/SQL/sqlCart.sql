CREATE DATABASE IF NOT EXISTS airasiadb;
USE airasiadb;

DROP TABLE IF EXISTS cart;

CREATE TABLE `cart`
(
    userid   int(8) not null,
    cardid   int(8) not null,
    quantity int(8) not null,
    primary key (userid, cardid),
    constraint cart_cards_null_fk
        foreign key (cardid) references cards (id)
#     constraint cart_users_null_fk
#         foreign key (userid) references users (userId)


) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;
