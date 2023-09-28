

/*
Реализуйте функцию joinNumbersFromRange(), которая объединяет все числа из диапазона в строку:

<?php

joinNumbersFromRange(1, 1);  // '1'
joinNumbersFromRange(2, 3);  // '23'
joinNumbersFromRange(5, 10); // '5678910'

*/



<?php

function joinNumbersFromRange($start, $finish){
    $result = '';
    $i = $start;
    while ($i <= $finish){
        $result = "{$result}{$i}";
        $i = $i+1;
    }
return $result;
}

