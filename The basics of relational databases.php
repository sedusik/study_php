

/*
В этом задании нужно создать три таблицы. Все запросы нужно записывать в файл, указанный в заголовке. Система проверки сама их выполнит внутри базы данных.

Напишите запрос, создающий таблицу courses со следующими полями:

name типа varchar длиной 255.
body типа text.
created_at типа timestamp.
Напишите запрос, создающий таблицу users со следующими полями:

first_name типа varchar длиной 255.
email типа varchar длиной 255.
manager типа boolean.
Напишите запрос, создающий таблицу course_members со следующими полями:

user_id типа bigint
course_id типа bigint
created_at типа timestamp
*/



CREATE TABLE courses (
name varchar(255),
body text,
created_at timestamp
);

CREATE TABLE users (
first_name varchar(255),
email varchar(255),
manager boolean
);

CREATE TABLE course_members (
user_id bigint,
course_id bigint,
created_at timestamp
);

______________________________________________________________________________________________________

/*
Запишите в файл следующие запросы:

Запрос, который удаляет из таблицы users пользователя с именем Sansa
Запрос, который вставляет в таблицу users пользователя с именем Arya и почтой arya@winter.com
Запрос, который устанавливает флаг manager в true для пользователя с емейлом tirion@got.com
*/



DELETE FROM users WHERE first_name = 'Sansa';
INSERT INTO users (first_name, email) VALUES
('Arya', 'arya@winter.com');
UPDATE users SET manager = true WHERE email = 'tirion@got.com';

______________________________________________________________________________________________________

/*
Составьте запрос, который извлекает все записи из таблицы users по следующим правилам:
* Пользователи должны быть рождены позже 23 октября 1999 года. Поле `birthday`.
* Выборка отсортирована в алфавитном порядке по полю `first_name`
* Нужно извлечь только три записи
*/



SELECT * FROM users WHERE birthday > '1999-10-23' ORDER BY first_name LIMIT 3;

______________________________________________________________________________________________________

/*
Создайте таблицу cars со следующими полями:
user_first_name - имя пользователя (соответствующее имени в таблице users)
brand - марка машины
model - конкретная модель
Добавьте в таблицу users две записи с именами arya и sansa. Сама таблица добавляется в базу данных автоматически (смотрите файл init.sql)
Добавьте в таблицу cars 5 произвольных записей. Две из них должны содержать пользователя по имени arya, а три других - sansa.
Пример
INSERT INTO users VALUES ('User First Name', 'User Last Name', '1832-10-11');
-- Машина для пользователя добавленного предыдущим запросом. Связь через имя.
INSERT INTO cars VALUES ('User First Name', 'bmw', 'x5');
*/



CREATE TABLE cars (
user_first_name varchar(255),
brand varchar(255),
model varchar(255)
);

INSERT INTO users (first_name)
VALUES ('arya'), ('sansa');

INSERT INTO cars VALUES
('arya', 'oka', 'lo'),
('arya', 'oka', 'lot'),
('sansa', 'oka', 'lof'),
('sansa', 'oka', 'lod'),
('sansa', 'oka', 'los');

______________________________________________________________________________________________________

/*
Создайте таблицу users со следующими полями:
id - первичный ключ
first_name - имя
created_at - дата создания пользователя
Добавьте в таблицу users одну запись с именем пользователя Tom.
Создайте таблицу orders со следующими полями:
id - первичный ключ
user_first_name - при вставке записи здесь указывается имя пользователя из таблицы users
months - количество покупаемых месяцев (обучение на Хекслете)
created_at - дата создания заказа
Добавьте в таблицу orders два заказа на созданного ранее пользователя
Значения первичных ключей задайте самостоятельно. Автогенерация изучается дальше по курсу. Примеры вставки данных в эти таблицы:

INSERT INTO users (id, first_name, created_at) VALUES (1, 'Tom', '1832-11-23');
INSERT INTO orders (id, user_first_name, months, created_at) VALUES (1, 'Tom', 3, '2012-10-1');
*/



CREATE TABLE users (
id bigint PRIMARY KEY,
first_name varchar(255),
created_at date
);

INSERT INTO users (id, first_name, created_at) VALUES (1, 'Tom', '1832-11-23');

CREATE TABLE orders (
id bigint PRIMARY KEY,
user_first_name varchar(255),
months integer,
created_at date
);

INSERT INTO orders (id, user_first_name, months, created_at)
VALUES (1, 'Tom', 3, '2012-10-17'), (2, 'Ted', 3, '2014-10-16');

______________________________________________________________________________________________________

