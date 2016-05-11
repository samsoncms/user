<?php
namespace samsoncms\app\user;

use samsonphp\i18n\IDictionary;

class Dictionary implements IDictionary
{
    public function getDictionary()
    {
        return array(
            "en" => array(
                "Пользователи системы" => 'Users',
                "Пользователи" => 'Users',
                "Пользователь" => 'User',
                'Имя' => 'Name',
                'Фамилия' => 'Surname',
                'Отчество' => 'Middle name'
            ),
            "ru" => array(
                "Пользователи системы" => '',
                "Пользователи" => '',
                'Имя' => '',
                'Фамилия' => '',
                'Отчество' => ''
            ),
            "ua" => array(
                "Пользователи системы" => 'Користувачі',
                "Пользователи" => 'Користувачі',
                "Пользователь" => 'Користувач',
                'Имя' => "Ім'я",
                'Фамилия' => 'Прізвище',
                'Отчество' => 'По батькові'
            ),
        );
    }
}
