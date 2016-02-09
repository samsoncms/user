<?php
namespace samsoncms\app\user;

use samson\activerecord\user;

/**
 * Class Application
 * @package samson\cms\web\user
 */
class Application extends \samsoncms\Application
{
    /** @var string Application name */
    public $name = 'Пользователь';

    /** Application description */
    public $description = 'Пользователи системы';

    /** @var string Application icon */
    public $icon = 'user';

    /** @var string Module identifier */
    protected $id = 'user';

    /** @var string Module identifier */
    protected $entity = '\samson\activerecord\user';

    /** @var string Form class */
    protected $formClassName = '\samsoncms\app\user\form\Form';

    /** Module initialization */
    public function init(array $params = array())
    {
        // Subscribe to input change event
        \samsonphp\event\Event::subscribe('samson.cms.input.change', array($this, 'inputUpdateHandler'));
    }

    /**
     * New entity creation generic controller action
     * @param int $parentID Parent identifier
     */
    public function __new($parentID = null)
    {
        /** @var user $entity */
        $entity = new $this->entity();

        // Persist
        $entity->group_id = 1;
        $entity->save();

        // Go to correct form URL
        url()->redirect($this->system->module('cms')->baseUrl.'/'.$this->id . '/form/' . $entity->id);
    }

    /**
     * Input field saving handler
     * @param \samsonframework\orm\Record $object
     * @param string $param Field
     * @param string $previousValue Previous object field value
     * @param string $response Response
     */
    public function inputUpdateHandler(& $object, $param, $previousValue, $response = null)
    {
        // Work only when event fired for User database record
        if ($object instanceof \samson\activerecord\user && isset($object->md5_email)) {
            $object->md5_email = $param == 'email' ? md5($object->email) : $object->md5_email;
            if ($param == 'md5_password') {
                $object->md5_password = md5($object->md5_password);
            }

            // Refresh session user object on any field change
            /*$auth_user_id = unserialize($_SESSION[m('socialemail')->identifier()]);
            if ($auth_user_id['user_id'] == $object['user_id']) {
                m('socialemail')->update($object);
            }*/
        }
    }
    
    /**
     * User entity delete controller action
     * @param int $identifier Entity identifier
     * @return array Asynchronous response array
     */
    public function __async_remove2($identifier)
    {
        if (!dbQuery('material')->cond('UserID', $identifier)->cond('Active', 1)->first()) {
            return parent::__async_remove2($identifier);
        }
        else {
            return array('status' => 1, 'error_message' => t('Пока у этого пользователя есть материалы, его удаление невозможно.', true));
        }
    }
}
