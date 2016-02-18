<?php
namespace samsoncms\app\user\field;

use samsonframework\core\RenderInterface;
use samsonframework\orm\QueryInterface;
use samsoncms\form\field\Generic;

/**
 * Overridden group field
 * @package samsoncms\app\user
 */
class FormGroup extends Generic
{
    /** @inheritdoc */
    public function render(RenderInterface $renderer, QueryInterface $query, $object)
    {
        // Get all available groups from db
        $groupSelect = array();
        foreach ($query->className('group')->cond('Active', 1)->exec() as $group) {
            $groupSelect[] = $group->GroupID.':'.$group->Name;
        }

        // Set view
        return $renderer->view($this->innerView)
            ->set($this->css, 'class')
            ->set($object, 'item')
            ->set(
                m('samsoncms_input_application')->createFieldByType(
                    $query,
                    4,
                    $object,
                    $this->name
                )->build(implode(',', $groupSelect)),
                'field'
            )->output();
    }
}