/*
В базе данных содержится таблица old_cars, в которой составной первичный ключ: model-brand.

old_cars:

model	brand	price	discount
m5	bmw	5500000	5
almera	nissan	5500000	10
x5m	bmw	6000000	5
m1	bmw	2500000	5
gt-r	nissan	5000000	10
Цена (price) в этой таблице зависит от первичного ключа (model-brand), а вот скидка (discount) только от бренда (brand).

solution.sql
Создайте две таблицы cars и brands. Эти таблицы должны отображать нормализованную структуру таблицы old_cars
Создайте суррогатный первичный ключ для каждой из таблиц
Укажите внешний ключ (brand_id) в таблице cars на таблицу brands
Поле с именем name в таблице brands должно содержать значения из поля brand таблицы old_cars
Добавьте в эти таблицы те же записи, что и в исходной таблице, но в нормализованной форме
В результате у вас должны получиться две следующие таблицы:

brands:

id	name	discount
1	bmw	5
2	nissan	10
cars:

id	brand_id	model	price
1	1	m5	5500000
2	1	x5m	6000000
3	1	m1	2500000
4	2	gt-r	5000000
5	2	almera	5500000

*/



CREATE TABLE brands (
id bigint PRIMARY KEY,
name varchar(255),
discount integer
);

CREATE TABLE cars (
id bigint PRIMARY KEY,
brand_id bigint REFERENCES brands (id),
model varchar(255),
price integer
);

INSERT INTO brands (id, name, discount)
VALUES (1, 'bmw', 5), (2, 'nissan', 10);

INSERT INTO cars
(id, brand_id, model, price)
VALUES
(1, 1, 'm5', 5500000),
(2, 1, 'x5m', 6000000),
(3, 1, 'm1', 2500000),
(4, 2, 'gt-r', 5000000),
(5, 2, 'almera', 5500000);

______________________________________________________________________________________________________


/*
В базе данных содержится таблица old_cities следующей структуры:

country	region	city
Россия	Татарстан	Бугульма
Россия	Татарстан	Казань
Россия	Самарская область	Тольятти
Город в этой таблице зависит и от региона и от страны. Зависимость от региона прямая, а вот от страны город зависит косвенно, так как страна определяется регионом.

solution.sql
Создайте три таблицы countries, country_regions и country_region_cities, в которых отобразите нормализованную структуру исходной таблицы old_cities. Создайте суррогатный первичный ключ для каждой из таблиц. Не забудьте указать внешний ключ. Поле для имени сущности в каждой таблице назовите именем name. Все ключи должны иметь тип bigint
Добавьте в созданные таблицы те же записи, что и в исходной таблице, но в нормализованной форме

*/



CREATE TABLE countries (
id bigint PRIMARY KEY,
name varchar(255)
);

CREATE TABLE country_regions (
id bigint PRIMARY KEY,
country_id bigint REFERENCES countries (id),
name varchar(255)
);

CREATE TABLE country_region_cities (
id bigint PRIMARY KEY,
country_region_id bigint REFERENCES country_regions (id),
name varchar(255)
);

INSERT INTO countries
VALUES
(1, 'Россия');

INSERT INTO country_regions
VALUES
(1, 1, 'Татарстан'),
(2, 1, 'Самарская область');

INSERT INTO country_region_cities
VALUES
(1, 1, 'Бугульма'),
(2, 1, 'Казань'),
(3, 2, 'Тольятти');

______________________________________________________________________________________________________
/*
Создайте таблицу article_categories с двумя полями:

id — автогенерируемый первичный ключ
name — текстовое поле
Добавьте в эту таблицу две произвольные записи.

*/

CREATE TABLE article_categories (
id bigint PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
name varchar(255)
);

INSERT INTO article_categories (name) VALUES ('valya'), ('petya');

______________________________________________________________________________________________________

/*
Каждый раз, когда мы совершаем покупки в интернете, на стороне продавца формируется «заказ». Это сущность, которая описывает собой конкретную покупку и включает в себя пользователя, а также список позиций. Если взять какой-нибудь интернет-магазин, торгующий электроникой, то в заказ могут входить клавиатура, мышка и коврик. Ниже представлена ERD в которой отражены сущности, участвующие в процессе.

ERD Заказа

На диаграмме выше цена из товара копируется в order_items. Подумайте, для чего это надо? Подсказка: мутабельность.

solution.sql
Реализуйте таблицы в соответствии с указанной выше диаграммой, кроме таблицы users, которая уже создана.

*/

CREATE TABLE goods (
id bigint PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
name varchar(255),
price integer
);

CREATE TABLE orders (
id bigint PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
user_id bigint REFERENCES users (id),
created_at date
);

CREATE TABLE order_items (
id bigint PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
order_id bigint REFERENCES orders (id),
good_id bigint REFERENCES goods (id),
price integer
);

______________________________________________________________________________________________________


/*
Напишите запрос, создающий таблицу users со следующими полями:

id — первичный автогенерируемый ключ
username — уникально и не может быть null
email — не может быть null
created_at — не может быть null
Напишите запрос, создающий таблицу topics со следующими полями:

id — первичный автогенерируемый ключ
user_id — внешний ключ
body — не может быть null
created_at — не может быть null

*/

