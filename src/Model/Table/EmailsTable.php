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

        $this->loadModel('Users');
        $query = $this->Users
                ->find()->where(['Users.id' => $id])
                ->first();

        return $query;
    }

    public function welcome($userId) {

        if (!isset($userId)) {
            return "This method requires 1 argument";
        }

        $user = $this->getUser($userId);

        $email = new Email();
        $email->from(['gm@vgphotohunt.com' => 'Game Master'])
                ->to($user->email)
                ->subject('Please Confirm Your Account')
                ->template('welcome')
                ->viewVars(['token' => $user->confirmation_token])
                ->send();
    }

}
