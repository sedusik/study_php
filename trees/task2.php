

/*

src/generator.php
Реализуйте функцию generator(), которая создает такую файловую систему:

# Обратите внимание на метаданные

php-package # директория (метаданные: ['hidden' => true])
├── Makefile # файл
├── README.md # файл
├── dist # пустая директория
├── tests # директория
│   └── test.php # файл (метаданные: ['type' => 'text/php'])
|── src #директория
|   └── index.php # файл (метаданные: ['type' => 'text/php'])
├── phpunit.xml # файл (метаданные: ['type' => 'text/xml'])
└── assets # директория (метаданные: ['owner' => 'root', 'hidden' => false])
   └── util # директория
       └── cli # директория
           └── LICENSE # файл


*/

//Мое решение:


<?php

namespace App\generator;

use function Php\Immutable\Fs\Trees\trees\mkdir;
use function Php\Immutable\Fs\Trees\trees\mkfile;

function generator()
{
  $tree = mkdir('php-package', [
      mkfile('Makefile'),
      mkfile('README.md'),
      mkdir('dist'),
      mkdir('tests', [
          mkfile('test.php', ['type' => 'text/php']),
      ]),
      mkdir('src', [
          mkfile('index.php', ['type' => 'text/php']),
      ]),
      mkfile('phpunit.xml', ['type' => 'text/xml']),
      mkdir('assets', [
          mkdir('util', [
              mkdir('cli', [
                  mkfile('LICENSE'),
              ]),
          ]),
      ], ['owner' => 'root', 'hidden' => false]),
  ], ['hidden' => true]);

  return $tree;
}