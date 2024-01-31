

/*
Реализуйте функцию reverse($list), которая принимает на вход односвязный список и переворачивает его.

<?php

use App\Node;
use function App\LinkedList\reverse;

// (1, 2, 3)
$numbers = new Node(1, new Node(2, new Node(3)));
$reversedNumbers = reverse($numbers); // (3, 2, 1)

*/

<?php

namespace App\LinkedList;

use App\Node;

// BEGIN (write your solution here)
function reverse($list)
{
    $reversedList = null;
    $current = $list;
    while($current) {
        $reversedList = new Node($current->getValue(), $reversedList);
        $current = $current->getNext();
    }
    return $reversedList;
}
// END

________________________________________________________________________________________________________________________


/*
Реализуйте функцию getLinks($tags), которая принимает на вход список тегов, находит среди них теги a, link и img, а затем извлекает ссылки и возвращает список ссылок. Теги подаются на вход в виде массива, где каждый элемент это тег. Тег имеет следующую структуру:

name - имя тега.
href или src - атрибуты. Атрибуты зависят от тега: img - src, a - href, link - href.
<?php

use function App\HTML\getLinks;

$tags = [
    ['name' => 'img', 'src' => 'hexlet.io/assets/logo.png'],
    ['name' => 'div'],
    ['name' => 'link', 'href' => 'hexlet.io/assets/style.css'],
    ['name' => 'h1']
];
$links = getLinks($tags);
// [
//     'hexlet.io/assets/logo.png',
//     'hexlet.io/assets/style.css'
// ];

*/

<?php

namespace App\HTML;

// BEGIN (write your solution here)
function getLinks($tags)
{
    $filtered = array_values(array_filter($tags, fn($tag) =>
    (array_key_exists('src', $tag)) or (array_key_exists('href', $tag))));
    return array_map(function ($line) {
        if (array_key_exists('src', $line)) {
            return $line['src'];
        } else {
            return $line['href'];
        }
    }, $filtered);
}
// END
________________________________________________________________________________________________________________________



/*
Реализуйте функцию stringify($tag), которая принимает на вход тег и возвращает его текстовое представление. Например:

Примеры
<?php

use function App\HTML\stringify;

$tag = ['name' => 'hr', 'class' => 'px-3', 'id' => 'myid', 'tagType' => 'single'];
$html = stringify($tag);
// <hr class="px-3" id="myid">


$tag = ['name' => 'div', 'tagType' => 'pair', 'body' => 'text2', 'id' => 'wow'];
$html = stringify($tag);
// <div id="wow">text2</div>
Внутри структуры тега есть три специальных ключа:

name - имя тега
tagType - тип тега, определяет его парность (pair) или одиночность (single)
body - тело тега, используется для парных тегов
Все остальное становится атрибутами тега и не зависит от того парный он или нет.

*/

<?php

namespace App\HTML;

// BEGIN (write your solution here)
function stringify($tag)
{
        $build = function ($tag) {
        return collect($tag)
            ->except(['name', 'tagType', 'body'])
            ->map(function ($attr, $value) {return " {$value}=\"{$attr}\"";})
            ->join('');
    };

    $mapping = [
        'single' => function ($tag) use ($build) {
            return "<{$tag['name']}{$build($tag)}>";
        },
        'pair' => function ($tag) use ($build) {
            return "<{$tag['name']}{$build($tag)}>{$tag['body']}</{$tag['name']}>";
        }
    ];

    return $mapping[$tag['tagType']]($tag);
}
// END
________________________________________________________________________________________________________________________




/*
Реализуйте класс DatabaseConfigLoader, который отвечает за загрузку конфигурации для базы данных. У класса следующий интерфейс:

Конструктор - принимает на вход путь, по которому нужно искать конфигурацию
load($env) - метод, который грузит конфигурацию для конкретной среды окружения. Она загружает файл database.{$env}.json, парсит его и возвращает результат наружу.
<?php

$loader = new DatabaseConfigLoader(__DIR__ . '/fixtures');
$config = $loader->load('production'); // loading database.production.json
// [
//     'host' => 'google.com',
//     'username' => 'postgres'
// ];
В этом классе и конфигурации реализована поддержка расширения.
Если в загружаемом конфиге есть ключ extend, то нужно загрузить конфигурацию с этим именем (он соответствует $env).
Далее конфигурации мержатся между собой так, что приоритет имеет загруженный раньше.
Более подробный пример посмотрите в тестах.

*/

<?php

namespace App;

// BEGIN (write your solution here)
class DatabaseConfigLoader
{
    private $path;
    public function __construct($path)
    {
        $this->path = $path;
    }

