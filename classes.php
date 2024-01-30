

/*
src/HTMLHrElement.php
Реализуйте класс HTMLHrElement (наследуется от HTMLElement), который отвечает за представление тега <hr>. Внутри класса определите функцию __toString(), которая возвращает текстовое представление тега.

<?php

$hr = new HTMLHrElement();
echo $hr; // <hr>

$hr = new HTMLHrElement(['class' => 'w-75', 'id' => 'wop']);
echo $hr; // '<hr class="w-75" id="wop">';
src/HTMLElement.php
Реализуйте метод stringifyAttributes(), который формирует строчку для аттрибутов. Используйте этот метод в наследнике для формирования тега.
*/

src/HTMLHrElement.php



namespace App;

// BEGIN (write your solution here)
class HTMLHrElement extends HTMLElement
{
    public function __toString()
    {
        $attrLine = $this->stringifyAttributes();
        return "<hr{$attrLine}>";
    }
}
// END

src/HTMLElement.php

namespace App;

class HTMLElement
{
    private $attributes = [];

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    protected function stringifyAttributes()
    {
        // BEGIN (write your solution here)
        return collect($this->attributes)
        ->map(fn($value, $key) => " {$key}=\"{$value}\"")
        ->join('');
        // END
    }
}
________________________________________________________________________________________________________________________



/*
Реализуйте набор методов для работы с классами:

addClass($className) – добавляет класс
removeClass($className) – удаляет класс
toggleClass($className) – ставит класс если его не было и убирает если он был
Эти методы должны обрабатывать свойство 'class' (внутри строка) массива $this->attributes. В процессе реализации вам понадобится постоянно преобразовывать строку классов в массив и обратно. Вынесите эту операцию в отдельные функции и установите им правильный модификатор доступа.

<?php

$div = new HTMLDivElement(['class' => 'one two']);
$div->getAttribute('class'); // 'one two'

$div->addClass('small');
$div->getAttribute('class'); // 'one two small'

$div->addClass('small');
$div->getAttribute('class'); // 'one two small'

$div->removeClass('two');
$div->getAttribute('class'); // 'one small'

$div->toggleClass('small');
$div->getAttribute('class'); // 'one'

$div->toggleClass('small');
$div->getAttribute('class'); // 'one small'
*/

<?php

namespace App;

class HTMLElement
{
    private $attributes = [];

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function getAttribute($key)
    {
        return $this->attributes[$key];
    }

    public function addClass($className)
    {
        $array = $this->classesArrays();
        if(!in_array($className, $array)) {
            $array[] = $className;
        }
        $this->attributes['class'] = $this->classesStringify($array);
    }

    public function removeClass($className)
    {
        $array =  $this->classesArrays();
        $array = array_diff($array, array($className));
        $this->attributes['class'] = $this->classesStringify($array);
    }

    public function toggleClass($className)
    {
        $array = $this->classesArrays();
        if(!in_array($className, $array)) {
            $this->addClass($className);
            return;
        } else {
            $array = array_diff($array, array($className));
        }
        $this->attributes['class'] = $this->classesStringify($array);
    }

    private function classesArrays()
    {
        return explode(' ', $this->getAttribute('class'));
    }

    private function classesStringify($array)
    {
        return implode(' ', $array);
    }

    // END
}
________________________________________________________________________________________________________________________

/*
Реализуйте метод isInstanceOf($className), который проверяет что объект принадлежит одному из классов в цепочке наследования.

<?php

// ChildOfChild extends FirstChild extends Base

$obj = new \App\ChildOfChild();
$obj->isInstanceOf('App\Base'); // true
$obj->isInstanceOf('Base'); // false
$obj->isInstanceOf('App\Base'); // true
$obj->isInstanceOf('App\FirstChild'); // true
$obj->isInstanceOf('SomeClass'); // false
*/

<?php

namespace App;

class Base
{
    // BEGIN (write your solution here)

    public function isInstanceOf($className)
    {
    //    return is_a($this, $className, true);

        $classes = class_parents($this);
        $currentClass = get_class($this);
        $classes[$currentClass] = $currentClass;
        return in_array($className, $classes);
    }
    // END
}
________________________________________________________________________________________________________________________

