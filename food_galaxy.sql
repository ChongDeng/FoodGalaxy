create database food_galaxy;
use food_galaxy;

create table admin
(
  username char(16) not null primary key,
  password char(40) not null
);

create table customer
(
  customer_id int unsigned not null auto_increment primary key,
  name char(60) not null,
  password char(80) not null,
  email char(80) not null,
  phone char(20)  
);

create table merchant
(
  merchant_id int unsigned not null auto_increment primary key,
  name char(60) not null,
  password char(80) not null,
  email char(80) not null,
  address char(80) not null,
  phone1 char(20) not null,
  phone2 char(20),
  phone3 char(20),
  popularity_level int
);

create table food_category
(
  food_category_id int unsigned not null auto_increment primary key,
  name char(60) not null,
  index(name) 
);

create table food
(
  food_id int unsigned not null auto_increment primary key,
  catogery_name char(60) not null,
  name char(80) not null,
  merchant_id int,
  price char(5),
  popularity_level int default 1,
  description text,
  index(name),
  index(catogery_name)
);

create table review
(
  review_id int unsigned not null auto_increment primary key,  
  type int, //0 食物 ； 1 厂家 
  target_id int not null,
  author_id int not null,
  title char(80) not null,
  content text not null,
  date date not null
);

create table complaint
(
  complaint_id int unsigned not null auto_increment primary key,
  customer_id int,
  type int, //0 食物 ； 1 厂家 
  target_id int,  
  content text,
  date date not null
);

create table black_list
(
  black_list_id int unsigned not null auto_increment primary key,
  key_words char(20) 
);

create table malign_person
(
  malign_person_id int unsigned not null auto_increment primary key,
  type int,
  target_id int, 
  content text
);

create table malign_according
(
  malign_accord_id int unsigned not null auto_increment primary key,
  type int, //0: customer reivew; 1: merchant food description
  target_id int  //  customer reivew id, or merchant food id
);

create table notification
(
  notification_id int unsigned not null auto_increment primary key,
  type int,
  target_id int, 
  content text,
  date date not null
);

create table recommendation
(
  recommendation_id int unsigned not null auto_increment primary key,
  customer_id int,
  food_id int 
);

create table coupon
(
  coupon_id int unsigned not null auto_increment primary key,
  merchant_id int,
  content text,
  expiresdate time 
);

create view food_by_merchant_name_view
as select food.name as food_name, food_id, description, price, food.popularity_level as popularity_level, merchant.name as merchant_name
from food, merchant
where merchant.merchant_id = food.merchant_id;

drop procedure if exists update_popularity_level;
create procedure update_popularity_level(in FoodId int)
	begin
		declare res int;

		update food 
		set popularity_level = popularity_level + 1
		where food_id = FoodId;
		
		select popularity_level into res 
		from food 
		where food_id = FoodId;	
		
		if res > 5 then
			insert into recommendation(food_id)
			values(FoodId);
                end if;
	end;

CREATE TRIGGER t_after_insert_on_review
AFTER INSERT ON review
FOR EACH ROW
BEGIN
 call update_popularity_level(new.target_id);
END;
	

grant select, insert, update, delete
on food_galaxy.*
to food_galaxy@localhost identified by 'password';
