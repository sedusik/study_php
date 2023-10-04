

/*
Реализуйте функцию countUniqChars, которая получает на вход строку и считает, сколько символов (уникальных символов) использовано в этой строке. Например, в строке 'yy' всего один уникальный символ — y. А в строке '111yya!' — четыре уникальных символа: 1, y, a и !.

Задание необходимо выполнить без использования функций array_unique и count_chars.

Примеры
<?php

$text1 = 'yyab';
countUniqChars($text1); // 3

$text2 = 'You know nothing Jon Snow';
countUniqChars($text2); // 13

$text3 = '';
countUniqChars($text3); // 0
Примечания
Если передана пустая строка, то функция должна вернуть 0, так как пустая строка вообще не содержит символов.

*/

//Мое решение:


<?php

function countUniqChars($string)
{
    if ($string === '') {
        return 0;
    }
    $array = str_split($string);
    $unicArray = array_unique($array);
    return count($unicArray);
}

//Решение2:

function countUniqChars($string)
{
    $uniqueChars = [];
    for ($i = 0; $i < strlen($string); $i++) {
        if (!in_array($string[$i], $uniqueChars)) {
            $uniqueChars[] = $string[$i];
        }
    }
    return count($uniqueChars);
}