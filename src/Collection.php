<?php
/**
 * Created by PhpStorm.
 * User: egorov
 * Date: 11.04.2015
 * Time: 9:58
 */
namespace samsoncms\app\user;

use samsoncms\app\user\field\FullName;
use samsonframework\core\RenderInterface;
use samsonframework\orm\QueryInterface;
use samsonframework\pager\PagerInterface;
use samsoncms\field\Generic;
use samsoncms\field\Control;

/**
 * Collection of SamsonCMS users
 * @package samsoncms\app\user
 */
class Collection extends \samsoncms\Collection
{
    /**
     * Overload default constructor
     * @param RenderInterface $renderer View renderer
     * @param QueryInterface $query Database query
     * @param PagerInterface $pager Paging
     */
    public function __construct(RenderInterface $renderer, QueryInterface $query, PagerInterface $pager)
    {
        // Fill collection fields
        $this->fields = array(
            new Generic('UserID', '#', 0, 'id', false),
            /*new Generic('FName', t('Имя', true), 0),
            new Generic('SName', t('Фамилия', true), 0),
            new Generic('TName', t('Отчество', true), 0),*/
            new FullName(),
            new Generic('Modyfied', t('Последнее изменение', true), 3),
            new Control(),
        );

        // Call parent
        parent::__construct($renderer, $query, $pager);

        // Apply sorting by identifier
        $this->sorter($this->entityPrimaryField, 'DESC');

        // Fill collection on creation
        $this->fill();
    }
}
