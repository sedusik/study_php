

/*
Реализуйте функцию union(...$arrays), которая находит объединение всех переданных массивов. Функция принимает на вход от одного массива и больше. Ключи исходных массивов не сохраняются (т.е. все значения итогового массива заново индексируются: 0, 1, 2, ...).

Примеры использования
<?php

union([3]); // [3]
union([3, 2], [2, 2, 1]); // [3, 2, 1]
union(['a', 3, false], [true, false, 3], [false, 5, 8]); // ['a', 3, false, true, 5, 8]
Объединение работает только для плоских массивов, то есть массивов внутри которых нет других массивов.

*/

//Мое решение:


<?php

function union($first, ...$rest)
{
    return array_values(array_unique(array_merge($first, ...$rest)));
}

//Решение учителя:

function union($first, ...$rest)
{
    $mapWithUniqKeys = array_unique(array_merge($first, ...$rest));
    return [...$mapWithUniqKeys];
}