

/*
Реализуйте функцию checkIfBalanced, которая проверяет балансировку круглых скобок в арифметических выражениях.

<?php

checkIfBalanced('(5 + 6) * (7 + 8)/(4 + 3)'); // true
checkIfBalanced('(4 + 3))'); // false

*/

//Мое решение:


<?php

function checkIfBalanced($expression)
{
    $stack = [];
    $symbol1 = ['('];
    $symbol2 = [')'];
    $pair = ['(', ')'];
    for ($i = 0; $i < strlen($expression); $i++) {
        $curr = $expression[$i];
        if (in_array($curr, $symbol1)) {
            array_push($stack, $curr);
        } elseif (in_array($curr, $symbol2)) {
            if (empty($stack) || !in_array(end($stack), $pair)) {
                return false;
            } else {
                array_pop($stack);
            }
        }
    }
    return (empty($stack));
}

//Решение учителя:

function checkIfBalanced(string $expression): bool
{
    $stack = [];
    for ($i = 0, $length = strlen($expression); $i < $length; $i++) {
        $curr = $expression[$i];
        if ($curr === '(') {
            array_push($stack, $curr);
        } elseif ($curr === ')') {
            if (empty($stack)) {
                return false;
            }
            array_pop($stack);
        };
    }

    return empty($stack);
}