/*
src\HTMLPairElement.php
Реализуйте класс HTMLPairElement (наследуется от HTMLElement), который отвечает за генерацию представления парных элементов и работу с телом. Реализуйте следующий интерфейс:

<?php
public function __toString();
public function getTextContent();
public function setTextContent(string $body);
src\HTMLDivElement.php
Реализуйте класс HTMLDivElement, который описывает собой парный тег <div>.

<?php

$div = new HTMLDivElement(['name' => 'div', 'data-toggle' => 'true']);
$div->setTextContent('Body');
echo $div; // '<div name="div" data-toggle="true">Body</div>'
*/

src\HTMLPairElement.php



namespace App;

// BEGIN (write your solution here)
class HTMLPairElement extends HTMLElement
{
    public $body;
    public function __toString()
    {
        $attrLine = $this->stringifyAttributes();
        $body = $this->getTextContent();
        $tagName = $this->getTagName();
        return "<{$tagName}{$attrLine}>{$body}</{$tagName}>";
    }

    public function getTextContent()
    {
        return $this->body;
    }

    public function setTextContent(string $body)
    {
        $this->body = $body;
    }
}
// END

src\HTMLDivElement.php



namespace App;

// BEGIN (write your solution here)
class HTMLDivElement extends HTMLPairElement
{
    public function getTagName()
    {
        return 'div';
    }
}
// END
________________________________________________________________________________________________________________________


/*
В стандартной библиотеке PHP есть класс SplFileInfo. Объекты этого класса описывают собой файлы. С их помощью можно получать любую метаинформацию о файле.

<?php

$file = new SplFileInfo('/etc/hosts');
echo $file->getSize();
src\SmartSplFileInfo.php
Реализуйте класс SmartSplFileInfo наследующийся от SplFileInfo. Этот класс должен расширять поведение метода getSize. В новом классе этот метод принимает на вход аргумент, который обозначает единицу измерения возвращаемых данных. По умолчанию это B, то есть байты. Но можно передать и b, то есть биты. В случае битов, переопределённый метод умножает байты на 8 и получившееся значение возвращает наружу.

Метод должен обрабатывать ситуацию, когда на вход поступает что-то другое, кроме указанных значений. Обработка сводится к возбуждению исключения Exception.

<?php

$file = new SmartSplFileInfo(__DIR__ . '/../Makefile');
$file->getSize();
$file->getSize('B');
$file->getSize('b');
*/

<?php

namespace App;

// BEGIN (write your solution here)
class SmartSplFileInfo extends \SplFileInfo
{
    public function getSize($unit = 'B')
    {
        if (!($unit == 'b' || $unit == 'B')) {
            throw new \Exception('Exception');
        } elseif ($unit == 'b') {
            return parent::getSize() * 8;
        }
        return parent::getSize();
    }
}
// END
________________________________________________________________________________________________________________________



/*
В этом задании вам придется написать код, который нарушает принцип Лисков. Запомните его и никогда так больше не делайте :D

Представьте себе библиотеку, которая предоставляет абстракции для работы с хранилищами ключ-значение. Все они расширяют интерфейс StorageInterface состоящий из трех методов:

set($key, $value) – устанавливает значение
get($key) – возвращает значение
count() – возвращает количество ключей в хранилище
В директории src три таких хранилища: Redis, InMemory, GoogleStorage. Первые два умеют возвращать число ключей внутри них, а последнее – нет.

Для простоты реализации, каждое хранилище складывает значения во внутренний массив. В реальности, они бы выполняли запросы по сети, но для текущего задания это ненужное усложнение.

src\GoogleStorage.php
Реализуйте интерфейс StorageInterface в классе GoogleStorage.

Так как GoogleStorage не поддерживает подсчет количества элементов, то сделайте так, чтобы этот метод кидал исключение Exception если его вызывают.

<?php

$storage = new GoogleStorage();
$storage->set('one', 'two');
$storage->get('one'); // 'two'
$storage->count(); // Exception

*/

<?php

namespace App;

// BEGIN (write your solution here)
class GoogleStorage implements StorageInterface
{
    private $elements = [];

    public function get($key)
    {
        return $this->elements[$key];
    }

    public function set($key, $value)
    {
        return $this->elements[$key] = $value;
    }

