

/*
Реализуйте функцию getSameCount(), которая считает количество общих уникальных элементов для двух массивов. Аргументы:

Первый массив
Второй массив
Примеры
<?php

getSameCount([], []); // 0
getSameCount([4, 4], [4, 4]); // 1
getSameCount([1, 10, 3], [10, 100, 35, 1]); // 2
getSameCount([1, 3, 2, 2], [3, 1, 1, 2]); // 3
Подсказки
array_unique()

*/

//Мое решение:


<?php

function getSameCount($array1, $array2)
{
    $result = 0;
    $uniqueArray1 = array_unique($array1);
    $uniqueArray2 = array_unique($array2);
    foreach ($uniqueArray1 as $item1) {
        if (array_search($item1, $uniqueArray2) !== false) {
            $result = $result + 1;
        }
    }
    return $result;
}

//Решение учителя:

function getSameCount($coll1, $coll2)
{
    $count = 0;
    $uniqColl1 = array_unique($coll1);
    $uniqColl2 = array_unique($coll2);
    foreach ($uniqColl1 as $item1) {
        foreach ($uniqColl2 as $item2) {
            if ($item1 === $item2) {
                $count++;
            }
        }
    }

    return $count;
}