

/*
Реализуйте функцию bubbleSort, которая сортирует массив используя пузырьковую сортировку.

<?php

use function App\Arrays\bubbleSort;

bubbleSort([]); // []
bubbleSort([3, 10, 4, 3]); // [3, 3, 4, 10]


*/

//Мое решение:


<?php

function bubbleSort($coll)
{
    $size = count($coll);
    do {
        $swapped = false;
        for ($i = 0; $i < $size - 1; $i++) {
            if ($coll[$i] > $coll[$i + 1]) {
                $temp = $coll[$i];
                $coll[$i] = $coll[$i + 1];
                $coll[$i + 1] = $temp;
                $swapped = true;
            }
        }
        $size--;
    } while ($swapped);
    return $coll;
}