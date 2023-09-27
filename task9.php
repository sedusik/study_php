

/*
Реализуйте функцию normalizeUrl(), которая выполняет так называемую нормализацию данных. Она принимает адрес сайта и возвращает его с https:// в начале.

Функция принимает адреса в виде:

АДРЕС
http://АДРЕС
https://АДРЕС
Но всегда возвращает URL в виде https://АДРЕС:

<?php

normalizeUrl('google.com');          // 'https://google.com'
normalizeUrl('http://ai.fi');        // 'https://ai.fi'
normalizeUrl('https://hexlet.io');   // 'https://hexlet.io'

*/

//Мое решение:

<?php

function normalizeUrl($adress)
{
    $protocol = "https://";
    if ((substr($adress,0,7)) == "http://"){
        return $protocol . (substr($adress, 7));
    }elseif((substr($adress,0,8)) == $protocol){
        return $adress;
    }else{
        return $protocol . $adress;
    }
}

//Решение преподователя:

function normalizeUrl($url)
{
    if (strpos($url, 'http://') === 0) {
        $domain = substr($url, 7);
    } elseif (strpos($url, 'https://') === 0) {
        $domain = substr($url, 8);
    } else {
        $domain = $url;
    }

    return "https://{$domain}";
}