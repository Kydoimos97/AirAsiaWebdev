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

insert into cart (userid, cardid, quantity) values (7, 17, 2);
insert into cart (userid, cardid, quantity) values (3, 2, 2);
insert into cart (userid, cardid, quantity) values (1, 1, 2);
insert into cart (userid, cardid, quantity) values (7, 11, 3);
insert into cart (userid, cardid, quantity) values (6, 8, 2);
insert into cart (userid, cardid, quantity) values (7, 3, 2);
insert into cart (userid, cardid, quantity) values (7, 9, 2);
insert into cart (userid, cardid, quantity) values (3, 1, 1);
insert into cart (userid, cardid, quantity) values (2, 8, 2);
insert into cart (userid, cardid, quantity) values (1, 15, 1);
insert into cart (userid, cardid, quantity) values (4, 2, 2);
insert into cart (userid, cardid, quantity) values (3, 16, 3);
insert into cart (userid, cardid, quantity) values (3, 14, 3);
insert into cart (userid, cardid, quantity) values (1, 4, 1);
insert into cart (userid, cardid, quantity) values (3, 6, 2);
insert into cart (userid, cardid, quantity) values (5, 10, 3);
insert into cart (userid, cardid, quantity) values (5, 3, 3);
insert into cart (userid, cardid, quantity) values (1, 20, 3);
insert into cart (userid, cardid, quantity) values (1, 9, 3);
insert into cart (userid, cardid, quantity) values (3, 13, 2);
insert into cart (userid, cardid, quantity) values (1, 14, 1);
insert into cart (userid, cardid, quantity) values (2, 16, 1);
insert into cart (userid, cardid, quantity) values (1, 7, 2);
insert into cart (userid, cardid, quantity) values (3, 19, 1);
insert into cart (userid, cardid, quantity) values (5, 6, 3);
insert into cart (userid, cardid, quantity) values (4, 7, 3);
insert into cart (userid, cardid, quantity) values (2, 1, 2);
insert into cart (userid, cardid, quantity) values (6, 20, 1);
insert into cart (userid, cardid, quantity) values (6, 18, 1);
insert into cart (userid, cardid, quantity) values (2, 10, 2);
insert into cart (userid, cardid, quantity) values (4, 3, 1);
insert into cart (userid, cardid, quantity) values (3, 11, 2);