

/*
Реализуйте функцию getFreeDomainsCount, которая принимает на вход список емейлов, а возвращает количество емейлов, расположенных на каждом бесплатном домене. Список бесплатных доменов хранится в константе FREE_EMAIL_DOMAINS.

Пример использования
<?php

$emails = [
    'info@gmail.com',
    'info@yandex.ru',
    'info@hotmail.com',
    'mk@host.com',
    'support@hexlet.io',
    'key@yandex.ru',
    'sergey@gmail.com',
    'vovan@gmail.com',
    'vovan@hotmail.com'
];

getFreeDomainsCount($emails);
# Array (
#     'gmail.com' => 3
#     'yandex.ru' => 2
#     'hotmail.com' => 2
#  )

*/

//Мое решение:


<?php

const FREE_EMAIL_DOMAINS = [
    'gmail.com', 'yandex.ru', 'hotmail.com'
];

function getFreeDomainsCount($emails)
{
    $domains = array_map(fn($email) => explode('@', $email)[1], $emails);
    $freeDomains = array_filter($domains, fn($domain) => in_array($domain, FREE_EMAIL_DOMAINS));
    return array_reduce($freeDomains, function ($acc, $domain) {
        $acc[$domain] = ($acc[$domain] ?? 0) + 1;
        return $acc;
    }, []);
}