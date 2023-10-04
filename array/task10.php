

/*
Реализуйте функцию buildDefinitionList, которая генерирует html список определений (теги dl, dt и dd) и возвращает получившуюся строку. При отсутствии элементов в массиве функция возвращает пустую строку.

Параметры функции
Список определений следующего формата:

<?php

$definitions = [
    ['definition1', 'description1'],
    ['definition2', 'description2']
];
То есть каждый элемент входного списка сам является массивом, содержащим два элемента: термин и его определение.

Пример использования


*/

//Мое решение:


<?php

function buildDefinitionList($list)
{
    if (empty($list)) {
        return '';
    }
    $parts = [];
    foreach ($list as $value) {
        $parts[] = "<dt>{$value[0]}</dt><dd>{$value[1]}</dd>";
    }
    $innerValue = implode('', $parts);
    $result = "<dl>{$innerValue}</dl>";
    return $result;
}