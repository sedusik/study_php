

/*
Реализуйте анонимную функцию, которая принимает на вход строку и возвращает её последний символ (или null, если строка пустая). Запишите созданную функцию в переменную $last.

Примеры
<?php

$last('');     // null
$last('0');    // 0
$last('210');  // 0
$last('pow');  // w
$last('kids'); // s


*/

//Мое решение:


<?php

function run(string $text)
{
    $last = function ($text) {
        if ($text === '') {
            return null;
        }
        return substr($text, -1);
    };

    return $last($text);
}