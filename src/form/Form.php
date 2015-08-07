<?php
/**
 * Created by PhpStorm.
 * User: onysko
 * Date: 27.05.2015
 * Time: 13:07
 */
namespace samsoncms\app\user\form;

use samsoncms\app\user\form\tab\Entity;
use samsonframework\core\RenderInterface;
use samsonframework\orm\QueryInterface;
use samsonframework\orm\Record;

/**
 * User SamsonCMS application form
 * @package samsoncms\app\user\form
 */
class Form extends \samsoncms\form\Form
{
    /** @inheritdoc */
    public function __construct(RenderInterface $renderer, QueryInterface $query, Record $entity)
    {
        // Add user entity tab
        $this->tabs = array(
            new Entity($renderer, $query, $entity)
        );

        parent::__construct($renderer, $query, $entity);
    }
}
