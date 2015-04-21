<?php
/**
 * Created by PhpStorm.
 * User: egorov
 * Date: 21.04.2015
 * Time: 14:52
 */
namespace samsoncms\app\user;

use samsonframework\core\RenderInterface;
use samsonframework\orm\QueryInterface;

/**
 * Overided control field
 * @package samsoncms\app\user
 */
class ControlField extends \samsoncms\CollectionField
{
    /** @var string CSS class */
    protected $css = 'control';

    /** @var string Disable editing */
    protected $editable = false;

    /** @var string Path to field view file */
    protected $view = 'www/controlfield';

    /**
     * Render collection entity field inner block
     * @param RenderInterface $renderer
     * @param QueryInterface $query
     * @param mixed $object Entity object instance
     * @return string Rendered entity field
     */
    public function render(RenderInterface $renderer, QueryInterface $query, $object)
    {
        // Render input field view
        return $renderer
            ->view($this->view)
            ->set('class', $this->css)
            ->set($object, 'item')
            ->output();
    }
}
