

/*
В этом задании вам предстоит реализовать простейший калькулятор. Функция calculate() принимает следующие аргументы:

Операция в виде строки (поддерживаются 4 операции +, -, /, *)
Два числа (первый и второй операнд)
Результатом работы функции является применения операции к этим числам. Если передается операция, которая не поддерживается, то функция должна вернуть null:

<?php

calculate('+', 3, 10); // 13
calculate('-', -8, 6); // -14
calculate('$', 0, 9);  // null

*/



function calculate($symbol, $number1, $number2){

    switch ($symbol){

        case '+':
            return $number1 + $number2;
        case '-':
            return $number1 - $number2;
        case '/':
            return $number1 / $number2;
        case '*':
            return $number1 * $number2;
        default:
            return null;
    }
}