    public function count()
    {
        throw new \Exception('Exception');
    }
}
// END
________________________________________________________________________________________________________________________


/*
src/File.php
Создайте класс File, который представляет собой абстракцию над файлом (упрощенная версия SplFileInfo). Реализуйте в этом классе метод read(). Этот метод проверяет можно ли прочитать файл и если да, то читает его, если нет, то бросает исключения двух видов:

Если файла не существует – App\Exceptions\NotExistsException
Если файл нельзя прочитать (но он существует) – App\Exceptions\NotReadableException
<?php

$file = new File('/etc/fstab');
$file->read();
src/Exceptions/FileException
Реализуйте класс FileException, который наследуется от Exception. Это базовое исключение для данной библиотеки.

src/Exceptions/NotReadableException, src/Exceptions/NotExistsException
Реализуйте классы исключения. Они должны наследоваться от базового класса исключений для данной библиотеки.

Utils
Реализуйте функцию readFiles, которая принимает на вход список файлов и возвращает их содержимое. Если в процессе обработки какого-то файла возникло исключение, то вместо данных этого файла возвращается null.

<?php

$values = Utils\readFiles(['/etc/fstab', '/etc/unknown']);
print_r($value);
// ["какие-то данные", null]

*/

src/File.php



namespace App;

// BEGIN (write your solution here)

class File
{
    protected $filepath;

    public function __construct($filepath)
    {
        $this->filepath = $filepath;
    }

    public function read(): string
    {
        $filepath = $this->filepath;

        if (!file_exists($filepath)) {
            throw new Exceptions\NotExistsException("'$filepath' does not exist");
        }
        if (!is_readable($filepath)) {
            throw new Exceptions\NotReadableException("'$filepath' does not read");
        }

        return file_get_contents($filepath);
    }
}
// END

src/Exceptions/FileException

// BEGIN (write your solution here)
namespace App\Exceptions;
class FileException extends \Exception
{

}
// END

src/Exceptions/NotReadableException, src/Exceptions/NotExistsException



// BEGIN (write your solution here)
namespace App\Exceptions;
class NotReadableException extends FileException
{

}
// END



// BEGIN (write your solution here)
namespace App\Exceptions;
class NotExistsException extends FileException
{

}
// END

Utils



namespace App\Utils;

use App\File;

function readFiles(array $filepaths): array
{
    // BEGIN (write your solution here)
       return collect($filepaths)
        ->map(fn($filepath) => new File($filepath))
        ->map(function ($file) {
            try {
                return $file->read();
            } catch (\App\Exceptions\FileException $e) {
                return null;
            }
        })->all();
    // END
}

// END
________________________________________________________________________________________________________________________



/*
Реализуйте механизм валидации для каждого элемента DOM, который проверяет переданные атрибуты на допустимость.

<?php

$img1 = new HTMLImgElement(['class' => 'rounded', 'src' => 'path/to/image']);
$img1->isValid(); // true

$img2 = new HTMLImgElement(['class' => 'rounded', 'href' => 'path/to/image']);
$img2->isValid(); // false

$button1 = new HTMLButtonElement(['class' => 'rounded', 'type' => 'button']);
$button1->isValid(); // true

$button2 = new HTMLButtonElement(['class' => 'rounded']);
$button2->isValid(); // false
src/HTMLElement.php
Определите абстрактный метод isValid()

src/HTMLImgElement.php
Реализуйте метод isValid, который проверяет соответствие между переданными атрибутами и допустимыми атрибутами.
Для тега Img допустимыми являются: name, class, src. Причём name и class допустимы для любого элемента.
Поэтому информация о них должна находиться в базовом классе.

src/HTMLButtonElement.php
Реализуйте валидацию по аналогии как для тега Img. Для тега Button допустимыми являются: name, class, type.
Причём атрибут type, является обязательным и может принимать одно из доступных значений: button, submit, reset.

*/

src/HTMLElement.php



namespace App;

abstract class HTMLElement
{
    private const ATTRIBUTE_NAMES = ['name', 'class'];

    public $attributes = [];

    public static function getAttributeNames()
    {
        return self::ATTRIBUTE_NAMES;
    }

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    // BEGIN (write your solution here)
    abstract public function isValid();

    // END
}

src/HTMLImgElement.php



