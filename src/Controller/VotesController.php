<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Votes Controller
 *
 * @property \App\Model\Table\VotesTable $Votes
 */
class VotesController extends AppController {

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function adminAdd() {
        
    $this->adminOnly();

        $vote = $this->Votes->newEntity();

        if ($this->request->is('post')) {
            $vote = $this->Votes->patchEntity($vote, $this->request->data);
            if ($this->Votes->save($vote)) {
                $this->Flash->success('The vote has been saved.');
                return $this->redirect(['controller' => 'Admin' ,'action' => 'votes']);
            } else {
                $this->Flash->error('The vote could not be saved. Please, try again.');
            }
        }
        
        $this->set('users', $this->Votes->Users->find('list', [
                'idField' => 'id',
                'valueField' => 'username'
            ]));
        $this->set('pictures', $this->Votes->Pictures->find('list'));
        $this->set('marks', $this->Votes->Marks->find('list'));
    }
    
    public function adminEdit($id = null) {

	$this->adminOnly();

        $vote = $this->Votes->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vote = $this->Votes->patchEntity($vote, $this->request->data);
            if ($this->Votes->save($vote)) {
                $this->Flash->success('Saved!');
                return $this->redirect(['action' => 'adminEdit', $id]);
            } else {
                $this->Flash->error('The vote could not be saved. Please, try again.');
            }
        }
        $this->set('vote', $vote);
        $this->set('users', $this->Votes->Users->find('list', [
                'idField' => 'id',
                'valueField' => 'username'
            ]));
        $this->set('portraits', $this->Votes->Pictures->find('list'));
        $this->set('marks', $this->Votes->Marks->find('list'));
    }
    
    public function adminDelete($id = null) {

	$this->adminOnly();

        $entity = $this->Votes->get($id);
        if ($this->Votes->delete($entity)) {
            $this->Flash->success('Deleted!');
        } else {
            $this->Flash->error('Failed!');
        }

        return $this->redirect($this->referer());    
    }
}
