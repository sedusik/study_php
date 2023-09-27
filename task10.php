

/*
Реализуйте функцию convertText(), которая принимает на вход строку. Если первая буква не заглавная, возвращает перевернутый вариант исходной строки. Если первая буква заглавная, то строка возвращается без изменений:

<?php

convertText('Hello'); // 'Hello'
convertText('hello'); // 'olleh'
Перевернуть строчку можно, используя функцию strrev().

Есть разные подходы к решению этой задачи. Возможно, вам пригодятся функции ucfirst(), strtoupper() и возможность получения символа из строки (например, $str[0]).

Попробуйте написать два варианта функции: с обычным if-else и с тернарным оператором.
*/


//Version1

<?php

function convertText($str){

    $firstChar = substr($str,0,1);
    if($firstChar !== strtoupper($firstChar)){
        return (strrev($str));
    }else{
        return $str;
    }
}

//Version2

function convertText($str){

    $firstChar = substr($str,0,1);
   return ($firstChar!==strtoupper($firstChar)) ? strrev($str) : $str;
}