namespace App;

class HTMLImgElement extends HTMLElement
{
    private const ATTRIBUTE_NAMES = ['src'];

    public static function getAttributeNames()
    {
        return array_merge(parent::getAttributeNames(), static::ATTRIBUTE_NAMES);
    }

    // BEGIN (write your solution here)
    public function isValid()
    {
        $names = array_keys($this->getAttributes());
        $diff = array_diff($names, $this->getAttributeNames());

        return empty($diff);
    }
    // END
}

src/HTMLButtonElement.php



namespace App;

class HTMLButtonElement extends HTMLElement
{
    private const ATTRIBUTE_NAMES = ['type'];
    private const TYPE_NAMES = ['button', 'submit', 'reset'];

    public static function getAttributeNames()
    {
        return array_merge(parent::getAttributeNames(), static::ATTRIBUTE_NAMES);
    }

    // BEGIN (write your solution here)
    public function isValid()
    {
        $names = array_keys($this->getAttributes());
        $diff = array_diff($names, $this->getAttributeNames());

        return empty($diff)
            && array_key_exists('type', $this->getAttributes())
            && in_array($this->getAttributes()['type'], static::TYPE_NAMES);
    }

    // END
}

// END
________________________________________________________________________________________________________________________


/*
В DOM библиотеке, каждый класс наследник HTMLElement имеет определенный набор атрибутов, которые относятся ко всему типу в целом. Например имя тега, парность и другое. Эта информация хорошо ложится на статические свойства, а использоваться они будут в суперклассе для построения текстового представления тега.

src\HTMLDivElement.php
Создайте класс HTMLDivElement и добавьте в него статическое свойство params с правильными значениями. Пример класса HTMLBrElement:

<?php

class HTMLBrElement extends HTMLElement
{
    protected static $params = [
        'name' => 'br',
        'pair' => false
    ];
}
src\HTMLElement.php
Реализуйте метод __toString(), который возвращает текстовое представление тега. Для этого он использует данные из статического свойства $params определенного в подклассах. Атрибуты в этой практике не предусмотрены. Если у объекта есть тело $this->body, то оно должно устанавливаться между открывающим и закрывающим тегом.

<?php

$element = new HTMLBrElement();
echo $element; // => '<br>'

$element = new HTMLDivElement();
$element->setTextContent('hello!');
echo $element // => '<div>hello!</div>'


*/

src\HTMLDivElement.php



namespace App;

// BEGIN (write your solution here)
class HTMLDivElement extends HTMLElement
{
    protected static $params = [
        'name' => 'div',
        'pair' => true
    ];
}
// END

src\HTMLElement.php



namespace App;

class HTMLElement
{
    private $body;

    public function setTextContent($body)
    {
        $this->body = $body;
    }

    // BEGIN (write your solution here)
    public function __toString()
    {
        $param = static::$params;
        if ($param['pair'] === true && empty($this->body)) {
            return "<{$param['name']}></{$param['name']}>";
        } elseif ($param['pair'] === true && !empty($this->body)) {
            return "<{$param['name']}>{$this->body}</{$param['name']}>";
        } elseif ($param['pair'] === false) {
            return "<{$param['name']}>";
        }
    }

    // END
}
________________________________________________________________________________________________________________________