    public function load($env)
    {
    $filename = "database.{$env}.json";
    $raw = file_get_contents($this->path . '/' . $filename);
    $config = json_decode($raw, true);
    if(isset($config['extend'])) {
        $config2 = $config['extend'];
        unset($config['extend']);
        return array_merge($this->load($config2), $config);
    }
    return $config;
    }
}
// END

________________________________________________________________________________________________________________________

/*
В программировании, для некоторых задач распространены key-value базы данных. Внешне они работают по принципу ассоциативных массивов, но живут как отдельные программы и умеют делать много полезных штук: например, сохранять данные на диск, переносить данные между машинами в сети и тому подобное.

В этой задаче реализована подобная база данных в виде класса FileKV, который сохраняет свои данные на диске в указанном файле. Она имеет следующий интерфейс:

<?php

$map = new FileKV('/path/to/dbfile');
// Получение значения по ключу
$map->get('key'); // key
$map->get('unkonwnkey'); // null
// Получение значения и дефолт
$map->get('unkonwnkey', 'default value'); // default value
// Установка и обновление ключа
$map->set('key2', 'value2');
$map->get('key2'); // value2
// Удаление ключа
$map->unset('key2'); // value2
$map->get('key2'); // null
$map->set('key', 'value'); // null
// Возврат всех данных из базы
$map->toArray(); // ['key' => 'value']
В целях тестирования бывает полезно иметь реализацию такой базы данных, которая хранит данные в памяти, а не во внешнем хранилище. Это позволяет легко сбрасывать состояние между тестами и не замедлять их.

src/InMemoryKV.php
Реализуйте класс InMemoryKV, который представляет собой in-memory key-value хранилище. Данные внутри него хранятся в обычном ассоциативном массиве. Интерфейс этого класса совпадает с FileKV за исключением конструктора. Конструктор InMemoryKV принимает на вход массив, который становится начальным значением базы данных.

<?php

use App\InMemoryKV;

$map = new InMemoryKV(['key' => 10]);
$map->get('key'); // 10
src/KeyValueFunctions.php
Реализуйте функцию swapKeyValue(), которая принимает на вход объект базы данных и меняет в нём ключи и значения местами.

swapKeyValue — полиморфная функция, она может работать с любой реализацией key-value, имеющей такой же интерфейс.

<?php

$map = new \App\InMemoryKV(['key' => 10]);
$map->set('key2', 'value2');
swapKeyValue($map);
$map->get('key'); // null
$map->get(10); // key
$map->get('value2'); // key2

*/

src/InMemoryKV.php



namespace App;

// BEGIN (write your solution here)
class InMemoryKV
{
        private $map;

    public function __construct($initial = [])
    {
        $this->map = $initial;
    }

    public function set($key, $value)
    {
        $this->map[$key] = $value;
    }

    public function unset($key)
    {
        unset($this->map[$key]);
    }

    public function get($key, $default = null)
    {
        return $this->map[$key] ?? $default;
    }

    public function toArray()
    {
        return $this->map;
    }
}
// END

src/KeyValueFunctions.php


namespace App\KeyValueFunctions;

// BEGIN (write your solution here)
function swapKeyValue($map)
{
    $data = $map->toArray();
    array_walk($data, fn($value, $key) => $map->unset($key));
    array_walk($data, fn($value, $key) => $map->set($value, $key));
}
// END

________________________________________________________________________________________________________________________

________________________________________________________________________________________________________________________

