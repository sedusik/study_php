

/*
Реализуйте функцию countVowels(), которая принимает строку, считает и возвращает количество гласных букв в ней.

Для проверки, является ли буква гласной, импортируйте и используйте функцию isVowel(). Неймспейс, в котором находится функция определён в файле Symbols.php, сам файл включать не нужно:

Пример использования:

<?php

countVowels('One'); // 2
countVowels('London is the capital of Great Britain'); // 13

*/



use function App\Symbols\isVowel;

function countVowels($str){

    $result = 0;
    for($i = 0; $i < strlen($str); $i++){
        $currentChar = substr($str, $i, 1);
        if(isVowel($currentChar)){
            $result = $result + 1;
        }
    }
    return $result;
}