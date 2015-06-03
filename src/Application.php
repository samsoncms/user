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
    public $name = 'Пользователи';

    /** Application description */
    public $description = 'Пользователи системы';

    /** @var string Application icon */
    public $icon = 'user';

    /** @var string Module identifier */
    protected $id = 'user';

    /** @var string Module identifier */
    protected $entity = 'user';

    protected $formClassName = '\samsoncms\app\user\form\Form';

    public function init(array $params = array())
    {
        \samsonphp\event\Event::subscribe('samson.cms.input.change', array($this, 'inputUpdateHandler'));
    }

    public function inputUpdateHandler(& $object, $param, $prev, $response = null)
    {
        if ($object instanceof user) {
            $object->md5_email = $param == 'email' ? md5($object->email) : $object->md5_email;
        }
    }

    /**
     * Render users form
     * @return array Asynchronous response array
     */
    public function __async_edit2($userID = null)
    {
        return array(
            'status'    =>1,
            'html'  => $this->view('form/form')
                ->user(dbQuery('user')
                    ->cond('user_id', $userID)
                    ->first())
                ->output()
        );
    }

    /** Save user data */
    public function __async_save()
    {
        // If form has been sent
        if (isset($_POST)) {

            // Create or find user depending on UserID passed
            /** @var \samson\activerecord\user $db_user */
            $db_user = null;
            if (!dbQuery('user')->cond('user_id', $_POST['user_id'])->cond('active', 1)->first($db_user)) {
                $db_user = new \samson\activerecord\user(false);
            }
            // Save user data from form
            $db_user->created 	    = ( $_POST['created'] == 0 ) ? date('Y-m-d H:i:s') : $_POST['created'];
            $db_user->f_name 	    = $_POST['f_name'];
            $db_user->s_name 	    = $_POST['s_name'];
            $db_user->t_name 	    = $_POST['t_name'];
            $db_user->email 	    = $_POST['email'];
            $db_user->md5_password 	= ($_POST['password'] != '') ? md5($_POST['password']) : $db_user->md5_password;
            $db_user->md5_email 	= md5($_POST['email']);
            $db_user->active		= 1;
            $db_user->save();

            // TODO: This has to be changed to Events
            // Refresh session user object
            $auth_user_id = unserialize($_SESSION[m('socialemail')->identifier()]);
            if ($auth_user_id['user_id'] == $db_user['user_id']) {
                m('socialemail')->update($db_user);
            }
        }

        return array ('status' => 1);
    }

    /**
     * Delete user from table
     * @param $userID
     *
     * @return array
     */
    public function __async_remove2($identifier)
    {
        $user = null;

        if (dbQuery('user')->cond('user_id', $identifier)->first($user)) {
            $user->delete();
        }

        return array(
            'status'=>1
        );
    }
}
