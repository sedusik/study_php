

/*
В данном упражнении вам предстоит реализовать класс Url, который позволяет извлекать из HTTP адреса, представленного строкой, его части.

Класс должен содержать конструктор и методы:

конструктор - принимает на вход HTTP адрес в виде строки.
getScheme() - возвращает протокол передачи данных (без двоеточия).
getHostName() - возвращает имя хоста.
getQueryParams() - возвращает параметры запроса в виде пар ключ-значение объекта.
getQueryParam() - получает значение параметра запроса по имени. Если параметр с переданным именем не существует, метод возвращает значение заданное вторым параметром (по умолчанию равно null).
equals($url) - принимает объект класса Url и возвращает результат сравнения с текущим объектом - true или false.
<?php

use App\Url;

$url = new Url('http://yandex.ru:80?key=value&key2=value2');
$url->getScheme(); // 'http'
$url->getHostName(); // 'yandex.ru'
$url->getQueryParams();
// [
//     'key' => 'value',
//     'key2' => 'value2',
// ];
$url->getQueryParam('key'); // 'value'
// второй параметр - значение по умолчанию
$url->getQueryParam('key2', 'lala'); // 'value2'
$url->getQueryParam('new', 'ehu'); // 'ehu'
$url->getQueryParam('new'); // null
$url->equals(new Url('http://yandex.ru:80?key=value&key2=value2')); // true
$url->equals(new Url('http://yandex.ru:80?key=value')); // false
*/



<?php

namespace App;

class Url
{
    private $url;
    private $queryParams;

    public function __construct($url)
    {
        $this->url = parse_url($url);
        $this->queryParams = [];

        if (isset($this->url['query'])) {
            parse_str($this->url['query'], $this->queryParams);
        }
    }

    public function getScheme()
    {
        return $this->url['scheme'];
    }

    public function getHostName()
    {
        return $this->url['host'];
    }
    public function getQueryParams()
    {
        return $this->queryParams;
    }
    public function getQueryParam($key, $defaultValue = null)
    {
        return $this->queryParams[$key] ?? $defaultValue;
    }
    public function equals($url)
    {
        return $this == $url;
    }
}
