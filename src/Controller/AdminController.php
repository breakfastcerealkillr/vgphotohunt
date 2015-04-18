<?php

namespace App\Controller;

use App\Controller\AppController;

class AdminController extends AppController {

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);

        $this->adminOnly(['action' => 'index']);
        $pageLimit = 10;
        $this->set('pageLimit', $pageLimit);
    }

    public function initialize() {
        parent::initialize();

        $this->loadComponent('Paginator');
	$this->adminOnly(['controller' => 'Admin', 'action' => 'index']);
    }
    
    public function index() {


        if ($this->request->is('post')) {

            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->Flash->success('Logged In!');
                return $this->redirect(['action' => 'dashboard']);
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function dashboard() {
        
    }

    public function games() {

        $this->paginate = [
            'order' => ['Games.id' => 'DESC']
        ];

        $this->set('games', $this->paginate('Games'));
    }

    public function hunts() {
        
        $this->paginate = [
            'contain' => ['Games'],
            'order' => ['Hunts.id' => 'DESC']
        ];

        $this->set('hunts', $this->paginate('Hunts'));
    }

    public function marks() {
        
        $this->paginate = [
            'contain' => ['Hunts', 'Hunts.Games', 'Submissions.Users', 'Winners'],
            'order' => ['Marks.id' => 'DESC']
        ];

        $this->set('marks', $this->paginate('Marks'));
    }

    public function users() {

        if (isset($this->request->query['status'])) {
            $finder = $this->request->query['status'];
        } else {
            $finder = 'enabled';
        }

        $this->paginate = [
            'finder' => $finder,
            'order' => ['Users.id' => 'DESC']
        ];

        $this->set('users', $this->paginate('Users'));
    }

    public function pictures() {

        $this->paginate = [
            'contain' => ['Users', 'Marks', 'Marks.Hunts'],
            'order' => ['Pictures.id' => 'DESC']
        ];

        $this->set('pictures', $this->paginate('Pictures'));
    }

    public function pictureComments() {

        $this->paginate = [
            'contain' => ['Users', 'Pictures'],
            'order' => ['PictureComments.id' => 'DESC']
        ];

        $this->set('picturecomments', $this->paginate('PictureComments'));
    }
    
    public function news() {

        $this->paginate = [
            'contain' => ['Users'],
            'order' => ['News.id' => 'DESC']
        ];

        $this->set('news', $this->paginate('News'));
    }
    
    public function newsComments() {

        $this->paginate = [
            'contain' => ['News', 'Users'],
            'order' => ['NewsComments.id' => 'DESC']
        ];

        $this->set('newscomments', $this->paginate('NewsComments'));
    }
    
    public function awards() {

        $this->paginate = [
            'contain' => ['Users', 'Portraits'],
            'order' => ['Awards.id' => 'DESC']
        ];

        $this->set('awards', $this->paginate('Awards'));
    }
    
    public function portraits() {

        $this->paginate = [
            'order' => ['Pictures.id' => 'DESC']
        ];

        $this->set('portraits', $this->paginate('Portraits'));
    }
    
    public function votes() {

        $this->paginate = [
            'contain' => ['Users', 'Pictures', 'Marks'],
            'order' => ['Votes.id' => 'DESC']
        ];

        $this->set('votes', $this->paginate('Votes'));
    }
}