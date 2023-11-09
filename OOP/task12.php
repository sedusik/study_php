

/*
Реализуйте класс User, который создает пользователей. Конструктор класса принимает на вход два параметра: идентификатор и имя.

Реализуйте интерфейс ComparableInterface для класса User. Сравнение пользователей происходит на основе их идентификатора.

<?php

$user1 = new User(4, 'tolya');
$user2 = new User(1, 'petya');

$user1->compareTo($user2); // false


*/



<?php

namespace App;

interface ComparableInterface
{
    public function compareTo($user2);
}

namespace App;

use App\ComparableInterface;

class User implements ComparableInterface
{
    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function compareTo($user2)
    {
        return ($this->getId() === $user2->getId());
    }
}