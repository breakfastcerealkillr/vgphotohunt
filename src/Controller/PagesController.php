<?php

namespace App\Controller;

use App\Controller\AppController;

class PagesController extends AppController {

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);

        $this->Auth->allow();
    }

    public function index() {
        
    $this->loadModel('News');
    $this->set('news', $this->News->findNewest(null, 3));
    
    $this->loadModel('Marks');
    $this->set('winners', $this->Marks->findWinners());
    
    $this->loadModel('Hunts');
    $this->set('openhunts', $this->Hunts->findOpenHunts());
    $this->set('openvotes', $this->Hunts->findOpenVotes());
    }

    public function what() {
        
    }

}
