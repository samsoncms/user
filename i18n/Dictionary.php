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
                "Пользователь" => 'User'
            ),
            "ru" => array(
                "Пользователи системы" => '',
                "Пользователи" => ''
            ),
            "ua" => array(
                "Пользователи системы" => 'Користувачі',
                "Пользователи" => 'Користувачі',
                "Пользователь" => 'Користувач'
            ),
        );
    }
}
