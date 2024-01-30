

/*

Реализуйте функцию getComposerFileData, которая возвращет ассоциативный массив, соответствующий json из файла composer.json в этом упражнении.
Всё, что вам нужно сделать — посмотреть на содержимое composer.json и руками сформировать массив аналогичной структуры.

*/

//Мое решение:


<?php

function getComposerFileData()
{
    return [
        'autoload' => [
            'files' => [
                'src/Arrays.php'
            ]
        ],
        'config' => [
            'vendor-dir' => '/composer/vendor'
        ]
    ];
}