<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $user_id;

    /*
     * Bootstrap helpers
     */
    public $helpers = [
        'Html' => [
            'className' => 'Bootstrap3.BootstrapHtml'
        ],
        'Form' => [
            'className' => 'Bootstrap3.BootstrapForm'
        ],
        'Paginator' => [
            'className' => 'Bootstrap3.BootstrapPaginator'
        ],
        'Modal' => [
            'className' => 'Bootstrap3.BootstrapModal'
        ]
    ];

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * @return void
     */
    public function initialize() {

        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'username', 'password' => 'password']
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ]
        ]);
    }

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);

        $this->Auth->allow([
            'index',
            'view',
            'dashboard', 
            'register', 
            'verify', 
            'forgotPass',
            'resetPass'
            ]);

        $userdata = $this->Auth->user();
        $this->user_id = $userdata['id'];
        // Temporary way to break data away from auth cache and update. Running every page = bad, though....
        $this->loadModel('Users');
        $this->loadModel('Notifications');
        if (!empty($userdata)) {
            $user = $this->Users->get($userdata['id']);
            $this->set('user_id', $user->id);
            $this->set('username', $user->username);
            $this->set('loggedin', true);
            $this->set('timezone', $user->timezone);
            $this->set('avatar', $user->avatar);
            $this->set('current_portrait', $user->current_portrait);
            $this->set('level', $user->level);
            $this->set('current_user', $user);
            $this->set('unread', $this->Notifications->findUnread($user->id)->count());
        } else {
            $this->set('loggedin', false);
            $this->set('username', false);
            $this->set('user_id', false);
            $this->set('timezone', null);
        }
    }

    public function adminOnly(array $redirect = null) {

        if (!isset($redirect)) {
            $redirect = $this->referer();
        }

        if ($this->Auth->user('roles') !== "admin" && $this->view !== "index") {
            $this->Flash->error('No no no! Not today!');
            return $this->redirect($redirect);
        }
    }

}
