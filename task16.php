

/*
Допишите реализацию функции invertCase(), которая инвертирует регистр каждого символа в переданной строке:

<?php

$str = 'ПрИвЕт!';
invertCase($str); // пРиВеТ!

*/



<?php

function invertCase($text)
{
    $result = '';

    for ($i = 0; $i < mb_strlen($text);$i++){
        $currentChar = mb_substr($text, $i, 1);
        if($currentChar === mb_strtolower($currentChar)){
            $invertChar = mb_strtoupper($currentChar);
            $result = "{$result}{$invertChar}";
        }elseif ($currentChar !== mb_strtolower($currentChar)){
            $invertChar = mb_strtolower($currentChar);
            $result = "{$result}{$invertChar}";
        }
    }
    return $result;

}