
/*
Напишите регулярное выражение, которому будут соответствовать все строки ruby1.*. В этой строке вместо символа * может находиться любой символ.
*/

ruby1\..

________________________________________________________________________________________________________________________

/*
Напишите регулярное выражение для поиска строк, у которых:

Первый и второй символы — это цифры
Третий символ — это /
Четвертый символ — любой, кроме a-z
*/

\d\d/[^a-z]

________________________________________________________________________________________________________________________

/*
Напишите регулярное выражение, которое находит строку, содержащую только support@hexlet.io.
Такие строки, как something here support@hexlet.io и support@hexlet.io something here не попадают под регулярное выражение.
*/

^support@hexlet\.io$

________________________________________________________________________________________________________________________

/*
Напишите регулярное выражение, которое соответствует подстрокам one, two или three.
*/

one|two|three

________________________________________________________________________________________________________________________

/*
Напишите регулярное выражение, которое находит электронную почту, удовлетворяющую следующим условиям:

Часть до @ должна содержать только символы класса \w в количестве не менее одного
Часть после @ и до ., после которой начинается домен, должна содержать только буквы и быть не короче трех символов (например, hexlet)
Часть после . может содержать только буквы и быть от двух до пяти символов в длину (например, io)
*/

^[\w]+@[a-zA-Z]{3,}\.[a-zA-Z]{2,5}$

________________________________________________________________________________________________________________________


/*
Напишите регулярное выражение, которое находит подстроки, состоящие из:

(
Хотя бы одного любого символа
)
*/

\(.+?\)

________________________________________________________________________________________________________________________


/*
Напишите регулярное выражение, которое находит подстроки, состоящие из:

Трех символов из класса a-z
:
Группы символов из первого условия
*/

([a-z]{3}):\1

________________________________________________________________________________________________________________________


/*
Напишите регулярное выражение, которое находит подстроку 1, за которой следует подстрока 2:

80
: и один или более символов, не входящих в класс a-z
Используйте позитивный просмотр вперед.

// match
['80:8080, 80:!@#$'];

// not match
['80:', '80', '80:d123f'];

*/

80(?=:[^a-z]+)

________________________________________________________________________________________________________________________

/*
Напишите регулярное выражение, которое находит строки, удовлетворяющие одному из условий:

Строка содержит группу из четырех цифр, перед которой следует строка code
Строка содержит подстроку ____, перед которой нет строки code
Используйте поиск по условию:

// match
['code1234', '____'];


// not match
['code123', 'code____'];


*/

(?(?<=code)[0-9]{4}|____)

________________________________________________________________________________________________________________________

/*
Напишите регулярное выражение, которое находит все подстроки python, заключенные в двойные " или одинарные ' кавычки. При этом вам нужно найти все варианты вне зависимости от регистра (Python, pytHon, pYThon и так далее).

Если будете использовать флаги, укажите их отдельной строкой:

yourRegexp # Здесь напишите регулярное выражение
mu # Здесь укажите необходимые флаги
Пример решения:

(\S+)@([a-z0-9.]+)
is


*/

('|")python\1
gi

________________________________________________________________________________________________________________________