/*
На Хекслете доступ к курсам оформляется через подписку. Подписка - это отдельная сущность, которая хранит в себе информацию о самой подписке: когда она началась, сколько продолжается, оплачена ли и так далее. Типичная проверка на наличие подписки (а значит доступ к платному контенту) выглядит так:

<?php

// Эти примеры сильно упрощены, к тому же Хекслет написан на Rails
// но для демонстрации идеи такая реализация подойдет
$user->getCurrentSubscription()->hasPremiumAccess();
$user->getCurrentSubscription()->hasProfessionalAccess();
Но не у всех пользователей есть подписка, на Хекслете есть и большая бесплатная часть. Так как подписка может отсутствовать, в коде придется делать так:

<?php

if ($user->getCurrentSubscription() && $user->getCurrentSubscription()->hasPremiumAccess()) {
   // есть преимум доступ, показываем что-то особенное
}
Чтобы избежать постоянных проверок на существование подписки, мы внедрили Null Object. Теперь подписка есть всегда и достаточно написать:

<?php

if ($user->getCurrentSubscription()->hasProfessionalAccess()) {
   // есть профессиональный доступ, показываем что-то особенное
}
src/FakeSubscription.php
Реализуйте класс FakeSubscription, который повторяет интерфейс класса Subscription за исключением конструктора. В конструктор FakeSubscription принимает пользователя. Если пользователь администратор $user->isAdmin(), то все доступы разрешены, если нет – то запрещены.

src/User.php
Допишите конструктор пользователя, так, чтобы внутри устанавливалась реальная подписка если она передана снаружи и создавалась фейковая в ином случае.

Примеры:
<?php

use App\Subscription;
use App\User;

$user = new User('vasya@email.com', new Subscription('premium'));
$user->getCurrentSubscription()->hasPremiumAccess(); // true
$user->getCurrentSubscription()->hasProfessionalAccess(); // false

$user = new User('vasya@email.com', new Subscription('professional'));
$user->getCurrentSubscription()->hasPremiumAccess(); // false
$user->getCurrentSubscription()->hasProfessionalAccess(); // true

// Внутри создается фейковая, потому что подписка не передается
$user = new User('vasya@email.com');
$user->getCurrentSubscription()->hasPremiumAccess(); // false
$user->getCurrentSubscription()->hasProfessionalAccess(); // false

$user = new User('rakhim@hexlet.io'); // администратор, проверяется по емейлу
$user->getCurrentSubscription()->hasPremiumAccess(); // true
$user->getCurrentSubscription()->hasProfessionalAccess(); // true

*/

src/FakeSubscription.php



namespace App;

// BEGIN (write your solution here)
class FakeSubscription
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function hasProfessionalAccess()
    {
        return $this->user->isAdmin();
    }

    public function hasPremiumAccess()
    {
        return $this->user->isAdmin();
    }
}
// END

src/User.php



namespace App;

// BEGIN (write your solution here)
class FakeSubscription
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function hasProfessionalAccess()
    {
        return $this->user->isAdmin();
    }

    public function hasPremiumAccess()
    {
        return $this->user->isAdmin();
    }
}
// END
________________________________________________________________________________________________________________________

/*
src/Helpers.php
Реализуйте функцию getGreeting($user), которая возвращает приветствие для пользователя. Это приветствие показывается пользователю на сайте. Если пользователь гость, то выводится "Nice to meet you Guest!", если не гость, то "Hello <Имя>!", где "<Имя>" это имя реального пользователя.

В этой задаче, способ решения остается на ваше усмотрение. Используйте знания полученные в этом курсе.

<?php

$guest = new \App\Guest();
getGreeting($guest); // 'Nice to meet you Guest!'

$user = new \App\User('Petr');
getGreeting($user); // 'Hello Petr!'


*/

Helpers.php


namespace App\Helpers;

// BEGIN (write your solution here)
function getGreeting($user)
{
    if ($user->isUser()) {
      return("Hello {$user->getName()}!");
    } elseif ($user->isGuest()) {
      return('Nice to meet you Guest!');
    }
}
// END

Guest.php



namespace App;

class Guest
{
    public function getName()
    {
        return 'Guest';
    }

    // BEGIN (write your solution here)
    public function isUser()
    {
        return false;
    }

    public function isGuest()
    {
        return true;
    }
    // END
}

User.php



namespace App;

class User
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    // BEGIN (write your solution here)
    public function isUser()
    {
        return true;
    }

    public function isGuest()
    {
        return false;
    }
    // END
}

_______________________________________________________________________________________________________________________


/*
Создайте полноценное консольное приложение, которое показывает текущую погоду в городе. Оно работает так:

$ php bin/weather.php berlin
Temperature in berlin: 26C
Это консольное приложение обращается внутри себя к сервису погоды. Сервис погоды расположен на localhost:8080. Информацию по городу можно извлечь сделав GET запрос на урл /api/v2/cities/<имя города>. Данные от сервиса возвращаются в виде json: { "name": "<имя города>", temperature: "<температура>" }.

src\WeatherService.php
Реализуйте логику работы сервиса. Сделайте так, чтобы http-клиент не был зашит внутри класса, используйте инъекцию зависимостей для проброса клиента во внутрь.

То как выполнять http-запросы через guzzle можно подсмотреть в его документации.

bin/weather.php
Реализуйте код, вызывающий сервис и печатающий на экран ожидаемую строку. Для извлечения города из аргументов командной строки, воспользуйтесь массивом $argv. Первый аргумент (передаваемое имя города) находится под индексом 1.


*/

src\WeatherService.php



require '/composer/vendor/autoload.php';

