

/*
Реализуйте функцию isContinuousSequence, которая проверяет, является ли переданная последовательность целых чисел возрастающей непрерывно (не имеющей пропусков чисел). Например, последовательность [4, 5, 6, 7] — непрерывная, а [0, 1, 3] — нет. Последовательность может начинаться с любого числа, главное условие — отсутствие пропусков чисел. Последовательность из одного числа не может считаться возрастающей.

<?php

isContinuousSequence([10, 11, 12, 13]);     // true
isContinuousSequence([10, 11, 12, 14, 15]); // false
isContinuousSequence([1, 2, 2, 3]);         // false
isContinuousSequence([]);                   // false


*/

//Мое решение:


<?php

function isContinuousSequence($array)
{
    $size = count($array);
    if ($size <= 1) {
        return false;
    }
    $start = $array[0];
    foreach ($array as $key => $value)
    if ($start + $key !== $value) {
        return false;
    }
    return true;
}