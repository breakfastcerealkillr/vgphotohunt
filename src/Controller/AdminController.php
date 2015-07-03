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
        
        // There might be a better way to do this....
        $this->loadModel('Users');
        $this->loadModel('Games');
        $this->loadModel('Hunts');
        $this->loadModel('Marks');
        $this->loadModel('Pictures');
        $this->loadModel('Votes');
        $this->loadModel('PictureComments');
        
        $this->set('totalusers', $this->Users->find('all')->count());
        $this->set('totalpics', $this->Pictures->find('all')->count());
        $this->set('totalgames', $this->Games->find('all')->count());
        $this->set('totalhunts', $this->Hunts->find('all')->count());
        $this->set('totalmarks', $this->Marks->find('all')->count());
        $this->set('totalvotes', $this->Votes->find('all')->count());
        $this->set('totalcomments', $this->PictureComments->find('all')->count());
        
        $this->set('topfive', $this->Users->find('all')->limit(5)->order(['level' => 'DESC', 'XP' => 'DESC']));
        
        $this->set('unresolved', $this->Marks->findUnresolved()->count());
        
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
            'contain' => ['Submissions.Users', 'Hunts.Games', 'Pictures'],
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
    
        public function suggestions() {

        $this->paginate = [
            'order' => ['Suggestions.id' => 'DESC']
        ];

        $this->set('suggestions', $this->paginate('Suggestions'));
    }
    
    public function notifications() {

        $this->paginate = [
            'contain' => ['Users'],
            'order' => ['Notifications.id' => 'DESC']
        ];

        $this->set('notifications', $this->paginate('Notifications'));
    }
}