CREATE TABLE users (
id bigint PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
username varchar(255) UNIQUE NOT NULL,
email varchar(255) NOT NULL,
created_at timestamp NOT NULL
);

CREATE TABLE topics (
id bigint PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
user_id bigint REFERENCES users (id),
body varchar(255) NOT NULL,
created_at timestamp NOT NULL
);

______________________________________________________________________________________________________

/*
Напишите запрос, обновляющий таблицу структуры:

CREATE TABLE users (
id bigint PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
email varchar(255) NOT NULL,
age integer,
name varchar(255)
);
В структуру:

CREATE TABLE users (
id bigint PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
email varchar(255) NOT NULL UNIQUE,
first_name varchar(255) NOT NULL,
created_at timestamp
);
name и first_name - одна и та же колонка.

*/

ALTER TABLE users DROP COLUMN age;
ALTER TABLE users RENAME COLUMN name TO first_name;
ALTER TABLE users ADD COLUMN created_at timestamp;
ALTER TABLE users
ALTER COLUMN first_name SET NOT NULL,
ADD CONSTRAINT unique_email UNIQUE (email);
______________________________________________________________________________________________________


/*
Составьте запрос, который извлекает из базы данных (таблица users) все имена (поле first_name) пользователей, отсортированных по дате рождения (поле birthday) в обратном порядке.
Те записи, у которых нет даты рождения, должны быть в конце списка.

*/

SELECT first_name FROM users ORDER BY birthday DESC NULLS LAST;
______________________________________________________________________________________________________



/*
Составьте запрос, который извлекает все записи из таблицы users по следующим правилам:

Пользователи созданы позже 2018-11-23 (включая эту дату) и раньше 2018-12-12 (включая эту дату) или поле house имеет значение stark
Данные отсортированы по дате создания по убыванию

*/

SELECT * FROM users WHERE created_at BETWEEN '2018-11-23' AND '2018-12-12' OR house = 'stark'
ORDER BY created_at DESC;
______________________________________________________________________________________________________



/*
Составьте запрос, который извлекает все записи из таблицы users по следующим правилам:

Пользователи должны быть рождены (birthday) раньше 3 октября 2002 года.
Данные отсортированы по имени в прямом порядке
Нужно извлечь 3 строчки, пропустив первые две

*/

SELECT * FROM users WHERE birthday < '2002-10-03'
ORDER BY first_name ASC LIMIT 3 OFFSET 2;
______________________________________________________________________________________________________
/*
Составьте запрос, который извлекает из таблицы users все уникальные значения поля house, отсортированные по возрастанию.

*/

SELECT DISTINCT house FROM users ORDER BY house;
______________________________________________________________________________________________________

/*
Составьте запрос, который извлекает из таблицы users количество записей, у которых значение поля house равно stark.

*/

SELECT COUNT(*) FROM users WHERE house = 'stark';
______________________________________________________________________________________________________

/*
Составьте запрос (к таблице users), который считает количество пользователей, рождённых (поле birthday) в каждом году (из тех, что есть в birthday) по следующим правилам:

Анализируются только те пользователи, у которых указана дата рождения
Выборка отсортирована по году рождения в прямом порядке

*/

SELECT EXTRACT(year FROM birthday) AS year_of_birthday, COUNT(*) as count
FROM users
WHERE birthday IS NOT NULL
GROUP BY year_of_birthday
ORDER BY year_of_birthday ASC;
______________________________________________________________________________________________________


/*
Составьте запрос, который извлекает из базы идентификатор топика и имя автора топика (first_name) по следующим правилам:

Анализируются топики только тех пользователей, чей емейл находится на домене lannister.com
Выборка отсортирована по дате создания топика в прямом порядке

*/

SELECT topics.id, users.first_name
FROM topics JOIN users ON topics.user_id = users.id
WHERE users.email LIKE '%@lannister.com'
ORDER BY topics.created_at;
______________________________________________________________________________________________________


/*
Механизм дружбы в социальных сетях обычно реализуется через отдельную таблицу friendship, которая ссылается на обоих пользователей. Когда два человека начинают дружить, то в эту таблицу заносятся сразу две записи:

friendship

id	user1_id	user2_id
1	3	10
2	10	3
Такой способ организации данных позволяет работать с понятием "дружба" независимо от того, кто был указан первым, а кто вторым.

solution.sql
Составьте транзакцию, которая создает дружбу между пользователями Tirion и Jon.

*/

BEGIN;
INSERT INTO friendship (user1_id, user2_id)
VALUES (7, 2);
INSERT INTO friendship (user1_id, user2_id)
VALUES (2, 7);
COMMIT;

______________________________________________________________________________________________________

