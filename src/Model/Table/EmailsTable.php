<?php

namespace App\Model\Table;

use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;

/**
 * Hunts Model
 */
class EmailsTable extends Table {

    public function initialize(array $config) {
        $this->table(false);
    }

    private function getUser($id) {

        if (!isset($id)) {
            return "This method requires 1 argument";
        }

        $users = TableRegistry::get('Users');
        $query = $users
                ->find()->where(['Users.id' => $id])
                ->first();

        return $query;
    }

    public function welcome($userId) {

        if (!isset($userId)) {
            return "This method requires 1 argument";
        }

        $user = $this->getUser($userId);

        if (!$user) {
            return false;
        }

        $email = new Email();
        $email->transport('default')
                ->from(['gm@vgphotohunt.com' => 'Game Master'])
                ->to($user->email)
                ->subject('VGPhotohunt - Please Confirm Your Account')
                ->template('welcome')
                ->viewVars([
                    'token' => $user->confirmation_token,
                    'username' => $user->username
                ])
                ->send();

        return true;
    }

    public function resetPass($email) {

        if (!isset($email)) {
            return false;
        }

        $users = TableRegistry::get('Users');

        $user = $users->find()
                ->where(['Users.email' => $email])
                ->first();

        if (!isset($user)) {
            return false;
        }

        $msg = new Email();
        $msg->transport('default')
                ->from(['gm@vgphotohunt.com' => 'Game Master'])
                ->to($user->email)
                ->subject('VGPhotohunt - Reset Your Password')
                ->template('resetPass')
                ->viewVars([
                    'token' => $user->confirmation_token,
                    'username' => $user->username
                ])
                ->send();

        return true;
    }

}
