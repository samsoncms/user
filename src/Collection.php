<?php
/**
 * Created by PhpStorm.
 * User: egorov
 * Date: 11.04.2015
 * Time: 9:58
 */
namespace samsoncms\app\user;

use samsonos\cms\collection\Generic;
use samsonframework\core\RenderInterface;
use samsonframework\orm\QueryInterface;

/**
 * Collection of SamsonCMS users
 * @package samsoncms\app\user
 */
class Collection extends Generic
{
    public $indexView = 'www/list/index';
    public $itemView = 'www/list/item/index';
    public $emptyView = 'www/list/item/empty';
    public $entityName = 'samson\activerecord\user';

    public function __construct(RenderInterface $renderer, QueryInterface $query)
    {
        parent::__construct($renderer, $query);

        // Store query for table "user"
        $this->query = $query->className($this->entityName);

        $this->fill();
     }

    public function fill()
    {
        $this->collection = $this->query->order_by('UserID')->exec();
    }
}
