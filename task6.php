

/*

Напишите функцию getAgeDifference(), которая принимает два года рождения и возвращает строку с разницей в возрасте в виде The age difference is 11. Например:

<?php

$actual = getAgeDifference(2001, 2018);
print_r($actual); // => The age difference is 17

$actual2 = getAgeDifference(2020, 2002);
print_r($actual2); // => The age difference is 18

*/



<?php

function getAgeDifference($year1, $year2)
{
    $difference = strval(abs($year1 - $year2));
    return "The age difference is $difference";

}
