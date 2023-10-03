

/*
Суперсерия Канада-СССР – это 8 товарищеских хоккейных матчей, проводившихся между командами СССР и Канады в 1972 (первая суперсерия) и в 1974 годах (вторая суперсерия). В этом задании вам предстоит написать функцию, которая вычисляет команду выигравшую суперсерию.

Superseries.php
Реализуйте функцию getSuperSeriesWinner($scores), которая находит команду победителя для конкретной суперсерии. Победитель определяется как команда, у которой больше побед (не количество забитых шайб) в конкретной серии. Функция принимает на вход массив, в котором каждый элемент это массив, описывающий счет в конкретной игре (сколько шайб забила Канада и СССР). Результат функции – название страны: 'canada', 'ussr'. Если суперсерия закончилась в ничью, то нужно вернуть null.

<?php

namespace App;

// Первое число – сколько забила Канада
// Второе число – сколько забил СССР
$scores = [
    [3, 7], // Первая игра
    [4, 1], // Вторая игра
    [4, 4],
    [3, 5],
    [4, 5],
    [3, 2],
    [4, 3],
    [6, 5],
];

Superseries\getSuperSeriesWinner($scores); // 'canada'


*/

//Мое решение:


<?php

function getSuperSeriesWinner($scores)
{
    $winUssr = 0;
    $winCanada = 0;
    foreach ($scores as $value) {
        if ($value[0] > $value[1]) {
            $winCanada = $winCanada + 1;
        } elseif ($value[0] < $value[1]) {
            $winUssr = $winUssr + 1;
        }
    }
    if ($winUssr > $winCanada) {
        return "ussr";
    } elseif ($winUssr < $winCanada) {
        return "canada";
    } else {
        return null;
    }
}

//Решение учителя:

function getSuperSeriesWinner($scores)
{
    $result = 0;
    foreach ($scores as $score) {
        // $result = $result + ($score[0] <=> $score[1]);
        $result += $score[0] <=> $score[1];
    }

    if ($result > 0) {
        return 'canada';
    } elseif ($result < 0) {
        return 'ussr';
    }

    return null;
}