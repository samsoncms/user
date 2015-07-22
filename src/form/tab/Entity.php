<?php
/**
 * Created by PhpStorm.
 * User: onysko
 * Date: 27.05.2015
 * Time: 13:07
 */
namespace samsoncms\app\user\form\tab;

use samsoncms\app\user\field\FormGroup;
use samsoncms\form\field\Generic;
use samsonframework\core\RenderInterface;
use samsonframework\orm\QueryInterface;
use samsonframework\orm\Record;

class Entity extends \samsoncms\form\tab\Entity
{
    /** @var string Tab name or identifier */
    protected $name = 'Главная';

    /** @inheritdoc */
    public function __construct(RenderInterface $renderer, QueryInterface $query, Record $entity)
    {
        $this->fields = array(
            new Generic('f_name', t('Имя', true), 0),
            new Generic('s_name', t('Фамилия', true), 0),
            new Generic('t_name', t('Отчество', true), 0),
            new Generic('email', t('Email', true), 0),
            new FormGroup('group_id', t('Группа', true))
        );

        // Call parent constructor to define all class fields
        parent::__construct($renderer, $query, $entity);
    }
}
