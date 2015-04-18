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

        
    }

    /**
     * View method
     *
     * @param string|null $id Hunt id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {

        $userdata = $this->Auth->user();

        $this->user_id = $userdata['id'];
        
        
        if ($id != null) {
            $hunt = $this->Hunts->get($id);
            $this->set('hunt', $hunt);
            $this->set('status', $this->Hunts->getStatus($id));
            
            $this->loadModel('Marks');
            $this->set('marks', $this->Marks->findByHunt($id, $this->user_id));
            
        }
        else {
            
            $this->set('openhunts', $this->Hunts->findOpenHunts());
            $this->set('openvotes', $this->Hunts->findOpenVotes());
            $this->set('pasthunts', $this->Hunts->findPastHunts());
            
        }
        
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