use App\WeatherService;

// BEGIN (write your solution here)
$weather = new WeatherService(new \GuzzleHttp\Client());
$data = $weather->lookup($argv[1]);
echo "Temperature in {$data['name']}: {$data['temperature']}C";
// END

bin/weather.php


namespace App;

// BEGIN (write your solution here)
class WeatherService
{
    private const API_URL = 'http://localhost:8080/api/v2';

    private $httpClient;

    public function __construct($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function lookup($cityName)
    {
        $url = implode('/', [self::API_URL, "cities/{$cityName}"]);
        $response = $this->httpClient->get($url);
        return json_decode($response->getBody(), true);
    }
}
// END
_______________________________________________________________________________________________________________________


/*
В этом задании используется класс InMemoryKV, с которым вы недавно работали. Теперь мы добавим ему интерфейс и дополнительно реализуем сериализацию.

src/KeyValueStorageInterface.php
Реализуйте интерфейс KeyValueStorageInterface, который расширяет интерфейс \Serializable и имеет следующие методы:

set($key, $value);
get($key, $default = null);
unset($key);
toArray();
src/InMemoryKV.php
Реализуйте в классе InMemoryKV интерфейс \Serializable, который встроен в PHP. Этот интерфейс позволяет применять к объектам методы serialize и unserialize.

Функция serialize позволяет представить объект строкой и сохранить его куда-нибудь в файловую систему или передать по сети. Функция unserialize выполняет обратную операцию и восстанавливает сериализованный объект.

Для сериализации используйте json_encode, для десериализации json_decode.

*/

src/KeyValueStorageInterface.php



namespace App;

// BEGIN (write your solution here)
interface KeyValueStorageInterface extends \Serializable
{
    public function set($key, $value);
    public function get($key, $default = null);
    public function unset($key);
    public function toArray();
}
// END

src/InMemoryKV.php



namespace App;

class InMemoryKV implements KeyValueStorageInterface
{
    private $map;

    public function __construct($initial = [])
    {
        $this->map = $initial;
    }

    public function set($key, $value)
    {
        $this->map[$key] = $value;
    }

    public function unset($key)
    {
        unset($this->map[$key]);
    }

    public function get($key, $default = null)
    {
        return $this->map[$key] ?? $default;
    }

    public function toArray()
    {
        return $this->map;
    }

    public function __serialize()
    {
    }
    public function __unserialize($data)
    {
    }

    // BEGIN (write your solution here)
    public function serialize()
    {
        return json_encode($this->map);
    }

    public function unserialize($data)
    {
    $this->map = json_decode($data, true);
    }
    // END
}
_______________________________________________________________________________________________________________________

/*
TicTacToe – известная игра в крестики нолики, на поле 3x3. В этом задании, вам предстоит реализовать данную игру. Основной движок игры находится в файле TicTacToe.php. В директории strategies находится код, который отвечает за поведение AI (искусственный интелект!). В зависимости от выбранного уровня игры, включается либо Easy стратегия, либо Normal.

Задание специально построено так, чтобы предоставить вам максимальную свободу в организации кода. Результат будет хорошей лакмусовой бумажкой, по которой можно оценить насколько архитектурная тема была понята.

src/TicTacToe.php
Реализуйте класс TicTacToe, который представляет собой игру крестики-нолики. Принцип его работы описан в коде ниже:

<?php

// По умолчанию выбран easy уровень. Его можно изменить, передав в конструктор строку 'normal'
$game = new TicTacToe();
// Если переданы аргументы, то ходит игрок. Первый аргумент – строка, второй – столбец.
$game->go(2, 2);
// Ход компьютера
$game->go();
$game->go(1, 2);
$game->go();
// Метод go возвращает true, если текущий ход победный и false в ином случае
$isWinner = $game->go(3, 2); // true
src/strategies/Easy.php
Реализуйте стратегию, которая пытается заполнить поля, пробегаясь построчно сверху вниз и слева направо. Как только она встречает свободное поле, то вставляет туда значение.

src/strategies/Normal.php
Реализуйте стратегию, которая пытается заполнить поля, пробегаясь построчно снизу вверх и слева направо. Как только она встречает свободное поле, то вставляет туда значение.

*/

src/TicTacToe.php



namespace App;

class TicTacToe
{
    // BEGIN (write your solution here)
      private $strategy;
    private $map;

    // implementation without inversion of control
    public function __construct($level = 'easy')
    {
        switch ($level) {
            case 'easy':
                $this->strategy = new strategies\Easy();
                break;
            case 'normal':
                $this->strategy = new strategies\Normal();
                break;
        }
        $this->map = [
            1 => array_fill(1, 3, null),
            2 => array_fill(1, 3, null),
            3 => array_fill(1, 3, null)
        ];
    }

