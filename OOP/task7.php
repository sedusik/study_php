

/*
В задании необходимо реализовать пользователей которым можно добавлять адреса. Такое часто встречается в интернет магазинах, когда у одного пользователя может быть набор разных адресов для доставки. Пользователь и адрес представлены двумя классами:

App\User\Address
App\User
src/User/Address.php
Реализуйте следующие публичные методы:

__construct($country, $city, $street)
getCountry() — возвращает страну.
getCity() — возвращает город.
getStreet() — возвращает улицу.
setCountry($country) — устанавливает страну.
setCity($city) — устанавливает город.
setStreet($street) — устанавливает улицу.
src/User.php
Реализуйте следующие публичные методы:

__construct($name)
addAddress(User\Address $address) — добавляет адрес пользователю.
getAddresses() — возвращает массив адресов пользователя.
getName() — возвращает имя пользователя.
Примеры
Для демонстрации проблемы изменяемости, объекты адресов содержат сеттеры:

<?php

$user = new User('Ivan');
$address = new User\Address('Russia', 'Moscow', 'Lenina');
$user->addAddress($address);

$user2 = new User('Mila');
$user2->addAddress($address);

// Изменение происходит сразу у обоих пользователей
// Такое поведение неожиданно и ломает систему
$address->setCountry('USA');

*/



<?php

namespace App;

class User
{
    private $name;
    private $addresses = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function addAddress(User\Address $address)
    {
        $this->addresses[] = $address;
    }

    public function getAddresses()
    {
        return $this->addresses;
    }
}

namespace App\User;

class Address
{
    private $country;
    private $city;
    private $street;

    public function __construct($country, $city, $street)
    {
        $this->country = $country;
        $this->city = $city;
        $this->street = $street;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function setStreet($street)
    {
        $this->street = $street;
    }
}