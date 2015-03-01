<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Awards Controller
 *
 * @property \App\Model\Table\AwardsTable $Awards
 */
class AwardsController extends AppController {

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function adminAdd() {
        
    $this->adminOnly();

        $award = $this->Awards->newEntity();

        if ($this->request->is('post')) {
            $award = $this->Awards->patchEntity($award, $this->request->data);
            if ($this->Awards->save($award)) {
                $this->Flash->success('The award has been saved.');
                return $this->redirect(['controller' => 'Admin' ,'action' => 'awards']);
            } else {
                $this->Flash->error('The award could not be saved. Please, try again.');
            }
        }
        
        $this->set('users', $this->Awards->Users->find('list', [
                'idField' => 'id',
                'valueField' => 'username'
            ]));
        $this->set('portraits', $this->Awards->Portraits->find('list', [
                'idField' => 'id',
                'valueField' => 'name'
            ]));
    }
    
    public function adminEdit($id = null) {

	$this->adminOnly();

        $award = $this->Awards->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $award = $this->Awards->patchEntity($award, $this->request->data);
            if ($this->Awards->save($award)) {
                $this->Flash->success('Saved!');
                return $this->redirect(['action' => 'adminEdit', $id]);
            } else {
                $this->Flash->error('The award could not be saved. Please, try again.');
            }
        }
        $this->set('award', $award);
        $this->set('users', $this->Awards->Users->find('list', [
                'idField' => 'id',
                'valueField' => 'username'
            ]));
        $this->set('portraits', $this->Awards->Portraits->find('list', [
                'idField' => 'id',
                'valueField' => 'name'
            ]));
    }
    
    public function adminDelete($id = null) {

	$this->adminOnly();

        $entity = $this->Awards->get($id);
        if ($this->Awards->delete($entity)) {
            $this->Flash->success('Deleted!');
        } else {
            $this->Flash->error('Failed!');
        }

        return $this->redirect($this->referer());    
    }
}
