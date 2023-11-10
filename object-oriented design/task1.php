

/*
Валидация - процесс проверки корректности данных. В вебе происходит всегда при отправке форм, например, регистрация на многих сайтах проверяет корректность введенного емейла, его уникальность (что такого пользователя ещё нет).

Каждый тип валидации в таких системах (на PHP) обычно представлен классом-валидатором, который принимает на вход опции и предоставляет интерфейс в виде функции validate(). Эта функция принимает на вход то что проверяется (валидируется) и возвращает массив с ошибками. Если массив пустой, значит ошибок нет.

src\PasswordValidator.php
Реализуйте класс PasswordValidator ориентируясь на тесты.

Этот валидатор поддерживает следующие опции:

minLength (по-умолчанию 8) - минимальная длина пароля
containNumbers (по-умолчанию false) - требование содержать хотя бы одну цифру
Массив ошибок в ключах содержит название опции, а в значении текст указывающий на ошибку (тексты можно подсмотреть в тестах)
*/



<?php

namespace App;

class PasswordValidator
{
    private const OPTIONS = [
        'minLength' => 8,
        'containNumbers' => false
    ];

    private $option;

    public function __construct($option = [])
    {
        $this->option = array_merge(self::OPTIONS, $option);
    }
    public function validate($password)
    {
        $errors = [];
        if (mb_strlen($password) < $this->option['minLength']) {
            $errors['minLength'] = 'too small';
        }
        if ($this->option['containNumbers']) {
            if (!$this->hasNumber($password)) {
                $errors['containNumbers'] = 'should contain at least one number';
            }
        }
        return $errors;
    }
    
    private function hasNumber(string $subject): bool
    {
        return strpbrk($subject, '1234567890') !== false;
    }
}
