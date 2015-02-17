<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Marks Controller
 *
 * @property \App\Model\Table\MarksTable $Marks
 */
class MarksController extends AppController {

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

        return $this->redirect($this->referer());
    }
    
    public function adminAdd() {
        if ($this->Auth->user('roles') != "admin") {
            return $this->redirect(['controller' => 'admin', 'action' => 'dashboard']);
        }
        $mark = $this->Marks->newEntity();

        if ($this->request->is('post')) {
            $mark = $this->Marks->patchEntity($mark, $this->request->data);
            if ($this->Marks->save($mark)) {
                $this->Flash->success('The mark has been saved.');
                return $this->redirect(['controller' => 'Admin' ,'action' => 'marks']);
            } else {
                $this->Flash->error('The mark could not be saved. Please, try again.');
            }
        }
        
        $this->set('hunts', $this->Marks->Hunts->find('list', [
                'idField' => 'id',
                'valueField' => 'name',
            //    'groupField' => 'game_id'  Doesn't work. Can't figure out why. BV 2/16
            ]));
        
    }
    
    public function adminEdit($id = null) {
        if ($this->Auth->user('roles') != "admin") {
            return $this->redirect(['controller' => 'admin', 'action' => 'dashboard']);
        }

        $mark = $this->Marks->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mark = $this->Marks->patchEntity($mark, $this->request->data);
            if ($this->Marks->save($mark)) {
                $this->Flash->success('Saved!');
                return $this->redirect(['action' => 'adminEdit', $id]);
            } else {
                $this->Flash->error('The mark could not be saved. Please, try again.');
            }
        }
        $this->set('mark', $mark);
        $this->set('hunts', $this->Marks->Hunts->find('list'));
        $this->set('users', $this->Marks->Users->find('list'));
    }
    
    public function adminDelete($id = null) {
        if ($this->Auth->user('roles') != "admin") {
            return $this->redirect(['controller' => 'admin', 'action' => 'dashboard']);
        }

        $entity = $this->Marks->get($id);
        if ($this->Marks->delete($entity)) {
            $this->Flash->success('Deleted!');
        } else {
            $this->Flash->error('Failed!');
        }

        return $this->redirect($this->referer());
        
    }

}
