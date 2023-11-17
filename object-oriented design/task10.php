

/*
Реализуйте функцию getQuestions(), которая принимает на вход текст (полученный из редактора) и возвращает извлеченные из этого текста вопросы. Это должна быть строчка в форме списка разделенных переводом строки вопросов (смотрите секцию "Примеры").

Входящий текст разбит на строки и может содержать любые пробельные символы. Некоторые из этих строк являются вопросами. Они определяются по последнему символу: если это знак ?, то считаем строку вопросом.

Примеры
<?php

$text = <<<HEREDOC
lala\r\nr
ehu?\t
vie?eii
\n \t
i see you
/r \n
one two?\r\n\n
turum-purum
HEREDOC;

$result = getQuestions($text); // "ehu?\none two?"
echo $result;
// ehu?
// one two?
*/



<?php

namespace App\Normalizer;

use function Symfony\Component\String\s;

function getQuestions(string $text)
{
    $result = collect(s($text)->split("\n"))
    ->map(fn($line) => $line->trim())
    ->filter(fn($line) => $line->endsWith("?"))
    ->toArray();

    return implode("\n", $result);
}
