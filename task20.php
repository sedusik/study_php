

/*
Реализуйте функцию reverse(), которая переворачивает цифры в переданном числе:

<?php

use function App\Number\reverse;

reverse(13); // 31
reverse(-123); // -321
Не забудьте задать тип входного и выходного аргумента.

Подсказки
Переворот строки
Одно из решений этой задачи опирается на явное преобразование типов
*/



<?php

function reverse(int $numbers): int
{
    if($numbers >= 0){
        $string = strval($numbers);
        $reversstring = strrev($string);
        $reversnumbers = intval($reversstring);
        return  $reversnumbers;
    }
    else{
        $string = strval($numbers);
        $modulnumbers = substr($numbers, 1);
        $reversstring = strrev($modulnumbers);
        $reversnumbers = intval($reversstring);
        return  "-" . $reversnumbers;
    }

}