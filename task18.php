

/*
Реализуйте функцию isPalindrome(), которая принимает на вход слово и определяет, является ли оно палиндромом, а затем возвращает логическое значение.

Чтобы определить палиндром, достаточно сравнивать попарно символы с обоих концов слова. Если они все равны, это палиндром. Решите задачу без использования реверса строки (функция strrev()).

Примеры использования:

<?php

isPalindrome('radar'); // true
isPalindrome('maam'); // true
isPalindrome('a');     // true
isPalindrome('abs');   // false
// Функция должна уметь работать с юникодом
isPalindrome('шалаш'); // true
*/


//Мое решение
<?php

function isPalindrome($word){

    $len = mb_strlen($word);
    for($i = 0; $i < $len; $i++){
        $beginChar = mb_substr($word, $i, 1);
        $endChar = mb_substr($word, (-$i-1), 1);
        if($beginChar !== $endChar){
            return false;
        }
    }
    return true;
}

//Решение учителя

function isPalindrome(string $word)
{
    $lastIndex = mb_strlen($word) - 1;
    $middleIndex = $lastIndex / 2;
    for ($i = 0; $i < $middleIndex; $i++) {
        $symbol = mb_substr($word, $i, 1);
        $mirroredSymbol = mb_substr($word, $lastIndex - $i, 1);
        if ($symbol !== $mirroredSymbol) {
            return false;
        }
    }
    return true;
}