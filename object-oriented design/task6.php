

/*
Реализуйте класс DeckOfCards, который описывает колоду карт и умеет её мешать.

Конструктор класса принимает на вход массив, в котором перечислены номиналы карт в единственном экземпляре, например, [6, 7, 8, 9, 10, 'king'].

Реализуйте публичный метод getShuffled(), с помощью которого можно получить полную колоду в виде отсортированного случайным образом массива.

Примеры
<?php

$deck = new DeckOfCards([2, 3]);
$deck->getShuffled(); // [2, 3, 3, 3, 2, 3, 2, 2]
$deck->getShuffled(); // [3, 3, 2, 2, 2, 3, 3, 2]
Примечания
В "полной" колоде каждая карта встречается 4 раза — для простоты не учитываем масть.
Подсказки
Используйте функцию collect() для оборачивания массивов
Документация по доступным функциям https://laravel.com/docs/9.x/collections
*/

//Решение 1:

<?php

namespace App;

class DeckOfCards
{
    private $cards;

    public function __construct($cards)
    {
        $this->cards = $cards;
    }
    public function getShuffled()
    {
        $deckCards = [];
        foreach ($this->cards as $card) {
            $deckCards[] = $card;
            $deckCards[] = $card;
            $deckCards[] = $card;
            $deckCards[] = $card;
        }
        $collection = collect($deckCards);
        $shuffled = $collection->shuffle();
        return $shuffled->all();
    }
}

//Решение 2:



namespace App;

class DeckOfCards
{
    private $cards;

    public function __construct(array $types)
    {
        $this->cards = collect($types)
        ->map(function($card) {
            return array_fill(0, 4, $card);
        })
        ->flatten();
    }

    public function getShuffled() :array
    {
        return $this->cards->shuffle()->all();
    }
}