    public function go($row = null, $col = null)
    {
        if ($row === null || $col === null) {
            [$autoRow, $autoCol] = $this->strategy->getNextStep($this->map);
            $this->map[$autoRow][$autoCol] = 'AI';
            return $this->isWinner('AI');
        }
        $this->map[$row][$col] = 'Player';
            return $this->isWinner('Player');
    }

    private function isWinner($type)
    {
        foreach ($this->map as $row) {
            if ($this->populatedByOnePlayer($row, $type)) {
                return true;
            }
        }

        for ($i = 1; $i <= 3; $i++) {
            if ($this->populatedByOnePlayer(array_column($this->map, $i), $type)) {
                return true;
            }
        }

        $diagonal1 = [$this->map[1][1], $this->map[2][2], $this->map[3][3]];
        if ($this->populatedByOnePlayer($diagonal1, $type)) {
            return true;
        }

        $diagonal2 = [$this->map[3][1], $this->map[2][2], $this->map[1][3]];
        if ($this->populatedByOnePlayer($diagonal2, $type)) {
            return true;
        }

        return false;
    }

    private function populatedByOnePlayer($row, $type)
    {
        foreach ($row as $value) {
            if ($value !== $type) {
                return false;
            }
        }
        return true;
    }
    // END
}

src/strategies/Easy.php



namespace App\strategies;

class Easy
{
    // BEGIN (write your solution here)
        public function getNextStep($map)
    {
        foreach ($map as $i => $row) {
            foreach ($row as $j => $value) {
                if ($value === null) {
                    return [$i, $j];
                }
            }
        }
    }
    // END
}

src/strategies/Normal.php



namespace App\strategies;

class Normal
{
    // BEGIN (write your solution here)
    public function getNextStep($map)
    {
        for ($i = 3; $i >= 1; $i--) {
            foreach ($map[$i] as $j => $value) {
                if ($value === null) {
                    return [$i, $j];
                }
            }
        }
    }
    // END
}
_______________________________________________________________________________________________________________________

/*
Эта практика демонстрирует реализацию динамической диспетчеризации без использования классов. Она больше рассчитана на изучение существующего кода, чем на написание нового. Разобравшись в ней, вы поймете что динамическая диспетчеризация может быть реализована практически в любом языке.

Когда речь идет не о полиморфном коде, то абстракции создаются как обычно используя конструкторы и селекторы:

<?php

use App\Circle;
use App\Square;

$circle = Circle\make(5);
echo Circle\getRadius($circle); // 5

$square = Square\make(10);
echo Square\getSide($square); // 10
Если функция должна быть полиморфной, то она создается через специальный (самописный) механизм. Этот механизм описан в файле src/Dispatcher.php и содержит некоторые запрещенные приемы (использование глобальной переменной), которые необходимы для реализации виртуальной таблицы. Будет здорово если вы разберетесь в устройстве этого кода.

В нашем случае добавляется ровно одна полиморфная функция getArea. Сначала посмотрим как этот код работает:

<?php

use App\Figure; // Специальный неймспейс, который содержит полиморфную функцию
use App\Circle;
use App\Square;

// Инициализация полиморфных методов
Circle\init();
Square\init();

$circle = Circle\make(5);
$square = Square\make(5);
// Вызов полиморфной функции. В зависимости от типа она идет либо в Circle либо в Square
Figure\getArea($circle); // ~ 78.5
Figure\getArea($square); // 25
Теперь реализация. Первым делом создается специальный неймспейс с полиморфной функцией:

<?php

namespace App\Figure;

use App\Dispatcher;

function getArea($self, ...$args)
{
    return Dispatcher\call($self, __FUNCTION__, $args);
}
Он вызывает диспетчер, который, в свою очередь, выполняет поиск нужной реализации функции в виртуальной таблице и вызывает ее. Для работы диспетчера нужно чтобы любая абстракция была создана с помощью ассоциативного массива, в котором под свойством name хранится тип сущности:


<?php

// src/Circle.php

function make($radius)
{
    return ['name' => __NAMESPACE__, 'data' => ['radius' => $radius]];
}
И последний шаг. Нужно создать реализацию функции именно для нашей текущей абстракции. Она делается в функции init:

<?php

function init()
{
    Dispatcher\defmethod(__NAMESPACE__, 'getArea', function ($self) {
        return pi() * $self['data']['radius'] ** 2;
    });
}
В этом месте происходит добавление функции конкретной абстракции (Circle) в виртуальную таблицу

src/Square.php
Реализуйте абстракцию Square опираясь на Circle. Эта абстракция должна содержать следующие функции:

Конструктор, который принимает на вход длину стороны
Селектор getSide, который возвращает сторону
Полиморфную функцию getArea, которая возвращает площадь квадрата
<?php

use App\Figure;
use App\Square;

Square\init();

$square = Square\make(2);
Square\getSide($square); // 2
Figure\getArea($square); // 4


*/

src/KeyValueStorageInterface.php



namespace App;

// BEGIN (write your solution here)
interface KeyValueStorageInterface extends \Serializable
{
    public function set($key, $value);
    public function get($key, $default = null);
    public function unset($key);
    public function toArray();
}
// END



namespace App\Square;

use App\Dispatcher;

// BEGIN (write your solution here)
function init()
{
    Dispatcher\defmethod(__NAMESPACE__, 'getArea', function ($self) {
        return $self['data']['side'] ** 2;
    });
}

function make($side)
{
    return ['name' => __NAMESPACE__, 'data' => ['side' => $side]];
}

function getSIde($self)
{
    return $self['data']['side'];
}
// END
_______________________________________________________________________________________________________________________


_______________________________________________________________________________________________________________________

/*
src/ConfigFactory.php
Создайте фабрику, которая принимает на вход путь до файла конфигурации в формате либо json либо yaml и возвращает объект класса Config. Конструктор класса Config принимает на вход массив с данными, полученными из конфигурационных файлов и предоставляет к нему объектный доступ.

<?php

$config = ConfigFactory::build(__DIR__ . '/fixtures/test.yml');
$config->key; // value
print_r(get_class($config)); // Config

$config = ConfigFactory::build(__DIR__ . '/fixtures/test2.yaml');
$config->key; // another value
print_r(get_class($config)); // Config

$config2 = ConfigFactory::build(__DIR__ . '/fixtures/test.json');
$config2->key; // something else
Учтите что файлы формата YAML могут иметь разные расширения: yaml и yml. Фабрика должна работать с обоими.

src/parsers/JsonParser.php
Реализуйте класс, отвечающий за парсинг json. Используйте внутри json_decode, в котором второй параметр true.

src/parsers/YamlParser.php
Реализуйте класс, отвечающий за парсинг yaml. Для парсинга используется сторонний компонент со следующим интерфейсом:

<?php

Yaml::parse($data);



*/

src/ConfigFactory.php



namespace App;

// BEGIN (write your solution here)
class ConfigFactory
{
    public static function build($filepath)
    {
        $mapping = [
            'yaml' => parsers\YamlParser::class,
            'yml' => parsers\YamlParser::class,
            'json' => parsers\JsonParser::class,
        ];
        $fileInfo = new \SplFileInfo($filepath);

        $parserClass = $mapping[$fileInfo->getExtension()];
        $parser = new $parserClass();
        $rawData = file_get_contents($fileInfo->getPathname());
        $data = $parser->parse($rawData);
        return new Config($data);
    }
}
// END


src/parsers/JsonParser.php



namespace App\parsers;

// BEGIN (write your solution here)
class JsonParser
{
    public function parse($file)
    {
        return json_decode($file, true);
    }
}
// END

src/parsers/YamlParser.php



namespace App\parsers;

use Symfony\Component\Yaml\Yaml;

// BEGIN (write your solution here)
class YamlParser
{
    public function parse($file)
    {
        return Yaml::parse($file);
    }
}

// END
_______________________________________________________________________________________________________________________

/*
В задании описан интерфейс TagInterface. Каждый класс, реализующий этот интерфейс, представляет из себя тег HTML. Метод render(), позволяет получить текстовое представление тега:

<?php

$tag = new InputTag('submit', 'Save');
$tag->render(); // <input type="submit" value="Save">
Предположим, что эта система нужна для генерации разных кусков верстки, которая может быть очень разнообразной. Попробуйте ответить на вопрос, сколько понадобится классов для представления всех возможных комбинаций тегов?

Если создавать по классу на каждый возможный вариант верстки, то классов будет бесконечно много и смысла в такой реализации очень мало. Но вместо этого лучше использовать композицию. Создать класс для каждого индивидуального тега (в html5 их около 100 штук), а затем путем комбинирования получить все возможные варианты верстки.

src/LabelTag.php
Реализуйте класс LabelTag, который реализует интерфейс TagInterface и умеет оборачивать другие теги:

<?php

$inputTag = new InputTag('submit', 'Save');
$labelTag = new LabelTag('Press Submit', $inputTag);
$labelTag->render();
// '<label>Press Submit<input type="submit" value="Save"></label>'

*/



namespace App\tags;

// BEGIN (write your solution here)

class LabelTag implements TagInterface
{
    private $text;
    private $inputTag;

