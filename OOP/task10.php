

/*
Реализуйте класс Point с публичным статическим свойством table (указывает на таблицу в базе данных, где хранятся экземпляры этого класса) равным 'points'.

*/



<?php

namespace App;

class Point
{
    public static $table = 'points';
}