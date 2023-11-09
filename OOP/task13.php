

/*
Реализуйте функцию json_decode, которая работает почти как встроенная, но вместо возврата ошибки, выбрасывает исключение \Exception.

<?php
 
use App\Safe;
 
// Второй параметр соответствует второму параметру во встроенной функции json_decode.
// Его нужно передать как есть во внутренний вызов встроенной функции json_decode.
$data = Safe\json_decode('{ "key": "value" }', true);
// ['key' => 'value']

*/



<?php

namespace App\Safe;

function json_decode($json, $assoc = false)
{
    $data = \json_decode($json, $assoc);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new \Exception(json_last_error_msg());
    }
    return $data;
}