    public function __construct($text, $inputTag)
    {
        $this->text = $text;
        $this->inputTag = $inputTag;
    }

    public function render()
    {
        return "<label>{$this->text}{$this->inputTag}</label>";
    }

    public function __toString()
    {
        return $this->render();
    }
}
// END
_______________________________________________________________________________________________________________________


/*
Адаптер – популярный шаблон проектирования. Он используется тогда, когда нужно использовать код, не поддерживающий необходимый интерфейс. В такой ситуации, создается "обертка" над необходимым кодом, которая поддерживает нужный интерфейс. Это очень похоже на адаптеры электронных устройств в реальной жизни.

В текущем задании, есть код отвечающий за генерацию паролей, он находится в классе PasswordBuilder. Для генерации паролей, этот класс использует внешний объект, класс которого реализует интерфейс PasswordGeneratorInterface.

Суть данного задания, внедрить в эту систему внешнюю библиотеку, которая не поддерживает интерфейс PasswordGeneratorInterface.

Обратите внимание на то, что задача решается не через исправление кода самой библиотеки, а за счет создания адаптера, благодаря которому соединяется код задания и код библиотеки.

src/HackzillaPasswordGeneratorAdapter.php
Напишите класс HackzillaPasswordGeneratorAdapter, который представляет собой адаптер к пакету hackzilla/password-generator. Реализуйте внутри него интерфейс PasswordGeneratorInterface.

Примеры:
<?php

$builder = new PasswordBuilder(new HackzillaPasswordGeneratorAdapter());
// Первый параметр — длина пароля (setLength в генераторе)

// Второй — набор опций
// Для настройки генератора смотрите официальную документацию https://github.com/hackzilla/password-generator

$passwordInfo = $builder->buildPassword(10, ['upperCase', 'symbols']);
// (
//    [password] => Pjz+(/gn/T
//    [digest] => dd1ae3051044c9edc2b32191a4ad39be076eddd7
// )

$passwordInfo2 = $builder->buildPassword(10, []);
// (
//    [password] => pvtetwmdcf
//    [digest] => ae334a6cbfb40ba57832fa8ac55a95b77923a0d9
// )
Вторым параметром в buildPassword передается набор опций:

upperCase
numbers
symbols
Каждая из этих опций, соответствует опциям внутри библиотеки hackzilla/password-generation. В официальной документации видно как их можно установить. Значение по умолчанию для данных опций, должно быть false.

*/



namespace App;

use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;

class HackzillaPasswordGeneratorAdapter implements PasswordGeneratorInterface
{
    // BEGIN (write your solution here)
   private $options = [
        'upperCase' => ComputerPasswordGenerator::OPTION_UPPER_CASE,
        'numbers' => ComputerPasswordGenerator::OPTION_NUMBERS,
        'symbols' => ComputerPasswordGenerator::OPTION_SYMBOLS
    ];

