

/*
Реализуйте функцию enlargeArrayImage(), которая принимает изображение в виде двумерного массива и увеличивает его в два раза.

<?php

$image = [
  ['*','*','*','*'],
  ['*',' ',' ','*'],
  ['*',' ',' ','*'],
  ['*','*','*','*']
];
// ****
// *  *
// *  *
// ****

enlargeArrayImage($image);
// ********
// ********
// **    **
// **    **
// **    **
// **    **
// ********
// ********

*/

//Мое решение:


<?php

function duplicateEach(array $items)
{
    return reduce_left(
        map($items, fn($item) => [$item, $item]),
        function ($value, $index, $coll, $acc) {
            return [...$acc, ...$value];
        },
        []
    );
}

function enlargeArrayImage($matrix)
{
    $horizontallyStretched = map($matrix, fn($col) => duplicateEach($col));
    return duplicateEach($horizontallyStretched);
}