<?php
/**
 * Created by PhpStorm.
 * User: egorov
 * Date: 21.04.2015
 * Time: 14:52
 */
namespace samsoncms\app\user\field;

use samsonframework\core\RenderInterface;
use samsonframework\orm\QueryInterface;
use samsoncms\field\Generic;

/**
 * Overridden full name field
 * @package samsoncms\app\user
 */
class FullName extends Generic
{
    /** @var string Path to field view file */
    protected $innerView = 'www/collection/field/fullname';

    /**  Overload parent constructor and pass needed params there */
    public function __construct()
    {
        parent::__construct('fio', t('ФИО', true), 0, 'fio', false);
    }
}
