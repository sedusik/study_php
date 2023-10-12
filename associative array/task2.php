

/*
Реализуйте функцию getDomainInfo(), которая принимает на вход имя сайта и возвращает информацию о нем:

<?php

use function App\Domains\getDomainInfo;

// Если домен передан без указания протокола,
// то по умолчанию берется http
getDomainInfo('yandex.ru')
// [
//     'scheme' => 'http',
//     'name' => 'yandex.ru'
// ]

getDomainInfo('https://hexlet.io');
// [
//     'scheme' => 'https',
//     'name' => 'hexlet.io'
// ]

getDomainInfo('http://google.com');
// [
//     'scheme' => 'http',
//     'name' => 'google.com'
// ]

*/

//Мое решение:


<?php

function getDomainInfo($site)
{
    if (substr($site, 0, 4) != 'http') {
        $scheme = 'http';
        $name = $site;
    } else {
        $parts = explode('://', $site);
        $scheme = $parts[array_key_first($parts)];
        $name = $parts[array_key_last($parts)];
    }
    $info = ['scheme' => $scheme, 'name' => $name];
    return $info;
}

//Решение учителя:

function getDomainInfo(string $domain): array
{
    if (substr($domain, 0, 8) === 'https://') {
        $scheme = 'https';
    } else {
        $scheme = 'http';
    }

    $name = str_replace("{$scheme}://", '', $domain);

    return ['scheme' => $scheme, 'name' => $name];
}