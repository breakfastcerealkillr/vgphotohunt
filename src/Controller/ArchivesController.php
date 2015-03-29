<?php

namespace App\Controller;

use App\Controller\AppController;

class ArchivesController extends AppController {

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);


    }

    public function initialize() {
        parent::initialize();

        $this->loadComponent('Paginator');
    }
    
    public function index() {



    }

    public function byGame() {
        $this->paginate = ['finder' => 'byGame', 'limit' => 3];
        $this->set('pics', $this->paginate('Pictures'));
    }
    
    public function byHunt() {
        $this->paginate = ['finder' => 'byHunt', 'limit' => 3];
        $this->set('pics', $this->paginate('Pictures'));
    }
    
    public function byMark() {
        $this->paginate = ['finder' => 'byMark', 'limit' => 3];
        $this->set('pics', $this->paginate('Pictures'));
    }
    
    public function byDate() {
        $this->paginate = ['finder' => 'byDate', 'limit' => 3];
        $this->set('pics', $this->paginate('Pictures'));
    }
}