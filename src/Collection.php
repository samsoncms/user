<?php
/**
 * Created by PhpStorm.
 * User: egorov
 * Date: 11.04.2015
 * Time: 9:58
 */
namespace samsoncms\app\user;


class Collection extends \samsonos\cms\collection\Generic
{
    public function __construct($query)
    {
        // Store query for table "user"
        $this->query = $query->className('user');

        $this->fill();
    }

    public function fill()
    {
        $this->collection = $this->query->exec();
    }
}
