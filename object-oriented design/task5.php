

/*
Реализуйте функцию compare($seq1, $seq2), которая сравнивает две строчки набранные в редакторе. Если они равны то возвращает true, иначе - false. Особенность строчек в том они могут содержать символ #, соответствующий нажатию клавиши Backspace. Она означает, что нужно стереть предыдущий символ: abd##a# превращается в a.

Примеры
<?php

// Перед самим сравнением, нужно вычислить реальную строчку отображенную в редакторе.
// 'ac' === 'ac'
compare('ab#c', 'ab#c'); // true

// '' === ''
compare('ab##', 'c#d#'); // true

// 'c' === 'b'
compare('a#c', 'b'); // false

// 'cd' === 'cd'
compare('#cd', 'cd'); // true
Подсказки
Поведение # соответствует тому как это происходит в реальной жизни. Если строчка пустая, то Backspace ничего не стирает.
В этой задаче понадобится стек.
Воспользуйтесь классом \Ds\Stack.
*/



//Решение 1:

<?php
namespace App\Comparator;

function compare($seq1, $seq2)
{
    $stack1 = new \Ds\Stack();
    $stack2 = new \Ds\Stack();
    $backspace = '#';

    for ($i = 0; $i < strlen($seq1); $i++) {
        $curr1 = $seq1[$i];
        if ($curr1 != $backspace) {
            $stack1->push($curr1);
        } else {
            if (!$stack1->isEmpty()) {
                $stack1->pop();
            }
        }
    }

    for ($i = 0; $i < strlen($seq2); $i++) {
        $curr2 = $seq2[$i];
        if ($curr2 != $backspace) {
            $stack2->push($curr2);
        } else {
            if (!$stack2->isEmpty()) {
                 $stack2->pop();
            }
        }
    }
    return $stack1 == $stack2;
}
//Решение 2:


namespace App\Comparator;

function evaluate($string)
{
    $stack = new \Ds\Stack();
    $backspace = '#';

    for ($i = 0; $i < strlen($string); $i++) {
        $curr = $string[$i];
        if ($curr != $backspace) {
            $stack->push($curr);
        } else {
            if (!$stack->isEmpty()) {
                $stack->pop();
            }
        }
    }
    return $stack;
}

function compare($seq1, $seq2)
{
    $evaluateSeq1 = evaluate($seq1);
    $evaluateSeq2 = evaluate($seq2);
    return $evaluateSeq1 == $evaluateSeq2;
}