    public function generatePassword($length, $options)
    {
        $generator = new ComputerPasswordGenerator();
        $generator->setLength($length);
        foreach ($this->options as $optionName => $optionValue) {
            $value = in_array($optionName, $options);
            $generator->setOptionValue($optionValue, $value);
        }
        return $generator->generatePassword();
    }
    // END
}
_______________________________________________________________________________________________________________________


/*
HTTP – протокол без состояния, то есть после запроса получается ответ и на этом все заканчивается. Не все протоколы так работают. Например, TCP устроен значительно сложнее. Сначала происходит соединение, затем обмен данными. В конце выполняется разрыв соединения. Примерно так же работают вебсокеты. Для имитации процесса соединения-разъединения поведения в ООП, создают объект, хранящий внутри себя состояние.

В этом задании TcpConnection не настоящий. Он эмулирует то поведение, которого достаточно для отработки паттерна Состояние, все остальное убрано чтобы не отвлекать от идей ООП.

Объект соединения ведет себя по-разному, в зависимости от того установлено соединение или нет. Например если попробовать отправить данные когда соединения нет, то он возбуждает исключение. То же самое касается попытки установить соединение в той ситуации когда оно уже установлено.

Примеры
<?php

$connection = new TcpConnection('132.223.243.88', 2342);
$connection->connect()
$connection->getCurrentState(); // connected
$connection->write('data');
$connection->disconnect();
$connection->getCurrentState(); // disconnected
$connection->disconnect(); // Boom!
src/TcpConnection.php
Реализуйте класс TcpConnection оглядываясь на интерфейс TcpConnectionInterface. Все варианты поведения можно увидеть в тестах.

Для изменения состояния вам понадобится дополнительная логика. Реализуйте ее по своему усмотрению.

src/states/Connected.php src/states/Disconnected.php
Реализуйте классы состояний, так как считаете нужным.

*/

src/TcpConnection.php



namespace App;

class TcpConnection implements TcpConnectionInterface
{
    private $ip;
    private $port;
    private $state;

