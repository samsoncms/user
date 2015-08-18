<?php
namespace samsoncms\app\user\field;

/**
 * Overridden group field
 * @package samsoncms\app\user
 */
class TableGroup extends FormGroup
{
    /** @var string Path to field view file */
    protected $innerView = 'www/collection/field/generic';

    /** @var string Path to field view file */
    protected $headerView = 'www/collection/field/header';
}