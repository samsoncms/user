<?php

namespace samsoncms\app\user\field;

use samsonframework\core\RenderInterface;
use samsonframework\orm\QueryInterface;
use samsoncms\field\Generic;

/**
 * Overridden full name field
 * @package samsoncms\app\user
 */
class Group extends Generic
{
    /** @inheritdoc */
    public function render(RenderInterface $renderer, QueryInterface $query, $object)
    {
        $groupSelect = '';
        $groups = dbQuery('group')->cond('Active', 1)->exec();
        foreach ($groups as $group) {
            $groupSelect .= $group->GroupID.':'.$group->Name.',';
        }
        if (sizeof($groupSelect)) {
            $groupSelect = substr($groupSelect, 0, -1);
        }

        // Set view
        $renderer = $renderer->view($this->innerView);
        $renderer->set(
            m('samsoncms_input_application')->createFieldByType(
                $query,
                4,
                $object,
                $this->name
            )->build($groupSelect),
            'field'
        );

        // Render input field view
        return $renderer
            ->set('class', $this->css)
            ->set($object, 'item')
            ->output();
    }
}