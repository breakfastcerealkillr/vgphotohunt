<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Sets Controller
 *
 * @property \App\Model\Table\SetsTable $Sets
 */
class SetsController extends AppController {

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

        $this->set('sets', $this->Sets->findWithStatus());
    }

    /**
     * View method
     *
     * @param string|null $id Set id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {

        $this->loadModel('Pictures');

        $set = $this->Sets->viewWithStatus($id);
        $this->set('set', $set);

        $completed = $this->Sets->completed($id, $this->user_id);
        $this->set('completed', $completed);
    }

    public function open($game = null) {

        $this->set('sets', $this->Sets->findOpenSets($game));

        $this->render('index');
    }

    public function openvotes($game = null) {

        $this->set('sets', $this->Sets->findOpenVotes($game));

        $this->render('index');
    }

    public function archives() {

        $this->set('sets', $this->Sets->findWithStatus());

        $this->render('index');
    }

}
