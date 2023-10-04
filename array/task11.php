

/*
Реализуйте функцию makeCensored(), которая заменяет каждое вхождение указанных слов в предложении на последовательность $#%! и возвращает полученную строку. Аргументы:

Текст
Набор стоп слов
Словом считается любая непрерывная последовательность символов, включая любые спецсимволы (без пробелов).

Примеры
<?php

use function App\Strings\makeCensored;

$sentence = 'When you play the game of thrones, you win or you die';
makeCensored($sentence, ['die', 'play']);
// => When you $#%! the game of thrones, you win or you $#%!

$sentence2 = 'chicken chicken? chicken! chicken';
makeCensored($sentence2, ['?', 'chicken']);
// => '$#%! chicken? chicken! $#%!';
Подсказки
Тернарная операция может сослужить вам хорошую службу в этой практике
Массив стоп слов может содержать как больше, так и меньше двух элементов
in_array()
//Мое решение:


<?php

function makeCensored($text, $stopWords)
{
    $words = explode(' ', $text);
    $result = [];
    $symbols = '$#%!';
    foreach ($words as $word) {
        $result[] = in_array($word, $stopWords) ? $symbols : $word;
    }
    return implode(' ', $result);
}

//Мое решение2:

<?php
function makeCensored($text, $stopWords)
{
    $words = explode(' ', $text);
    $result = [];
    $symbols = '$#%!';
    foreach ($words as $word){
        if(in_array($word, $stopWords)) {
             $result[] = $symbols;
        } else {
            $result[] = $word;
        }
    }
    return implode (' ', $result);
}