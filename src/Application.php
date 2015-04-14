<?php
namespace samsoncms\app\user;

/**
 * Class Application
 * @package samson\cms\web\user
 */
class Application extends \samson\cms\App
{
    /** @var string Application name */
    public $name = 'Пользователи';

    /** @var string Application icon */
    public $icon = 'user';

    /** @var string Module identifier */
    protected $id = 'user';

    /** Universal controller action */
    public function __handler()
    {
        // Prepare view
        m()->view('index')
            ->title(t('Пользователи системы', true))
            ->set($this->__async_table());
    }

    /**
     * Render users list
     * @return array Asynchronous response array
     */
    public function __async_table()
    {
        $users = new Collection($this, dbQuery('user'));

        return array_merge(
            array('status' => 1),
            $users->toView('list_')
        );
    }

    /**
     * Render users form
     * @return array Asynchronous response array
     */
    public function __async_form($userID = null)
    {
        return array(
            'status'    =>1,
            'html'  => $this->view('form/form')
                ->user(dbQuery('user')
                    ->UserID($userID)
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
            if (!dbQuery('user')->UserID($_POST['UserID'])->Active(1)->first($db_user)) {
                $db_user = new \samson\activerecord\user(false);
            }
            // Save user data from form
            $db_user->Created 	    = ( $_POST['Created'] == 0 ) ? date('Y-m-d H:i:s') : $_POST['Created'];
            $db_user->FName 	    = $_POST['FName'];
            $db_user->SName 	    = $_POST['SName'];
            $db_user->TName 	    = $_POST['TName'];
            $db_user->Password  	= $_POST['Password'];
            $db_user->Email 	    = $_POST['Email'];
            $db_user->md5_password 	= md5($_POST['Password']);
            $db_user->md5_email 	= md5($_POST['Email']);
            $db_user->Active		= 1;
            $db_user->save();

            // Refresh session user object
            $auth_id = unserialize($_SESSION[m('socialemail')->identifier()]);
            if ($auth_user_id['UserID'] == $db_user['UserID']) {
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
    public function __async_delete($userID)
    {
        $user = null;

        if (dbQuery('user')->UserID($userID)->first($user)) {
            $user->delete();
        }

        return array(
            'status'=>1
        );
    }
}