/*
В программировании часто встречается задача очистки текста от мусора или потенциально опасных частей, например HTML тегов. В PHP для такой очистки подходят функции trim (отрезает концевые пробелы), strip_tags (удаляет теги) и другие.

Представьте себе объектно-ориентированный интерфейс для очистки текста:

<?php

$sanitizer = new Sanitizer();
$sanitizer->sanitize('text   '); // 'text'
$sanitizer->sanitize(' boom '); // 'boom'
Этот санитайзер очень простой. Единственное, что он умеет – удалять концевые пробелы. Представьте, что появилась задача добавить в этот процесс очистку текста от тегов. Эту задачу можно решить несколькими путями:

Через прямое изменение класса санитайзера. Такой способ иногда может сработать, но он не сработает, если это чужая библиотека или она используется где-то, где нужно удалять только концевые пробелы.
Через наследование. Тут все понятно, создаем класс наследник в котором переопределяем метод sanitize. В этом методе делаем strip_tags($text) и передаем результат дальше в родительскую функцию. Результат возвращаем наружу.
Через композицию.
В этом задании нужно реализовать последний вариант. Он сводится к использованию полиморфизма через объект-обертку. Такой подход называется "шаблон проектирования декоратор".

<?php

$baseSanitizer = new Sanitizer();
$sanitizer = new SanitizerStripTagsDecorator($baseSanitizer);
$sanitizer->sanitize('text   '); // 'text'
$sanitizer->sanitize(' boom '); // 'boom'
src\Sanitizer.php
Создайте класс Sanitizer и реализуйте интерфейс SanitizerInterface. Метод sanitize($text) должен отрезать концевые пробелы и возвращать результат наружу.

src\SanitizerStripTagsDecorator.php
Создайте класс (декоратор) SanitizerStripTagsDecorator, который также реализует интерфейс SanitizerInterface.
Он принимает в конструктор исходный санитайзер и дополнительно к его логике, выполняет очистку текста от тегов.
Очистка текста от тегов должна идти раньше чем отрезание концевых пробелов.


*/

src\Sanitizer.php

namespace App;

// BEGIN (write your solution here)
class Sanitizer implements SanitizerInterface
{
    public function sanitize(string $text)
    {
        return trim($text);
    }
}
// END

src\SanitizerStripTagsDecorator.php

namespace App;

// BEGIN (write your solution here)
class SanitizerStripTagsDecorator implements SanitizerInterface
{
    private $sanitizer;

    public function __construct($sanitizer)
    {
        $this->sanitizer = $sanitizer;
    }

    public function sanitize(string $text)
    {
        $strippedText = strip_tags($text);
        return $this->sanitizer->sanitize($strippedText);
    }
}
// END
________________________________________________________________________________________________________________________

/*
Один из самых красивых примеров использования трейтов – Enumerable. Он крайне популярен в языках с поддержкой миксинов (а трейты это разновидность миксинов).

<?php

public function maxBy(callable $fn);
public function sortBy(callable $fn);
public function select(callable $fn);
public function map(callable $fn);
// и еще несколько десятков полезных методов

// Трейт требует от класса реализации функции getIterator.
// Это все что ему нужно для реализации своих методов.
abstract public function getIterator(): iterable;
Представьте себе любой класс, который описывает собой коллекцию элементов.
Как правило этой коллекции требуются разнообразные методы для работы, например сортировка или фильтрация.
До трейтов, эта задача превращалась в бесконечную копипасту кода. Трейты же, позволяют выделить всю необходимую логику в одно место.

<?php

$lessons = [
    // Второй параметр это продолжительность урока в минутах
    new Lesson('react start', 3),
    new Lesson('react component', 9),
    new Lesson('react lifecycle', 2),
    new Lesson('redux', 4),
];

// use Enumerable;
$course = new Course($lessons);
$lesson = $course->maxBy(function ($l1, $l2) {
    return $l1->getDuration() <=> $l2->getDuration();
});

print_r($lesson); // ('react component', 9)
src/Course.php
Подключите трейт Enumerable

src/Enumerable.php
Реализуйте трейт, добавьте в него метод maxBy, работающий по примеру выше.
Этот метод принимает на вход анонимную функцию, которая выполняет сравнение двух элементов коллекции по нужному признаку.
Результатом этой функции будет элемент соответствующий критерию максимальности. Принцип работы такой же как и у usort


*/

src/Course.php

namespace App;

class Course
{
    // BEGIN (write your solution here)

    use Enumerable;

    // END

    private $lessons;

    public function __construct($lessons)
    {
        $this->lessons = $lessons;
    }

    public function getIterator(): iterable
    {
        // Для простоты возвращает массив, вместо итератора
        return $this->lessons;
    }
}

src/Enumerable.php

namespace App;

trait Enumerable
{
    abstract public function getIterator(): iterable;

    // BEGIN (write your solution here)
    public function maxBy(callable $fn)
    {
        $items = $this->getIterator();
        if (empty($items)) {
            return null;
        }
        $result = array_reduce($items, function ($acc, $item) use ($fn) {
             return $fn($acc, $item) >= 0 ? $acc : $item;
        }, $items[0]);
        return $result;

    }
    // END
}

________________________________________________________________________________________________________________________
