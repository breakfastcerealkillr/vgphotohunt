<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Hunts Controller
 *
 * @property \App\Model\Table\HuntsTable $Hunts
 */
class HuntsController extends AppController {

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);

        $this->Auth->allow();
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {

        $this->set('hunts', $this->Hunts->findWithStatus());
    }

    /**
     * View method
     *
     * @param string|null $id Hunt id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {

        $this->loadModel('Pictures');

        $this->set('hunts', $this->Hunts->viewWithStatus($id));

        $this->set('completed', $this->Hunts->completed($id, $this->user_id));
    }

    public function open($game = null) {

        $this->set('hunts', $this->Hunts->findOpen($game));

        $this->render('index');
    }

    public function openvotes($game = null) {

        $this->set('hunts', $this->Hunts->findOpenVotes($game));

        $this->render('index');
    }

    public function archives() {

        $this->set('hunts', $this->Hunts->findWithStatus());

        $this->render('index');
    }

}