    // BEGIN (write your solution here)
    public function __construct($ip, $port)
    {
        $this->ip = $ip;
        $this->port = $port;
        $this->setState(states\Disconnected::class);
    }
    public function getCurrentState()
    {
        return $this->state->getName();
    }

    public function connect()
    {
        $this->state->connect();
    }
    public function disconnect()
    {
        $this->state->disconnect();
    }
    public function write($data)
    {
        $this->state->write($data);
    }
    public function setState(string $stateClassName)
    {
        $this->state = new $stateClassName($this);
    }
    // END
}


src/states/Connected.php src/states/Disconnected.php



namespace App\states;

class Disconnected
{
    // BEGIN (write your solution here)
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getName()
    {
        return 'disconnected';
    }

    public function connect()
    {
        $this->connection->setState(Connected::class);
    }

    public function disconnect()
    {
        throw new \Exception('Connection already disconnected');
    }

    public function write($data)
    {
        throw new \Exception('It is not possible write to closed connection');
    }

    // END
}



namespace App\states;

class Connected
{
    // BEGIN (write your solution here)
    private $buffer;
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function connect()
    {
        throw new \Exception('Connection has established already');
    }

    public function disconnect()
    {
        $this->connection->setState(Disconnected::class);
    }

    public function write($data)
    {
        $this->buffer[] = $data;
    }

    public function getName()
    {
        return 'connected';
    }
    // END
}
_______________________________________________________________________________________________________________________




/*
В этом упражнении мы попробуем воспользоваться библиотекой PHP-DI для сборки приложения.

В самом приложении есть три сущности:

Класс Application. Представим что это и есть само приложение. Через конструктор он принимает логгер (обязательно посмотрите на определение конструктора). Метод run() запускает приложение на выполнение. Для простоты, внутри метода run() логгируется фраза The application has been started!. Именно ее ожидают увидеть тесты.
LoggerInterface интерфейс с одним методом info($message)
Logger – конкретный логгер, реализующий интерфейс LoggerInterface
Приложение можно собрать и запустить на выполнение так:

<?php

$app = new Application(new Logger());
$app->run();
Это ручной способ, который отлично работает пока кода мало, и становится тяжелым, когда количество объектов превысит десятки. Ваша задача состоит в том, чтобы собрать приложение с помощью библиотеки PHP-DI. Результатом сборки станет ровно тоже приложение что и в примере выше, но сам процесс компоновки выполнится с помощью контейнера. Для реализации этого кода, вам потребуется провести немного времени в документации.

Что потребуется:

Контейнер – это объект класса \DI\Container
Контейнер нужно заполнить классами. Для этого используется метод set
При добавлении классов в контейнер, используйте функцию \DI\autowire
Для извлечения готового приложения из контейнера, понадобится метод get
Пример работы DI:

<?php

// Класс приложения
class Application {
    public function __construct(DatabaseInterface $db) {
        // some code
    }

    // some methods
}

class Postgresql implements DatabaseInterface {
    // some methods
}

$container = new \DI\Container();
// Первый параметр - интерфейс, второй - конкретная реализация, которую надо использовать
$container->set(DatabaseInterface::class, \Di\autowire(Postgresql::class));
// get запускает процесс сборки приложения. Контейнер анализирует зависимости на основании сигнатур функций (см. конструктор в Application)
// и создает необходимые объекты. Процесс формирования приложения выглядит как сборка матрешки.
$app = $container->get(Application::class);
src/Main.php
Реализуйте функцию buildApplication(), которая собирает приложение и возвращает его наружу.
*/

<?php

namespace App\Main;

use App\Logger;
use App\Application;
use App\LoggerInterface;

function buildApplication()
{
    // BEGIN (write your solution here)
    $container = new \DI\Container();
    $container->set(LoggerInterface::class, \Di\autowire(Logger::class));
    $app = $container->get(Application::class);
    return $app;
    // END
}
_______________________________________________________________________________________________________________________