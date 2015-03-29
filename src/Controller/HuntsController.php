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

    public function adminAdd() {
        if ($this->Auth->user('roles') != "admin") {
            return $this->redirect(['controller' => 'admin', 'action' => 'dashboard']);
        }
        $hunt = $this->Hunts->newEntity();

        if ($this->request->is('post')) {
            $hunt = $this->Hunts->patchEntity($hunt, $this->request->data);
            if ($this->Hunts->save($hunt)) {
                $this->Flash->success('The hunt has been saved.');
                return $this->redirect(['controller' => 'Admin' ,'action' => 'hunts']);
            } else {
                $this->Flash->error('The hunt could not be saved. Please, try again.' . $hunt);
            }
        }
        
        $this->set('games', $this->Hunts->Games->find('list'));
        
    }
    
    public function adminEdit($id = null) {
        if ($this->Auth->user('roles') != "admin") {
            return $this->redirect(['controller' => 'admin', 'action' => 'dashboard']);
        }

        $hunt = $this->Hunts->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hunt = $this->Hunts->patchEntity($hunt, $this->request->data);
            if ($this->Hunts->save($hunt)) {
                $this->Flash->success('Saved!');
                return $this->redirect(['action' => 'adminEdit', $id]);
            } else {
                $this->Flash->error('The hunt could not be saved. Please, try again.');
            }
        }
        $this->set('hunt', $hunt);
        $this->set('games', $this->Hunts->Games->find('list'));
    }
    
    public function adminDelete($id = null) {
        if ($this->Auth->user('roles') != "admin") {
            return $this->redirect(['controller' => 'admin', 'action' => 'dashboard']);
        }

        $entity = $this->Hunts->get($id);
        if ($this->Hunts->delete($entity)) {
            $this->Flash->success('Deleted!');
        } else {
            $this->Flash->error('Failed!');
        }

        return $this->redirect($this->referer());    
    }
    
}
