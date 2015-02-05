<?php

namespace App\Controller;

use App\Controller\AppController;

class PagesController extends AppController {

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);

        $this->Auth->allow();
    }

    public function index() {
        
    }

    public function what() {
        
    }

}
