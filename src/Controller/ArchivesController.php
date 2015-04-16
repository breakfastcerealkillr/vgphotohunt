<?php

namespace App\Controller;

use App\Controller\AppController;

class ArchivesController extends AppController {

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();

    }

    public function initialize() {
        parent::initialize();
        $this->loadComponent('Paginator');
    }
    
    public function index() {



    }

    public function byGame($id = null) {
        $this->loadModel('Pictures');
        
        $query = $this->Pictures->findByGame($id);
        $this->paginate = ['limit' => 30];
        $this->set('pics', $this->paginate($query));
    }
    
    public function byHunt($id = null) {
        $this->loadModel('Pictures');
        
        $query = $this->Pictures->findByHunt($id);
        $this->paginate = ['limit' => 30];
        $this->set('pics', $this->paginate($query));
    }
    
    public function byMark($id = null) {
        $this->loadModel('Pictures');
        
        $query = $this->Pictures->findByMark($id);
        $this->paginate = ['limit' => 30];
        $this->set('pics', $this->paginate($query));
    }
    
    public function byDate() {
        $this->loadModel('Pictures');
        
        $query = $this->Pictures->findByDate();
        $this->paginate = ['limit' => 30];
        $this->set('pics', $this->paginate($query));
    }
}